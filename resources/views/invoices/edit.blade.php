@extends('layouts.app')

@section('title', $invoice->type === 'quotation' ? 'Edit Quotation' : 'Edit Invoice')
@section('header_title', $invoice->type === 'quotation' ? 'Modify Quotation' : 'Modify Invoice')

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
</style>
@endsection

@section('content')
<div class="container-fluid p-0">
    <form method="POST" action="{{ route('invoices.update', $invoice->id) }}" id="invoice-form">
        @csrf
        @method('PUT')

        <div class="row g-4">
            <!-- Left Panel -->
            <div class="col-12 col-xl-9">
                <!-- Metadata -->
                <div class="premium-card mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="m-0 fs-5" id="card-metadata-title">{{ $invoice->type === 'quotation' ? 'Quotation Metadata & Client' : 'Invoice Metadata & Client' }}</h4>
                        <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-light btn-sm rounded-pill px-3">← Back to Details</a>
                    </div>

                    <div class="row g-3">
                        <!-- Client Selector -->
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-semibold text-muted fs-7">Select Client <span class="text-danger">*</span></label>
                            <select name="client_id" id="client-select" class="form-select rounded-3" required>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" data-email="{{ $client->email }}" data-phone="{{ $client->phone }}" data-address="{{ $client->address }}" data-gst="{{ $client->gst_number }}" {{ $invoice->client_id === $client->id ? 'selected' : '' }}>
                                        {{ $client->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Invoice Number -->
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-semibold text-muted fs-7" id="label-doc-number">{{ $invoice->type === 'quotation' ? 'Quotation Number' : 'Invoice Number' }} <span class="text-danger">*</span></label>
                            <input type="text" name="invoice_number" id="invoice-number-input" class="form-control rounded-3" value="{{ old('invoice_number', $invoice->invoice_number) }}" required>
                        </div>

                        <!-- Currency -->
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-semibold text-muted fs-7">Currency Support <span class="text-danger">*</span></label>
                            <select name="currency_code" id="currency-select" class="form-select rounded-3" required>
                                <option value="INR" data-symbol="₹" {{ $invoice->currency_code === 'INR' ? 'selected' : '' }}>INR (₹)</option>
                                @php
                                    $hasInvoiceCurrencyInActive = false;
                                @endphp
                                @foreach($activeCurrencies as $curr)
                                    @php
                                        if ($curr->code === $invoice->currency_code) {
                                            $hasInvoiceCurrencyInActive = true;
                                        }
                                    @endphp
                                    <option value="{{ $curr->code }}" data-symbol="{{ $curr->symbol }}" {{ $invoice->currency_code === $curr->code ? 'selected' : '' }}>
                                        {{ $curr->code }} ({{ $curr->symbol }})
                                    </option>
                                @endforeach
                                @if($invoice->currency_code !== 'INR' && !$hasInvoiceCurrencyInActive)
                                    <option value="{{ $invoice->currency_code }}" data-symbol="{{ $invoice->currency_symbol }}" selected>
                                        {{ $invoice->currency_code }} ({{ $invoice->currency_symbol }}) [Inactive]
                                    </option>
                                @endif
                            </select>
                            <input type="hidden" name="currency_symbol" id="currency-symbol-input" value="{{ $invoice->currency_symbol }}">
                        </div>

                        <!-- Date -->
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-semibold text-muted fs-7" id="label-doc-date">{{ $invoice->type === 'quotation' ? 'Quotation Date' : 'Invoice Date' }} <span class="text-danger">*</span></label>
                            <input type="date" name="invoice_date" class="form-control rounded-3" value="{{ old('invoice_date', $invoice->invoice_date->format('Y-m-d')) }}" required>
                        </div>

                        <!-- Due Date -->
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-semibold text-muted fs-7" id="label-doc-duedate">Due Date</label>
                            <input type="date" name="due_date" class="form-control rounded-3" value="{{ old('due_date', $invoice->due_date ? $invoice->due_date->format('Y-m-d') : '') }}">
                        </div>

                        <!-- Exchange Rate Override -->
                        <div class="col-12 col-md-4" id="exchange-rate-input-container" style="display: none;">
                            <label class="form-label fw-semibold text-warning fs-7">Custom Exchange Rate (INR per unit)</label>
                            <input type="number" name="exchange_rate_inr" id="exchange-rate-input" class="form-control rounded-3 text-warning border-warning" step="any" min="0.000001" value="{{ old('exchange_rate_inr', $invoice->exchange_rate_inr) }}" placeholder="Override rate...">
                        </div>
                    </div>

                    <!-- Client Detail Auto-fill Preview Box -->
                    <div class="mt-4 p-3 border rounded-3 bg-light" id="client-preview-box">
                        <div class="row g-2">
                            <div class="col-12 col-sm-6">
                                <span class="fw-bold fs-7 d-block">Billing To:</span>
                                <span id="preview-client-name" class="fw-semibold text-dark">{{ $invoice->client->name ?? 'N/A' }}</span>
                            </div>
                            <div class="col-12 col-sm-6">
                                <span class="fw-bold fs-7 d-block">GST/VAT Number:</span>
                                <span id="preview-client-gst" class="text-muted fs-7">{{ $invoice->client->gst_number ?: '—' }}</span>
                            </div>
                            <div class="col-12 col-sm-6">
                                <span class="fw-bold fs-7 d-block">Contact Info:</span>
                                <span id="preview-client-contact" class="text-muted fs-7">{{ $invoice->client->email ?: 'No email' }} | {{ $invoice->client->phone ?: 'No phone' }}</span>
                            </div>
                            <div class="col-12 col-sm-6">
                                <span class="fw-bold fs-7 d-block">Billing Address:</span>
                                <span id="preview-client-address" class="text-muted fs-7">{{ $invoice->client->address ?: 'No address' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Line Items System -->
                <div class="premium-card mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="m-0 fs-5">Invoice Line Items</h4>
                        <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3" id="btn-add-item">+ Add Line Row</button>
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
                                    <th style="width: 130px;">Total (<span class="currency-symbol-label">{{ $invoice->currency_symbol }}</span>)</th>
                                    <th style="width: 60px;" class="text-end"></th>
                                </tr>
                            </thead>
                            <tbody id="items-tbody">
                                @foreach($invoice->items as $index => $item)
                                    <tr class="item-row" data-row-id="{{ $index }}">
                                        <td>
                                            <input type="text" name="items[{{ $index }}][item_name]" class="form-control form-control-sm rounded-2 mb-2" required value="{{ $item->item_name }}">
                                            <input type="text" name="items[{{ $index }}][description]" class="form-control form-control-xs rounded-2 fs-7 text-muted" value="{{ $item->description }}" placeholder="Optional short description">
                                        </td>
                                        <td>
                                            @php
                                                $sacPresets = ['998314','998315','998316','998319','998365','998366'];
                                                $currentSac = $item->sac_code ?? '998315';
                                                $isCustomSac = !in_array($currentSac, $sacPresets);
                                            @endphp
                                            <select class="form-select form-select-sm rounded-2 input-sac-select">
                                                <option value="998314" {{ $currentSac === '998314' ? 'selected' : '' }}>998314 – Web Dev</option>
                                                <option value="998315" {{ $currentSac === '998315' ? 'selected' : '' }}>998315 – Hosting</option>
                                                <option value="998316" {{ $currentSac === '998316' ? 'selected' : '' }}>998316 – Maintenance</option>
                                                <option value="998319" {{ $currentSac === '998319' ? 'selected' : '' }}>998319 – IT Services</option>
                                                <option value="998365" {{ $currentSac === '998365' ? 'selected' : '' }}>998365 – Digital Mktg</option>
                                                <option value="998366" {{ $currentSac === '998366' ? 'selected' : '' }}>998366 – Email Mktg</option>
                                                <option value="custom" {{ $isCustomSac ? 'selected' : '' }}>✏️ Custom</option>
                                            </select>
                                            <input type="text" class="form-control form-control-sm rounded-2 input-sac-custom mt-1" placeholder="e.g. 998411" maxlength="8" style="display:{{ $isCustomSac ? 'block' : 'none' }}" value="{{ $isCustomSac ? $currentSac : '' }}">
                                            <input type="hidden" name="items[{{ $index }}][sac_code]" class="input-sac-value" value="{{ $currentSac }}">
                                        </td>
                                        <td>
                                            <input type="number" name="items[{{ $index }}][qty]" class="form-control form-control-sm rounded-2 input-qty" required min="0.01" step="any" value="{{ $item->qty }}">
                                        </td>
                                        <td>
                                            <input type="number" name="items[{{ $index }}][rate]" class="form-control form-control-sm rounded-2 input-rate" required min="0" step="any" value="{{ $item->rate }}">
                                        </td>
                                        <td>
                                            <input type="number" name="items[{{ $index }}][tax_percent]" class="form-control form-control-sm rounded-2 input-tax" required min="0" max="100" step="any" value="{{ $item->tax_percent }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm rounded-2 input-total bg-light border-0 fw-semibold text-dark" readonly value="{{ number_format($item->total, 2) }}">
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
                            <textarea name="bank_notes" rows="4" class="form-control rounded-3 fs-7" placeholder="Bank payment instructions...">{{ old('bank_notes', $invoice->bank_notes) }}</textarea>
                        </div>
                        
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-semibold text-muted fs-7">Invoice Terms / Notes to Client</label>
                            <textarea name="notes" rows="4" class="form-control rounded-3 fs-7" placeholder="e.g. Terms details...">{{ old('notes', $invoice->notes) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- FIRC/e-BRC Tracking (Only for Foreign Currencies) -->
                <div class="premium-card mb-4" id="firc-tracking-card" style="display: none;">
                    <h4 class="mb-4 fs-5 text-warning">Compliance: FIRC/e-BRC Tracking</h4>
                    <p class="text-muted fs-7 mb-4">Log Foreign Inward Remittance Certificate reference details once payment is liquidated by your bank.</p>
                    
                    <div class="row g-3">
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-semibold text-muted fs-7">FIRC / e-BRC Ref Number</label>
                            <input type="text" name="firc_number" class="form-control rounded-3" value="{{ old('firc_number', $invoice->firc_number ?: ($invoice->payment?->firc_number ?? '')) }}" placeholder="e.g. FIRC12345678">
                        </div>
                        
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-semibold text-muted fs-7">Bank Exchange Rate (per foreign unit)</label>
                            <input type="number" name="actual_exchange_rate" step="any" class="form-control rounded-3" value="{{ old('actual_exchange_rate', $invoice->actual_exchange_rate ?: ($invoice->payment?->exchange_rate_payment ?? '')) }}" placeholder="e.g. 83.250000">
                        </div>
                        
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-semibold text-muted fs-7">Actual INR Received</label>
                            <input type="number" name="actual_inr_received" step="any" class="form-control rounded-3" value="{{ old('actual_inr_received', $invoice->actual_inr_received ?: ($invoice->payment?->inr_amount_received ?? '')) }}" placeholder="e.g. 416250.00">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Panel -->
            <div class="col-12 col-xl-3">
                <div class="premium-card position-sticky" style="top: 80px;">
                    <h4 class="mb-4 fs-5">Invoice Summary</h4>

                    <div class="calculation-box d-flex flex-column gap-3 mb-4">
                        <div class="d-flex justify-content-between align-items-center pb-2 border-bottom">
                            <span class="text-muted fs-7">Subtotal:</span>
                            <span class="fw-semibold"><span class="currency-symbol-label">{{ $invoice->currency_symbol }}</span><span id="label-subtotal">{{ number_format($invoice->subtotal, 2) }}</span></span>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center pb-2 border-bottom">
                            <span class="text-muted fs-7">Tax:</span>
                            <span class="fw-semibold"><span class="currency-symbol-label">{{ $invoice->currency_symbol }}</span><span id="label-tax">{{ number_format($invoice->tax_amount, 2) }}</span></span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-2">
                            <span class="text-dark fw-bold">Grand Total:</span>
                            <span class="fw-extrabold text-primary fs-5"><span class="currency-symbol-label">{{ $invoice->currency_symbol }}</span><span id="label-grandtotal">{{ number_format($invoice->grand_total, 2) }}</span></span>
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
                            <option value="invoice" {{ $invoice->type === 'invoice' ? 'selected' : '' }}>Invoice</option>
                            <option value="quotation" {{ $invoice->type === 'quotation' ? 'selected' : '' }}>Quotation</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted fs-7">Document Status</label>
                        <select name="status" class="form-select rounded-3">
                            <option value="draft" {{ $invoice->status === 'draft' ? 'selected' : '' }}>Draft (Private)</option>
                            <option value="sent" {{ $invoice->status === 'sent' ? 'selected' : '' }}>Sent (Unpaid/Unaccepted)</option>
                            <option value="paid" {{ $invoice->status === 'paid' ? 'selected' : '' }}>Paid (Settled/Accepted)</option>
                            <option value="overdue" {{ $invoice->status === 'overdue' ? 'selected' : '' }}>Overdue</option>
                        </select>
                    </div>

                    <div class="d-flex flex-column gap-2">
                        <button type="submit" class="btn btn-primary rounded-pill py-3 fw-semibold border-0" id="btn-submit-document" style="background: linear-gradient(135deg, #0284c7, #2563eb);">
                            {{ $invoice->type === 'quotation' ? 'Update Quotation' : 'Update Invoice' }}
                        </button>
                        <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-light rounded-pill py-3 fw-semibold text-dark">
                            Cancel
                        </a>
                    </div>
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
        let rowCount = {{ $invoice->items->count() }};

        // Dynamic type toggles
        const typeSelect = document.getElementById('document-type-select');
        const cardMetadataTitle = document.getElementById('card-metadata-title');
        const labelDocNumber = document.getElementById('label-doc-number');
        const labelDocDate = document.getElementById('label-doc-date');
        const docNumberInput = document.getElementById('invoice-number-input');
        const btnSubmitDoc = document.getElementById('btn-submit-document');

        typeSelect.addEventListener('change', function() {
            const val = this.value;
            if (val === 'quotation') {
                cardMetadataTitle.textContent = 'Quotation Metadata & Client';
                labelDocNumber.innerHTML = 'Quotation Number <span class="text-danger">*</span>';
                labelDocDate.innerHTML = 'Quotation Date <span class="text-danger">*</span>';
                btnSubmitDoc.textContent = 'Update Quotation';
                
                let currentNum = docNumberInput.value;
                if (currentNum.startsWith('INV-')) {
                    docNumberInput.value = currentNum.replace('INV-', 'QUO-');
                }
            } else {
                cardMetadataTitle.textContent = 'Invoice Metadata & Client';
                labelDocNumber.innerHTML = 'Invoice Number <span class="text-danger">*</span>';
                labelDocDate.innerHTML = 'Invoice Date <span class="text-danger">*</span>';
                btnSubmitDoc.textContent = 'Update Invoice';
                
                let currentNum = docNumberInput.value;
                if (currentNum.startsWith('QUO-')) {
                    docNumberInput.value = currentNum.replace('QUO-', 'INV-');
                }
            }
        });

        // Client Details
        const clientSelect = document.getElementById('client-select');
        const previewBox = document.getElementById('client-preview-box');
        
        clientSelect.addEventListener('change', function() {
            const selectedOpt = this.options[this.selectedIndex];
            const name = selectedOpt.textContent.trim();
            const email = selectedOpt.getAttribute('data-email') || 'No email';
            const phone = selectedOpt.getAttribute('data-phone') || 'No phone';
            const gst = selectedOpt.getAttribute('data-gst') || 'N/A';
            const address = selectedOpt.getAttribute('data-address') || 'No address';

            document.getElementById('preview-client-name').textContent = name;
            document.getElementById('preview-client-gst').textContent = gst;
            document.getElementById('preview-client-contact').textContent = `${email} | ${phone}`;
            document.getElementById('preview-client-address').textContent = address;
        });

        // Currency
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

            // Toggle FIRC Compliance panel
            const fircCard = document.getElementById('firc-tracking-card');
            if (currency === 'INR') {
                fircCard.style.display = 'none';
                rateInputContainer.style.display = 'none';
                rateInput.value = '';
            } else {
                fircCard.style.display = 'block';
                if (currency === "{{ $invoice->currency_code }}") {
                    rateInput.value = "{{ $invoice->exchange_rate_inr }}";
                } else {
                    const defaultRate = exchangeRates[currency] ?? '';
                    rateInput.value = defaultRate ? parseFloat(defaultRate).toFixed(4) : '';
                }
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

            const sym = symbolInput.value;

            newRow.innerHTML = `
                <td>
                    <input type="text" name="items[${rowCount}][item_name]" class="form-control form-control-sm rounded-2 mb-2" required placeholder="Item Name">
                    <input type="text" name="items[${rowCount}][description]" class="form-control form-control-xs rounded-2 fs-7 text-muted" placeholder="Optional description">
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

        // Event delegator
        function bindCalculations() {
            document.querySelectorAll('.item-row').forEach(row => {
                const qtyInput = row.querySelector('.input-qty');
                const rateInput = row.querySelector('.input-rate');
                const taxInput = row.querySelector('.input-tax');
                const removeBtn = row.querySelector('.btn-remove-row');

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

            // INR Equivalent calculations
            const selectedCurrency = currencySelect.value;
            const inrPreviewBox = document.getElementById('inr-equivalent-preview-box');
            if (selectedCurrency === 'INR') {
                inrPreviewBox.style.display = 'none';
            } else {
                let rate = parseFloat(document.getElementById('exchange-rate-input').value);
                if (isNaN(rate) || rate <= 0) {
                    rate = exchangeRates[selectedCurrency] ?? null;
                }
                
                if (rate === null) {
                    document.getElementById('label-exchange-rate-inr').textContent = 'Fetching live rate…';
                    document.getElementById('label-inr-equivalent').textContent = '—';
                } else {
                    const inrEquivalent = grandTotal * rate;
                    document.getElementById('label-exchange-rate-inr').textContent = `1 ${selectedCurrency} = ${rate.toFixed(4)} INR`;
                    document.getElementById('label-inr-equivalent').textContent = inrEquivalent.toLocaleString('en-IN', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                }
                inrPreviewBox.style.display = 'block';
            }
        }

        bindCalculations();
        calculateInvoice();

        // Initial FIRC visibility check
        const fircCard = document.getElementById('firc-tracking-card');
        if (currencySelect.value === 'INR') {
            fircCard.style.display = 'none';
            rateInputContainer.style.display = 'none';
        } else {
            fircCard.style.display = 'block';
            rateInputContainer.style.display = 'block';
        }
    });
</script>
@endsection
