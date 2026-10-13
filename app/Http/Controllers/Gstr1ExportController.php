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

    /**
     * Export standard GSTR-1 JSON offline tool payload for direct upload to GST portal.
     */
    public function exportJson(Request $request)
    {
        $request->validate([
            'month' => ['required', 'regex:/^\d{4}-\d{2}$/']
        ]);

        $user = Auth::user();
        $userId = $user->id;
        $monthStr = $request->month; // YYYY-MM
        [$year, $month] = explode('-', $monthStr);

        $companySetting = $user->companySetting;
        $supplierGstin = $companySetting?->gst_number ?? '10BZUPA6699D1Z7';
        $supplierStateCode = substr($supplierGstin, 0, 2) ?: '10'; // Default 10 (Bihar)

        // GSTR-1 filing period format is MMYYYY e.g. 092026
        $fp = str_pad($month, 2, '0', STR_PAD_LEFT) . $year;

        // Fetch all invoices, credit notes, debit notes for that month
        $invoices = Invoice::with(['client', 'items', 'originalInvoice'])
            ->where('user_id', $userId)
            ->whereIn('type', ['invoice', 'credit_note', 'debit_note'])
            ->whereYear('invoice_date', $year)
            ->whereMonth('invoice_date', $month)
            ->orderBy('invoice_date', 'asc')
            ->get();

        if ($invoices->isEmpty()) {
            return redirect()->back()->with('error', "No invoices or notes found for the month of {$monthStr}.");
        }

        $b2bMap = []; // Grouped by client GSTIN
        $b2csMap = []; // Grouped by POS + Tax rate
        $expInvoices = []; // Export invoices (foreign currency / LUT)
        $cdnrMap = []; // Registered Credit/Debit notes
        $cdnur = []; // Unregistered Credit/Debit notes

        foreach ($invoices as $inv) {
            $currency = $inv->currency_code;
            $isForeign = ($currency !== 'INR');
            $rate = floatval($inv->exchange_rate_inr ?? 1.0);
            $invDateFormatted = $inv->invoice_date ? $inv->invoice_date->format('d-m-Y') : date('d-m-Y');

            $taxableInr = round($isForeign ? ($inv->subtotal * $rate) : $inv->subtotal, 2);
            $taxInr = round($isForeign ? ($inv->tax_amount * $rate) : $inv->tax_amount, 2);
            $totalInr = round($isForeign ? ($inv->grand_total * $rate) : $inv->grand_total, 2);

            $clientGstin = trim(optional($inv->client)->gst_number ?? '');
            // Check if valid Indian GSTIN (15 chars)
            $hasValidGstin = preg_match('/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/', $clientGstin);

            // Determine Place of Supply (POS)
            $clientCountry = optional($inv->client)->country ?? 'India';
            $clientStateCode = $hasValidGstin ? substr($clientGstin, 0, 2) : '96'; // 96 is Other Country
            $isInterstate = ($clientStateCode !== $supplierStateCode);

            // Item tax breakdown
            $itemTaxRate = 18.0; // default IT services rate
            if ($inv->items->isNotEmpty()) {
                $itemTaxRate = floatval($inv->items->first()->tax_percent ?? 18.0);
            }

            if ($inv->type === 'invoice') {
                if ($isForeign) {
                    // Export invoice under LUT (Zero-rated without payment of tax: WOPAY)
                    $expInvoices[] = [
                        'inum' => $inv->invoice_number,
                        'idt' => $invDateFormatted,
                        'val' => $totalInr,
                        'sbnum' => '',
                        'sbdt' => '',
                        'itms' => [
                            [
                                'txval' => $taxableInr,
                                'rt' => 0, // 0% under LUT
                                'iamt' => 0.0,
                                'csamt' => 0.0,
                            ]
                        ]
                    ];
                } elseif ($hasValidGstin) {
                    // B2B Registered Domestic Client
                    if (!isset($b2bMap[$clientGstin])) {
                        $b2bMap[$clientGstin] = [
                            'ctin' => $clientGstin,
                            'cfs' => 'Y',
                            'inv' => []
                        ];
                    }

                    $iamt = $isInterstate ? $taxInr : 0.0;
                    $camt = $isInterstate ? 0.0 : round($taxInr / 2, 2);
                    $samt = $isInterstate ? 0.0 : round($taxInr / 2, 2);

                    $b2bMap[$clientGstin]['inv'][] = [
                        'inum' => $inv->invoice_number,
                        'idt' => $invDateFormatted,
                        'val' => $totalInr,
                        'pos' => $clientStateCode,
                        'rchrg' => 'N',
                        'etin' => '',
                        'inv_typ' => 'R',
                        'itms' => [
                            [
                                'num' => 1,
                                'itm_det' => [
                                    'rt' => $itemTaxRate,
                                    'txval' => $taxableInr,
                                    'iamt' => $iamt,
                                    'camt' => $camt,
                                    'samt' => $samt,
                                    'csamt' => 0.0,
                                ]
                            ]
                        ]
                    ];
                } else {
                    // B2CS (Unregistered Domestic Client)
                    $splyTy = $isInterstate ? 'INTER' : 'INTRA';
                    $key = "{$splyTy}_{$clientStateCode}_{$itemTaxRate}";
                    if (!isset($b2csMap[$key])) {
                        $b2csMap[$key] = [
                            'sply_ty' => $splyTy,
                            'rt' => $itemTaxRate,
                            'typ' => 'OE',
                            'pos' => $clientStateCode,
                            'txval' => 0.0,
                            'iamt' => 0.0,
                            'camt' => 0.0,
                            'samt' => 0.0,
                            'csamt' => 0.0,
                        ];
                    }
                    $b2csMap[$key]['txval'] += $taxableInr;
                    if ($isInterstate) {
                        $b2csMap[$key]['iamt'] += $taxInr;
                    } else {
                        $b2csMap[$key]['camt'] += round($taxInr / 2, 2);
                        $b2csMap[$key]['samt'] += round($taxInr / 2, 2);
                    }
                }
            } elseif (in_array($inv->type, ['credit_note', 'debit_note'])) {
                // Credit Note (C) or Debit Note (D)
                $ntType = $inv->type === 'credit_note' ? 'C' : 'D';
                $origInvNumber = optional($inv->originalInvoice)->invoice_number ?: $inv->invoice_number;
                $origInvDate = optional($inv->originalInvoice)->invoice_date ? $inv->originalInvoice->invoice_date->format('d-m-Y') : $invDateFormatted;

                if ($hasValidGstin) {
                    // CDNR
                    if (!isset($cdnrMap[$clientGstin])) {
                        $cdnrMap[$clientGstin] = [
                            'ctin' => $clientGstin,
                            'cfs' => 'Y',
                            'nt' => []
                        ];
                    }
                    $iamt = $isInterstate ? $taxInr : 0.0;
                    $camt = $isInterstate ? 0.0 : round($taxInr / 2, 2);
                    $samt = $isInterstate ? 0.0 : round($taxInr / 2, 2);

                    $cdnrMap[$clientGstin]['nt'][] = [
                        'ntty' => $ntType,
                        'nt_num' => $inv->invoice_number,
                        'nt_dt' => $invDateFormatted,
                        'inum' => $origInvNumber,
                        'idt' => $origInvDate,
                        'val' => $totalInr,
                        'pos' => $clientStateCode,
                        'rchrg' => 'N',
                        'itms' => [
                            [
                                'num' => 1,
                                'itm_det' => [
                                    'rt' => $itemTaxRate,
                                    'txval' => $taxableInr,
                                    'iamt' => $iamt,
                                    'camt' => $camt,
                                    'samt' => $samt,
                                    'csamt' => 0.0,
                                ]
                            ]
                        ]
                    ];
                } else {
                    // CDNUR
                    $cdnur[] = [
                        'typ' => $isForeign ? 'EXPWOP' : 'B2CL',
                        'ntty' => $ntType,
                        'nt_num' => $inv->invoice_number,
                        'nt_dt' => $invDateFormatted,
                        'inum' => $origInvNumber,
                        'idt' => $origInvDate,
                        'val' => $totalInr,
                        'pos' => $clientStateCode,
                        'itms' => [
                            [
                                'num' => 1,
                                'itm_det' => [
                                    'rt' => $isForeign ? 0 : $itemTaxRate,
                                    'txval' => $taxableInr,
                                    'iamt' => $isForeign ? 0.0 : ($isInterstate ? $taxInr : 0.0),
                                    'camt' => $isForeign ? 0.0 : ($isInterstate ? 0.0 : round($taxInr / 2, 2)),
                                    'samt' => $isForeign ? 0.0 : ($isInterstate ? 0.0 : round($taxInr / 2, 2)),
                                    'csamt' => 0.0,
                                ]
                            ]
                        ]
                    ];
                }
            }
        }

        $payload = [
            'gstin' => $supplierGstin,
            'fp' => $fp,
            'version' => 'GST3.0.4',
            'hash' => 'hash',
        ];

        if (!empty($b2bMap)) {
            $payload['b2b'] = array_values($b2bMap);
        }
        if (!empty($b2csMap)) {
            $payload['b2cs'] = array_values($b2csMap);
        }
        if (!empty($expInvoices)) {
            $payload['exp'] = [
                [
                    'exp_typ' => 'WOPAY',
                    'inv' => $expInvoices
                ]
            ];
        }
        if (!empty($cdnrMap)) {
            $payload['cdnr'] = array_values($cdnrMap);
        }
        if (!empty($cdnur)) {
            $payload['cdnur'] = $cdnur;
        }

        $jsonContent = json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        $fileName = "GSTR1_{$supplierGstin}_{$fp}.json";

        return response($jsonContent, 200, [
            'Content-Type' => 'application/json',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ]);
    }
}
