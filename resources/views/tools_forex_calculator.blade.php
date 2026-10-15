<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Live Forex & Exporter Remittance Calculator | Cod Xpert</title>
    <meta name="description" content="Calculate real-time foreign currency conversions and remittance variance for invoices across USD, AED, EUR, GBP, CAD, AUD, and INR.">
    <link rel="canonical" href="{{ url('/tools/forex-calculator') }}">

    <!-- Open Graph / Social Media -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/tools/forex-calculator') }}">
    <meta property="og:title" content="Live Forex & Exporter Remittance Calculator | Cod Xpert">
    <meta property="og:description" content="Calculate real-time foreign currency conversions and remittance variance for invoices across USD, AED, EUR, GBP, CAD, AUD, and INR.">
    <meta property="og:image" content="https://invoice.codxpert.com/images/forex_dashboard.png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Cod Xpert Invoices">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url('/tools/forex-calculator') }}">
    <meta name="twitter:title" content="Live Forex & Exporter Remittance Calculator | Cod Xpert">
    <meta name="twitter:description" content="Calculate real-time foreign currency conversions and remittance variance for invoices across USD, AED, EUR, GBP, CAD, AUD, and INR.">
    <meta name="twitter:image" content="https://invoice.codxpert.com/images/forex_dashboard.png">


    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon-192x192.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Schema.org SoftwareApplication -->
    <script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebApplication",
    "name": "Cod Xpert Exporter Forex & Remittance Calculator",
    "image": "https://invoice.codxpert.com/images/codxpert-logo.png",
    "applicationCategory": "FinanceApplication",
    "operatingSystem": "All",
    "brand": {
        "@type": "Brand",
        "name": "CodXpert"
    },
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.9",
        "reviewCount": "128",
        "bestRating": "5",
        "worstRating": "1"
    },
    "offers": {
        "@type": "Offer",
        "price": "0.00",
        "priceCurrency": "USD",
        "priceValidUntil": "2027-12-31",
        "hasMerchantReturnPolicy": {
            "@type": "MerchantReturnPolicy",
            "applicableCountry": "IN",
            "returnPolicyCountry": "IN",
            "returnPolicyCategory": "https://schema.org/MerchantReturnFiniteReturnWindow",
            "merchantReturnDays": 30,
            "returnMethod": "https://schema.org/ReturnNotPermitted",
            "returnFees": "https://schema.org/FreeReturn"
        },
        "shippingDetails": {
            "@type": "OfferShippingDetails",
            "shippingRate": {
                "@type": "MonetaryAmount",
                "value": "0.00",
                "currency": "USD"
            },
            "shippingDestination": {
                "@type": "DefinedRegion",
                "addressCountry": "IN"
            },
            "deliveryTime": {
                "@type": "ShippingDeliveryTime",
                "handlingTime": {
                    "@type": "QuantitativeValue",
                    "minValue": 0,
                    "maxValue": 0,
                    "unitCode": "DAY"
                },
                "transitTime": {
                    "@type": "QuantitativeValue",
                    "minValue": 0,
                    "maxValue": 0,
                    "unitCode": "DAY"
                }
            }
        }
    },
    "publisher": {
        "@type": "Organization",
        "name": "CodXpert",
        "url": "https://codxpert.com/"
    },
    "sku": "CODXPERT-INV-TOOLS_FOREX_CALCULATOR",
    "mpn": "CXP-INV-2026"
}
    </script>

    <!-- Google Fonts & Bootstrap -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@500;600;700;800&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --brand-primary: #0284c7;
            --brand-dark: #0f172a;
            --font-heading: 'Outfit', sans-serif;
            --font-main: 'Plus Jakarta Sans', sans-serif;
        }
        body {
            font-family: var(--font-main);
            color: #334155;
            background-color: #f8fafc;
            padding-top: 80px;
        }
        h1, h2, h3, h4, h5 {
            font-family: var(--font-heading);
        }
        .navbar-custom {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        }
        .calc-card {
            background: #ffffff;
            border-radius: 24px;
            border: 1px solid #e2e8f0;
            padding: 36px;
            box-shadow: 0 20px 40px -15px rgba(15, 23, 42, 0.07);
        }
        .rate-badge {
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            padding: 8px 16px;
            border-radius: 12px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.85rem;
        }
        .footer-modern {
            background: #ffffff;
            border-top: 1px solid #e2e8f0;
            padding: 40px 0 30px;
        }
    </style>
</head>
<body>

    <!-- Navigation -->
    @include('partials.public_navbar')

    <!-- Header -->
    <header class="py-5 text-center bg-white border-bottom">
        <div class="container py-4">
            <span class="badge bg-primary-subtle text-primary px-3 py-1.5 rounded-pill fw-bold fs-7 mb-3">Free Interactive Tool</span>
            <h1 class="display-4 fw-extrabold text-dark mb-3">Live Forex & Invoice Variance Calculator</h1>
            <p class="lead text-muted mx-auto mb-4" style="max-width: 720px;">
                Calculate precise foreign invoice realizations, bank markup spreads, and domestic INR equivalent values with live market benchmarks.
            </p>

            <!-- Live Benchmark Pill Strip -->
            <div class="d-flex flex-wrap justify-content-center gap-2">
                @foreach($rates as $cur => $rate)
                    <div class="rate-badge">
                        <span class="fw-bold text-dark">1 {{ $cur }}</span> = <span class="text-primary fw-semibold">₹{{ number_format($rate, 2) }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </header>

    <!-- Main Tool -->
    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="calc-card mb-5">
                    <h4 class="fw-bold text-dark mb-4">Invoice Remittance Estimator</h4>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark">Billed Invoice Amount</label>
                            <input type="number" id="calcAmount" class="form-control form-control-lg" value="5000" min="1" step="any">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark">Billed Currency</label>
                            <select id="calcCurrency" class="form-select form-select-lg">
                                @foreach($rates as $cur => $rate)
                                    <option value="{{ $rate }}" data-code="{{ $cur }}" {{ $cur == 'USD' ? 'selected' : '' }}>
                                        {{ $cur }} (Benchmark: ₹{{ number_format($rate, 2) }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark">Estimated Bank Margin / Spread (%)</label>
                            <input type="number" id="calcSpread" class="form-control" value="1.5" min="0" max="10" step="0.1">
                            <div class="form-text text-muted">Typical Indian banks charge 1.2% - 2.5% on retail foreign wire conversion.</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-dark">Bank Fixed Inward Fee (INR)</label>
                            <input type="number" id="calcFixedFee" class="form-control" value="500" min="0" step="50">
                            <div class="form-text text-muted">Fixed SWIFT/FIRC issuance charge debited by your bank.</div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Results Output Display -->
                    <div class="p-4 bg-light rounded-4 border">
                        <div class="row text-center g-3">
                            <div class="col-sm-4">
                                <div class="text-muted fs-8 text-uppercase fw-semibold">Gross INR Equivalent</div>
                                <div class="h4 fw-bold text-dark mb-0 font-mono" id="outGrossINR">₹0.00</div>
                            </div>
                            <div class="col-sm-4">
                                <div class="text-muted fs-8 text-uppercase fw-semibold">Bank FX Loss & Fees</div>
                                <div class="h4 fw-bold text-danger mb-0 font-mono" id="outFeeINR">₹0.00</div>
                            </div>
                            <div class="col-sm-4">
                                <div class="text-muted fs-8 text-uppercase fw-semibold text-success">Net Bank Realization</div>
                                <div class="h4 fw-bold text-success mb-0 font-mono" id="outNetINR">₹0.00</div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 text-center">
                        <a href="{{ route('tools.invoice-generator') }}" class="btn btn-primary px-4 py-2 rounded-pill fw-bold">Generate Compliant Multi-Currency Invoice</a>
                    </div>
                </div>

                <!-- Explanatory Knowledge Guide -->
                <div class="p-4 rounded-4 bg-white border">
                    <h4 class="fw-bold text-dark mb-3">How Foreign Exchange Rates Work in Export Invoicing</h4>
                    <p class="text-muted fs-7 leading-relaxed mb-3">
                        When issuing an export invoice under GST Rule 96A, you must record the invoice in the contracted foreign currency (e.g., $10,000 USD) and specify the reference exchange rate on the date of supply.
                    </p>
                    <p class="text-muted fs-7 leading-relaxed mb-0">
                        When the foreign wire is realized in your bank account, currency fluctuation creates an exchange gain or loss. Cod Xpert helps you track both the invoice date rate and final realization values for seamless accounting and e-BRC closure.
                    </p>
                </div>
            </div>
        </div>

        <!-- Statutory Forex Accounting Framework -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mt-5 mb-5">
            <h3 class="fw-bold text-dark mb-4 text-center">Statutory Accounting for Foreign Exchange Fluctuations in India</h3>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="border rounded-3 p-4 h-100 bg-light">
                        <h5 class="fw-bold text-dark mb-2">Accounting Standard AS-11 & Ind AS 21</h5>
                        <p class="text-muted fs-7 mb-3">Under Indian Accounting Standard AS-11, a foreign currency transaction must be recorded initially in the reporting currency (INR) by applying the exchange rate on the date of supply. When funds are received, the variance between invoice date value and bank credit value constitutes a realized foreign exchange gain or loss.</p>
                        <a href="{{ route('features.multi-currency') }}" class="text-primary fw-bold fs-7 text-decoration-none">Explore Our Multi-Currency Engine →</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="border rounded-3 p-4 h-100 bg-light">
                        <h5 class="fw-bold text-dark mb-2">Tax Treatment Under Section 43AA</h5>
                        <p class="text-muted fs-7 mb-3">Under Section 43AA of the Income Tax Act, 1961, foreign exchange gains or losses arising in respect of monetary items relating to business revenue must be treated as taxable income or allowable business deductions in the financial year in which realization occurs.</p>
                        <a href="{{ route('guides.firc-e-brc') }}" class="text-primary fw-bold fs-7 text-decoration-none">Learn More in the FIRC & e-BRC Guide →</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fintech vs Traditional Banks Spread Comparison -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h3 class="fw-bold text-dark mb-3 text-center">Minimizing Foreign Wire Spread Loss: Fintech vs. Traditional Banks</h3>
            <p class="text-muted text-center fs-7 mx-auto mb-4" style="max-width: 720px;">
                Selecting the optimal remittance channel can save Indian exporters and agencies between 1.5% and 3.5% on every international settlement.
            </p>
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-dark fw-bold">Remittance Channel</th>
                            <th class="text-primary fw-bold">Typical FX Margin</th>
                            <th class="text-dark fw-bold">Fixed Wire Fees</th>
                            <th class="text-dark fw-bold">FIRC / e-BRC Ease</th>
                        </tr>
                    </thead>
                    <tbody class="fs-7 text-muted">
                        <tr>
                            <td class="fw-semibold text-dark">Direct SWIFT Wire (AD Bank)</td>
                            <td>1.5% - 2.8% over interbank rate.</td>
                            <td>$15 - $35 intermediary deduction + ₹250 bank fee.</td>
                            <td>Direct bank FIRA issued by your AD Branch.</td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-dark">Wise Business Remittances</td>
                            <td>0.4% - 0.7% (Mid-market transparent rate).</td>
                            <td>Low transparent fee (typically &lt;0.5%).</td>
                            <td>Partner bank FIRA downloadable from Wise portal.</td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-dark">Payoneer Virtual Receiving</td>
                            <td>1.5% - 2.0% above mid-market rate.</td>
                            <td>Standard platform withdrawal fees.</td>
                            <td>FIRA generated within 48-72 hours.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Forex FAQs -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h3 class="fw-bold text-dark mb-4 text-center">Frequently Asked Questions on Forex Invoicing</h3>
            <div class="row g-4">
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">Which exchange rate should I declare on a GST export invoice?</h6>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">How should I document foreign bank intermediary deductions?</h6>
                    <p class="text-muted fs-7">When overseas clients remit payments, correspondent banks often deduct $15 to $30 in wire charges. Record these fees under allowable bank expenses inside our tracker to maintain exact gross-to-net reconciliation.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">What is the statutory deadline for realizing foreign exchange proceeds in India?</h6>
                    <p class="text-muted fs-7">Under Foreign Exchange Management Act (FEMA) regulations, foreign inward remittances for services must be realized within 9 months from the invoice date (extended to 1 year under GST Rule 96A(1)(b)).</p>
                </div>

                    <p class="text-muted fs-7">Under CBIC guidelines, the exchange rate notified by the Central Board of Indirect Taxes and Customs (CBIC) or the Reserve Bank of India (RBI) reference rate on the date of the invoice should be applied for calculating statutory INR values.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">What causes variance between invoice INR and bank credit?</h6>
                    <p class="text-muted fs-7">Two factors cause remittance variance: exchange rate movements between the invoice dispatch date and realization date, and bank intermediary spread margins (typically 1.2% - 2.5%) plus fixed telegraphic transfer fees.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">Can CodXpert automatically freeze exchange rates on invoice creation?</h6>
                    <p class="text-muted fs-7">Yes. When creating an invoice in USD, EUR, GBP, or AED, CodXpert locks the benchmark exchange rate on that date so your historical records remain audit-ready.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">Does an exchange loss reduce my taxable income in India?</h6>
                    <p class="text-muted fs-7">Yes. Under Section 43AA of the Income Tax Act, 1961, a realized foreign exchange loss incurred on revenue account transactions is treated as an allowable business deduction.</p>
                </div>
            </div>
        </div>

        <!-- Forex Resource Hub -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h4 class="fw-bold text-dark mb-3 text-center">Related Invoicing Tools, Solutions & Guides</h4>
            <div class="row g-3 text-center">
                <div class="col-6 col-md-3">
                    <a href="{{ route('tools.invoice-generator') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">Instant Generator</div>
                        <span class="text-muted fs-8">Create multi-currency PDF</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('features.multi-currency') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">Multi-Currency</div>
                        <span class="text-muted fs-8">Automated live forex sync</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('guides.fema-23r') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">FEMA 23(R) Guide</div>
                        <span class="text-muted fs-8">RBI export declarations</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('templates.excel') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">Excel Templates</div>
                        <span class="text-muted fs-8">Download multi-currency sheets</span>
                    </a>
                </div>
            </div>
        </div>

    </main>

    <!-- Interactive Script -->
    <script>
        function calculateForex() {
            const amount = parseFloat(document.getElementById('calcAmount').value) || 0;
            const rateSelect = document.getElementById('calcCurrency');
            const rate = parseFloat(rateSelect.value) || 1;
            const spreadPct = parseFloat(document.getElementById('calcSpread').value) || 0;
            const fixedFee = parseFloat(document.getElementById('calcFixedFee').value) || 0;

            const gross = amount * rate;
            const spreadFee = gross * (spreadPct / 100);
            const totalFee = spreadFee + fixedFee;
            const net = Math.max(0, gross - totalFee);

            const formatINR = (val) => '₹' + val.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

            document.getElementById('outGrossINR').innerText = formatINR(gross);
            document.getElementById('outFeeINR').innerText = '-' + formatINR(totalFee);
            document.getElementById('outNetINR').innerText = formatINR(net);
        }

        document.getElementById('calcAmount').addEventListener('input', calculateForex);
        document.getElementById('calcCurrency').addEventListener('change', calculateForex);
        document.getElementById('calcSpread').addEventListener('input', calculateForex);
        document.getElementById('calcFixedFee').addEventListener('input', calculateForex);

        calculateForex();
    </script>

    <!-- Footer -->
    @include('partials.public_footer')

</body>
</html>
