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

    /* Stepper Styling */
    .invoice-stepper-card {
        background: #ffffff;
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        padding: 24px 32px;
    }
    .stepper-track {
        display: flex;
        justify-content: space-between;
        position: relative;
    }
    .stepper-track::before {
        content: '';
        position: absolute;
        top: 20px;
        left: 40px;
        right: 40px;
        height: 3px;
        background: #e2e8f0;
        z-index: 1;
    }
    .stepper-step {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        flex: 1;
    }
    .step-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #ffffff;
        color: #94a3b8;
        border: 3px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 14px;
        margin-bottom: 8px;
        transition: all 0.25s ease;
    }
    .stepper-step.completed .step-circle {
        background: #10b981;
        border-color: #d1fae5;
        color: #ffffff;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15);
    }
    .stepper-step.active .step-circle {
        background: #0284c7;
        border-color: #bae6fd;
        color: #ffffff;
        box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.2);
    }
    .step-title {
        font-size: 13px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 2px;
    }
    .stepper-step:not(.completed):not(.active) .step-title {
        color: #94a3b8;
    }
    .step-desc {
        font-size: 11px;
        color: #64748b;
    }

    /* Action Card Overflow & Dropdown on Hover + Click */
    .action-buttons-card {
        overflow: visible !important;
        position: relative;
        z-index: 1050;
    }
    .action-buttons-card .dropdown {
        position: relative;
    }
    .action-buttons-card .dropdown-menu {
        z-index: 1060 !important;
    }
    .action-buttons-card .dropdown-menu::before {
        content: '';
        position: absolute;
        top: -10px;
        left: 0;
        right: 0;
        height: 10px;
    }
    .action-buttons-card .dropdown:hover > .dropdown-menu {
        display: block !important;
        margin-top: 2px;
        animation: fadeInDropdown 0.15s ease-in-out;
    }
    @keyframes fadeInDropdown {
        from { opacity: 0; transform: translateY(4px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Print styling rules */
    @media print {
        body {
            background-color: white !important;
            color: black !important;
        }
        .sidebar, .header-bar, .action-buttons-card, .invoice-stepper-card, .footer-bar {
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
            <div class="d-flex align-items-center gap-2">
                <a href="{{ $invoice->type === 'quotation' ? route('invoices.index', ['type' => 'quotation']) : route('invoices.index') }}" class="btn btn-light rounded-pill px-3">
                    ← Back
                </a>
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
                <span class="text-muted fs-7 d-none d-md-inline ms-1">• {{ $invoice->invoice_number }}</span>
            </div>
            
            <div class="d-flex flex-wrap align-items-center gap-2">
                <!-- Primary Action 1: Download PDF -->
                <a href="{{ route('invoices.pdf', $invoice->id) }}" class="btn btn-primary rounded-pill px-4 fw-semibold border-0 shadow-sm" style="background: linear-gradient(135deg, #0284c7, #2563eb);">
                    <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="me-1"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Download PDF
                </a>

                @if($invoice->currency_code !== 'INR')
                    <!-- Prominent Export Compliance: HDFC EDF & Request Letter -->
                    <a href="{{ route('invoices.fema-declaration', $invoice->id) }}" class="btn text-white rounded-pill px-3 py-2 fw-semibold border-0 shadow-sm d-inline-flex align-items-center gap-1.5" style="background: linear-gradient(135deg, #1e3a5f, #0f172a);" title="Download pre-filled HDFC Bank Export Declaration Form (EDF) Cum Request Letter (.xlsx)">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span>📄 Download EDF & Request Letter (.xlsx)</span>
                    </a>
                @endif

                <!-- Primary Action 2: Send Email -->
                <button type="button" onclick="document.getElementById('emailModal').style.display='flex'" class="btn btn-success rounded-pill px-4 fw-semibold border-0 shadow-sm" style="background: linear-gradient(135deg,#059669,#047857);">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="me-1"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Send Email
                </button>

                <!-- Action: Duplicate Invoice -->
                <a href="{{ route('invoices.duplicate', $invoice->id) }}" class="btn btn-outline-secondary rounded-pill px-3 py-2 fw-semibold border shadow-xs d-inline-flex align-items-center gap-1.5" title="Duplicate this invoice for a new monthly billing cycle">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    <span>Duplicate</span>
                </a>

                <!-- Primary Action 3 (Contextual): Convert / Record Payment -->
                @if($invoice->type === 'quotation')
                    <form method="POST" action="{{ route('quotations.convert', $invoice->id) }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-info text-white rounded-pill px-4 fw-semibold border-0 shadow-sm" style="background: linear-gradient(135deg, #0ea5e9, #0284c7);">
                            ⚡ Convert to Invoice
                        </button>
                    </form>
                @elseif($invoice->type === 'invoice')
                    @if($invoice->status !== 'paid' && !$invoice->payment)
                        <button type="button" onclick="document.getElementById('recordPaymentModal').style.display='flex'; initForexReconcilerModal();" class="btn text-white rounded-pill px-4 fw-semibold border-0 shadow-sm" style="background: linear-gradient(135deg,#0d9488,#0f766e);">
                            💵 Record Payment
                        </button>
                    @else
                        <button type="button" onclick="document.getElementById('recordPaymentModal').style.display='flex'; initForexReconcilerModal();" class="btn btn-outline-teal rounded-pill px-4 fw-semibold" style="color: #0f766e; border: 1px solid #0d9488; background-color: #f0fdfa;" title="Edit recorded payment details">
                            ✏️ Edit Payment
                        </button>
                    @endif
                @endif

                <!-- Streamlined Dropdown: More Actions -->
                <div class="dropdown d-inline-block">
                    <button class="btn btn-light rounded-pill px-3 fw-semibold dropdown-toggle border" type="button" id="moreActionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        More Actions
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg rounded-4 p-2 border-0" aria-labelledby="moreActionsDropdown" style="min-width: 240px;">
                        <li>
                            <a class="dropdown-item rounded-3 py-2 px-3 fw-medium d-flex align-items-center gap-2" href="{{ route('invoices.duplicate', $invoice->id) }}">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                Duplicate / Copy Invoice
                            </a>
                        </li>
                        <li>
                            <button class="dropdown-item rounded-3 py-2 px-3 fw-medium d-flex align-items-center gap-2" onclick="window.print()">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-3a2 2 0 00-2-2H9a2 2 0 00-2 2v3a2 2 0 002 2zm5-17v2m-6 2h12"/></svg>
                                Print Invoice
                            </button>
                        </li>
                        @if($invoice->currency_code !== 'INR')
                        <li>
                            <a class="dropdown-item rounded-3 py-2 px-3 fw-medium d-flex align-items-center gap-2" href="{{ route('invoices.fema-declaration', $invoice->id) }}" title="Download mandatory FEMA 23(R) / HDFC Bank EDF Declaration Form (.xlsx)">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                FEMA 23(R) Form (.xlsx)
                            </a>
                        </li>
                        @endif
                        @if($invoice->type !== 'quotation')
                        <li>
                            <button type="button" class="dropdown-item rounded-3 py-2 px-3 fw-medium d-flex align-items-center gap-2 text-warning-emphasis" onclick="document.getElementById('reminderModal').style.display='flex'">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                Send Payment Reminder
                            </button>
                        </li>
                        @endif
                        @if($invoice->type === 'invoice')
                        <li>
                            <a class="dropdown-item rounded-3 py-2 px-3 fw-medium d-flex align-items-center gap-2" href="{{ route('invoices.create', ['type' => 'credit_note', 'original_invoice_id' => $invoice->id]) }}">
                                <span>🔻</span> Issue Credit Note
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item rounded-3 py-2 px-3 fw-medium d-flex align-items-center gap-2" href="{{ route('invoices.create', ['type' => 'debit_note', 'original_invoice_id' => $invoice->id]) }}">
                                <span>🔺</span> Issue Debit Note
                            </a>
                        </li>
                        @endif
                        <li><hr class="dropdown-divider my-1 opacity-25"></li>
                        <li>
                            <a class="dropdown-item rounded-3 py-2 px-3 fw-medium d-flex align-items-center gap-2" href="{{ route('invoices.edit', $invoice->id) }}">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                Edit Details
                            </a>
                        </li>
                        <li><hr class="dropdown-divider my-1 opacity-25"></li>
                        <li>
                            <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this {{ $invoice->type === 'quotation' ? 'quotation' : ($invoice->type === 'credit_note' ? 'credit note' : ($invoice->type === 'debit_note' ? 'debit note' : 'invoice')) }}? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item rounded-3 py-2 px-3 fw-medium text-danger d-flex align-items-center gap-2">
                                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Delete Document
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Visual Lifecycle Stepper Widget -->
    <div class="invoice-stepper-card">
        @if($invoice->type === 'quotation')
            @php
                $isQuoAccepted = $invoice->status === 'paid';
                $isQuoSent = in_array($invoice->status, ['sent', 'paid']);
            @endphp
            <div class="stepper-track">
                <!-- Step 1: Draft -->
                <div class="stepper-step completed">
                    <div class="step-circle">✓</div>
                    <div class="step-title">1. Drafted</div>
                    <div class="step-desc">{{ $invoice->created_at->format('d M Y') }}</div>
                </div>
                <!-- Step 2: Sent -->
                <div class="stepper-step {{ $isQuoSent ? 'completed' : 'active' }}">
                    <div class="step-circle">{{ $isQuoSent ? '✓' : '2' }}</div>
                    <div class="step-title">2. Sent to Client</div>
                    <div class="step-desc">{{ $invoice->emailed_at ? $invoice->emailed_at->format('d M Y') : ($isQuoSent ? 'Dispatched' : 'Pending Send') }}</div>
                </div>
                <!-- Step 3: Accepted -->
                <div class="stepper-step {{ $isQuoAccepted ? 'completed' : ($isQuoSent ? 'active' : '') }}">
                    <div class="step-circle">{{ $isQuoAccepted ? '✓' : '3' }}</div>
                    <div class="step-title">3. Accepted</div>
                    <div class="step-desc">{{ $isQuoAccepted ? 'Approved by Client' : 'Awaiting Approval' }}</div>
                </div>
                <!-- Step 4: Converted -->
                <div class="stepper-step">
                    <div class="step-circle">4</div>
                    <div class="step-title">4. Tax Invoice</div>
                    <div class="step-desc">Convert to Bill</div>
                </div>
            </div>
        @else
            @php
                $isCreated = true;
                $isSent = in_array($invoice->status, ['sent', 'paid', 'overdue']) || !empty($invoice->emailed_at);
                $isPaid = ($invoice->status === 'paid') || !empty($invoice->payment);
                $isOverdue = ($invoice->status === 'overdue');
                $hasFirc = !empty($invoice->payment?->firc_number) || !empty($invoice->firc_number);
                $isReconciled = $isPaid && ($invoice->currency_code === 'INR' || $hasFirc);
            @endphp
            <div class="stepper-track">
                <!-- Step 1: Created -->
                <div class="stepper-step completed">
                    <div class="step-circle">✓</div>
                    <div class="step-title">1. Created</div>
                    <div class="step-desc">{{ $invoice->created_at->format('d M Y') }}</div>
                </div>

                <!-- Step 2: Sent -->
                <div class="stepper-step {{ $isSent ? 'completed' : 'active' }}">
                    <div class="step-circle">{{ $isSent ? '✓' : '2' }}</div>
                    <div class="step-title">2. Dispatched</div>
                    <div class="step-desc">{{ $invoice->emailed_at ? $invoice->emailed_at->format('d M') : ($isSent ? 'Sent to Client' : 'Draft') }}</div>
                </div>

                <!-- Step 3: Review / Pending -->
                <div class="stepper-step {{ $isPaid ? 'completed' : ($isOverdue ? 'active text-danger' : ($isSent ? 'active' : '')) }}">
                    <div class="step-circle" style="{{ $isOverdue ? 'border-color:#fca5a5; background:#fef2f2; color:#ef4444;' : '' }}">
                        {{ $isPaid ? '✓' : ($isOverdue ? '!' : '3') }}
                    </div>
                    <div class="step-title {{ $isOverdue ? 'text-danger' : '' }}">
                        {{ $isOverdue ? '3. Overdue' : '3. Awaiting Payment' }}
                    </div>
                    <div class="step-desc">
                        {{ $isPaid ? 'Cleared' : ($invoice->due_date ? 'Due ' . $invoice->due_date->format('d M Y') : 'Net 14') }}
                    </div>
                </div>

                <!-- Step 4: Paid -->
                <div class="stepper-step {{ $isPaid ? 'completed' : '' }}">
                    <div class="step-circle">{{ $isPaid ? '✓' : '4' }}</div>
                    <div class="step-title">4. Paid / Settled</div>
                    <div class="step-desc">
                        @if($isPaid)
                            {{ $invoice->currency_symbol }}{{ number_format($invoice->grand_total, 2) }}
                        @else
                            Pending
                        @endif
                    </div>
                </div>

                <!-- Step 5: Reconciled (FEMA 23R / e-BRC or GST) -->
                <div class="stepper-step {{ $isReconciled ? 'completed' : ($isPaid ? 'active' : '') }}">
                    <div class="step-circle">{{ $isReconciled ? '✓' : '5' }}</div>
                    <div class="step-title">5. Reconciled</div>
                    <div class="step-desc">
                        @if($invoice->currency_code !== 'INR')
                            @if($hasFirc)
                                FIRC / e-BRC
                            @elseif($isPaid)
                                Ready for FEMA 23(R)
                            @else
                                FEMA & Bank
                            @endif
                        @else
                            {{ $isPaid ? 'GST Reconciled' : 'Tax Reconciliation' }}
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- ✅ Referenced Original Invoice Banner (if Credit/Debit Note) --}}
    @if($invoice->originalInvoice)
    <div class="premium-card mb-4" style="background: linear-gradient(135deg, #fef2f2, #fee2e2); border: 1px solid #fca5a5; padding: 16px 24px;">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div class="d-flex align-items-center gap-3">
                <span style="font-size:24px;">🔗</span>
                <div>
                    <span class="fw-bold text-danger fs-6">{{ $invoice->type === 'credit_note' ? 'Credit Note' : 'Debit Note' }} Linked to Original Tax Invoice</span>
                    <div class="text-muted fs-7 mt-1">
                        Original Invoice: <a href="{{ route('invoices.show', $invoice->originalInvoice->id) }}" class="fw-bold text-dark text-decoration-underline">{{ $invoice->originalInvoice->invoice_number }}</a>
                        ({{ $invoice->originalInvoice->invoice_date->format('d M Y') }})
                        @if($invoice->note_reason)
                            &nbsp;|&nbsp; <strong>Reason:</strong> {{ $invoice->note_reason }}
                        @endif
                    </div>
                </div>
            </div>
            <a href="{{ route('invoices.show', $invoice->originalInvoice->id) }}" class="btn btn-sm btn-outline-danger rounded-pill px-3">View Original Invoice →</a>
        </div>
    </div>
    @endif

    {{-- ✅ Linked Credit / Debit Notes History (if Tax Invoice) --}}
    @if($invoice->creditDebitNotes->isNotEmpty())
    <div class="premium-card mb-4" style="border: 1px solid #e2e8f0;">
        <h5 class="fs-6 fw-bold mb-3 d-flex align-items-center gap-2">
            <span>📑 Linked Credit Notes & Debit Notes</span>
            <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill">{{ $invoice->creditDebitNotes->count() }}</span>
        </h5>
        <div class="table-responsive">
            <table class="table align-middle table-sm mb-0">
                <thead class="table-light fs-8 text-uppercase">
                    <tr>
                        <th>Note Type</th>
                        <th>Note Number</th>
                        <th>Date</th>
                        <th>Reason</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoice->creditDebitNotes as $cdn)
                        <tr>
                            <td>
                                <span class="badge rounded-pill px-2 py-1 fs-9 {{ $cdn->type === 'credit_note' ? 'bg-danger text-white' : 'bg-primary text-white' }}">
                                    {{ $cdn->type === 'credit_note' ? 'Credit Note' : 'Debit Note' }}
                                </span>
                            </td>
                            <td class="fw-semibold">{{ $cdn->invoice_number }}</td>
                            <td class="text-muted">{{ $cdn->invoice_date->format('d M Y') }}</td>
                            <td class="text-muted fs-7">{{ $cdn->note_reason ?: '—' }}</td>
                            <td class="fw-bold">{{ $cdn->currency_symbol }}{{ number_format($cdn->grand_total, 2) }}</td>
                            <td><span class="badge-status badge-{{ $cdn->status }}">{{ $cdn->status }}</span></td>
                            <td class="text-end">
                                <a href="{{ route('invoices.show', $cdn->id) }}" class="btn btn-sm btn-light rounded-pill px-3">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    {{-- ✅ Recurring Subscription Badge --}}
    @if($invoice->is_recurring)
    <div class="premium-card mb-4" style="background: linear-gradient(135deg, #faf5ff, #f3e8ff); border: 1px solid #d8b4fe; padding: 16px 24px;">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div class="d-flex align-items-center gap-3">
                <span style="font-size:24px;">🔄</span>
                <div>
                    <span class="fw-bold" style="color: #6b21a8; font-size:14px;">Active Recurring Subscription</span>
                    <div class="text-muted fs-7 mt-1">
                        Frequency: <strong>{{ ucfirst($invoice->recurring_frequency) }}</strong> &nbsp;|&nbsp;
                        Next Billing Date: <strong>{{ $invoice->recurring_next_date ? $invoice->recurring_next_date->format('d M Y') : '—' }}</strong> &nbsp;|&nbsp;
                        End Date: <strong>{{ $invoice->recurring_end_date ? $invoice->recurring_end_date->format('d M Y') : 'Indefinite' }}</strong> &nbsp;|&nbsp;
                        Auto-Send Client Email: <strong>{{ $invoice->recurring_auto_send ? 'Enabled (Automated)' : 'Disabled' }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ✅ Email Log Badge --}}
    @if($invoice->emailed_to)
    <div class="premium-card mb-4" style="background: linear-gradient(135deg,#f0fdf4,#dcfce7); border: 1px solid #86efac; padding: 16px 24px;">
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

                @php
                    $payment = $invoice->payment;
                    $tdsAmount = $payment ? floatval($payment->tds_deducted) : 0;
                    $tdsSec = $payment?->tds_section;
                @endphp

                @if($invoice->currency_code === 'INR' && ($payment || $actualReceivedInr))
                    <div class="p-3 border border-success-subtle rounded-3 bg-light">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="metadata-label text-success m-0">Payment & Tax Settlement Record</span>
                            <button type="button" onclick="document.getElementById('recordPaymentModal').style.display='flex';" class="btn btn-sm btn-outline-success text-dark fw-semibold rounded-pill py-0 px-2 fs-8 d-inline-flex align-items-center gap-1" title="Edit payment details">
                                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                Edit
                            </button>
                        </div>
                        <div class="row g-2 fs-7 text-muted">
                            <div class="col-6">Bank Received Amount:</div>
                            <div class="col-6 fw-bold text-success">₹{{ number_format($actualReceivedInr ?? $invoice->grand_total, 2) }}</div>
                            @if($tdsAmount > 0)
                                <div class="col-6">TDS Deducted by Client:</div>
                                <div class="col-6 fw-bold text-primary">₹{{ number_format($tdsAmount, 2) }} <span class="badge bg-primary-subtle text-primary fs-8 ms-1">{{ $tdsSec ?: 'Sec 194J' }}</span></div>
                                <div class="col-6">Total Invoiced Settled:</div>
                                <div class="col-6 fw-extrabold text-dark">₹{{ number_format(($actualReceivedInr ?? 0) + $tdsAmount, 2) }} of ₹{{ number_format($invoice->grand_total, 2) }}</div>
                            @endif
                            @if($paymentDate)
                                <div class="col-6">Payment Received Date:</div>
                                <div class="col-6 fw-semibold text-dark">{{ $paymentDate }}</div>
                            @endif
                            @if($payment?->payment_notes)
                                <div class="col-6">Reference / UTR / Notes:</div>
                                <div class="col-6 text-dark">{{ $payment->payment_notes }}</div>
                            @endif
                        </div>
                    </div>
                @endif

                @if($invoice->currency_code !== 'INR')
                    <div class="p-3 border border-primary-subtle rounded-3 bg-light shadow-2xs">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="metadata-label text-primary m-0 d-flex align-items-center gap-1.5 fw-bold">
                                <span>🏛️</span> HDFC Bank & RBI FEMA 23(R) Export Compliance
                            </span>
                            @if($invoice->payment || $fircRef || $actualReceivedInr)
                                <button type="button" onclick="document.getElementById('recordPaymentModal').style.display='flex'; initForexReconcilerModal();" class="btn btn-sm btn-outline-warning text-dark fw-semibold rounded-pill py-0 px-2 fs-8 d-inline-flex align-items-center gap-1" title="Edit payment details">
                                    <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    Edit Payment
                                </button>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary fs-9 rounded-pill px-2">Payment Pending</span>
                            @endif
                        </div>
                        <div class="row g-2 fs-7 text-muted">
                            <div class="col-6">Mandatory Purpose Code:</div>
                            <div class="col-6 fw-bold text-dark">P0802 (Software Consultancy)</div>

                            <div class="col-6">Credit Account Number:</div>
                            <div class="col-6 fw-bold text-dark">50200120756905 (HDFC Bank)</div>

                            <div class="col-6">GST LUT Declaration:</div>
                            <div class="col-6 fw-semibold text-dark">AD100626002271U</div>

                            @if($fircRef)
                                <div class="col-6">FIRC/e-BRC Ref:</div>
                                <div class="col-6 fw-bold text-dark">{{ $fircRef }}</div>
                            @endif
                            @if($liquidationRate)
                                <div class="col-6">Bank Liquidation Rate:</div>
                                <div class="col-6 fw-bold text-dark">1 {{ $invoice->currency_code }} = {{ number_format($liquidationRate, 4) }} INR</div>
                            @endif
                            @if($actualReceivedInr)
                                <div class="col-6">Actual INR Received:</div>
                                <div class="col-6 fw-bold text-dark">₹{{ number_format($actualReceivedInr, 2) }}</div>
                            @endif
                            @if($tdsAmount > 0)
                                <div class="col-6">Withholding / TDS Tax:</div>
                                <div class="col-6 fw-bold text-primary">₹{{ number_format($tdsAmount, 2) }} ({{ $tdsSec ?: 'Sec 195' }})</div>
                            @endif
                            <div class="col-6">Invoiced INR Value:</div>
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

                            <div class="col-12 border-top pt-2 mt-2">
                                <div class="small text-muted mb-2">
                                    Required by HDFC Bank to credit remittance & regularise export bill in RBI EDPMS:
                                </div>
                                <a href="{{ route('invoices.fema-declaration', $invoice->id) }}" class="btn btn-sm btn-dark rounded-pill px-3 py-1.5 fs-7 fw-semibold d-inline-flex align-items-center gap-1.5 w-100 justify-content-center" style="background: #1e3a5f; border-color: #1e3a5f;" title="Auto-populate HDFC EDF Declaration Form (.xlsx)">
                                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    Download EDF & Request Letter (.xlsx)
                                </a>
                            </div>
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
            Made by <a href="https://codxpert.com/" target="_blank" rel="noopener" class="fw-semibold ms-1 text-primary text-decoration-none">CodXpert</a>
        </div>
    </div>
</div>
    {{-- 💵 Record / Edit Payment Modal --}}
    @if($invoice->type === 'invoice')
    <div id="recordPaymentModal" style="display:none; position:fixed; inset:0; z-index:9999; background:rgba(0,0,0,0.5); align-items:center; justify-content:center; padding:20px;">
        <div style="background:#fff; border-radius:20px; padding:32px; width:100%; max-width:650px; box-shadow:0 25px 60px rgba(0,0,0,0.3); max-height: 90vh; overflow-y: auto;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; border-bottom: 1px solid #f1f5f9; padding-bottom: 15px;">
                <h5 style="margin:0; font-weight:800; color:#111827; font-size:18px;">
                    {{ ($invoice->payment || $invoice->status === 'paid') ? '✏️ Edit Payment & Forex Reconciliation' : '💵 Record Payment & Forex Reconciliation' }}
                </h5>
                <button onclick="document.getElementById('recordPaymentModal').style.display='none'" style="background:none; border:none; font-size:22px; color:#9ca3af; cursor:pointer; line-height:1;">×</button>
            </div>
            
            <form method="POST" action="{{ route('invoices.record-payment', $invoice->id) }}">
                @csrf
                
                <div class="row g-3 mb-4">
                    <!-- Payment Date -->
                    <div class="col-12 col-md-6">
                        <label style="display:block; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#374151; margin-bottom:6px;">Payment Received Date</label>
                        <input type="date" name="payment_date" id="modal-payment-date-input" value="{{ old('payment_date', $invoice->payment?->payment_date ? $invoice->payment->payment_date->format('Y-m-d') : date('Y-m-d')) }}" required
                            style="width:100%; padding:10px 12px; border:1.5px solid #e5e7eb; border-radius:8px; font-size:13px; color:#111827; outline:none; font-family:inherit;">
                    </div>
                    
                    <!-- FIRC Number -->
                    <div class="col-12 col-md-6">
                        <label style="display:block; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#374151; margin-bottom:6px;">FIRC / e-BRC Ref Number</label>
                        <input type="text" name="firc_number" id="modal-firc-number-input" value="{{ old('firc_number', $invoice->payment?->firc_number ?? $invoice->firc_number) }}" placeholder="e.g. FIRC12345678"
                            style="width:100%; padding:10px 12px; border:1.5px solid #e5e7eb; border-radius:8px; font-size:13px; color:#111827; outline:none; font-family:inherit;">
                    </div>

                    @if($invoice->currency_code !== 'INR')
                        <!-- Realized Bank Exchange Rate -->
                        <div class="col-12 col-md-6">
                            <label style="display:block; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#374151; margin-bottom:6px;">Bank Exchange Rate (per {{ $invoice->currency_code }})</label>
                            <input type="number" name="exchange_rate_payment" id="bank-exchange-rate-input" step="any" value="{{ old('exchange_rate_payment', $invoice->payment?->exchange_rate_payment ?? $invoice->actual_exchange_rate) }}" required
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
                        <label style="display:block; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#374151; margin-bottom:6px;">Actual INR Received in Bank <span class="text-danger">*</span></label>
                        <input type="number" name="inr_amount_received" id="inr-received-input" step="any" value="{{ old('inr_amount_received', $invoice->payment?->inr_amount_received ?? $invoice->actual_inr_received) }}" required
                            style="width:100%; padding:10px 12px; border:1.5px solid #e5e7eb; border-radius:8px; font-size:13px; color:#111827; outline:none; font-family:inherit;">
                    </div>

                    <!-- TDS Deducted by Client -->
                    <div class="col-12 col-md-6">
                        <label style="display:block; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#374151; margin-bottom:6px;">
                            TDS Deducted by Client (₹)
                            <span class="text-muted fw-normal fs-8" style="text-transform:none;">(If applicable)</span>
                        </label>
                        <input type="number" name="tds_deducted" id="tds-deducted-input" step="any" min="0" value="{{ old('tds_deducted', $invoice->payment?->tds_deducted ?? '0.00') }}" placeholder="0.00"
                            style="width:100%; padding:10px 12px; border:1.5px solid #e5e7eb; border-radius:8px; font-size:13px; color:#111827; outline:none; font-family:inherit;">
                    </div>

                    <!-- TDS Section -->
                    <div class="col-12 col-md-6">
                        <label style="display:block; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#374151; margin-bottom:6px;">TDS Income Tax Section</label>
                        <select name="tds_section" id="tds-section-select"
                            style="width:100%; padding:10px 12px; border:1.5px solid #e5e7eb; border-radius:8px; font-size:13px; color:#111827; outline:none; font-family:inherit; background:#fff;">
                            <option value="">-- No TDS Deducted --</option>
                            <option value="194J - Professional & Technical Fees (10%)" {{ ($invoice->payment?->tds_section === '194J - Professional & Technical Fees (10%)') ? 'selected' : '' }}>Sec 194J – Professional & Technical (10%)</option>
                            <option value="194J - Technical Services (2%)" {{ ($invoice->payment?->tds_section === '194J - Technical Services (2%)') ? 'selected' : '' }}>Sec 194J – Technical Services (2%)</option>
                            <option value="194C - Contractor & Maintenance (1% Ind / 2% Co)" {{ ($invoice->payment?->tds_section === '194C - Contractor & Maintenance (1% Ind / 2% Co)') ? 'selected' : '' }}>Sec 194C – Contracts / Maint. (1% or 2%)</option>
                            <option value="194Q - Purchase of Goods (0.1%)" {{ ($invoice->payment?->tds_section === '194Q - Purchase of Goods (0.1%)') ? 'selected' : '' }}>Sec 194Q – Purchase (0.1%)</option>
                            <option value="195 - Non-Resident Withholding Tax" {{ ($invoice->payment?->tds_section === '195 - Non-Resident Withholding Tax') ? 'selected' : '' }}>Sec 195 – Non-Resident Foreign Withholding</option>
                        </select>
                    </div>

                    <!-- Payment Notes -->
                    <div class="col-12">
                        <label style="display:block; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#374151; margin-bottom:6px;">Payment Notes / UTR / Reference</label>
                        <input type="text" name="payment_notes" id="modal-payment-notes-input" value="{{ old('payment_notes', $invoice->payment?->payment_notes) }}" placeholder="e.g. Received via NEFT / HDFC NetBanking Ref # CMS12345678"
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
                        {{ ($invoice->payment || $invoice->status === 'paid') ? '✔️ Update Payment Details' : '✔️ Record & Sync Payment' }}
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

            // Existing payment values if already recorded
            const existingPaymentDate = "{{ $invoice->payment?->payment_date ? $invoice->payment->payment_date->format('Y-m-d') : '' }}";
            const existingBankRate = parseFloat("{{ $invoice->payment?->exchange_rate_payment ?? ($invoice->actual_exchange_rate ?? '') }}");
            const existingInrReceived = parseFloat("{{ $invoice->payment?->inr_amount_received ?? ($invoice->actual_inr_received ?? '') }}");

            if (existingPaymentDate) {
                const dateInput = document.getElementById('modal-payment-date-input');
                if (dateInput) {
                    dateInput.value = existingPaymentDate;
                }
            }

            if (currency === 'INR') {
                const inrInput = document.getElementById('inr-received-input');
                if (inrInput) {
                    inrInput.value = (!isNaN(existingInrReceived) && existingInrReceived > 0)
                        ? existingInrReceived.toFixed(2)
                        : grandTotal.toFixed(2);
                }
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

            const hasExistingRate = !isNaN(existingBankRate) && existingBankRate > 0;
            const hasExistingInr = !isNaN(existingInrReceived) && existingInrReceived > 0;
            const effectiveRate = hasExistingRate ? existingBankRate : lockedRate;

            // Setup dynamic slider range
            const minRate = Math.min(lockedRate, effectiveRate) - 3.00;
            const maxRate = Math.max(lockedRate, effectiveRate) + 3.00;
            rateSlider.min = minRate.toFixed(2);
            rateSlider.max = maxRate.toFixed(2);
            rateSlider.value = effectiveRate.toFixed(2);
            bankRateInput.value = effectiveRate.toFixed(4);
            sliderValLabel.textContent = effectiveRate.toFixed(2);

            if (hasExistingInr) {
                inrReceivedInput.value = existingInrReceived.toFixed(2);
            }

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

            // Run initial calculate with existing values if available
            if (hasExistingInr) {
                updateCalculations(effectiveRate, 'amount');
            } else {
                updateCalculations(effectiveRate, 'input');
            }
        }
    </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownEl = document.getElementById('moreActionsDropdown');
            const dropdownParent = dropdownEl ? dropdownEl.closest('.dropdown') : null;
            if (dropdownEl && dropdownParent && window.bootstrap) {
                const bsDropdown = bootstrap.Dropdown.getOrCreateInstance(dropdownEl);
                let hoverTimeout;
                dropdownParent.addEventListener('mouseenter', () => {
                    clearTimeout(hoverTimeout);
                    bsDropdown.show();
                });
                dropdownParent.addEventListener('mouseleave', () => {
                    hoverTimeout = setTimeout(() => {
                        bsDropdown.hide();
                    }, 150);
                });
            }
        });
    </script>
@endsection
