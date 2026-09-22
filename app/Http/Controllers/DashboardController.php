<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the user dashboard with invoice statistics.
     */
    public function index()
    {
        $userId = Auth::id();

        // --- Core Metrics ---
        $totalInvoices      = Invoice::where('user_id', $userId)->where('type', 'invoice')->count();
        $paidInvoicesCount  = Invoice::where('user_id', $userId)->where('type', 'invoice')->where('status', 'paid')->count();
        $pendingInvoicesCount = Invoice::where('user_id', $userId)->where('type', 'invoice')->where('status', 'sent')->count();
        $draftInvoicesCount = Invoice::where('user_id', $userId)->where('type', 'invoice')->where('status', 'draft')->count();
        $overdueCount       = Invoice::where('user_id', $userId)->where('type', 'invoice')->where('status', 'overdue')->count();
        $quotationCount     = Invoice::where('user_id', $userId)->where('type', 'quotation')->count();

        // Revenue must be in INR — use inr_equivalent for foreign currency invoices, grand_total for INR invoices
        $totalRevenue = Invoice::where('user_id', $userId)
            ->where('type', 'invoice')
            ->where('status', 'paid')
            ->selectRaw('SUM(CASE WHEN currency_code = "INR" THEN grand_total ELSE COALESCE(inr_equivalent, grand_total) END) as total')
            ->value('total') ?? 0;

        $pendingRevenue = Invoice::where('user_id', $userId)
            ->where('type', 'invoice')
            ->whereIn('status', ['sent', 'draft'])
            ->selectRaw('SUM(CASE WHEN currency_code = "INR" THEN grand_total ELSE COALESCE(inr_equivalent, grand_total) END) as total')
            ->value('total') ?? 0;

        // Outgoing expenses in INR
        $totalExpenses = \App\Models\Expense::where('user_id', $userId)->sum('total_amount');
        $netProfit     = $totalRevenue - $totalExpenses;

        // --- Recent Invoices ---
        $recentInvoices = Invoice::with('client')
            ->where('user_id', $userId)
            ->where('type', 'invoice')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // --- Monthly Revenue Chart (last 12 months) ---
        $monthlyRevenue = [];
        $monthlyLabels  = [];
        $monthlyPaid    = [];
        $monthlyPending = [];

        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthlyLabels[] = $month->format('M Y');

            $paid = Invoice::where('user_id', $userId)
                ->where('status', 'paid')
                ->whereYear('invoice_date', $month->year)
                ->whereMonth('invoice_date', $month->month)
                ->sum('grand_total');

            $pending = Invoice::where('user_id', $userId)
                ->whereIn('status', ['sent', 'draft', 'overdue'])
                ->whereYear('invoice_date', $month->year)
                ->whereMonth('invoice_date', $month->month)
                ->sum('grand_total');

            $monthlyPaid[]    = round($paid, 2);
            $monthlyPending[] = round($pending, 2);
        }

        // --- Status Distribution for Donut Chart ---
        $statusDistribution = [
            'paid'    => $paidInvoicesCount,
            'sent'    => $pendingInvoicesCount,
            'draft'   => $draftInvoicesCount,
            'overdue' => $overdueCount,
        ];

        // --- Overdue Invoices (for alert list) ---
        $overdueInvoices = Invoice::with('client')
            ->where('user_id', $userId)
            ->where('status', 'overdue')
            ->orderBy('due_date', 'asc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalInvoices',
            'paidInvoicesCount',
            'pendingInvoicesCount',
            'draftInvoicesCount',
            'overdueCount',
            'quotationCount',
            'totalRevenue',
            'pendingRevenue',
            'totalExpenses',
            'netProfit',
            'recentInvoices',
            'monthlyLabels',
            'monthlyPaid',
            'monthlyPending',
            'statusDistribution',
            'overdueInvoices'
        ));
    }
}
