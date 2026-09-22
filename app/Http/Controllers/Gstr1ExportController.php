<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Gstr1ExportController extends Controller
{
    /**
     * Display the GST & Forex reconciliation dashboard.
     */
    public function index()
    {
        $userId = Auth::id();

        // 1. Fetch distinct months of invoices for the export dropdown selector
        // Use SUBSTRING for broad DB compatibility (MySQL, MariaDB, SQLite via SUBSTR)
        $months = Invoice::where('user_id', $userId)
            ->where('type', 'invoice')
            ->selectRaw("SUBSTRING(invoice_date, 1, 7) as month_val")
            ->distinct()
            ->orderByDesc('month_val')
            ->pluck('month_val');

        // If no records but user exists, default to current month
        if ($months->isEmpty()) {
            $months = collect([date('Y-m')]);
        }

        // 2. Fetch all foreign currency invoices for the interactive reconciliation selector
        $foreignInvoices = Invoice::with(['client', 'payment'])
            ->where('user_id', $userId)
            ->where('type', 'invoice')
            ->where('currency_code', '!=', 'INR')
            ->orderBy('invoice_date', 'desc')
            ->get();

        return view('gstr1.index', compact('months', 'foreignInvoices'));
    }

    /**
     * Export the monthly GSTR-1 compliant invoice ledger as CSV.
     */
    public function export(Request $request)
    {
        $request->validate([
            'month' => ['required', 'regex:/^\d{4}-\d{2}$/']
        ]);

        $userId = Auth::id();
        $monthStr = $request->month; // YYYY-MM
        [$year, $month] = explode('-', $monthStr);

        // Fetch invoices for that month, ordered by date.
        // GST GSTR-1 filing pulls strictly based on Invoice Date & Locked INR Invoice Value.
        $invoices = Invoice::with(['client', 'payment'])
            ->where('user_id', $userId)
            ->where('type', 'invoice')
            ->whereYear('invoice_date', $year)
            ->whereMonth('invoice_date', $month)
            ->orderBy('invoice_date', 'asc')
            ->get();

        if ($invoices->isEmpty()) {
            return redirect()->back()->with('error', "No invoices found for the month of {$monthStr}.");
        }

        $fileName = "GSTR1_Export_{$monthStr}.csv";

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename={$fileName}",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use($invoices) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for Excel UTF-8 display
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // Write CSV headers
            fputcsv($file, [
                'Invoice Number',
                'Invoice Date',
                'Client Name',
                'Client GSTIN/VAT',
                'GST Supply Type',
                'Invoice Currency',
                'Foreign Amount',
                'Exchange Rate (Locked)',
                'Taxable Value (INR)',
                'Tax Amount (INR)',
                'Total Invoice Value (INR)',
                'Payment Status',
                'Payment Date',
                'FIRC Ref Number',
                'Actual Received (INR)',
                'Forex Gain/Loss (INR)'
            ]);

            foreach ($invoices as $invoice) {
                $currency = $invoice->currency_code;
                $isForeign = ($currency !== 'INR');
                
                // For GSTR-1, Taxable Value and Totals must be in INR
                $rate = floatval($invoice->exchange_rate_inr ?? 1.0);
                $taxableValueInr = $isForeign 
                    ? ($invoice->subtotal * $rate) 
                    : $invoice->subtotal;

                $taxAmountInr = $isForeign 
                    ? ($invoice->tax_amount * $rate) 
                    : $invoice->tax_amount;

                $totalValueInr = $isForeign 
                    ? ($invoice->grand_total * $rate) 
                    : $invoice->grand_total;

                // Retrieve Payment Receipt record if present
                $payment = $invoice->payment;
                $paymentDate = $payment ? $payment->payment_date->format('Y-m-d') : '—';
                $fircNumber = !empty($payment?->firc_number) ? $payment->firc_number : (!empty($invoice->firc_number) ? $invoice->firc_number : '—');
                $actualReceived = !empty($payment?->inr_amount_received) ? $payment->inr_amount_received : (!empty($invoice->actual_inr_received) ? $invoice->actual_inr_received : '—');
                
                if ($payment) {
                    $forexDiff = $payment->forex_gain_loss;
                } else if ($invoice->actual_inr_received) {
                    $forexDiff = floatval($invoice->actual_inr_received) - floatval($invoice->inr_equivalent);
                } else {
                    $forexDiff = '—';
                }

                fputcsv($file, [
                    $invoice->invoice_number,
                    optional($invoice->invoice_date)->format('Y-m-d') ?? '',
                    optional($invoice->client)->name ?? 'N/A',
                    optional($invoice->client)->gst_number ?? 'N/A',
                    $isForeign ? 'Export under LUT (0%)' : 'Domestic Supply',
                    $currency,
                    $isForeign ? number_format($invoice->grand_total, 2, '.', '') : '—',
                    $isForeign ? number_format($rate, 4, '.', '') : '1.0000',
                    number_format($taxableValueInr, 2, '.', ''),
                    number_format($taxAmountInr, 2, '.', ''),
                    number_format($totalValueInr, 2, '.', ''),
                    strtoupper($invoice->status),
                    $paymentDate,
                    $fircNumber,
                    is_numeric($actualReceived) ? number_format($actualReceived, 2, '.', '') : $actualReceived,
                    is_numeric($forexDiff) ? number_format($forexDiff, 2, '.', '') : $forexDiff
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
