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
</style>
@endsection

@section('content')
<div class="container-fluid p-0">
    <form method="POST" action="{{ route('invoices.store') }}" id="invoice-form">
        @csrf

        <div class="row g-4">
            <!-- Left Panel: Core Fields & Line Items -->
            <div class="col-12 col-xl-9">
                <!-- Metadata & Client -->
                <div class="premium-card mb-4">
                    <h4 class="mb-4 fs-5" id="card-metadata-title">{{ $type === 'quotation' ? 'Quotation Metadata & Client' : 'Invoice Metadata & Client' }}</h4>

                    <div class="row g-3">
                        <!-- Client Selector -->
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-semibold text-muted fs-7">Select Client <span class="text-danger">*</span></label>
                            <select name="client_id" id="client-select" class="form-select rounded-3" required>
                                <option value="" disabled selected>-- Choose Customer --</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" data-email="{{ $client->email }}" data-phone="{{ $client->phone }}" data-address="{{ $client->address }}" data-gst="{{ $client->gst_number }}">
                                        {{ $client->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Invoice Number -->
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-semibold text-muted fs-7" id="label-doc-number">{{ $type === 'quotation' ? 'Quotation Number' : 'Invoice Number' }} <span class="text-danger">*</span></label>
                            <input type="text" name="invoice_number" id="invoice-number-input" class="form-control rounded-3" value="{{ old('invoice_number', $defaultInvoiceNumber) }}" required>
                        </div>

                        <!-- Currency -->
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-semibold text-muted fs-7">Currency Support <span class="text-danger">*</span></label>
                            <select name="currency_code" id="currency-select" class="form-select rounded-3" required>
                                <option value="INR" data-symbol="₹">INR (₹)</option>
                                @foreach($activeCurrencies as $curr)
                                    <option value="{{ $curr->code }}" data-symbol="{{ $curr->symbol }}">{{ $curr->code }} ({{ $curr->symbol }})</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="currency_symbol" id="currency-symbol-input" value="₹">
                        </div>

                        <!-- Date -->
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-semibold text-muted fs-7" id="label-doc-date">{{ $type === 'quotation' ? 'Quotation Date' : 'Invoice Date' }} <span class="text-danger">*</span></label>
                            <input type="date" name="invoice_date" class="form-control rounded-3" value="{{ old('invoice_date', date('Y-m-d')) }}" required>
                        </div>

                        <!-- Due Date -->
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-semibold text-muted fs-7" id="label-doc-duedate">Due Date</label>
                            <input type="date" name="due_date" class="form-control rounded-3" value="{{ old('due_date', date('Y-m-d', strtotime('+14 days'))) }}">
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
                                <span class="fw-bold fs-7 d-block">GST/VAT Number:</span>
                                <span id="preview-client-gst" class="text-muted fs-7">—</span>
                            </div>
                            <div class="col-12 col-sm-6">
                                <span class="fw-bold fs-7 d-block">Contact Info:</span>
                                <span id="preview-client-contact" class="text-muted fs-7">—</span>
                            </div>
                            <div class="col-12 col-sm-6">
                                <span class="fw-bold fs-7 d-block">Billing Address:</span>
                                <span id="preview-client-address" class="text-muted fs-7">—</span>
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
                                    <th style="width: 130px;">Total (<span class="currency-symbol-label">₹</span>)</th>
                                    <th style="width: 60px;" class="text-end"></th>
                                </tr>
                            </thead>
                            <tbody id="items-tbody">
                                <!-- Row 1 Default -->
                                <tr class="item-row" data-row-id="0">
                                    <td>
                                        <input type="text" name="items[0][item_name]" class="form-control form-control-sm rounded-2 mb-2" required placeholder="Item Name / Service title">
                                        <input type="text" name="items[0][description]" class="form-control form-control-xs rounded-2 fs-7 text-muted" placeholder="Optional short description">
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
                                        <input type="hidden" name="items[0][sac_code]" class="input-sac-value" value="998315">
                                    </td>
                                    <td>
                                        <input type="number" name="items[0][qty]" class="form-control form-control-sm rounded-2 input-qty" required min="0.01" step="any" value="1.00">
                                    </td>
                                    <td>
                                        <input type="number" name="items[0][rate]" class="form-control form-control-sm rounded-2 input-rate" required min="0" step="any" value="0.00">
                                    </td>
                                    <td>
                                        <input type="number" name="items[0][tax_percent]" class="form-control form-control-sm rounded-2 input-tax" required min="0" max="100" step="any" value="18.00">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm rounded-2 input-total bg-light border-0 fw-semibold text-dark" readonly value="0.00">
                                    </td>
                                    <td class="text-end">
                                        <button type="button" class="btn btn-outline-danger btn-sm border-0 rounded-circle btn-remove-row" style="height: 28px; width: 28px; padding: 0;">×</button>
                                    </td>
                                </tr>
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

                    <div class="d-flex flex-column gap-2">
                        <button type="submit" class="btn btn-primary rounded-pill py-3 fw-semibold border-0" id="btn-submit-document" style="background: linear-gradient(135deg, #0284c7, #2563eb);">
                            {{ $type === 'quotation' ? 'Generate Quotation' : 'Generate Invoice' }}
                        </button>
                        <a href="{{ route('invoices.index') }}" class="btn btn-light rounded-pill py-3 fw-semibold text-dark">
                            Cancel
                        </a>
                    </div>
                    
                    <div class="mt-4 pt-3 border-top text-center text-muted fs-8">
                        Branding: <a href="https://codxpert.com" target="_blank" class="fw-semibold text-muted text-decoration-none">codxpert.com</a>
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
        let rowCount = 1;

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
                btnSubmitDoc.textContent = 'Generate Quotation';
                
                let currentNum = docNumberInput.value;
                if (currentNum.startsWith('INV-')) {
                    docNumberInput.value = currentNum.replace('INV-', 'QUO-');
                }
            } else {
                cardMetadataTitle.textContent = 'Invoice Metadata & Client';
                labelDocNumber.innerHTML = 'Invoice Number <span class="text-danger">*</span>';
                labelDocDate.innerHTML = 'Invoice Date <span class="text-danger">*</span>';
                btnSubmitDoc.textContent = 'Generate Invoice';
                
                let currentNum = docNumberInput.value;
                if (currentNum.startsWith('QUO-')) {
                    docNumberInput.value = currentNum.replace('QUO-', 'INV-');
                }
            }
        });

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
            const gst = selectedOpt.getAttribute('data-gst') || 'N/A';
            const address = selectedOpt.getAttribute('data-address') || 'No address';

            document.getElementById('preview-client-name').textContent = name;
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
                    // Rate not yet available (DB empty, API not yet called)
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

        // Initial setup
        bindCalculations();
        calculateInvoice();
        
        rateInputContainer.style.display = currencySelect.value === 'INR' ? 'none' : 'block';
    });
</script>
@endsection
