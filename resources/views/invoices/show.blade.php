@extends('layouts.app')

@section('title', $invoice->type === 'quotation' ? 'Quotation Details' : 'Invoice Details')
@section('header_title', $invoice->type === 'quotation' ? 'Quotation View' : 'Invoice View')

@section('styles')
<style>
    /* Styling optimized for preview & printing */
    .invoice-preview-card {
        background-color: white;
        border: 1px solid var(--glass-border);
        border-radius: 24px;
        box-shadow: var(--shadow-premium);
        padding: 48px;
    }
    
    .invoice-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        border-bottom: 2px solid #f1f5f9;
        padding-bottom: 30px;
        margin-bottom: 40px;
    }
    
    .invoice-logo img {
        max-height: 70px;
        border-radius: 8px;
    }
    
    .company-title {
        font-family: var(--font-heading);
        font-weight: 800;
        font-size: 22px;
        color: #0f172a;
    }
    
    .metadata-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--color-text-light);
        letter-spacing: 0.05em;
    }

    .metadata-value {
        font-weight: 600;
        color: #1e293b;
    }
    
    .address-card {
        background-color: #f8fafc;
        border-radius: 16px;
        padding: 20px;
        border: 1px solid #e2e8f0;
        height: 100%;
    }

    .badge-status {
        padding: 6px 16px;
        font-size: 12px;
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

    /* Print styling rules */
    @media print {
        body {
            background-color: white !important;
            color: black !important;
        }
        .sidebar, .header-bar, .action-buttons-card, .footer-bar {
            display: none !important;
        }
        .main-content {
            margin-left: 0 !important;
            padding: 0 !important;
        }
        .content-body {
            padding: 0 !important;
        }
        .invoice-preview-card {
            border: 0 !important;
            box-shadow: none !important;
            padding: 0 !important;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid p-0 d-flex flex-column gap-4">
    
    <!-- Action buttons bar -->
    <div class="premium-card action-buttons-card">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div class="d-flex gap-2">
                <a href="{{ $invoice->type === 'quotation' ? route('invoices.index', ['type' => 'quotation']) : route('invoices.index') }}" class="btn btn-light rounded-pill px-4">← Back</a>
                @if($invoice->type === 'quotation')
                    @if($invoice->status === 'paid')
                        <span class="badge-status mt-1" style="background-color:#e0f2fe; color:#0369a1; border:1px solid #bae6fd;">ACCEPTED</span>
                    @elseif($invoice->status === 'sent')
                        <span class="badge-status badge-sent mt-1">SENT</span>
                    @else
                        <span class="badge-status badge-draft mt-1">DRAFT</span>
                    @endif
                @else
                    <span class="badge-status badge-{{ $invoice->status }} mt-1">{{ $invoice->status }}</span>
                @endif
            </div>
            
            <div class="d-flex flex-wrap gap-2">
                @if($invoice->type === 'quotation')
                    <!-- Convert to Invoice -->
                    <form method="POST" action="{{ route('quotations.convert', $invoice->id) }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-info text-white rounded-pill px-4 fw-semibold border-0" style="background: linear-gradient(135deg, #0ea5e9, #0284c7);">
                            ⚡ Convert to Invoice
                        </button>
                    </form>
                @endif

                <!-- Print Trigger -->
                <button onclick="window.print()" class="btn btn-light rounded-pill px-4 fw-semibold">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="me-1"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-3a2 2 0 00-2-2H9a2 2 0 00-2 2v3a2 2 0 002 2zm5-17v2m-6 2h12"/></svg>
                    Print
                </button>
                
                <!-- PDF Download -->
                <a href="{{ route('invoices.pdf', $invoice->id) }}" class="btn btn-primary rounded-pill px-4 fw-semibold border-0" style="background: linear-gradient(135deg, #0284c7, #2563eb);">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="me-1"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Download PDF
                </a>

                @if($invoice->type === 'invoice' && $invoice->status !== 'paid')
                    <!-- Record Payment Trigger -->
                    <button type="button" onclick="document.getElementById('recordPaymentModal').style.display='flex'; initForexReconcilerModal();" class="btn text-white rounded-pill px-4 fw-semibold border-0" style="background: linear-gradient(135deg,#0d9488,#0f766e);">
                        💵 Record Payment
                    </button>
                @endif

                <!-- Send Invoice Email -->
                <button type="button" onclick="document.getElementById('emailModal').style.display='flex'" class="btn btn-success rounded-pill px-4 fw-semibold border-0" style="background: linear-gradient(135deg,#059669,#047857);">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="me-1"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Send Email
                </button>

                @if($invoice->type !== 'quotation')
                    <!-- Send Invoice Reminder Email -->
                    <button type="button" onclick="document.getElementById('reminderModal').style.display='flex'" class="btn btn-warning text-dark rounded-pill px-4 fw-semibold border-0" style="background: linear-gradient(135deg,#eab308,#ca8a04);">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="me-1"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        Send Reminder
                    </button>
                @endif

                <!-- Edit -->
                <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-outline-secondary rounded-pill px-4">
                    Edit
                </a>

                <!-- Delete -->
                <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this {{ $invoice->type === 'quotation' ? 'quotation' : 'invoice' }}? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger rounded-pill px-4">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- ✅ Email Log Badge --}}
    @if($invoice->emailed_to)
    <div class="premium-card" style="background: linear-gradient(135deg,#f0fdf4,#dcfce7); border: 1px solid #86efac; padding: 16px 24px;">
        <div class="d-flex align-items-center gap-3">
            <span style="font-size:22px;">📧</span>
            <div>
                <span class="fw-bold text-success" style="font-size:13px;">Invoice Emailed Successfully</span>
                <div class="text-muted" style="font-size:12px; margin-top:2px;">
                    Sent to <strong>{{ $invoice->emailed_to }}</strong> on {{ $invoice->emailed_at->format('d M Y \a\t h:i A') }}
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- 📨 Send Email Modal --}}
    <div id="emailModal" style="display:none; position:fixed; inset:0; z-index:9999; background:rgba(0,0,0,0.5); align-items:center; justify-content:center; padding:20px;">
        <div style="background:#fff; border-radius:20px; padding:36px; width:100%; max-width:440px; box-shadow:0 25px 60px rgba(0,0,0,0.3);">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
                <h5 style="margin:0; font-weight:800; color:#111827; font-size:18px;">📨 Send Invoice Email</h5>
                <button onclick="document.getElementById('emailModal').style.display='none'" style="background:none; border:none; font-size:22px; color:#9ca3af; cursor:pointer; line-height:1;">×</button>
            </div>
            <p style="color:#6b7280; font-size:13px; margin-bottom:20px; line-height:1.6;">
                Send invoice <strong>{{ $invoice->invoice_number }}</strong> to the client or any email address. This will be logged on the invoice.
            </p>
            <form method="POST" action="{{ route('invoices.send-email', $invoice->id) }}">
                @csrf
                <div style="margin-bottom:16px;">
                    <label style="display:block; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#374151; margin-bottom:6px;">Recipient Email Address</label>
                    <input type="email" name="recipient_email"
                        value="{{ $invoice->client->email ?? '' }}"
                        placeholder="client@example.com"
                        required
                        style="width:100%; padding:12px 14px; border:1.5px solid #e5e7eb; border-radius:10px; font-size:14px; color:#111827; outline:none; font-family:inherit;">
                    @error('recipient_email')
                        <p style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</p>
                    @enderror
                </div>
                <div style="display:flex; gap:10px; margin-top:8px;">
                    <button type="button" onclick="document.getElementById('emailModal').style.display='none'"
                        style="flex:1; padding:12px; background:#f3f4f6; border:none; border-radius:10px; font-size:14px; font-weight:600; color:#374151; cursor:pointer;">
                        Cancel
                    </button>
                    <button type="submit"
                        style="flex:2; padding:12px; background:linear-gradient(135deg,#059669,#047857); border:none; border-radius:10px; font-size:14px; font-weight:700; color:#fff; cursor:pointer;">
                        🚀 Send Invoice Email
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ⚠️ Send Reminder Modal --}}
    <div id="reminderModal" style="display:none; position:fixed; inset:0; z-index:9999; background:rgba(0,0,0,0.5); align-items:center; justify-content:center; padding:20px;">
        <div style="background:#fff; border-radius:20px; padding:36px; width:100%; max-width:440px; box-shadow:0 25px 60px rgba(0,0,0,0.3);">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
                <h5 style="margin:0; font-weight:800; color:#111827; font-size:18px;">⚠️ Send Payment Reminder</h5>
                <button onclick="document.getElementById('reminderModal').style.display='none'" style="background:none; border:none; font-size:22px; color:#9ca3af; cursor:pointer; line-height:1;">×</button>
            </div>
            <p style="color:#6b7280; font-size:13px; margin-bottom:20px; line-height:1.6;">
                Send a payment follow-up reminder for invoice <strong>{{ $invoice->invoice_number }}</strong> to the client. The invoice will be attached as a PDF.
            </p>
            <form method="POST" action="{{ route('invoices.send-reminder', $invoice->id) }}">
                @csrf
                <div style="margin-bottom:16px;">
                    <label style="display:block; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#374151; margin-bottom:6px;">Recipient Email Address</label>
                    <input type="email" name="recipient_email"
                        value="{{ $invoice->client->email ?? '' }}"
                        placeholder="client@example.com"
                        required
                        style="width:100%; padding:12px 14px; border:1.5px solid #e5e7eb; border-radius:10px; font-size:14px; color:#111827; outline:none; font-family:inherit;">
                    @error('recipient_email')
                        <p style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</p>
                    @enderror
                </div>
                <div style="display:flex; gap:10px; margin-top:8px;">
                    <button type="button" onclick="document.getElementById('reminderModal').style.display='none'"
                        style="flex:1; padding:12px; background:#f3f4f6; border:none; border-radius:10px; font-size:14px; font-weight:600; color:#374151; cursor:pointer;">
                        Cancel
                    </button>
                    <button type="submit"
                        style="flex:2; padding:12px; background:linear-gradient(135deg,#eab308,#ca8a04); border:none; border-radius:10px; font-size:14px; font-weight:700; color:#0f172a; cursor:pointer;">
                        🚀 Send Reminder Email
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Live Preview Sheet --}}
    <div class="invoice-preview-card">
        
        <!-- Header -->
        <div class="invoice-header">
            <div>
                <!-- Brand logo preview -->
                @if($invoice->user->companySetting && $invoice->user->companySetting->logo)
                    <div class="invoice-logo mb-3">
                        <img src="{{ Storage::url($invoice->user->companySetting->logo) }}" alt="Logo">
                    </div>
                @else
                    <div class="brand-icon mb-3" style="height: 50px; width: 50px; font-size: 24px;">EX</div>
                @endif
                <div class="company-title">{{ $invoice->user->companySetting->company_name ?? $invoice->user->name }}</div>
                <span class="text-muted fs-7">{{ $invoice->user->companySetting->website ?? '' }}</span>
            </div>
            
            <div class="text-md-end">
                <h2 class="text-primary fw-extrabold fs-3 mb-1">{{ $invoice->type === 'quotation' ? 'QUOTATION' : 'INVOICE' }}</h2>
                <div class="text-muted fw-bold mb-3 fs-7">{{ $invoice->invoice_number }}</div>

                <div class="d-flex flex-column gap-1 text-md-end">
                    <div>
                        <span class="metadata-label">{{ $invoice->type === 'quotation' ? 'Quotation Date:' : 'Invoice Date:' }}</span>
                        <span class="metadata-value">{{ $invoice->invoice_date->format('M d, Y') }}</span>
                    </div>
                    @if($invoice->due_date)
                        <div>
                            <span class="metadata-label">Due Date:</span>
                            <span class="metadata-value text-danger">{{ $invoice->due_date->format('M d, Y') }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Address Cards -->
        <div class="row g-4 mb-5">
            <!-- Sender -->
            <div class="col-12 col-md-6">
                <div class="address-card">
                    <span class="metadata-label d-block mb-2">From (Vendor):</span>
                    <h5 class="m-0 fs-6 fw-bold mb-1 text-dark">{{ $invoice->user->companySetting?->company_name ?? $invoice->user->name }}</h5>
                    <p class="fs-7 text-muted mb-2" style="white-space: pre-line;">{{ $invoice->user->companySetting?->address ?? 'No corporate address provided.' }}</p>
                    
                    <div class="fs-8 text-muted pt-2 border-top">
                        @if($invoice->user->companySetting?->email) <div>Email: {{ $invoice->user->companySetting->email }}</div> @endif
                        @if($invoice->user->companySetting?->phone) <div>Phone: {{ $invoice->user->companySetting->phone }}</div> @endif
                        @if($invoice->user->companySetting?->gst_number) <div class="fw-semibold mt-1">GST/VAT: {{ $invoice->user->companySetting->gst_number }}</div> @endif
                    </div>
                </div>
            </div>

            <!-- Recipient -->
            <div class="col-12 col-md-6">
                <div class="address-card">
                    <span class="metadata-label d-block mb-2">To (Client):</span>
                    <h5 class="m-0 fs-6 fw-bold mb-1 text-dark">{{ $invoice->client->name ?? 'N/A' }}</h5>
                    <p class="fs-7 text-muted mb-2" style="white-space: pre-line;">{{ $invoice->client->address ?? 'No billing address provided.' }}</p>
                    
                    <div class="fs-8 text-muted pt-2 border-top">
                        @if($invoice->client->email) <div>Email: {{ $invoice->client->email }}</div> @endif
                        @if($invoice->client->phone) <div>Phone: {{ $invoice->client->phone }}</div> @endif
                        @if($invoice->client->gst_number) <div class="fw-semibold mt-1">GST/VAT: {{ $invoice->client->gst_number }}</div> @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Items Table -->
        <div class="table-responsive mb-5">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr class="fs-7 text-uppercase text-muted fw-bold">
                        <th>Item Description</th>
                        <th style="width: 100px;" class="text-center">SAC</th>
                        <th style="width: 80px;" class="text-center">Qty</th>
                        <th style="width: 130px;" class="text-end">Rate</th>
                        <th style="width: 90px;" class="text-center">Tax %</th>
                        <th style="width: 150px;" class="text-end">Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoice->items as $item)
                        <tr>
                            <td>
                                <div class="fw-semibold text-dark">{{ $item->item_name }}</div>
                                @if($item->description)
                                    <div class="fs-7 text-muted">{{ $item->description }}</div>
                                @endif
                            </td>
                            <td class="text-center"><span class="badge bg-light text-dark border fs-8">{{ $item->sac_code ?? '998315' }}</span></td>
                            <td class="text-center">{{ number_format($item->qty, 1) }}</td>
                            <td class="text-end">{{ number_format($item->rate, 2) }}</td>
                            <td class="text-center text-muted">{{ number_format($item->tax_percent, 1) }}%</td>
                            <td class="text-end fw-semibold text-dark">{{ $invoice->currency_symbol }}{{ number_format($item->total, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Invoice Summary and Signature Row -->
        <div class="row g-4 mb-4">
            <!-- Left side: signature (aligned to bottom) -->
            <div class="col-12 col-md-7 d-flex align-items-end">
                @if($invoice->user->companySetting && $invoice->user->companySetting->signature)
                    <div class="text-start mt-4">
                        <span class="metadata-label d-block mb-1">Authorized Representative:</span>
                        <div class="d-inline-block">
                            <img src="{{ Storage::url($invoice->user->companySetting->signature) }}" alt="Signature" style="max-height: 60px;">
                        </div>
                    </div>
                @endif
            </div>

            <!-- Right side: totals card -->
            <div class="col-12 col-md-5">
                <div class="p-4 rounded-4 bg-light border d-flex flex-column gap-3">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                        <span class="text-muted fs-7">Subtotal Amount:</span>
                        <span class="fw-semibold text-dark">{{ $invoice->currency_symbol }}{{ number_format($invoice->subtotal, 2) }}</span>
                    </div>

                    @php
                        $vendorStateCode = substr($invoice->user->companySetting?->gst_number ?? '', 0, 2);
                        $clientStateCode = substr($invoice->client->gst_number ?? '', 0, 2);
                        $isIntraState = ($vendorStateCode !== '' && $clientStateCode !== '' && $vendorStateCode === $clientStateCode);
                        $effectiveTaxRate = $invoice->subtotal > 0
                            ? round(($invoice->tax_amount / $invoice->subtotal) * 100, 2)
                            : 0;
                        $halfRate = $effectiveTaxRate / 2;
                    @endphp
                    @if($invoice->tax_amount > 0)
                        @if($isIntraState)
                            <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                                <span class="text-muted fs-7">CGST ({{ number_format($halfRate, 0) }}%):</span>
                                <span class="fw-semibold text-dark">{{ $invoice->currency_symbol }}{{ number_format($invoice->tax_amount / 2, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                                <span class="text-muted fs-7">SGST ({{ number_format($halfRate, 0) }}%):</span>
                                <span class="fw-semibold text-dark">{{ $invoice->currency_symbol }}{{ number_format($invoice->tax_amount / 2, 2) }}</span>
                            </div>
                        @else
                            <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                                <span class="text-muted fs-7">IGST ({{ number_format($effectiveTaxRate, 0) }}%):</span>
                                <span class="fw-semibold text-dark">{{ $invoice->currency_symbol }}{{ number_format($invoice->tax_amount, 2) }}</span>
                            </div>
                        @endif
                    @else
                        <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                            <span class="text-muted fs-7">Tax (GST/VAT):</span>
                            <span class="fw-semibold text-dark">{{ $invoice->currency_symbol }}0.00</span>
                        </div>
                    @endif

                    <div class="d-flex justify-content-between align-items-center pt-2">
                        <span class="fw-bold text-dark fs-6">Grand Total:</span>
                        <span class="fw-extrabold text-primary fs-4">{{ $invoice->currency_symbol }}{{ number_format($invoice->grand_total, 2) }}</span>
                    </div>

                    @if($invoice->currency_code !== 'INR')
                    <div class="d-flex flex-column gap-1 bg-white border border-warning rounded-3 p-3 mt-3" style="border-style: dashed !important;">
                        <span class="text-warning fw-bold fs-8 text-uppercase">GST Compliance (Locked Value)</span>
                        <div class="d-flex justify-content-between align-items-center pt-1 fs-7">
                            <span class="text-muted">Rate on Invoice Date:</span>
                            <span class="fw-semibold text-dark">1 {{ $invoice->currency_code }} = {{ number_format($invoice->exchange_rate_inr ?? 1.0, 4) }} INR</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center pt-1 fs-7 border-top">
                            <span class="fw-bold text-dark">INR Equivalent:</span>
                            <span class="fw-extrabold text-success">₹{{ number_format($invoice->inr_equivalent ?? 0.00, 2) }}</span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Bank Instructions, Customer Notes & Compliance Row (unified completely below) -->
        <div class="row g-4 mb-4">
            <div class="col-12 d-flex flex-column gap-3">
                <!-- Payment terms -->
                @if($invoice->bank_notes)
                    <div class="p-3 border rounded-3 bg-light">
                        <span class="metadata-label d-block mb-1">Bank Payment Instructions:</span>
                        <div class="fs-7 text-dark fw-medium" style="white-space: pre-line;">{{ $invoice->bank_notes }}</div>
                    </div>
                @endif

                @if($invoice->notes)
                    <div class="p-3 border rounded-3 bg-light">
                        <span class="metadata-label d-block mb-1">Customer Notes:</span>
                        <div class="fs-7 text-muted" style="white-space: pre-line;">{{ $invoice->notes }}</div>
                    </div>
                @endif

                @php
                    $fircRef = !empty($invoice->payment?->firc_number) ? $invoice->payment->firc_number : (!empty($invoice->firc_number) ? $invoice->firc_number : null);
                    $liquidationRate = $invoice->payment?->exchange_rate_payment ?? $invoice->actual_exchange_rate;
                    $actualReceivedInr = $invoice->payment?->inr_amount_received ?? $invoice->actual_inr_received;
                    $paymentDate = $invoice->payment?->payment_date ? $invoice->payment->payment_date->format('d M Y') : null;
                    $invoicedInr = $invoice->inr_amount_invoice ?? $invoice->inr_equivalent;
                    $difference = $invoice->payment?->forex_gain_loss ?? ($actualReceivedInr && $invoicedInr ? (floatval($actualReceivedInr) - floatval($invoicedInr)) : null);
                @endphp

                @if($invoice->currency_code !== 'INR' && ($invoice->payment || $fircRef || $actualReceivedInr))
                    <div class="p-3 border border-warning rounded-3 bg-light">
                        <span class="metadata-label d-block mb-2 text-warning">Compliance: FIRC/e-BRC Tracking Summary</span>
                        <div class="row g-2 fs-7 text-muted">
                            <div class="col-6">FIRC/e-BRC Ref:</div>
                            <div class="col-6 fw-bold text-dark">{{ $fircRef ?: 'N/A' }}</div>
                            @if($liquidationRate)
                                <div class="col-6">Bank Liquidation Rate:</div>
                                <div class="col-6 fw-bold text-dark">1 {{ $invoice->currency_code }} = {{ number_format($liquidationRate, 4) }} INR</div>
                            @endif
                            @if($actualReceivedInr)
                                <div class="col-6">Actual INR Received:</div>
                                <div class="col-6 fw-bold text-dark">₹{{ number_format($actualReceivedInr, 2) }}</div>
                            @endif
                            <div class="col-6">Invoiced INR Equivalent:</div>
                            <div class="col-6 fw-semibold text-dark">₹{{ number_format($invoicedInr, 2) }}</div>
                            @if($paymentDate)
                                <div class="col-6">Payment Received Date:</div>
                                <div class="col-6 fw-semibold text-dark">{{ $paymentDate }}</div>
                            @endif
                            
                            @if($difference !== null)
                                <div class="col-12 border-top pt-2 mt-2">
                                    @if($difference >= 0)
                                        <div class="text-success fw-bold">📈 Forex Gain: +₹{{ number_format($difference, 2) }} (Realized Credit)</div>
                                    @else
                                        <div class="text-danger fw-bold">📉 Forex Loss: -₹{{ number_format(abs($difference), 2) }} (Realized Debit)</div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>

        @if($invoice->currency_code !== 'INR')
            <div class="p-3 bg-light text-center border rounded-3 fs-7 text-muted my-4" style="border-style: dotted !important;">
                ⚠️ <strong>Export of Services</strong> – Supplied under Letter of Undertaking (LUT)
                @if($invoice->user->companySetting && $invoice->user->companySetting->lut_number)
                    No. <strong>{{ $invoice->user->companySetting->lut_number }}</strong>
                @endif
                without payment of IGST.
            </div>
        @endif

        <!-- Footer -->
        <hr class="my-5 text-muted opacity-25">
        <div class="d-flex justify-content-center text-muted fs-8 py-2">
            Made by <a href="https://codxpert.com" target="_blank" class="fw-semibold ms-1 text-primary text-decoration-none">codxpert.com</a>
        </div>
    </div>
</div>
    {{-- 💵 Record Payment Modal --}}
    @if($invoice->type === 'invoice' && $invoice->status !== 'paid')
    <div id="recordPaymentModal" style="display:none; position:fixed; inset:0; z-index:9999; background:rgba(0,0,0,0.5); align-items:center; justify-content:center; padding:20px;">
        <div style="background:#fff; border-radius:20px; padding:32px; width:100%; max-width:650px; box-shadow:0 25px 60px rgba(0,0,0,0.3); max-height: 90vh; overflow-y: auto;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; border-bottom: 1px solid #f1f5f9; padding-bottom: 15px;">
                <h5 style="margin:0; font-weight:800; color:#111827; font-size:18px;">💵 Record Payment & Forex Reconciliation</h5>
                <button onclick="document.getElementById('recordPaymentModal').style.display='none'" style="background:none; border:none; font-size:22px; color:#9ca3af; cursor:pointer; line-height:1;">×</button>
            </div>
            
            <form method="POST" action="{{ route('invoices.record-payment', $invoice->id) }}">
                @csrf
                
                <div class="row g-3 mb-4">
                    <!-- Payment Date -->
                    <div class="col-12 col-md-6">
                        <label style="display:block; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#374151; margin-bottom:6px;">Payment Received Date</label>
                        <input type="date" name="payment_date" value="{{ date('Y-m-d') }}" required
                            style="width:100%; padding:10px 12px; border:1.5px solid #e5e7eb; border-radius:8px; font-size:13px; color:#111827; outline:none; font-family:inherit;">
                    </div>
                    
                    <!-- FIRC Number -->
                    <div class="col-12 col-md-6">
                        <label style="display:block; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#374151; margin-bottom:6px;">FIRC / e-BRC Ref Number</label>
                        <input type="text" name="firc_number" placeholder="e.g. FIRC12345678"
                            style="width:100%; padding:10px 12px; border:1.5px solid #e5e7eb; border-radius:8px; font-size:13px; color:#111827; outline:none; font-family:inherit;">
                    </div>

                    @if($invoice->currency_code !== 'INR')
                        <!-- Realized Bank Exchange Rate -->
                        <div class="col-12 col-md-6">
                            <label style="display:block; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#374151; margin-bottom:6px;">Bank Exchange Rate (per {{ $invoice->currency_code }})</label>
                            <input type="number" name="exchange_rate_payment" id="bank-exchange-rate-input" step="any" required
                                style="width:100%; padding:10px 12px; border:1.5px solid #e5e7eb; border-radius:8px; font-size:13px; color:#111827; outline:none; font-family:inherit;">
                            
                            <!-- Slider input for interactive reconciliation -->
                            <div style="margin-top:12px; display:flex; align-items:center; gap:10px;">
                                <input type="range" id="bank-rate-slider" step="0.05" style="flex-grow:1; accent-color:#0ea5e9;">
                                <span id="slider-val-label" style="font-size:12px; color:#6b7280; min-width:40px; text-align:right;"></span>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Actual INR Amount Received -->
                    <div class="col-12 col-md-6">
                        <label style="display:block; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#374151; margin-bottom:6px;">Actual INR Received in Bank</label>
                        <input type="number" name="inr_amount_received" id="inr-received-input" step="any" required
                            style="width:100%; padding:10px 12px; border:1.5px solid #e5e7eb; border-radius:8px; font-size:13px; color:#111827; outline:none; font-family:inherit;">
                    </div>
                </div>

                @if($invoice->currency_code !== 'INR')
                    <!-- Interactive Visual Panels -->
                    <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:12px; padding:18px; margin-bottom:20px;">
                        <span style="font-size: 10px; font-weight: 700; text-transform: uppercase; color: #94a3b8; display: block; margin-bottom: 12px;">Real-Time Forex Calculator</span>
                        
                        <div style="display:flex; justify-content:space-between; gap:15px; margin-bottom:15px;">
                            <div style="flex:1; background:#fff; border:1px solid #e2e8f0; border-radius:10px; padding:10px 14px;">
                                <span style="font-size:9px; font-weight:700; color:#94a3b8; text-transform:uppercase;">Locked Invoice Value</span>
                                <div style="font-size:14px; font-weight:800; color:#1e293b; margin-top:3px;">₹{{ number_format($invoice->inr_equivalent, 2) }}</div>
                                <div style="font-size:9px; color:#64748b; margin-top:2px;">Rate: 1 {{ $invoice->currency_code }} = {{ number_format($invoice->exchange_rate_inr, 4) }} INR</div>
                            </div>
                            
                            <div style="flex:1; background:#fff; border:1px solid #e2e8f0; border-radius:10px; padding:10px 14px;">
                                <span style="font-size:9px; font-weight:700; color:#94a3b8; text-transform:uppercase;">Dynamic Received INR</span>
                                <div style="font-size:14px; font-weight:800; color:#1e293b; margin-top:3px;" id="modal-dynamic-received-lbl">₹0.00</div>
                                <div style="font-size:9px; color:#64748b; margin-top:2px;" id="modal-dynamic-rate-lbl">Rate: 1 {{ $invoice->currency_code }} = 0.0000 INR</div>
                            </div>
                        </div>

                        <!-- Forex Gain/Loss Result block -->
                        <div id="modal-forex-result-box" style="border-radius:10px; padding:12px 16px; display:flex; align-items:center; justify-content:center; gap:8px; font-weight:800; font-size:14px;">
                            <!-- Dynamic Content -->
                        </div>

                        <!-- Typo Warning banner (>10%) -->
                        <div id="modal-variance-warning-banner" style="display:none; background:#fffbeb; border:1px solid #fde047; border-radius:8px; padding:10px 12px; margin-top:12px; font-size:12px; color:#854d0e;">
                            ⚠️ <strong>Typo Protection Alert:</strong> The actual received amount varies by <span id="modal-variance-percent-lbl">0%</span> from the locked invoice amount. Please double check if you made a typo entering the bank receipt or rate.
                        </div>

                        <div style="font-size:10px; color:#64748b; margin-top:12px; border-top:1px solid #e2e8f0; padding-top:10px; text-align:center;">
                            ℹ️ GST Return Base Value remains fixed at <strong>₹{{ number_format($invoice->inr_equivalent, 2) }}</strong>. Forex variations do not impact GST liability.
                        </div>
                    </div>
                @else
                    <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:12px; padding:18px; margin-bottom:20px; font-size:12px; color:#475569; text-align:center;">
                        ℹ️ For domestic INR invoices, GST Base Value and payment receipt are identical. No Forex differences calculated.
                    </div>
                @endif

                <div style="display:flex; gap:10px;">
                    <button type="button" onclick="document.getElementById('recordPaymentModal').style.display='none'"
                        style="flex:1; padding:12px; background:#f3f4f6; border:none; border-radius:10px; font-size:14px; font-weight:600; color:#374151; cursor:pointer;">
                        Cancel
                    </button>
                    <button type="submit"
                        style="flex:2; padding:12px; background:linear-gradient(135deg,#0ea5e9,#2563eb); border:none; border-radius:10px; font-size:14px; font-weight:700; color:#fff; cursor:pointer;">
                        ✔️ Record & Sync Payment
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        function initForexReconcilerModal() {
            const currency = "{{ $invoice->currency_code }}";
            const lockedRate = parseFloat("{{ $invoice->exchange_rate_inr ?? 1.0 }}");
            const grandTotal = parseFloat("{{ $invoice->grand_total }}");
            const invoicedInr = parseFloat("{{ $invoice->inr_equivalent ?? $invoice->grand_total }}");

            if (currency === 'INR') {
                document.getElementById('inr-received-input').value = grandTotal.toFixed(2);
                return;
            }

            const bankRateInput = document.getElementById('bank-exchange-rate-input');
            const rateSlider = document.getElementById('bank-rate-slider');
            const inrReceivedInput = document.getElementById('inr-received-input');
            const sliderValLabel = document.getElementById('slider-val-label');
            const dynamicReceivedLbl = document.getElementById('modal-dynamic-received-lbl');
            const dynamicRateLbl = document.getElementById('modal-dynamic-rate-lbl');
            const resultBox = document.getElementById('modal-forex-result-box');
            const warningBanner = document.getElementById('modal-variance-warning-banner');
            const variancePercentLbl = document.getElementById('modal-variance-percent-lbl');

            // Setup dynamic slider range
            const minRate = lockedRate - 3.00;
            const maxRate = lockedRate + 3.00;
            rateSlider.min = minRate.toFixed(2);
            rateSlider.max = maxRate.toFixed(2);
            rateSlider.value = lockedRate.toFixed(2);
            bankRateInput.value = lockedRate.toFixed(4);
            sliderValLabel.textContent = lockedRate.toFixed(2);

            function updateCalculations(currentRate, source) {
                if (isNaN(currentRate) || currentRate <= 0) return;

                const actualInr = grandTotal * currentRate;

                // Sync sliders / fields based on source
                if (source === 'input') {
                    if (currentRate >= minRate && currentRate <= maxRate) {
                        rateSlider.value = currentRate.toFixed(2);
                        sliderValLabel.textContent = currentRate.toFixed(2);
                    }
                    inrReceivedInput.value = actualInr.toFixed(2);
                } else if (source === 'slider') {
                    bankRateInput.value = currentRate.toFixed(4);
                    inrReceivedInput.value = actualInr.toFixed(2);
                } else if (source === 'amount') {
                    // Back-calculate rate
                    const computedAmount = parseFloat(inrReceivedInput.value) || 0;
                    const calculatedRate = grandTotal > 0 ? (computedAmount / grandTotal) : 0;
                    bankRateInput.value = calculatedRate.toFixed(6);
                    if (calculatedRate >= minRate && calculatedRate <= maxRate) {
                        rateSlider.value = calculatedRate.toFixed(2);
                        sliderValLabel.textContent = calculatedRate.toFixed(2);
                    }
                }

                const finalInr = parseFloat(inrReceivedInput.value) || 0;
                const forexDiff = finalInr - invoicedInr;

                // Update Labels
                dynamicReceivedLbl.textContent = '₹' + finalInr.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2});
                const activeRate = parseFloat(bankRateInput.value) || 0;
                dynamicRateLbl.textContent = `Rate: 1 ${currency} = ${activeRate.toFixed(4)} INR`;

                // Update Forex Box styling
                if (forexDiff >= 0) {
                    resultBox.style.background = '#f0fdf4';
                    resultBox.style.color = '#15803d';
                    resultBox.style.border = '1px solid #bbf7d0';
                    resultBox.innerHTML = `📈 Forex Gain (P&L Credit): +₹${forexDiff.toLocaleString('en-IN', {minimumFractionDigits:2, maximumFractionDigits:2})}`;
                } else {
                    resultBox.style.background = '#fff1f2';
                    resultBox.style.color = '#e11d48';
                    resultBox.style.border = '1px solid #fecdd3';
                    resultBox.innerHTML = `📉 Forex Loss (P&L Debit): -₹${Math.abs(forexDiff).toLocaleString('en-IN', {minimumFractionDigits:2, maximumFractionDigits:2})}`;
                }

                // Typos / Variance Check (>10%)
                const pctDiff = invoicedInr > 0 ? (Math.abs(finalInr - invoicedInr) / invoicedInr) : 0;
                if (pctDiff > 0.10) {
                    variancePercentLbl.textContent = (pctDiff * 100).toFixed(1) + '%';
                    warningBanner.style.display = 'block';
                } else {
                    warningBanner.style.display = 'none';
                }
            }

            // Bind listeners
            bankRateInput.oninput = () => {
                updateCalculations(parseFloat(bankRateInput.value), 'input');
            };
            rateSlider.oninput = () => {
                updateCalculations(parseFloat(rateSlider.value), 'slider');
            };
            inrReceivedInput.oninput = () => {
                updateCalculations(parseFloat(inrReceivedInput.value), 'amount');
            };

            // Run initial calculate
            updateCalculations(lockedRate, 'input');
        }
    </script>
    @endif
@endsection
