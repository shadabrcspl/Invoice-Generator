<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Http\Requests\StoreExpenseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userId = Auth::id();
        $query = Expense::where('user_id', $userId);

        // Date range filter
        if ($request->filled('start_date')) {
            $query->whereDate('expense_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('expense_date', '<=', $request->end_date);
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Search vendor/payment mode
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('vendor_name', 'like', "%{$search}%")
                  ->orWhere('payment_mode', 'like', "%{$search}%");
            });
        }

        $expenses = $query->orderBy('expense_date', 'desc')->paginate(15);
        
        // Get unique categories for filter dropdown
        $categories = Expense::where('user_id', $userId)->distinct()->pluck('category');

        // Total sum of expenses in the selected scope
        $totalExpensesSum = $query->sum('total_amount');
        
        // Total ITC credit in the selected scope
        $totalItcSum = $query->where('is_itc_eligible', true)
            ->selectRaw('SUM(cgst + sgst + igst) as total')
            ->value('total') ?? 0;

        return view('expenses.index', compact('expenses', 'categories', 'totalExpensesSum', 'totalItcSum'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('expenses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseRequest $request)
    {
        $validated = $request->validated();
        
        if ($request->hasFile('receipt')) {
            $path = $request->file('receipt')->store('receipts', 'public');
            $validated['receipt_url'] = $path;
        }

        $validated['is_itc_eligible'] = $request->has('is_itc_eligible');

        Auth::user()->expenses()->create($validated);

        return redirect()->route('expenses.index')->with('success', 'Expense recorded successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        $this->authorize('update', $expense);
        return view('expenses.edit', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreExpenseRequest $request, Expense $expense)
    {
        $this->authorize('update', $expense);
        $validated = $request->validated();

        if ($request->hasFile('receipt')) {
            // Delete old file if exists
            if ($expense->receipt_url) {
                Storage::disk('public')->delete($expense->receipt_url);
            }
            $path = $request->file('receipt')->store('receipts', 'public');
            $validated['receipt_url'] = $path;
        }

        $validated['is_itc_eligible'] = $request->has('is_itc_eligible');

        $expense->update($validated);

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        $this->authorize('delete', $expense);

        if ($expense->receipt_url) {
            Storage::disk('public')->delete($expense->receipt_url);
        }

        $expense->delete();

        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully!');
    }

    /**
     * Export expenses to an Excel-compatible CSV file.
     */
    public function export(Request $request)
    {
        $userId = Auth::id();
        $query = Expense::where('user_id', $userId);

        // Apply filters matching the index view
        if ($request->filled('start_date')) {
            $query->whereDate('expense_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('expense_date', '<=', $request->end_date);
        }
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('vendor_name', 'like', "%{$search}%")
                  ->orWhere('payment_mode', 'like', "%{$search}%");
            });
        }

        $expenses = $query->orderBy('expense_date', 'desc')->get();

        if ($expenses->isEmpty()) {
            return redirect()->back()->with('error', 'No expenses found to export for the selected criteria.');
        }

        $timestamp = now()->format('Ymd_His');
        $fileName = "Business_Expenses_{$timestamp}.csv";

        $headers = [
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename={$fileName}",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use ($expenses) {
            $file = fopen('php://output', 'w');

            // Add UTF-8 BOM so Microsoft Excel renders Indian Rupee and special characters properly
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // Write CSV Header Row
            fputcsv($file, [
                'Expense Date',
                'Vendor Name',
                'Vendor GSTIN',
                'Expense Category',
                'Base Amount (INR)',
                'CGST (INR)',
                'SGST (INR)',
                'IGST (INR)',
                'Total Tax (INR)',
                'Total Amount (INR)',
                'Payment Mode',
                'ITC Claim Eligible',
                'Receipt Link'
            ]);

            foreach ($expenses as $expense) {
                $totalTax = floatval($expense->cgst) + floatval($expense->sgst) + floatval($expense->igst);
                $receiptInfo = $expense->receipt_url ? url(Storage::url($expense->receipt_url)) : 'None';

                fputcsv($file, [
                    $expense->expense_date ? $expense->expense_date->format('Y-m-d') : '',
                    $expense->vendor_name ?? 'N/A',
                    $expense->vendor_gstin ?: '—',
                    $expense->category ?? 'General',
                    number_format($expense->base_amount, 2, '.', ''),
                    number_format($expense->cgst, 2, '.', ''),
                    number_format($expense->sgst, 2, '.', ''),
                    number_format($expense->igst, 2, '.', ''),
                    number_format($totalTax, 2, '.', ''),
                    number_format($expense->total_amount, 2, '.', ''),
                    $expense->payment_mode ?: 'N/A',
                    $expense->is_itc_eligible ? 'YES' : 'NO',
                    $receiptInfo
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
