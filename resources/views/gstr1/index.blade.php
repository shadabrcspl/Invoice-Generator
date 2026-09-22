@extends('layouts.app')

@section('title', 'GST & Forex Compliance')
@section('header_title', 'GST Compliance & Forex Reconciliation')

@section('styles')
<style>
    .compliance-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 24px;
    }
    @media (min-width: 992px) {
        .compliance-grid {
            grid-template-columns: 1fr 2fr;
        }
    }
    .reconcile-card {
        background: #fff;
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        box-shadow: var(--shadow-premium);
        padding: 30px;
        transition: all 0.3s ease;
    }
    .reconcile-card:hover {
        box-shadow: var(--shadow-hover);
    }
    .state-box {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        flex: 1;
        text-align: center;
    }
    .gain-banner {
        background-color: #f0fdf4;
        border: 1px solid #bbf7d0;
        color: #15803d;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        margin: 20px 0;
        transition: all 0.2s ease;
    }
    .loss-banner {
        background-color: #fff1f2;
        border: 1px solid #fecdd3;
        color: #e11d48;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        margin: 20px 0;
        transition: all 0.2s ease;
    }
    .grid-row-comp {
        display: flex;
        justify-content: space-between;
        font-size: 13px;
        color: #64748b;
        padding: 10px 0;
    }
    .grid-row-comp + .grid-row-comp {
        border-top: 1px solid #f1f5f9;
    }
    .slider-container {
        margin-top: 24px;
        background-color: #f8fafc;
        border-radius: 12px;
        padding: 20px;
        border: 1px dashed #cbd5e1;
    }
</style>
@endsection

@section('content')
<div class="container-fluid p-0">
    <div class="compliance-grid">
        
        <!-- Left Panel: GSTR-1 Export Tool -->
        <div class="d-flex flex-column gap-4">
            <div class="reconcile-card">
                <div class="mb-4">
                    <span style="font-size: 24px;">🗄️</span>
                    <h4 class="mt-2 mb-1 fs-5">GSTR-1 Monthly Export</h4>
                    <p class="text-muted fs-7 m-0">Generate GSTR-1 compliant CSV reports for your accountant. Ignores payment dates and realized values, locking strictly on invoice-date values.</p>
                </div>

                <form method="GET" action="{{ route('gstr1.export') }}">
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted fs-7">Select Filing Period</label>
                        <select name="month" class="form-select rounded-3" required>
                            @foreach($months as $m)
                                @php 
                                    $carbon = \Carbon\Carbon::createFromFormat('Y-m', $m);
                                    $label = $carbon->format('F Y');
                                @endphp
                                <option value="{{ $m }}">{{ $label }} ({{ $m }})</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary rounded-pill w-100 py-2.5 fw-semibold border-0" style="background: linear-gradient(135deg, #0284c7, #2563eb);">
                        📥 Download GSTR-1 CSV Ledger
                    </button>
                </form>
            </div>
            
            <div class="reconcile-card" style="background: linear-gradient(135deg, #faf5ff, #f3e8ff); border-color: #d8b4fe;">
                <h5 class="fs-6 fw-bold mb-2">💡 Accountant Compliance Guideline</h5>
                <p class="fs-7 text-muted mb-0" style="line-height: 1.6;">
                    Under Indian GST Law, all exports under LUT require reporting the equivalent INR value based on the conversion rate on the **Invoice Issue Date**. 
                    Subsequent fluctuations realized upon bank liquidation are treated purely as financial **Forex Gain or Loss** and are credited/debited to your Profit & Loss ledger, leaving your filed GST return taxable base untouched.
                </p>
            </div>
        </div>

        <!-- Right Panel: Forex Reconciliation Interactive Dashboard -->
        <div class="reconcile-card">
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
                <div>
                    <h4 class="m-0 fs-5 mb-1">📈 Forex Reconciliation Dashboard</h4>
                    <p class="text-muted fs-7 m-0">Simulate or reconcile foreign currency payments against locked invoice bases.</p>
                </div>
                
                <div>
                    <!-- Dropdown selector to choose invoice -->
                    <select id="invoice-selector" class="form-select form-select-sm rounded-3" style="min-width: 260px;">
                        <option value="mock" 
                                data-currency="AUD" 
                                data-amount="5000" 
                                data-rate="55.20" 
                                data-inr="276000"
                                data-number="INV-2026-MOCK">
                            Mock Demo ($5,000.00 AUD @ 55.20)
                        </option>
                        @foreach($foreignInvoices as $fi)
                            @php 
                                $paymentData = $fi->payment;
                                $statusLabel = $fi->status === 'paid' ? 'PAID' : 'UNPAID';
                            @endphp
                            <option value="{{ $fi->id }}"
                                    data-currency="{{ $fi->currency_code }}"
                                    data-amount="{{ $fi->grand_total }}"
                                    data-rate="{{ $fi->exchange_rate_inr }}"
                                    data-inr="{{ $fi->inr_equivalent }}"
                                    data-number="{{ $fi->invoice_number }}"
                                    data-actual-rate="{{ $paymentData ? $paymentData->exchange_rate_payment : '' }}"
                                    data-actual-inr="{{ $paymentData ? $paymentData->inr_amount_received : '' }}"
                                    data-firc="{{ $paymentData ? $paymentData->firc_number : '' }}"
                                    data-date="{{ $paymentData ? $paymentData->payment_date->format('Y-m-d') : '' }}">
                                {{ $fi->invoice_number }} ({{ $fi->client->name }}) [{{ $statusLabel }}]
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Dashboard Widget Spec Content -->
            <div id="forex-widget-wrapper">
                <div class="d-flex flex-column flex-sm-row gap-3">
                    <!-- Locked Invoice -->
                    <div class="state-box">
                        <span style="font-size: 10px; font-weight: 700; text-transform: uppercase; color: #94a3b8; letter-spacing:0.5px;">Locked Invoice</span>
                        <h3 class="fw-extrabold mt-2 mb-1" id="lbl-locked-amount" style="font-size:24px; color:#1e293b;">₹2,76,000.00</h3>
                        <span class="fs-8 text-muted" id="lbl-locked-rate">Rate: 1 AUD = 55.20 INR</span>
                    </div>
                    
                    <!-- Actual Receipt -->
                    <div class="state-box">
                        <span style="font-size: 10px; font-weight: 700; text-transform: uppercase; color: #94a3b8; letter-spacing:0.5px;">Actual Receipt</span>
                        <h3 class="fw-extrabold mt-2 mb-1" id="lbl-received-amount" style="font-size:24px; color:#1e293b;">₹2,80,500.00</h3>
                        <span class="fs-8 text-muted" id="lbl-received-rate">Dynamic Bank Rate</span>
                    </div>
                </div>

                <!-- Highlighted Forex Banner -->
                <div id="lbl-forex-banner" class="gain-banner">
                    <span style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px;">Forex Gain (P&L Credit)</span>
                    <h2 class="fw-extrabold mt-2 mb-0" id="lbl-forex-amount" style="font-size:32px;">+ ₹4,500.00</h2>
                </div>

                <!-- Status confirmation note -->
                <div class="p-3 border rounded-3 bg-light text-center fs-7 text-muted mb-4" id="lbl-fixed-notice" style="border-style: dotted !important;">
                    Note: GST Return Base Value remains fixed at <strong id="lbl-fixed-base-notice">₹2,76,000.00</strong>. Forex variations do not impact GST liability.
                </div>

                <!-- Side-by-side Comparison Grid -->
                <div class="table-responsive bg-light p-3 border rounded-3">
                    <div class="grid-row-comp text-uppercase fw-bold fs-8">
                        <div>Description</div>
                        <div class="text-end">Value</div>
                    </div>
                    <div class="grid-row-comp">
                        <div>Locked Invoice Value (<sup id="desc-currency-invoiced">AUD</sup>)</div>
                        <div class="fw-semibold text-dark" id="grid-locked-val">₹2,76,000.00</div>
                    </div>
                    <div class="grid-row-comp">
                        <div>Actual Receipt Value (<sup id="desc-currency-received">AUD</sup>)</div>
                        <div class="fw-semibold text-dark" id="grid-received-val">₹2,80,500.00</div>
                    </div>
                    <div class="grid-row-comp">
                        <div>Forex Impact Difference</div>
                        <div class="fw-bold" id="grid-impact-val">+₹4,500.00</div>
                    </div>
                </div>

                <!-- Slider and Number input -->
                <div class="slider-container">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <label class="form-label fw-bold text-dark fs-7 mb-0">Bank Exchange Rate (INR)</label>
                        <button type="button" class="btn btn-xs btn-outline-secondary rounded-pill py-0 px-2" id="btn-reset-simulator" style="font-size: 10px;">Reset Default</button>
                    </div>
                    
                    <div class="row align-items-center g-3">
                        <div class="col-8">
                            <input type="range" class="form-range" id="simulator-rate-slider" step="0.05">
                            <div class="d-flex justify-content-between fs-8 text-muted mt-1">
                                <span id="lbl-slider-min">53.00</span>
                                <span id="lbl-slider-max">58.00</span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-group input-group-sm">
                                <input type="number" class="form-control rounded-3" id="simulator-rate-input" step="any" min="0.0001">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const selector = document.getElementById('invoice-selector');
        const slider = document.getElementById('simulator-rate-slider');
        const rateInput = document.getElementById('simulator-rate-input');
        const btnReset = document.getElementById('btn-reset-simulator');
        
        // Element labels
        const lblLockedAmount = document.getElementById('lbl-locked-amount');
        const lblLockedRate = document.getElementById('lbl-locked-rate');
        const lblReceivedAmount = document.getElementById('lbl-received-amount');
        const lblReceivedRate = document.getElementById('lbl-received-rate');
        const lblForexBanner = document.getElementById('lbl-forex-banner');
        const lblForexAmount = document.getElementById('lbl-forex-amount');
        const lblFixedNotice = document.getElementById('lbl-fixed-base-notice');
        
        const descCurrInvoiced = document.getElementById('desc-currency-invoiced');
        const descCurrReceived = document.getElementById('desc-currency-received');
        const gridLockedVal = document.getElementById('grid-locked-val');
        const gridReceivedVal = document.getElementById('grid-received-val');
        const gridImpactVal = document.getElementById('grid-impact-val');
        const lblSliderMin = document.getElementById('lbl-slider-min');
        const lblSliderMax = document.getElementById('lbl-slider-max');

        // State holder
        let activeInvoice = {
            currency: 'AUD',
            amount: 5000,
            lockedRate: 55.20,
            invoicedInr: 276000,
            number: 'INV-2026-MOCK',
            defaultSimRate: 56.10
        };

        function loadSelectedInvoice() {
            const opt = selector.options[selector.selectedIndex];
            
            if (opt.value === 'mock') {
                activeInvoice = {
                    currency: 'AUD',
                    amount: 5000,
                    lockedRate: 55.20,
                    invoicedInr: 276000,
                    number: 'INV-2026-MOCK',
                    defaultSimRate: 56.10
                };
            } else {
                const amount = parseFloat(opt.getAttribute('data-amount')) || 0;
                const lockedRate = parseFloat(opt.getAttribute('data-rate')) || 1.0;
                const invoicedInr = parseFloat(opt.getAttribute('data-inr')) || 0;
                
                // If paid, default rate is the actual rate, otherwise prefill with locked rate + 1% offset
                const actualRate = opt.getAttribute('data-actual-rate');
                const defaultSimRate = actualRate ? parseFloat(actualRate) : (lockedRate * 1.01);

                activeInvoice = {
                    currency: opt.getAttribute('data-currency'),
                    amount: amount,
                    lockedRate: lockedRate,
                    invoicedInr: invoicedInr,
                    number: opt.getAttribute('data-number'),
                    defaultSimRate: defaultSimRate
                };
            }

            // Setup slider ranges
            const minRate = activeInvoice.lockedRate - 3.00;
            const maxRate = activeInvoice.lockedRate + 3.00;
            
            slider.min = minRate.toFixed(2);
            slider.max = maxRate.toFixed(2);
            lblSliderMin.textContent = minRate.toFixed(2);
            lblSliderMax.textContent = maxRate.toFixed(2);

            // Populate inputs
            slider.value = activeInvoice.defaultSimRate.toFixed(2);
            rateInput.value = activeInvoice.defaultSimRate.toFixed(4);

            // Update UI Labels
            lblLockedAmount.textContent = '₹' + activeInvoice.invoicedInr.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2});
            lblLockedRate.textContent = `Rate: 1 ${activeInvoice.currency} = ${activeInvoice.lockedRate.toFixed(4)} INR`;
            lblFixedNotice.textContent = '₹' + activeInvoice.invoicedInr.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2});
            
            descCurrInvoiced.textContent = `${activeInvoice.amount.toLocaleString(undefined, {minimumFractionDigits: 2})} ${activeInvoice.currency}`;
            descCurrReceived.textContent = `${activeInvoice.amount.toLocaleString(undefined, {minimumFractionDigits: 2})} ${activeInvoice.currency}`;
            gridLockedVal.textContent = '₹' + activeInvoice.invoicedInr.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2});

            recalculate();
        }

        function recalculate() {
            const currentRate = parseFloat(rateInput.value) || 0;
            const receivedInr = activeInvoice.amount * currentRate;
            const forexDiff = receivedInr - activeInvoice.invoicedInr;

            lblReceivedAmount.textContent = '₹' + receivedInr.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2});
            lblReceivedRate.textContent = `Rate: 1 ${activeInvoice.currency} = ${currentRate.toFixed(4)} INR`;
            
            gridReceivedVal.textContent = '₹' + receivedInr.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2});

            // Update Banner
            if (forexDiff >= 0) {
                lblForexBanner.className = 'gain-banner';
                lblForexBanner.querySelector('span').textContent = 'Forex Gain (P&L Credit)';
                lblForexAmount.textContent = '+ ₹' + forexDiff.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2});
                gridImpactVal.className = 'fw-bold text-success';
                gridImpactVal.textContent = '+₹' + forexDiff.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2});
            } else {
                lblForexBanner.className = 'loss-banner';
                lblForexBanner.querySelector('span').textContent = 'Forex Loss (P&L Debit)';
                lblForexAmount.textContent = '- ₹' + Math.abs(forexDiff).toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2});
                gridImpactVal.className = 'fw-bold text-danger';
                gridImpactVal.textContent = '-₹' + Math.abs(forexDiff).toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2});
            }
        }

        // Event hooks
        selector.addEventListener('change', loadSelectedInvoice);
        
        slider.addEventListener('input', () => {
            const val = parseFloat(slider.value);
            rateInput.value = val.toFixed(4);
            recalculate();
        });

        rateInput.addEventListener('input', () => {
            const val = parseFloat(rateInput.value) || 0;
            const min = parseFloat(slider.min);
            const max = parseFloat(slider.max);
            if (val >= min && val <= max) {
                slider.value = val.toFixed(2);
            }
            recalculate();
        });

        btnReset.addEventListener('click', () => {
            rateInput.value = activeInvoice.defaultSimRate.toFixed(4);
            slider.value = activeInvoice.defaultSimRate.toFixed(2);
            recalculate();
        });

        // Init
        loadSelectedInvoice();
    });
</script>
@endsection
