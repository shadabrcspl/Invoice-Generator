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
</style>
@endsection

@section('content')
<div class="container-fluid p-0 d-flex flex-column gap-4">
    
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
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr class="fs-7 text-uppercase text-muted fw-bold">
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
                        <tr>
                            <td class="fw-semibold">
                                {{ $invoice->invoice_number }}
                                @if($invoice->type === 'quotation')
                                    <span class="badge bg-teal-subtle text-teal-800 border border-teal-200 rounded-pill px-2 py-1 fs-9 ms-1" style="background-color: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; font-size: 10px; font-weight: 600;">QUO</span>
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
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-light btn-sm rounded-pill px-3">View</a>
                                    <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-light btn-sm rounded-pill px-3">Edit</a>
                                    <a href="{{ route('invoices.pdf', $invoice->id) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">PDF</a>
                                    <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this {{ $invoice->type === 'quotation' ? 'quotation' : 'invoice' }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">
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

        @if($invoices->hasPages())
            <div class="mt-4 d-flex justify-content-center">
                {{ $invoices->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
