<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Multi-Currency Invoicing Software | Live Forex | Cod Xpert</title>
    <meta name="description" content="Generate compliant international invoices with live exchange rate conversions, RBI reference rate tracking, and automated foreign exchange variance ledgers.">
    <link rel="canonical" href="{{ url('/features/multi-currency') }}">

    <!-- Open Graph / Social Media -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/features/multi-currency') }}">
    <meta property="og:title" content="Multi-Currency Invoicing Software | Live Forex | Cod Xpert">
    <meta property="og:description" content="Generate compliant international invoices with live exchange rate conversions, RBI reference rate tracking, and automated foreign exchange variance ledgers.">
    <meta property="og:image" content="https://invoice.codxpert.com/images/forex_dashboard.png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Cod Xpert Invoices">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url('/features/multi-currency') }}">
    <meta name="twitter:title" content="Multi-Currency Invoicing Software | Live Forex | Cod Xpert">
    <meta name="twitter:description" content="Generate compliant international invoices with live exchange rate conversions, RBI reference rate tracking, and automated foreign exchange variance ledgers.">
    <meta name="twitter:image" content="https://invoice.codxpert.com/images/forex_dashboard.png">


    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon-192x192.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Schema.org SoftwareApplication -->
    <script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "SoftwareApplication",
    "name": "Cod Xpert Multi-Currency Invoicing Engine",
    "applicationCategory": "BusinessApplication",
    "operatingSystem": "All",
    "offers": {
        "@type": "Offer",
        "price": "0.00",
        "priceCurrency": "USD",
        "priceValidUntil": "2027-12-31",
        "availability": "https://schema.org/InStock",
        "url": "https://invoice.codxpert.com/pricing",
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
    "image": "https://invoice.codxpert.com/images/codxpert-logo.png",
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
    "sku": "CODXPERT-INV-FEATURES_MULTI_CURRENCY",
    "mpn": "CXP-INV-2026"
}
    </script>

    <!-- Google Fonts & Bootstrap -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --brand-primary: #0284c7;
            --brand-dark: #0f172a;
            --font-heading: 'Outfit', sans-serif;
            --font-main: 'Plus Jakarta Sans', sans-serif;
        }
        body { font-family: var(--font-main); color: #334155; background-color: #f8fafc; padding-top: 80px; }
        h1, h2, h3, h4, h5 { font-family: var(--font-heading); }
        .navbar-custom { background: rgba(255, 255, 255, 0.92); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(226, 232, 240, 0.8); }
        .btn-brand-primary { background: linear-gradient(135deg, #0284c7, #2563eb); color: #ffffff; font-weight: 700; padding: 12px 28px; border-radius: 50px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 14px rgba(2, 132, 199, 0.25); transition: all 0.2s ease; }
        .btn-brand-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(2, 132, 199, 0.35); color: #ffffff; }
        .btn-brand-secondary { background: #ffffff; color: #0f172a; font-weight: 700; padding: 12px 28px; border-radius: 50px; border: 1px solid #cbd5e1; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: all 0.2s ease; }
        .feature-card { background: #ffffff; border: 1px solid #e2e8f0; border-radius: 20px; padding: 32px; height: 100%; transition: all 0.3s ease; }
        .feature-card:hover { transform: translateY(-4px); box-shadow: 0 16px 32px -8px rgba(15, 23, 42, 0.08); border-color: #38bdf8; }
        .card-icon { width: 48px; height: 48px; border-radius: 12px; background: #e0f2fe; color: #0284c7; display: flex; align-items: center; justify-content: center; font-size: 22px; margin-bottom: 20px; }
        .footer-modern { background: #ffffff; border-top: 1px solid #e2e8f0; padding: 40px 0 30px; }
    </style>
</head>
<body>

    <!-- Navigation -->
    @include('partials.public_navbar')

    <!-- Hero Section -->
    <header class="py-5 text-center bg-white border-bottom">
        <div class="container py-4">
            <span class="badge bg-primary-subtle text-primary px-3 py-1.5 rounded-pill fw-bold fs-7 mb-3">Multi-Currency & Forex Engine</span>
            <h1 class="display-4 fw-extrabold text-dark mb-3">Multi-Currency Invoicing Software with Live Forex Sync</h1>
            <p class="lead text-muted mx-auto mb-4" style="max-width: 720px;">
                Bill international clients seamlessly in USD, AED, EUR, GBP, AUD, or CAD while maintaining 100% statutory INR compliance, real-time exchange rates, and automated Forex Gain/Loss ledger.
            </p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="{{ route('register') }}" class="btn-brand-primary">Start Multi-Currency Free</a>
                <a href="{{ route('tools.invoice-generator') }}" class="btn-brand-secondary">Try Live Generator</a>
            </div>
            <p class="text-muted fs-8 mt-3 mb-0">⚡ 100% Free during open beta · No credit card required</p>
        </div>
    </header>

    <!-- Main Content Grid -->
    <main class="container py-5">
        
        <!-- Live Currency Strip -->
        <div class="row g-3 mb-5">
            @foreach(['USD' => '$', 'AED' => 'AED', 'EUR' => '€', 'GBP' => '£', 'AUD' => 'A$', 'CAD' => 'C$'] as $curr => $sym)
            <div class="col-md-2 col-6">
                <div class="p-3 bg-white rounded-4 border text-center">
                    <div class="fs-8 text-muted fw-bold">{{ $curr }}/INR</div>
                    <div class="fs-5 fw-extrabold text-primary">₹{{ number_format($rates[$curr] ?? 83.5, 2) }}</div>
                    <div class="fs-8 text-success fw-semibold">Live Interbank</div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="card-icon">💱</div>
                    <h4 class="fw-bold text-dark mb-2">Dual Currency PDF Display</h4>
                    <p class="text-muted fs-7 mb-0">Your client sees their local currency (e.g. $5,000 USD) while the PDF automatically embeds statutory INR conversion rates required by GST authorities.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="card-icon">📈</div>
                    <h4 class="fw-bold text-dark mb-2">Automated Forex Gain / Loss</h4>
                    <p class="text-muted fs-7 mb-0">Compares the invoice issue exchange rate with the bank realization rate to auto-calculate your taxable Forex Gain or Loss under Section 43AA.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="card-icon">📜</div>
                    <h4 class="fw-bold text-dark mb-2">GST Rule 96A LUT Auto-Stamp</h4>
                    <p class="text-muted fs-7 mb-0">Whenever foreign currency is selected, the platform automatically applies zero-rated export declarations so you are never charged 18% IGST wrongly.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="card-icon">🏦</div>
                    <h4 class="fw-bold text-dark mb-2">Multiple Bank & Wire Details</h4>
                    <p class="text-muted fs-7 mb-0">Store specific SWIFT/BIC codes, IBAN numbers, and intermediary routing details for US Wire, SEPA (Europe), or UAE local transfers.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="card-icon">⚡</div>
                    <h4 class="fw-bold text-dark mb-2">Automated Rate Caching</h4>
                    <p class="text-muted fs-7 mb-0">Rates are fetched daily from official central bank feeds and cached for sub-10ms response times so billing never slows down.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="card-icon">📁</div>
                    <h4 class="fw-bold text-dark mb-2">GSTR-1 Table 6A Exports</h4>
                    <p class="text-muted fs-7 mb-0">Exports ready-to-upload CSV files formatted precisely for Table 6A (Exports) of the Indian GST portal with foreign values and INR conversions.</p>
                </div>
            </div>
        </div>


        <!-- Real-Time Exchange Rate Architecture -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h3 class="fw-bold text-dark mb-4 text-center">Multi-Currency Engine Architecture & Dual-Reporting Standards</h3>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="p-4 rounded-3 bg-light h-100 border">
                        <div class="badge bg-primary text-white rounded-pill mb-2 px-3 py-1">Feature 1</div>
                        <h5 class="fw-bold text-dark mb-2">Automated Interbank Feeds</h5>
                        <p class="text-muted fs-7 mb-0">Daily reference rates for USD, EUR, AED, GBP, CAD, and AUD are synchronized via secure institutional currency APIs, ensuring your billing reflects precise market exchange rates.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 rounded-3 bg-light h-100 border">
                        <div class="badge bg-primary text-white rounded-pill mb-2 px-3 py-1">Feature 2</div>
                        <h5 class="fw-bold text-dark mb-2">Invoice Date Rate Freezing</h5>
                        <p class="text-muted fs-7 mb-0">Once an invoice is finalized, the exchange rate on the date of supply is permanently frozen in accordance with statutory accounting standards, providing an audit-proof historical record.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 rounded-3 bg-light h-100 border">
                        <div class="badge bg-primary text-white rounded-pill mb-2 px-3 py-1">Feature 3</div>
                        <h5 class="fw-bold text-dark mb-2">Dual Currency PDF Display</h5>
                        <p class="text-muted fs-7 mb-0">Clients see clean foreign currency charges ($ USD, € EUR) while your accounting department sees statutory INR conversions alongside mandatory GST declarations on the same PDF.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statutory Regulatory Compliance for International Invoicing -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h3 class="fw-bold text-dark mb-3 text-center">Statutory Compliance: RBI Reference Rates & Accounting Standard AS-11</h3>
            <p class="text-muted text-center fs-7 mx-auto mb-4" style="max-width: 720px;">
                Invoicing international clients involves cross-border statutory compliance regulated by both the Reserve Bank of India (RBI) and the Goods and Services Tax (GST) Council.
            </p>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="border rounded-3 p-4 h-100 bg-light">
                        <h5 class="fw-bold text-dark mb-2">Section 16 IGST Act & Rule 96A Exemption</h5>
                        <p class="text-muted fs-7 mb-3">Service exports billed in foreign convertible currency qualify for zero-rated status under Section 16 of the IGST Act, provided a valid Letter of Undertaking (LUT) is filed. Cod Xpert stamps the legal LUT declaration automatically onto foreign currency invoices.</p>
                        <a href="{{ route('guides.gst-lut') }}" class="text-primary fw-bold fs-7 text-decoration-none">Read the GST LUT Rule 96A Exporter Guide →</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="border rounded-3 p-4 h-100 bg-light">
                        <h5 class="fw-bold text-dark mb-2">FEMA 23(R) & Bank Realization Closure</h5>
                        <p class="text-muted fs-7 mb-3">Under RBI Master Directions, export invoices must be reconciled against inward remittances within a statutory window. Cod Xpert generates standardized declarations compatible with Authorised Dealer (AD) banking desks at HDFC, ICICI, SBI, and Axis Bank.</p>
                        <a href="{{ route('guides.fema-23r') }}" class="text-primary fw-bold fs-7 text-decoration-none">Review the FEMA 23(R) Compliance Guide →</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Multi-Currency FAQs -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h3 class="fw-bold text-dark mb-4 text-center">Frequently Asked Questions on Multi-Currency Invoicing</h3>
            <div class="row g-4">
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">Which foreign currencies are supported?</h6>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">What official rate sources does Cod Xpert use for benchmark rates?</h6>
                    <p class="text-muted fs-7">Cod Xpert integrates authoritative benchmark exchange feeds sourced from institutional central banks including the European Central Bank (ECB) and the Reserve Bank of India (RBI) reference rate archives.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">How do multi-currency invoices link with our e-BRC filings?</h6>
                    <p class="text-muted fs-7">Every multi-currency invoice captures both foreign face value and domestic INR conversion on the supply date, giving your bank an unambiguous document to issue the Foreign Inward Remittance Certificate (FIRC).</p>
                </div>

                    <p class="text-muted fs-7">Cod Xpert supports all major global currencies including US Dollars (USD), Euros (EUR), British Pounds (GBP), UAE Dirhams (AED), Australian Dollars (AUD), and Canadian Dollars (CAD).</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">Can I manually override an exchange rate on a specific invoice?</h6>
                    <p class="text-muted fs-7">Yes. While the system automatically suggests the live benchmark exchange rate, you can manually adjust the rate to match a specific forward contract or bank agreement.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">How does Cod Xpert handle realized forex gains and losses?</h6>
                    <p class="text-muted fs-7">When you record payment against a foreign invoice, the system logs the net INR received and calculates the currency variance for easy entry into your accounting software under Section 43AA.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">Does this work with international payment gateways like Stripe or Wise?</h6>
                    <p class="text-muted fs-7">Yes. You can display your Wise, Payoneer, or foreign virtual account numbers (SWIFT/IBAN) directly on foreign invoices to make cross-border settlements frictionless.</p>
                </div>
            </div>
        </div>

        <!-- Multi-Currency Resource Hub -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h4 class="fw-bold text-dark mb-3 text-center">Related Features, Invoicing Tools & Exporter Guides</h4>
            <div class="row g-3 text-center">
                <div class="col-6 col-md-3">
                    <a href="{{ route('tools.forex-calculator') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">Forex Calculator</div>
                        <span class="text-muted fs-8">Real-time wire conversion</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('features.e-invoicing') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">E-Invoicing</div>
                        <span class="text-muted fs-8">Statutory GST compliance</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('guides.firc-e-brc') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">FIRC & e-BRC Guide</div>
                        <span class="text-muted fs-8">Export remittance closure</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('templates.excel') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">Excel Templates</div>
                        <span class="text-muted fs-8">Multi-currency spreadsheets</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- CTA Banner -->
        <div class="p-5 rounded-4 text-center text-white" style="background: linear-gradient(135deg, #0f172a, #1e293b);">
            <h2 class="fw-extrabold mb-3">Invoice Globally with Zero Foreign Exchange Headaches</h2>
            <p class="text-slate-300 fs-6 mx-auto mb-4" style="max-width: 600px;">Experience the easiest multi-currency invoicing system built for modern export businesses.</p>
            <a href="{{ route('register') }}" class="btn-brand-primary">Create Free Account</a>
        </div>
    </main>

    <!-- Footer -->
    @include('partials.public_footer')

</body>
</html>
