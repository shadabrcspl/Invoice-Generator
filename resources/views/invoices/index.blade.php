@extends('layouts.app')

@section('title', $type === 'quotation' ? 'Quotation Management' : 'Invoice Management')
@section('header_title', $type === 'quotation' ? 'Quotation Management' : 'Invoice Management')

@section('styles')
<style>
    .badge-status {
        padding: 5px 12px;
        font-size: 11px;
        font-weight: 700;
        border-radius: 30px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        display: inline-block;
    }
    .badge-paid {
        background-color: #ecfdf5;
        color: #059669;
        border: 1px solid #a7f3d0;
    }
    .badge-sent {
        background-color: #eff6ff;
        color: #1d4ed8;
        border: 1px solid #bfdbfe;
    }
    .badge-draft {
        background-color: #f1f5f9;
        color: #475569;
        border: 1px solid #cbd5e1;
    }
    .badge-overdue {
        background-color: #fff1f2;
        color: #e11d48;
        border: 1px solid #fecdd3;
    }
    .row-status-paid { border-left: 4px solid #10b981 !important; }
    .row-status-sent { border-left: 4px solid #0284c7 !important; }
    .row-status-overdue { border-left: 4px solid #ef4444 !important; }
    .row-status-draft { border-left: 4px solid #94a3b8 !important; }
</style>
@endsection

@section('content')
<div class="container-fluid p-0 d-flex flex-column gap-4">

    <!-- Financial KPI Summary Strip -->
    @if(isset($kpiStats))
    <div class="row g-3">
        <!-- Total Invoiced / Billed -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="premium-card p-3 d-flex align-items-center justify-content-between h-100" style="border-left: 4px solid #0284c7 !important;">
                <div>
                    <span class="fs-8 fw-bold text-uppercase text-muted">{{ $type === 'quotation' ? 'Total Proposals' : 'Total Billed Value' }}</span>
                    <h4 class="fw-extrabold text-dark m-0 mt-1">₹{{ number_format($kpiStats['totalInvoicedSum'], 2) }}</h4>
                    <span class="fs-8 text-muted">{{ $kpiStats['totalCount'] }} {{ Str::plural($type === 'quotation' ? 'quote' : 'invoice', $kpiStats['totalCount']) }}</span>
                </div>
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: #e0f2fe; color: #0284c7; font-size: 20px;">
                    💳
                </div>
            </div>
        </div>

        <!-- Paid / Settled -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="premium-card p-3 d-flex align-items-center justify-content-between h-100" style="border-left: 4px solid #10b981 !important;">
                <div>
                    <span class="fs-8 fw-bold text-uppercase text-success">{{ $type === 'quotation' ? 'Accepted Orders' : 'Paid & Settled' }}</span>
                    <h4 class="fw-extrabold text-success m-0 mt-1">₹{{ number_format($kpiStats['paidSum'], 2) }}</h4>
                    <span class="fs-8 text-muted">{{ $kpiStats['paidCount'] }} {{ $type === 'quotation' ? 'accepted' : 'settled' }} ({{ $kpiStats['totalCount'] > 0 ? round(($kpiStats['paidCount'] / $kpiStats['totalCount']) * 100) : 0 }}%)</span>
                </div>
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: #dcfce7; color: #16a34a; font-size: 20px;">
                    ✅
                </div>
            </div>
        </div>

        <!-- Pending / Sent -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="premium-card p-3 d-flex align-items-center justify-content-between h-100" style="border-left: 4px solid #f59e0b !important;">
                <div>
                    <span class="fs-8 fw-bold text-uppercase text-warning-emphasis">{{ $type === 'quotation' ? 'Awaiting Client' : 'Pending Payment' }}</span>
                    <h4 class="fw-extrabold text-warning-emphasis m-0 mt-1">₹{{ number_format($kpiStats['pendingSum'], 2) }}</h4>
                    <span class="fs-8 text-muted">{{ $kpiStats['pendingCount'] }} in pipeline</span>
                </div>
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: #fef3c7; color: #d97706; font-size: 20px;">
                    ⏳
                </div>
            </div>
        </div>

        <!-- Overdue -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="premium-card p-3 d-flex align-items-center justify-content-between h-100" style="border-left: 4px solid #ef4444 !important;">
                <div>
                    <span class="fs-8 fw-bold text-uppercase text-danger">{{ $type === 'quotation' ? 'Expired' : 'Overdue / Follow-up' }}</span>
                    <h4 class="fw-extrabold text-danger m-0 mt-1">₹{{ number_format($kpiStats['overdueSum'], 2) }}</h4>
                    <span class="fs-8 text-muted">{{ $kpiStats['overdueCount'] }} past deadline</span>
                </div>
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: #fee2e2; color: #dc2626; font-size: 20px;">
                    ⚠️
                </div>
            </div>
        </div>
    </div>
    @endif
    
    <!-- Filter Card -->
    <div class="premium-card">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
            <div>
                <h4 class="m-0 fs-5 mb-1">{{ $type === 'quotation' ? 'Quotations Directory' : 'Invoices Directory' }}</h4>
                <p class="text-muted fs-7 m-0">Browse generated {{ $type === 'quotation' ? 'quotations, proformas, or track accepted orders.' : 'invoices, download PDFs, or track collection statuses.' }}</p>
            </div>
            
            <a href="{{ route('invoices.create', ['type' => $type]) }}" class="btn btn-primary rounded-pill px-4 fw-semibold border-0" style="background: linear-gradient(135deg, #0284c7, #2563eb);">
                + Create {{ $type === 'quotation' ? 'Quotation' : 'Invoice' }}
            </a>
        </div>

        <hr class="my-4 text-muted opacity-25">

        <!-- Search & Filter Forms -->
        <form method="GET" action="{{ route('invoices.index') }}" class="row g-3 m-0">
            <input type="hidden" name="type" value="{{ $type }}">
            
            <div class="col-12 col-lg-3 col-md-6">
                <input type="text" name="search" class="form-control rounded-pill px-4" placeholder="Search by number or client..." value="{{ request('search') }}">
            </div>
            
            <div class="col-12 col-lg-3 col-md-6">
                <select name="status" class="form-select rounded-pill px-4">
                    <option value="">All Statuses</option>
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                    @if($type === 'quotation')
                        <option value="sent" {{ request('status') === 'sent' ? 'selected' : '' }}>Sent / Unaccepted</option>
                        <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Accepted</option>
                    @else
                        <option value="sent" {{ request('status') === 'sent' ? 'selected' : '' }}>Sent / Unpaid</option>
                        <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Paid / Settled</option>
                        <option value="overdue" {{ request('status') === 'overdue' ? 'selected' : '' }}>Overdue</option>
                    @endif
                </select>
            </div>

            <div class="col-12 col-lg-2 col-md-4">
                <input type="{{ request('start_date') ? 'date' : 'text' }}" name="start_date" class="form-control rounded-pill px-4" value="{{ request('start_date') }}" placeholder="Start Date" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'">
            </div>

            <div class="col-12 col-lg-2 col-md-4">
                <input type="{{ request('end_date') ? 'date' : 'text' }}" name="end_date" class="form-control rounded-pill px-4" value="{{ request('end_date') }}" placeholder="End Date" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'">
            </div>

            <div class="col-12 col-lg-2 col-md-4">
                <button type="submit" class="btn btn-primary rounded-pill w-100 fw-semibold" style="background-color: var(--color-primary); border-color: var(--color-primary);">
                    Apply Filters
                </button>
            </div>
        </form>
    </div>

    <!-- Table Card -->
    <div class="premium-card">
        @if($type === 'invoice')
            <form id="consolidated-fema-form" method="POST" action="{{ route('invoices.fema-declaration.consolidated') }}" class="mb-3" style="display: none;">
                @csrf
                <div class="d-flex align-items-center justify-content-between p-3 rounded-3" style="background: linear-gradient(135deg, #1e3a5f, #0f172a); color: white;">
                    <div class="d-flex align-items-center gap-2">
                        <span style="font-size: 20px;">📄</span>
                        <span class="fw-semibold fs-7"><span id="selected-count">0</span> foreign currency invoices selected for monthly filing</span>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-warning btn-sm rounded-pill px-4 fw-bold text-dark">
                            📥 Download Consolidated FEMA 23(R) / EDF (.xlsx)
                        </button>
                    </div>
                </div>
            </form>
        @endif

        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr class="fs-7 text-uppercase text-muted fw-bold">
                        @if($type === 'invoice')
                            <th style="width: 40px;">
                                <input type="checkbox" id="select-all-fema" class="form-check-input" title="Select all foreign invoices">
                            </th>
                        @endif
                        <th>{{ $type === 'quotation' ? 'Quotation Number' : 'Invoice Number' }}</th>
                        <th>Client</th>
                        <th>Issue Date</th>
                        <th>Due Date</th>
                        <th>Grand Total</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($invoices as $invoice)
                        <tr class="{{ $invoice->status === 'paid' ? 'row-status-paid' : ($invoice->status === 'sent' ? 'row-status-sent' : ($invoice->status === 'overdue' ? 'row-status-overdue' : 'row-status-draft')) }}">
                            @if($type === 'invoice')
                                <td>
                                    @if($invoice->currency_code !== 'INR')
                                        <input type="checkbox" name="invoice_ids[]" value="{{ $invoice->id }}" form="consolidated-fema-form" class="form-check-input fema-checkbox" title="Select for consolidated FEMA filing">
                                    @else
                                        <span class="text-muted opacity-25">—</span>
                                    @endif
                                </td>
                            @endif
                            <td class="fw-semibold">
                                <a href="{{ route('invoices.show', $invoice->id) }}" class="text-decoration-none text-dark fw-bold hover-primary">
                                    {{ $invoice->invoice_number }}
                                </a>
                                @if($invoice->type === 'quotation')
                                    <span class="badge rounded-pill px-2 py-1 fs-9 ms-1" style="background-color: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; font-size: 10px; font-weight: 600;">QUO</span>
                                @elseif($invoice->type === 'credit_note')
                                    <span class="badge rounded-pill px-2 py-1 fs-9 ms-1" style="background-color: #fef2f2; color: #991b1b; border: 1px solid #fecaca; font-size: 10px; font-weight: 600;">CN</span>
                                @elseif($invoice->type === 'debit_note')
                                    <span class="badge rounded-pill px-2 py-1 fs-9 ms-1" style="background-color: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe; font-size: 10px; font-weight: 600;">DN</span>
                                @endif
                                @if($invoice->is_recurring)
                                    <span class="badge rounded-pill px-2 py-1 fs-9 ms-1" style="background-color: #faf5ff; color: #7e22ce; border: 1px solid #e9d5ff; font-size: 10px; font-weight: 600;" title="Recurring {{ ucfirst($invoice->recurring_frequency) }}">🔄 {{ ucfirst($invoice->recurring_frequency) }}</span>
                                @endif
                            </td>
                            <td class="fw-medium">{{ $invoice->client->name ?? 'N/A' }}</td>
                            <td class="text-muted">{{ $invoice->invoice_date->format('M d, Y') }}</td>
                            <td class="text-muted">{{ $invoice->due_date ? $invoice->due_date->format('M d, Y') : '—' }}</td>
                            <td class="fw-bold">{{ $invoice->currency_symbol }}{{ number_format($invoice->grand_total, 2) }}</td>
                            <td>
                                @if($invoice->type === 'quotation')
                                    @if($invoice->status === 'paid')
                                        <span class="badge-status" style="background-color:#e0f2fe; color:#0369a1; border:1px solid #bae6fd;">ACCEPTED</span>
                                    @elseif($invoice->status === 'sent')
                                        <span class="badge-status badge-sent">SENT</span>
                                    @else
                                        <span class="badge-status badge-draft">DRAFT</span>
                                    @endif
                                @else
                                    <span class="badge-status badge-{{ $invoice->status }}">{{ $invoice->status }}</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex align-items-center gap-1">
                                    <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-light btn-sm rounded-pill px-3 fw-semibold text-dark border shadow-xs" title="View details">
                                        View
                                    </a>
                                    <a href="{{ route('invoices.pdf', $invoice->id) }}" class="btn btn-outline-primary btn-sm rounded-pill px-2 py-1" title="Download PDF">
                                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                    </a>
                                    <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-outline-secondary btn-sm rounded-pill px-2 py-1" title="Edit">
                                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this {{ $invoice->type === 'quotation' ? 'quotation' : 'invoice' }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-2 py-1" title="Delete">
                                            <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ $type === 'invoice' ? 8 : 7 }}" class="text-center text-muted py-5">
                                <svg class="mb-3 text-muted" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="m-0 fw-semibold">No matching {{ $type === 'quotation' ? 'quotations' : 'invoices' }} found</p>
                                <p class="fs-7 text-muted">Modify filter selection or create a new {{ $type === 'quotation' ? 'quotation' : 'invoice' }}.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const selectAll = document.getElementById('select-all-fema');
                const checkboxes = document.querySelectorAll('.fema-checkbox');
                const banner = document.getElementById('consolidated-fema-form');
                const countLabel = document.getElementById('selected-count');

                function updateFemaState() {
                    const checkedCount = document.querySelectorAll('.fema-checkbox:checked').length;
                    if (countLabel) countLabel.textContent = checkedCount;
                    if (banner) {
                        banner.style.display = checkedCount > 0 ? 'block' : 'none';
                    }
                    if (selectAll) {
                        selectAll.checked = checkboxes.length > 0 && checkedCount === checkboxes.length;
                    }
                }

                if (selectAll) {
                    selectAll.addEventListener('change', function() {
                        checkboxes.forEach(cb => cb.checked = selectAll.checked);
                        updateFemaState();
                    });
                }

                checkboxes.forEach(cb => {
                    cb.addEventListener('change', updateFemaState);
                });
            });
        </script>

        @if($invoices->hasPages())
            <div class="mt-4 d-flex justify-content-center">
                {{ $invoices->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
