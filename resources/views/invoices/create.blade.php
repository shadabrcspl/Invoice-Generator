@extends('layouts.app')

@section('title', $type === 'quotation' ? 'Create Quotation' : 'Create Invoice')
@section('header_title', $type === 'quotation' ? 'Create New Quotation' : 'Create New Invoice')

@section('styles')
<style>
    .item-row {
        transition: all 0.2s ease;
    }
    .item-row:hover {
        background-color: #f8fafc;
    }
    .calculation-box {
        background-color: #f8fafc;
        border: 1px solid var(--glass-border);
        border-radius: 16px;
        padding: 20px;
    }
    .sac-preset-btn {
        font-size: 11px;
        font-weight: 600;
        padding: 4px 12px;
        transition: all 0.2s ease;
        border-color: #cbd5e1;
        background: #ffffff;
        color: #334155;
    }
    .sac-preset-btn:hover {
        background: #0284c7;
        color: #ffffff;
        border-color: #0284c7;
        transform: translateY(-1px);
    }
    .sticky-summary-bar {
        position: fixed;
        bottom: 0;
        left: 280px;
        right: 0;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(12px);
        border-top: 1px solid #e2e8f0;
        z-index: 1040;
        box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.06);
    }
    @media (max-width: 991.98px) {
        .sticky-summary-bar {
            left: 0 !important;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid p-0">
    <form method="POST" action="{{ route('invoices.store') }}" id="invoice-form">
        @csrf

        @if(!empty($originalInvoice))
            <input type="hidden" name="original_invoice_id" value="{{ $originalInvoice->id }}">
            <div class="alert alert-info border-0 rounded-4 mb-4 d-flex align-items-center justify-content-between p-3" style="background: linear-gradient(135deg, #eff6ff, #dbeafe); border-left: 5px solid #0284c7 !important;">
                <div class="d-flex align-items-center gap-3">
                    <span style="font-size: 24px;">🔗</span>
                    <div>
                        <span class="fw-bold text-primary fs-7">Referenced Original Tax Invoice:</span>
                        <a href="{{ route('invoices.show', $originalInvoice->id) }}" target="_blank" class="fw-bold text-dark fs-7 ms-1 text-decoration-underline">{{ $originalInvoice->invoice_number }}</a>
                        <span class="text-muted fs-8">({{ $originalInvoice->invoice_date->format('d M Y') }}) — Grand Total: {{ $originalInvoice->currency_symbol }}{{ number_format($originalInvoice->grand_total, 2) }}</span>
                        <div class="text-muted fs-8 mt-1">Pre-filled with customer details, original currency, and line items. Modify amounts/quantities as needed for this note.</div>
                    </div>
                </div>
                <span class="badge bg-primary rounded-pill px-3 py-2 fs-8">{{ strtoupper(str_replace('_', ' ', $type)) }}</span>
            </div>
        @endif

        <div class="row g-4">
            <!-- Left Panel: Core Fields & Line Items -->
            <div class="col-12 col-xl-9">
                <!-- Metadata & Client -->
                <div class="premium-card mb-4">
                    <h4 class="mb-4 fs-5" id="card-metadata-title">
                        {{ $type === 'quotation' ? 'Quotation Metadata & Client' : ($type === 'credit_note' ? 'Credit Note Metadata & Client' : ($type === 'debit_note' ? 'Debit Note Metadata & Client' : 'Invoice Metadata & Client')) }}
                    </h4>

                    <div class="row g-3">
                        <!-- Client Selector -->
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-semibold text-muted fs-7">Select Client <span class="text-danger">*</span></label>
                            <select name="client_id" id="client-select" class="form-select rounded-3" required>
                                <option value="" disabled {{ empty($originalInvoice) ? 'selected' : '' }}>-- Choose Customer --</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" data-email="{{ $client->email }}" data-phone="{{ $client->phone }}" data-address="{{ $client->address }}" data-country="{{ $client->country }}" data-gst="{{ $client->gst_number }}" {{ (old('client_id', $originalInvoice?->client_id) == $client->id) ? 'selected' : '' }}>
                                        {{ $client->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Invoice Number -->
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-semibold text-muted fs-7" id="label-doc-number">
                                {{ $type === 'quotation' ? 'Quotation Number' : ($type === 'credit_note' ? 'Credit Note Number' : ($type === 'debit_note' ? 'Debit Note Number' : 'Invoice Number')) }} <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="invoice_number" id="invoice-number-input" class="form-control rounded-3" value="{{ old('invoice_number', $defaultInvoiceNumber) }}" required>
                        </div>

                        <!-- Currency -->
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-semibold text-muted fs-7">Currency Support <span class="text-danger">*</span></label>
                            <select name="currency_code" id="currency-select" class="form-select rounded-3" required>
                                <option value="INR" data-symbol="₹" {{ (old('currency_code', $originalInvoice?->currency_code) === 'INR') ? 'selected' : '' }}>INR (₹)</option>
                                @foreach($activeCurrencies as $curr)
                                    <option value="{{ $curr->code }}" data-symbol="{{ $curr->symbol }}" {{ (old('currency_code', $originalInvoice?->currency_code) === $curr->code) ? 'selected' : '' }}>
                                        {{ $curr->code }} ({{ $curr->symbol }})
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="currency_symbol" id="currency-symbol-input" value="{{ $originalInvoice?->currency_symbol ?: '₹' }}">
                        </div>

                        <!-- Date -->
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-semibold text-muted fs-7" id="label-doc-date">
                                {{ $type === 'quotation' ? 'Quotation Date' : ($type === 'credit_note' ? 'Credit Note Date' : ($type === 'debit_note' ? 'Debit Note Date' : 'Invoice Date')) }} <span class="text-danger">*</span>
                            </label>
                            <input type="date" name="invoice_date" class="form-control rounded-3" value="{{ old('invoice_date', date('Y-m-d')) }}" required>
                        </div>

                        <!-- Due Date -->
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-semibold text-muted fs-7" id="label-doc-duedate">Due Date</label>
                            <input type="date" name="due_date" class="form-control rounded-3" value="{{ old('due_date', date('Y-m-d', strtotime('+14 days'))) }}">
                        </div>

                        <!-- Note Reason (Section 34 Mandate for Credit / Debit Notes) -->
                        <div class="col-12 col-md-4" id="note-reason-container" style="{{ in_array($type, ['credit_note', 'debit_note']) ? '' : 'display: none;' }}">
                            <label class="form-label fw-semibold text-muted fs-7">Reason for Note (GST Sec 34) <span class="text-danger">*</span></label>
                            <select name="note_reason" class="form-select rounded-3">
                                <option value="Post-sale Discount" {{ old('note_reason') === 'Post-sale Discount' ? 'selected' : '' }}>Post-sale Discount</option>
                                <option value="Deficiency in Services" {{ old('note_reason') === 'Deficiency in Services' ? 'selected' : '' }}>Deficiency in Services</option>
                                <option value="Correction in Invoice" {{ old('note_reason') === 'Correction in Invoice' ? 'selected' : '' }}>Correction in Invoice</option>
                                <option value="Order Cancellation / Refund" {{ old('note_reason') === 'Order Cancellation / Refund' ? 'selected' : '' }}>Order Cancellation / Refund</option>
                                <option value="Supplementary Services" {{ old('note_reason') === 'Supplementary Services' ? 'selected' : '' }}>Supplementary Services</option>
                                <option value="Others" {{ old('note_reason') === 'Others' ? 'selected' : '' }}>Others</option>
                            </select>
                        </div>

                        <!-- Exchange Rate Override -->
                        <div class="col-12 col-md-4" id="exchange-rate-input-container" style="display: none;">
                            <label class="form-label fw-semibold text-warning fs-7">Custom Exchange Rate (INR per unit)</label>
                            <input type="number" name="exchange_rate_inr" id="exchange-rate-input" class="form-control rounded-3 text-warning border-warning" step="any" min="0.000001" placeholder="Override rate...">
                        </div>
                    </div>

                    <!-- Client Detail Auto-fill Preview Box -->
                    <div class="mt-4 p-3 border rounded-3 bg-light" id="client-preview-box" style="display: none;">
                        <div class="row g-2">
                            <div class="col-12 col-sm-6">
                                <span class="fw-bold fs-7 d-block">Billing To:</span>
                                <span id="preview-client-name" class="fw-semibold text-dark"></span>
                            </div>
                            <div class="col-12 col-sm-6">
                                <span class="fw-bold fs-7 d-block">Country:</span>
                                <span id="preview-client-country" class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1 fs-8">—</span>
                            </div>
                            <div class="col-12 col-sm-6">
                                <span class="fw-bold fs-7 d-block">GST/VAT Number:</span>
                                <span id="preview-client-gst" class="text-muted fs-7">—</span>
                            </div>
                            <div class="col-12 col-sm-6">
                                <span class="fw-bold fs-7 d-block">Contact Info:</span>
                                <span id="preview-client-contact" class="text-muted fs-7">—</span>
                            </div>
                            <div class="col-12">
                                <span class="fw-bold fs-7 d-block">Billing Address:</span>
                                <span id="preview-client-address" class="text-muted fs-7">—</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Line Items System -->
                <div class="premium-card mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="m-0 fs-5">Invoice Line Items</h4>
                        <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3" id="btn-add-item">+ Add Line Row</button>
                    </div>

                    <!-- 1-Click SAC Code Presets -->
                    <div class="d-flex flex-wrap align-items-center gap-2 mb-3 p-2.5 rounded-3 bg-light border">
                        <span class="fs-8 fw-bold text-muted text-uppercase me-1">⚡ Quick Presets:</span>
                        <button type="button" class="btn btn-xs rounded-pill sac-preset-btn" data-sac="998314" data-title="Software & Web Application Development">
                            💻 998314 Software Dev
                        </button>
                        <button type="button" class="btn btn-xs rounded-pill sac-preset-btn" data-sac="998311" data-title="IT Consulting & Technical Advisory">
                            💼 998311 IT Consulting
                        </button>
                        <button type="button" class="btn btn-xs rounded-pill sac-preset-btn" data-sac="998313" data-title="DevOps & Cloud Infrastructure Management">
                            ☁️ 998313 DevOps & Cloud
                        </button>
                        <button type="button" class="btn btn-xs rounded-pill sac-preset-btn" data-sac="998315" data-title="Cloud Web Hosting & SaaS Platform Subscription">
                            🌐 998315 SaaS / Hosting
                        </button>
                        <button type="button" class="btn btn-xs rounded-pill sac-preset-btn" data-sac="998365" data-title="Digital Performance Marketing & SEO Consulting">
                            📈 998365 Digital Marketing
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle" id="items-table">
                            <thead class="table-light">
                                <tr class="fs-7 text-uppercase text-muted fw-bold">
                                    <th style="min-width: 180px;">Item / Description</th>
                                    <th style="width: 130px;">SAC Code</th>
                                    <th style="width: 90px;">Qty</th>
                                    <th style="width: 120px;">Rate</th>
                                    <th style="width: 90px;">Tax (%)</th>
                                    <th style="width: 130px;">Total (<span class="currency-symbol-label">₹</span>)</th>
                                    <th style="width: 60px;" class="text-end"></th>
                                </tr>
                            </thead>
                            <tbody id="items-tbody">
                                @php
                                    $initialItems = old('items');
                                    if (!$initialItems && !empty($originalInvoice) && $originalInvoice->items->isNotEmpty()) {
                                        $initialItems = $originalInvoice->items->map(function($it) {
                                            return [
                                                'item_name' => $it->item_name,
                                                'description' => $it->description,
                                                'sac_code' => $it->sac_code ?: '998315',
                                                'qty' => $it->qty,
                                                'rate' => $it->rate,
                                                'tax_percent' => $it->tax_percent,
                                                'total' => $it->total,
                                            ];
                                        })->toArray();
                                    }
                                    if (empty($initialItems)) {
                                        $initialItems = [
                                            [
                                                'item_name' => '',
                                                'description' => '',
                                                'sac_code' => '998315',
                                                'qty' => 1.00,
                                                'rate' => 0.00,
                                                'tax_percent' => 18.00,
                                                'total' => 0.00,
                                            ]
                                        ];
                                    }
                                @endphp
                                @foreach($initialItems as $idx => $item)
                                    <tr class="item-row" data-row-id="{{ $idx }}">
                                        <td>
                                            <input type="text" name="items[{{ $idx }}][item_name]" class="form-control form-control-sm rounded-2 mb-2" required placeholder="Item Name / Service title" value="{{ $item['item_name'] ?? '' }}">
                                            <input type="text" name="items[{{ $idx }}][description]" class="form-control form-control-xs rounded-2 fs-7 text-muted" placeholder="Optional short description" value="{{ $item['description'] ?? '' }}">
                                        </td>
                                        <td>
                                            @php
                                                $curSac = $item['sac_code'] ?? '998315';
                                                $standardSacs = ['998314', '998315', '998316', '998319', '998365', '998366'];
                                                $isCustomSac = !in_array($curSac, $standardSacs);
                                            @endphp
                                            <select class="form-select form-select-sm rounded-2 input-sac-select">
                                                <option value="998314" {{ $curSac === '998314' ? 'selected' : '' }}>998314 – Web Dev</option>
                                                <option value="998315" {{ $curSac === '998315' ? 'selected' : '' }}>998315 – Hosting</option>
                                                <option value="998316" {{ $curSac === '998316' ? 'selected' : '' }}>998316 – Maintenance</option>
                                                <option value="998319" {{ $curSac === '998319' ? 'selected' : '' }}>998319 – IT Services</option>
                                                <option value="998365" {{ $curSac === '998365' ? 'selected' : '' }}>998365 – Digital Mktg</option>
                                                <option value="998366" {{ $curSac === '998366' ? 'selected' : '' }}>998366 – Email Mktg</option>
                                                <option value="custom" {{ $isCustomSac ? 'selected' : '' }}>✏️ Custom</option>
                                            </select>
                                            <input type="text" class="form-control form-control-sm rounded-2 input-sac-custom mt-1" placeholder="e.g. 998411" maxlength="8" value="{{ $isCustomSac ? $curSac : '' }}" style="{{ $isCustomSac ? '' : 'display:none;' }}">
                                            <input type="hidden" name="items[{{ $idx }}][sac_code]" class="input-sac-value" value="{{ $curSac }}">
                                        </td>
                                        <td>
                                            <input type="number" name="items[{{ $idx }}][qty]" class="form-control form-control-sm rounded-2 input-qty" required min="0.01" step="any" value="{{ $item['qty'] ?? 1.00 }}">
                                        </td>
                                        <td>
                                            <input type="number" name="items[{{ $idx }}][rate]" class="form-control form-control-sm rounded-2 input-rate" required min="0" step="any" value="{{ $item['rate'] ?? 0.00 }}">
                                        </td>
                                        <td>
                                            <input type="number" name="items[{{ $idx }}][tax_percent]" class="form-control form-control-sm rounded-2 input-tax" required min="0" max="100" step="any" value="{{ $item['tax_percent'] ?? 18.00 }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm rounded-2 input-total bg-light border-0 fw-semibold text-dark" readonly value="{{ number_format($item['total'] ?? 0, 2, '.', '') }}">
                                        </td>
                                        <td class="text-end">
                                            <button type="button" class="btn btn-outline-danger btn-sm border-0 rounded-circle btn-remove-row" style="height: 28px; width: 28px; padding: 0;">×</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Footer / Bank Notes -->
                <div class="premium-card mb-4">
                    <h4 class="mb-4 fs-5">Bank Details & Customer Notes</h4>
                    
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-semibold text-muted fs-7">Bank & Payment Instructions (Editable)</label>
                            <textarea name="bank_notes" rows="4" class="form-control rounded-3 fs-7" placeholder="Bank payment instructions...">{{ old('bank_notes', $companySetting->bank_notes ?? '') }}</textarea>
                        </div>
                        
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-semibold text-muted fs-7">Invoice Terms / Notes to Client</label>
                            <textarea name="notes" rows="4" class="form-control rounded-3 fs-7" placeholder="e.g. Thank you for your business! Payment is due within 14 days."></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Panel: Dynamic Calculations & Submission -->
            <div class="col-12 col-xl-3">
                <div class="premium-card position-sticky" style="top: 80px;">
                    <h4 class="mb-4 fs-5">Invoice Summary</h4>

                    <div class="calculation-box d-flex flex-column gap-3 mb-4">
                        <div class="d-flex justify-content-between align-items-center pb-2 border-bottom">
                            <span class="text-muted fs-7">Subtotal:</span>
                            <span class="fw-semibold"><span class="currency-symbol-label">₹</span><span id="label-subtotal">0.00</span></span>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center pb-2 border-bottom">
                            <span class="text-muted fs-7">Tax (GST/VAT):</span>
                            <span class="fw-semibold"><span class="currency-symbol-label">₹</span><span id="label-tax">0.00</span></span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-2">
                            <span class="text-dark fw-bold">Grand Total:</span>
                            <span class="fw-extrabold text-primary fs-5"><span class="currency-symbol-label">₹</span><span id="label-grandtotal">0.00</span></span>
                        </div>
                    </div>

                    <!-- INR Equivalent Preview Box (only shown for foreign currency invoices) -->
                    <div class="calculation-box d-flex flex-column gap-2 mb-4 bg-light border-warning" id="inr-equivalent-preview-box" style="display: none; border-style: dashed;">
                        <span class="text-warning fw-bold fs-8 text-uppercase">GST Compliance (INR Value)</span>
                        <div class="d-flex justify-content-between align-items-center pt-1">
                            <span class="text-muted fs-7">Exchange Rate:</span>
                            <span class="fw-semibold fs-7" id="label-exchange-rate-inr">—</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center pt-1 border-top">
                            <span class="text-dark fw-bold fs-7">INR Equivalent:</span>
                            <span class="fw-extrabold text-success fs-6">₹<span id="label-inr-equivalent">0.00</span></span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted fs-7">Document Type</label>
                        <select name="type" id="document-type-select" class="form-select rounded-3">
                            <option value="invoice" {{ $type === 'invoice' ? 'selected' : '' }}>Invoice</option>
                            <option value="quotation" {{ $type === 'quotation' ? 'selected' : '' }}>Quotation</option>
                            <option value="credit_note" {{ $type === 'credit_note' ? 'selected' : '' }}>Credit Note (Reversal / Discount)</option>
                            <option value="debit_note" {{ $type === 'debit_note' ? 'selected' : '' }}>Debit Note (Additional / Supplemental)</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted fs-7">Document Status</label>
                        <select name="status" class="form-select rounded-3">
                            <option value="draft">Draft (Private)</option>
                            <option value="sent" selected>Sent (Unpaid/Unaccepted)</option>
                            <option value="paid">Paid (Settled/Accepted)</option>
                            <option value="overdue">Overdue</option>
                        </select>
                    </div>

                    <!-- Recurring Invoices & Subscriptions Box -->
                    <div class="calculation-box mb-4" id="recurring-settings-box" style="{{ in_array($type, ['invoice']) ? '' : 'display: none;' }}">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" role="switch" name="is_recurring" value="1" id="is-recurring-switch" {{ old('is_recurring') ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold text-dark fs-7" for="is-recurring-switch">🔄 Recurring Subscription</label>
                        </div>
                        <div id="recurring-fields-container" style="{{ old('is_recurring') ? '' : 'display: none;' }}">
                            <div class="mb-2">
                                <label class="form-label fw-semibold text-muted fs-8 mb-1">Billing Frequency</label>
                                <select name="recurring_frequency" class="form-select form-select-sm rounded-2">
                                    <option value="weekly" {{ old('recurring_frequency') === 'weekly' ? 'selected' : '' }}>Weekly</option>
                                    <option value="monthly" {{ old('recurring_frequency', 'monthly') === 'monthly' ? 'selected' : '' }}>Monthly</option>
                                    <option value="quarterly" {{ old('recurring_frequency') === 'quarterly' ? 'selected' : '' }}>Quarterly</option>
                                    <option value="yearly" {{ old('recurring_frequency') === 'yearly' ? 'selected' : '' }}>Yearly</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-semibold text-muted fs-8 mb-1">Next Recurrence Date</label>
                                <input type="date" name="recurring_next_date" class="form-control form-control-sm rounded-2" value="{{ old('recurring_next_date', date('Y-m-d', strtotime('+1 month'))) }}">
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-semibold text-muted fs-8 mb-1">End Date (Optional)</label>
                                <input type="date" name="recurring_end_date" class="form-control form-control-sm rounded-2" value="{{ old('recurring_end_date') }}" placeholder="Indefinite if empty">
                            </div>
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="recurring_auto_send" value="1" id="auto-send-check" {{ old('recurring_auto_send') ? 'checked' : '' }}>
                                <label class="form-check-label fs-8 text-muted" for="auto-send-check">Auto-send email upon billing cycle</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column gap-2">
                        <button type="submit" class="btn btn-primary rounded-pill py-3 fw-semibold border-0" id="btn-submit-document" style="background: linear-gradient(135deg, #0284c7, #2563eb);">
                            {{ $type === 'quotation' ? 'Generate Quotation' : ($type === 'credit_note' ? 'Issue Credit Note' : ($type === 'debit_note' ? 'Issue Debit Note' : 'Generate Invoice')) }}
                        </button>
                        <a href="{{ route('invoices.index') }}" class="btn btn-light rounded-pill py-3 fw-semibold text-dark">
                            Cancel
                        </a>
                    </div>
                    
                    <div class="mt-4 pt-3 border-top text-center text-muted fs-8">
                        Branding: <a href="https://codxpert.com/" target="_blank" rel="noopener" class="fw-semibold text-muted text-decoration-none">CodXpert</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Floating Bottom Sticky Summary Bar -->
        <div id="sticky-invoice-summary-bar" class="sticky-summary-bar">
            <div class="container-fluid d-flex flex-wrap justify-content-between align-items-center gap-2 py-2.5 px-4">
                <div class="d-flex align-items-center gap-3">
                    <span class="fs-7 text-muted d-none d-sm-inline">Live Total:</span>
                    <span class="fw-bold fs-5 text-primary"><span class="currency-symbol-label">₹</span><span id="sticky-label-grandtotal">0.00</span></span>
                    <span id="sticky-inr-wrapper" class="fs-7 text-success fw-semibold" style="display: none;">
                        (≈ ₹<span id="sticky-label-inr">0.00</span>)
                    </span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button type="submit" class="btn btn-primary btn-sm rounded-pill px-4 fw-semibold shadow-sm" style="background: linear-gradient(135deg, #0284c7, #2563eb);">
                        💾 Save Document
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const exchangeRates = @json($latestRates);
        let rowCount = {{ count($initialItems ?? [1]) }};

        // Dynamic type toggles
        const typeSelect = document.getElementById('document-type-select');
        const cardMetadataTitle = document.getElementById('card-metadata-title');
        const labelDocNumber = document.getElementById('label-doc-number');
        const labelDocDate = document.getElementById('label-doc-date');
        const docNumberInput = document.getElementById('invoice-number-input');
        const btnSubmitDoc = document.getElementById('btn-submit-document');
        const reasonContainer = document.getElementById('note-reason-container');
        const recurringBox = document.getElementById('recurring-settings-box');

        typeSelect.addEventListener('change', function() {
            const val = this.value;
            let currentNum = docNumberInput.value;
            
            if (val === 'quotation') {
                cardMetadataTitle.textContent = 'Quotation Metadata & Client';
                labelDocNumber.innerHTML = 'Quotation Number <span class="text-danger">*</span>';
                labelDocDate.innerHTML = 'Quotation Date <span class="text-danger">*</span>';
                btnSubmitDoc.textContent = 'Generate Quotation';
                if (reasonContainer) reasonContainer.style.display = 'none';
                if (recurringBox) recurringBox.style.display = 'none';
                docNumberInput.value = currentNum.replace(/^(INV|CN|DN)-/, 'QUO-');
            } else if (val === 'credit_note') {
                cardMetadataTitle.textContent = 'Credit Note Metadata & Client';
                labelDocNumber.innerHTML = 'Credit Note Number <span class="text-danger">*</span>';
                labelDocDate.innerHTML = 'Credit Note Date <span class="text-danger">*</span>';
                btnSubmitDoc.textContent = 'Issue Credit Note';
                if (reasonContainer) reasonContainer.style.display = 'block';
                if (recurringBox) recurringBox.style.display = 'none';
                docNumberInput.value = currentNum.replace(/^(INV|QUO|DN)-/, 'CN-');
            } else if (val === 'debit_note') {
                cardMetadataTitle.textContent = 'Debit Note Metadata & Client';
                labelDocNumber.innerHTML = 'Debit Note Number <span class="text-danger">*</span>';
                labelDocDate.innerHTML = 'Debit Note Date <span class="text-danger">*</span>';
                btnSubmitDoc.textContent = 'Issue Debit Note';
                if (reasonContainer) reasonContainer.style.display = 'block';
                if (recurringBox) recurringBox.style.display = 'none';
                docNumberInput.value = currentNum.replace(/^(INV|QUO|CN)-/, 'DN-');
            } else {
                cardMetadataTitle.textContent = 'Invoice Metadata & Client';
                labelDocNumber.innerHTML = 'Invoice Number <span class="text-danger">*</span>';
                labelDocDate.innerHTML = 'Invoice Date <span class="text-danger">*</span>';
                btnSubmitDoc.textContent = 'Generate Invoice';
                if (reasonContainer) reasonContainer.style.display = 'none';
                if (recurringBox) recurringBox.style.display = 'block';
                docNumberInput.value = currentNum.replace(/^(QUO|CN|DN)-/, 'INV-');
            }
        });

        // Recurring switch handler
        const isRecurringSwitch = document.getElementById('is-recurring-switch');
        const recurringFieldsContainer = document.getElementById('recurring-fields-container');
        if (isRecurringSwitch && recurringFieldsContainer) {
            isRecurringSwitch.addEventListener('change', function() {
                recurringFieldsContainer.style.display = this.checked ? 'block' : 'none';
            });
        }

        // Auto-fill Client Details
        const clientSelect = document.getElementById('client-select');
        const previewBox = document.getElementById('client-preview-box');
        
        clientSelect.addEventListener('change', function() {
            const selectedOpt = this.options[this.selectedIndex];
            if (!selectedOpt.value) {
                previewBox.style.display = 'none';
                return;
            }

            const name = selectedOpt.textContent.trim();
            const email = selectedOpt.getAttribute('data-email') || 'No email';
            const phone = selectedOpt.getAttribute('data-phone') || 'No phone';
            const country = selectedOpt.getAttribute('data-country') || '—';
            const gst = selectedOpt.getAttribute('data-gst') || 'N/A';
            const address = selectedOpt.getAttribute('data-address') || 'No address';

            document.getElementById('preview-client-name').textContent = name;
            document.getElementById('preview-client-country').textContent = country;
            document.getElementById('preview-client-gst').textContent = gst;
            document.getElementById('preview-client-contact').textContent = `${email} | ${phone}`;
            document.getElementById('preview-client-address').textContent = address;
            
            previewBox.style.display = 'block';
        });

        // Currency updates
        const currencySelect = document.getElementById('currency-select');
        const symbolInput = document.getElementById('currency-symbol-input');
        const symbolLabels = document.querySelectorAll('.currency-symbol-label');
        const rateInputContainer = document.getElementById('exchange-rate-input-container');
        const rateInput = document.getElementById('exchange-rate-input');

        currencySelect.addEventListener('change', function() {
            const selectedOpt = this.options[this.selectedIndex];
            const symbol = selectedOpt.getAttribute('data-symbol');
            const currency = this.value;
            symbolInput.value = symbol;
            
            symbolLabels.forEach(lbl => {
                lbl.textContent = symbol;
            });

            if (currency === 'INR') {
                rateInputContainer.style.display = 'none';
                rateInput.value = '';
            } else {
                const defaultRate = exchangeRates[currency] ?? '';
                rateInput.value = defaultRate ? parseFloat(defaultRate).toFixed(4) : '';
                rateInputContainer.style.display = 'block';
            }

            calculateInvoice();
        });

        rateInput.addEventListener('input', () => {
            calculateInvoice();
        });

        // Add Line Item Row
        document.getElementById('btn-add-item').addEventListener('click', () => {
            const tbody = document.getElementById('items-tbody');
            const newRow = document.createElement('tr');
            newRow.className = 'item-row';
            newRow.setAttribute('data-row-id', rowCount);

            newRow.innerHTML = `
                <td>
                    <input type="text" name="items[${rowCount}][item_name]" class="form-control form-control-sm rounded-2 mb-2" required placeholder="Item Name / Service title">
                    <input type="text" name="items[${rowCount}][description]" class="form-control form-control-xs rounded-2 fs-7 text-muted" placeholder="Optional short description">
                </td>
                <td>
                    <select class="form-select form-select-sm rounded-2 input-sac-select">
                        <option value="998314">998314 – Web Dev</option>
                        <option value="998315" selected>998315 – Hosting</option>
                        <option value="998316">998316 – Maintenance</option>
                        <option value="998319">998319 – IT Services</option>
                        <option value="998365">998365 – Digital Mktg</option>
                        <option value="998366">998366 – Email Mktg</option>
                        <option value="custom">✏️ Custom</option>
                    </select>
                    <input type="text" class="form-control form-control-sm rounded-2 input-sac-custom mt-1" placeholder="e.g. 998411" maxlength="8" style="display:none">
                    <input type="hidden" name="items[${rowCount}][sac_code]" class="input-sac-value" value="998315">
                </td>
                <td>
                    <input type="number" name="items[${rowCount}][qty]" class="form-control form-control-sm rounded-2 input-qty" required min="0.01" step="any" value="1.00">
                </td>
                <td>
                    <input type="number" name="items[${rowCount}][rate]" class="form-control form-control-sm rounded-2 input-rate" required min="0" step="any" value="0.00">
                </td>
                <td>
                    <input type="number" name="items[${rowCount}][tax_percent]" class="form-control form-control-sm rounded-2 input-tax" required min="0" max="100" step="any" value="18.00">
                </td>
                <td>
                    <input type="text" class="form-control form-control-sm rounded-2 input-total bg-light border-0 fw-semibold text-dark" readonly value="0.00">
                </td>
                <td class="text-end">
                    <button type="button" class="btn btn-outline-danger btn-sm border-0 rounded-circle btn-remove-row" style="height: 28px; width: 28px; padding: 0;">×</button>
                </td>
            `;

            tbody.appendChild(newRow);
            rowCount++;
            bindCalculations();
            calculateInvoice();
        });

        // SAC selector binding — toggles between preset dropdown and custom text input
        function bindSacSelectors() {
            document.querySelectorAll('.item-row').forEach(row => {
                const sacSelect = row.querySelector('.input-sac-select');
                const sacCustom = row.querySelector('.input-sac-custom');
                const sacValue = row.querySelector('.input-sac-value');
                if (!sacSelect || !sacValue) return;

                sacSelect.onchange = () => {
                    if (sacSelect.value === 'custom') {
                        sacCustom.style.display = 'block';
                        sacCustom.required = true;
                        sacCustom.focus();
                        sacValue.value = sacCustom.value || '';
                    } else {
                        sacCustom.style.display = 'none';
                        sacCustom.required = false;
                        sacCustom.value = '';
                        sacValue.value = sacSelect.value;
                    }
                };

                sacCustom.oninput = () => {
                    sacValue.value = sacCustom.value;
                };
            });
        }

        // Event Delegator binding
        function bindCalculations() {
            document.querySelectorAll('.item-row').forEach(row => {
                const qtyInput = row.querySelector('.input-qty');
                const rateInput = row.querySelector('.input-rate');
                const taxInput = row.querySelector('.input-tax');
                const removeBtn = row.querySelector('.btn-remove-row');

                // Clear listeners first by cloning and replacing, or simple assign
                qtyInput.oninput = () => calculateInvoice();
                rateInput.oninput = () => calculateInvoice();
                taxInput.oninput = () => calculateInvoice();

                if (removeBtn) {
                    removeBtn.onclick = () => {
                        row.remove();
                        calculateInvoice();
                    };
                }
            });
            bindSacSelectors();
        }

        // Live calculation engine
        function calculateInvoice() {
            let totalSubtotal = 0;
            let totalTax = 0;

            document.querySelectorAll('.item-row').forEach(row => {
                const qty = parseFloat(row.querySelector('.input-qty').value) || 0;
                const rate = parseFloat(row.querySelector('.input-rate').value) || 0;
                const taxPercent = parseFloat(row.querySelector('.input-tax').value) || 0;
                const totalInput = row.querySelector('.input-total');

                const rowSubtotal = qty * rate;
                const rowTax = rowSubtotal * (taxPercent / 100);
                const rowTotal = rowSubtotal + rowTax;

                totalInput.value = rowTotal.toFixed(2);
                
                totalSubtotal += rowSubtotal;
                totalTax += rowTax;
            });

            const subtotalVal = parseFloat(totalSubtotal.toFixed(2));
            const taxVal = parseFloat(totalTax.toFixed(2));
            const grandTotal = subtotalVal + taxVal;

            document.getElementById('label-subtotal').textContent = subtotalVal.toFixed(2);
            document.getElementById('label-tax').textContent = taxVal.toFixed(2);
            document.getElementById('label-grandtotal').textContent = grandTotal.toFixed(2);

            // Sticky Bar live updates
            const stickyGrandTotal = document.getElementById('sticky-label-grandtotal');
            if (stickyGrandTotal) stickyGrandTotal.textContent = grandTotal.toFixed(2);
            const stickyInrWrapper = document.getElementById('sticky-inr-wrapper');
            const stickyInrLabel = document.getElementById('sticky-label-inr');

            // INR Equivalent calculations
            const selectedCurrency = currencySelect.value;
            const inrPreviewBox = document.getElementById('inr-equivalent-preview-box');
            if (selectedCurrency === 'INR') {
                inrPreviewBox.style.display = 'none';
                if (stickyInrWrapper) stickyInrWrapper.style.display = 'none';
            } else {
                let rate = parseFloat(document.getElementById('exchange-rate-input').value);
                if (isNaN(rate) || rate <= 0) {
                    rate = exchangeRates[selectedCurrency] ?? null;
                }
                
                if (rate === null) {
                    // Rate not yet available (DB empty, API not yet called)
                    document.getElementById('label-exchange-rate-inr').textContent = 'Fetching live rate…';
                    document.getElementById('label-inr-equivalent').textContent = '—';
                    if (stickyInrWrapper) stickyInrWrapper.style.display = 'none';
                } else {
                    const inrEquivalent = grandTotal * rate;
                    const inrStr = inrEquivalent.toLocaleString('en-IN', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                    document.getElementById('label-exchange-rate-inr').textContent = `1 ${selectedCurrency} = ${rate.toFixed(4)} INR`;
                    document.getElementById('label-inr-equivalent').textContent = inrStr;
                    if (stickyInrWrapper && stickyInrLabel) {
                        stickyInrWrapper.style.display = 'inline';
                        stickyInrLabel.textContent = inrStr;
                    }
                }
                inrPreviewBox.style.display = 'block';
            }
        }

        // 1-Click SAC Presets
        function applySacPreset(sac, title) {
            const rows = document.querySelectorAll('.item-row');
            let targetRow = null;
            if (rows.length > 0) {
                const lastRow = rows[rows.length - 1];
                const nameInput = lastRow.querySelector('input[name*="[item_name]"]');
                if (nameInput && nameInput.value.trim() === '') {
                    targetRow = lastRow;
                }
            }
            if (!targetRow) {
                const addBtn = document.getElementById('btn-add-item');
                if (addBtn) addBtn.click();
                const updatedRows = document.querySelectorAll('.item-row');
                targetRow = updatedRows[updatedRows.length - 1];
            }
            if (targetRow) {
                const nameInput = targetRow.querySelector('input[name*="[item_name]"]');
                const sacSelect = targetRow.querySelector('.input-sac-select');
                const sacCustom = targetRow.querySelector('.input-sac-custom');
                const sacValue = targetRow.querySelector('.input-sac-value');
                if (nameInput) nameInput.value = title;
                if (sacSelect && sacValue) {
                    sacSelect.value = sac;
                    if (sacSelect.value === sac) {
                        sacValue.value = sac;
                        if (sacCustom) sacCustom.style.display = 'none';
                    } else {
                        sacSelect.value = 'custom';
                        sacValue.value = sac;
                        if (sacCustom) {
                            sacCustom.style.display = 'block';
                            sacCustom.value = sac;
                        }
                    }
                }
                const rateInput = targetRow.querySelector('.input-rate');
                if (rateInput) rateInput.focus();
                calculateInvoice();
            }
        }

        document.querySelectorAll('.sac-preset-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                applySacPreset(this.dataset.sac, this.dataset.title);
            });
        });

        // Initial setup
        bindCalculations();
        calculateInvoice();
        
        if (clientSelect.value) {
            clientSelect.dispatchEvent(new Event('change'));
        }
        if (currencySelect.value !== 'INR') {
            currencySelect.dispatchEvent(new Event('change'));
        } else {
            rateInputContainer.style.display = 'none';
        }
    });
</script>
@endsection
