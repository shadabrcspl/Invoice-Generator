@extends('layouts.app')

@section('title', 'Expense Ledger')
@section('header_title', 'Business Expense Tracker')

@section('content')
<div class="container-fluid p-0 d-flex flex-column gap-4">
    
    <!-- Summary Cards -->
    <div class="row g-4">
        <div class="col-12 col-md-6">
            <div class="premium-card d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase text-muted fw-bold mb-1" style="font-size: 11px; letter-spacing: 0.08em;">Total Expenses (Filtered)</p>
                    <h3 class="metric-value text-danger" style="font-size: 28px; font-weight: 800;">₹{{ number_format($totalExpensesSum, 2) }}</h3>
                    <span class="text-muted fs-7">Sum of outgoing expenses in scope</span>
                </div>
                <div class="metric-icon" style="background-color: #fff1f2; color: #e11d48; height: 52px; width: 52px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 22px;">
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="premium-card d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase text-muted fw-bold mb-1" style="font-size: 11px; letter-spacing: 0.08em;">Available GST ITC Credits</p>
                    <h3 class="metric-value text-success" style="font-size: 28px; font-weight: 800;">₹{{ number_format($totalItcSum, 2) }}</h3>
                    <span class="text-muted fs-7">Accumulated Input Tax Credit</span>
                </div>
                <div class="metric-icon" style="background-color: #ecfdf5; color: #10b981; height: 52px; width: 52px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 22px;">
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Header & Filter Form -->
    <div class="premium-card">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
            <div>
                <h4 class="m-0 fs-5 mb-1">Expense Entries</h4>
                <p class="text-muted fs-7 m-0">Log operational cost statements, upload billing receipts, and track GST claims.</p>
            </div>
            
            <div class="d-flex flex-wrap align-items-center gap-2">
                <a href="{{ route('expenses.export', request()->query()) }}" class="btn btn-outline-success rounded-pill px-3 fw-semibold d-inline-flex align-items-center gap-2">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Export to Excel
                </a>
                <a href="{{ route('expenses.create') }}" class="btn btn-primary rounded-pill px-4 fw-semibold border-0" style="background: linear-gradient(135deg, #0284c7, #2563eb);">
                    + Record Expense
                </a>
            </div>
        </div>

        <hr class="my-4 text-muted opacity-25">

        <!-- Filters Form -->
        <form method="GET" action="{{ route('expenses.index') }}" class="m-0">
            <div class="row g-3">
                <div class="col-12 col-md-3">
                    <label class="form-label fw-semibold text-muted fs-7">Search</label>
                    <input type="text" name="search" class="form-control rounded-3" placeholder="Search Vendor or Payment..." value="{{ request('search') }}">
                </div>
                
                <div class="col-12 col-md-2">
                    <label class="form-label fw-semibold text-muted fs-7">Category</label>
                    <select name="category" class="form-select rounded-3">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-3 col-lg-2">
                    <label class="form-label fw-semibold text-muted fs-7">Start Date</label>
                    <input type="date" name="start_date" class="form-control rounded-3" value="{{ request('start_date') }}">
                </div>

                <div class="col-12 col-md-3 col-lg-2">
                    <label class="form-label fw-semibold text-muted fs-7">End Date</label>
                    <input type="date" name="end_date" class="form-control rounded-3" value="{{ request('end_date') }}">
                </div>

                <div class="col-12 col-md-2 col-lg-3 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary rounded-3 w-100 fw-semibold" style="background-color: var(--color-primary); border-color: var(--color-primary);">Filter</button>
                    <a href="{{ route('expenses.index') }}" class="btn btn-light rounded-3 w-100 fw-semibold text-dark">Reset</a>
                </div>
            </div>
        </form>
    </div>

    <!-- Expenses Table -->
    <div class="premium-card">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr class="fs-7 text-uppercase text-muted fw-bold">
                        <th>Date</th>
                        <th>Vendor Details</th>
                        <th>Category</th>
                        <th class="text-end">Base Amount</th>
                        <th class="text-end">Taxes (CGST/SGST/IGST)</th>
                        <th class="text-end">Total Amount</th>
                        <th>ITC Claim?</th>
                        <th>Receipt</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($expenses as $expense)
                        <tr>
                            <td>{{ $expense->expense_date->format('d-M-Y') }}</td>
                            <td>
                                <div class="fw-semibold">{{ $expense->vendor_name }}</div>
                                @if($expense->vendor_gstin)
                                    <div class="text-muted fs-8">GSTIN: <span class="badge bg-light text-secondary border border-secondary-subtle px-2 py-0.5">{{ $expense->vendor_gstin }}</span></div>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border border-slate-200 rounded px-2.5 py-1">{{ $expense->category }}</span>
                            </td>
                            <td class="text-end fw-medium">₹{{ number_format($expense->base_amount, 2) }}</td>
                            <td class="text-end text-muted fs-7">
                                @if($expense->cgst > 0 || $expense->sgst > 0 || $expense->igst > 0)
                                    @if($expense->igst > 0)
                                        IGST: ₹{{ number_format($expense->igst, 2) }}
                                    @else
                                        CGST: ₹{{ number_format($expense->cgst, 2) }}<br>
                                        SGST: ₹{{ number_format($expense->sgst, 2) }}
                                    @endif
                                @else
                                    —
                                @endif
                            </td>
                            <td class="text-end fw-bold text-dark">₹{{ number_format($expense->total_amount, 2) }}</td>
                            <td>
                                @if($expense->is_itc_eligible)
                                    <span class="badge rounded-pill bg-success-subtle text-success border border-success-subtle px-2.5 py-1 text-uppercase fw-semibold" style="font-size: 10px;">ITC ON</span>
                                @else
                                    <span class="badge rounded-pill bg-secondary-subtle text-secondary border border-secondary-subtle px-2.5 py-1 text-uppercase fw-semibold" style="font-size: 10px;">ITC OFF</span>
                                @endif
                            </td>
                            <td>
                                @if($expense->receipt_url)
                                    <a href="{{ Storage::url($expense->receipt_url) }}" target="_blank" class="btn btn-link btn-sm text-primary p-0 d-flex align-items-center gap-1 fw-semibold text-decoration-none">
                                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        View
                                    </a>
                                @else
                                    <span class="text-muted fs-7">—</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-light btn-sm rounded-pill px-3">Edit</a>
                                    
                                    <form method="POST" action="{{ route('expenses.destroy', $expense->id) }}" class="m-0" onsubmit="return confirm('Are you sure you want to delete this expense entry?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-5">
                                <svg class="mb-3 text-muted" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                                <p class="m-0 fw-semibold">No expenses recorded</p>
                                <p class="fs-7 text-muted">Keep your accounting clean by recording business expenditures.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($expenses->hasPages())
            <div class="mt-4 d-flex justify-content-center">
                {{ $expenses->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
