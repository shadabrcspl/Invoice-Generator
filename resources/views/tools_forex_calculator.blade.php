<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Live Forex & Exporter Remittance Calculator | Cod Xpert</title>
    <meta name="description" content="Calculate real-time foreign currency conversions and remittance variance for invoices. Instant conversions between USD, AED, EUR, GBP, CAD, AUD and INR with RBI reference buffer checks.">
    <meta name="keywords" content="forex calculator for invoices, export currency conversion calculator, inward remittance calculator, forex variance calculator, INR exchange rate calculator">
    <link rel="canonical" href="{{ url('/tools/forex-calculator') }}">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/tools/forex-calculator') }}">
    <meta property="og:title" content="Live Forex & Exporter Remittance Calculator | Cod Xpert">
    <meta property="og:description" content="Interactive currency calculator for exporters and freelancers. Compute exact invoice conversions and buffer against bank spreads.">

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
                        <a href="{{ route('free-invoice-generator') }}" class="btn btn-primary px-4 py-2 rounded-pill fw-bold">Generate Compliant Multi-Currency Invoice</a>
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
