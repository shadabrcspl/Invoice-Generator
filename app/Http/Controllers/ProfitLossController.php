<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfitLossController extends Controller
{
    /**
     * Display the Profit & Loss statement with dual-lens (Accrual vs Realized Cash) metrics.
     */
    public function index(Request $request)
    {
        $userId = Auth::id();

        // 1. Gather all distinct months with activity across invoices, payments, and expenses
        $invoiceMonths = Invoice::where('user_id', $userId)
            ->where('type', 'invoice')
            ->whereNotNull('invoice_date')
            ->selectRaw("DISTINCT strftime('%Y-%m', invoice_date) as m")
            ->pluck('m')
            ->toArray();

        // Fallback for MySQL if running in production
        if (empty($invoiceMonths)) {
            $invoiceMonths = Invoice::where('user_id', $userId)
                ->where('type', 'invoice')
                ->whereNotNull('invoice_date')
                ->selectRaw("DISTINCT DATE_FORMAT(invoice_date, '%Y-%m') as m")
                ->pluck('m')
                ->toArray();
        }

        $paymentMonths = Payment::whereHas('invoice', fn($q) => $q->where('user_id', $userId))
            ->whereNotNull('payment_date')
            ->pluck('payment_date')
            ->map(fn($d) => Carbon::parse($d)->format('Y-m'))
            ->unique()
            ->toArray();

        $expenseMonths = Expense::where('user_id', $userId)
            ->whereNotNull('expense_date')
            ->pluck('expense_date')
            ->map(fn($d) => Carbon::parse($d)->format('Y-m'))
            ->unique()
            ->toArray();

        $allMonths = array_unique(array_merge($invoiceMonths, $paymentMonths, $expenseMonths));
        rsort($allMonths);

        // Determine current selected period (default to current month, or the latest month with activity)
        $defaultMonth = in_array(date('Y-m'), $allMonths) ? date('Y-m') : (!empty($allMonths) ? $allMonths[0] : date('Y-m'));
        $selectedPeriod = $request->input('period', $defaultMonth);
        $isFullYear = str_contains($selectedPeriod, 'FY-');

        // Navigation calculations (previous / next month)
        $prevMonth = null;
        $nextMonth = null;

        if (!$isFullYear) {
            $currentCarbon = Carbon::createFromFormat('Y-m', $selectedPeriod)->startOfMonth();
            $prevMonth = $currentCarbon->copy()->subMonth()->format('Y-m');
            $nextMonth = $currentCarbon->copy()->addMonth()->format('Y-m');
            $periodLabel = $currentCarbon->format('F Y');
            $startDate = $currentCarbon->copy()->startOfMonth()->toDateString();
            $endDate = $currentCarbon->copy()->endOfMonth()->toDateString();
        } else {
            // e.g. FY-2026-2027 => April 1, 2026 to March 31, 2027
            $years = explode('-', str_replace('FY-', '', $selectedPeriod));
            $periodLabel = "Financial Year {$years[0]}-" . ($years[1] ?? ($years[0] + 1));
            $startDate = "{$years[0]}-04-01";
            $endDate = ($years[1] ?? ($years[0] + 1)) . "-03-31";
        }

        // --- 2. Realized Cash Inflow (Bank Receipts in Period) ---
        $paymentsQuery = Payment::whereHas('invoice', fn($q) => $q->where('user_id', $userId))
            ->whereBetween('payment_date', [$startDate, $endDate])
            ->with(['invoice.client'])
            ->orderBy('payment_date', 'desc');

        $payments = $paymentsQuery->get();

        $totalRealizedInflow = (float) $payments->sum('inr_amount_received');
        $totalForexVariance  = (float) $payments->sum('forex_gain_loss');

        // Invoiced paper value of these specific settled invoices
        $invoicedValueOfSettled = (float) $payments->sum(function ($p) {
            if (!$p->invoice) {
                return (float) $p->inr_amount_received;
            }
            return (float) ($p->invoice->currency_code === 'INR'
                ? $p->invoice->grand_total
                : ($p->invoice->inr_equivalent ?? $p->inr_amount_received));
        });

        // --- 3. Accrual Invoiced Revenue (Invoices Issued in Period) ---
        $invoicesQuery = Invoice::where('user_id', $userId)
            ->where('type', 'invoice')
            ->whereBetween('invoice_date', [$startDate, $endDate])
            ->with(['client', 'payment'])
            ->orderBy('invoice_date', 'desc');

        $invoices = $invoicesQuery->get();

        $totalInvoicedRevenue = (float) $invoices->sum(function ($i) {
            return (float) ($i->currency_code === 'INR'
                ? $i->grand_total
                : ($i->inr_equivalent ?? $i->grand_total));
        });

        $invoicesPaidInPeriodCount = $invoices->where('status', 'paid')->count();
        $invoicesPendingCount      = $invoices->whereIn('status', ['sent', 'draft', 'overdue'])->count();
        $invoicesPendingAmount     = (float) $invoices->whereIn('status', ['sent', 'draft', 'overdue'])->sum(function ($i) {
            return (float) ($i->currency_code === 'INR' ? $i->grand_total : ($i->inr_equivalent ?? $i->grand_total));
        });

        // --- 4. Operating Expenses (Paid in Period) ---
        $expensesQuery = Expense::where('user_id', $userId)
            ->whereBetween('expense_date', [$startDate, $endDate])
            ->orderBy('expense_date', 'desc');

        $expenses = $expensesQuery->get();
        $totalExpenses = (float) $expenses->sum('total_amount');

        // Group expenses by category
        $categoryBreakdown = $expenses->groupBy('category')->map(function ($group, $category) use ($totalExpenses) {
            $catTotal = (float) $group->sum('total_amount');
            $percentage = $totalExpenses > 0 ? round(($catTotal / $totalExpenses) * 100, 1) : 0;
            return [
                'category'   => $category,
                'total'      => $catTotal,
                'count'      => $group->count(),
                'percentage' => $percentage,
            ];
        })->sortByDesc('total');

        // --- 5. Net Profit Calculations ---
        // A. True Realized Cash Profit (In-Hand Cash in Bank - Expenses Paid)
        $realizedNetProfit = $totalRealizedInflow - $totalExpenses;
        $realizedMarginPct = $totalRealizedInflow > 0 ? round(($realizedNetProfit / $totalRealizedInflow) * 100, 1) : 0;

        // B. Accrual / Booked Net Profit (Total Invoiced Revenue - Expenses)
        $accrualNetProfit = $totalInvoicedRevenue - $totalExpenses;
        $accrualMarginPct = $totalInvoicedRevenue > 0 ? round(($accrualNetProfit / $totalInvoicedRevenue) * 100, 1) : 0;

        // --- 6. Historical Trend (Last 6 Months for mini-chart or comparative table) ---
        $trends = [];
        for ($i = 5; $i >= 0; $i--) {
            $mCarbon = Carbon::createFromFormat('Y-m', !$isFullYear ? $selectedPeriod : date('Y-m'))->subMonths($i);
            $mKey = $mCarbon->format('Y-m');
            $mStart = $mCarbon->copy()->startOfMonth()->toDateString();
            $mEnd   = $mCarbon->copy()->endOfMonth()->toDateString();

            $mRealized = (float) Payment::whereHas('invoice', fn($q) => $q->where('user_id', $userId))
                ->whereBetween('payment_date', [$mStart, $mEnd])
                ->sum('inr_amount_received');

            $mExpenses = (float) Expense::where('user_id', $userId)
                ->whereBetween('expense_date', [$mStart, $mEnd])
                ->sum('total_amount');

            $mProfit = $mRealized - $mExpenses;

            $trends[] = [
                'key'      => $mKey,
                'label'    => $mCarbon->format('M Y'),
                'realized' => $mRealized,
                'expenses' => $mExpenses,
                'profit'   => $mProfit,
            ];
        }

        return view('profit_loss.index', compact(
            'selectedPeriod',
            'periodLabel',
            'isFullYear',
            'allMonths',
            'prevMonth',
            'nextMonth',
            'totalRealizedInflow',
            'totalInvoicedRevenue',
            'invoicedValueOfSettled',
            'totalForexVariance',
            'totalExpenses',
            'realizedNetProfit',
            'realizedMarginPct',
            'accrualNetProfit',
            'accrualMarginPct',
            'categoryBreakdown',
            'payments',
            'invoices',
            'expenses',
            'invoicesPendingCount',
            'invoicesPendingAmount',
            'trends'
        ));
    }
}
