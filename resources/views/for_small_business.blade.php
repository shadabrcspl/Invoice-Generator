<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Small Business Invoicing Software | GST & Forex | Cod Xpert</title>
    <meta name="description" content="Purpose-built invoicing software for growing businesses. Automate 0% IGST LUT export declarations, multi-currency billing, and seamless GSTR-1 compliance.">
    <link rel="canonical" href="{{ url('/solutions/small-business') }}">

    <!-- Open Graph / Social Media -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/solutions/small-business') }}">
    <meta property="og:title" content="Small Business Invoicing Software | GST & Forex | Cod Xpert">
    <meta property="og:description" content="Purpose-built invoicing software for growing businesses. Automate 0% IGST LUT export declarations, multi-currency billing, and seamless GSTR-1 compliance.">
    <meta property="og:image" content="https://invoice.codxpert.com/images/invoice_pdf.png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Cod Xpert Invoices">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url('/solutions/small-business') }}">
    <meta name="twitter:title" content="Small Business Invoicing Software | GST & Forex | Cod Xpert">
    <meta name="twitter:description" content="Purpose-built invoicing software for growing businesses. Automate 0% IGST LUT export declarations, multi-currency billing, and seamless GSTR-1 compliance.">
    <meta name="twitter:image" content="https://invoice.codxpert.com/images/invoice_pdf.png">


    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon-192x192.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Schema.org SoftwareApplication -->
    <script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "SoftwareApplication",
    "name": "Cod Xpert Small Business Invoicing",
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
    "sku": "CODXPERT-INV-FOR_SMALL_BUSINESS",
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
        .btn-brand-primary {
            background: linear-gradient(135deg, #0284c7, #2563eb);
            color: #ffffff;
            font-weight: 700;
            padding: 12px 28px;
            border-radius: 50px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 14px rgba(2, 132, 199, 0.25);
            transition: all 0.2s ease;
        }
        .btn-brand-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(2, 132, 199, 0.35);
            color: #ffffff;
        }
        .feature-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 32px;
            height: 100%;
            transition: all 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 32px -8px rgba(15, 23, 42, 0.08);
            border-color: #38bdf8;
        }
        .card-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: #e0f2fe;
            color: #0284c7;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 20px;
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

    <!-- Hero Section -->
    <header class="py-5 text-center bg-white border-bottom">
        <div class="container py-4">
            <span class="badge bg-primary-subtle text-primary px-3 py-1.5 rounded-pill fw-bold fs-7 mb-3">Built for Growing SMBs</span>
            <h1 class="display-4 fw-extrabold text-dark mb-3">Modern Invoicing Built for Small Businesses</h1>
            <p class="lead text-muted mx-auto mb-4" style="max-width: 720px;">
                Ditch bloated ERPs and clunky legacy software. Cod Xpert delivers clean, lightning-fast billing with built-in GST zero-rating, multi-currency conversion, and automated client tracking.
            </p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('register') }}" class="btn-brand-primary">Start Free Today</a>
                <a href="{{ route('pricing') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-semibold">View Free Plan</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container py-5">
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="card-icon">⚡</div>
                    <h4 class="fw-bold text-dark mb-2">Create Invoices in 60s</h4>
                    <p class="text-muted fs-7 mb-0">Select saved clients, auto-fill item catalogs, calculate tax rates automatically, and dispatch sleek PDFs directly to customer inboxes in under one minute.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="card-icon">🌍</div>
                    <h4 class="fw-bold text-dark mb-2">Multi-Currency & Forex</h4>
                    <p class="text-muted fs-7 mb-0">Bill foreign clients in USD, EUR, AED, GBP, or CAD with real-time exchange rates and RBI reference tracking. Never lose margin to currency confusion.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="card-icon">🛡️</div>
                    <h4 class="fw-bold text-dark mb-2">100% Tax & Legal Compliant</h4>
                    <p class="text-muted fs-7 mb-0">Full support for CGST/SGST/IGST breakdown, HSN/SAC codes, Rule 96A Letter of Undertaking (LUT) zero-rating, and DPDP Act 2023 data compliance.</p>
                </div>
            </div>
        </div>

        <!-- Problem / Solution Grid -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h2 class="fw-bold text-dark mb-4 text-center">Why Small Businesses Choose Cod Xpert</h2>
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="p-4 rounded-3 bg-danger-subtle border border-danger-subtle h-100">
                        <h5 class="fw-bold text-danger mb-3">❌ The Old Way (Legacy Software & Spreadsheets)</h5>
                        <ul class="list-unstyled d-flex flex-column gap-2 text-muted fs-7 mb-0">
                            <li>• Heavy desktop software (Tally) with complex menus and steep learning curves.</li>
                            <li>• Excel formulas breaking, resulting in inaccurate tax calculations and embarrassing client errors.</li>
                            <li>• Manual chasing of late payments via WhatsApp and endless email threads.</li>
                            <li>• Zero visibility on whether a customer actually received or viewed the invoice.</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-4 rounded-3 bg-success-subtle border border-success-subtle h-100">
                        <h5 class="fw-bold text-success mb-3">✓ The Cod Xpert Way (Modern Cloud Platform)</h5>
                        <ul class="list-unstyled d-flex flex-column gap-2 text-dark fs-7 mb-0">
                            <li>• Clean, responsive web interface accessible from your laptop, tablet, or smartphone.</li>
                            <li>• Automated tax engine ensuring full compliance with Indian GST and international export norms.</li>
                            <li>• One-click recurring billing, overdue alerts, and automated follow-ups.</li>
                            <li>• Full audit logs and real-time payment status badges (Paid, Partial, Overdue).</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h3 class="fw-bold text-dark mb-4 text-center">Frequently Asked Questions</h3>
            <div class="row g-4">
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">Can I add my business logo and custom bank accounts?</h6>
                    <p class="text-muted fs-7">Yes. Upload your high-resolution company logo, address, GSTIN, PAN, and customize domestic (NEFT/RTGS/UPI) or international wire details (SWIFT, IBAN) easily.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">Does this support Indian GST e-Invoicing?</h6>
                    <p class="text-muted fs-7">Yes. You can generate B2B invoices with IRN and QR codes compliant with the IRP portal specifications for businesses above the mandatory turnover threshold.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">Can my accountant export our data?</h6>
                    <p class="text-muted fs-7">Absolutely. One-click CSV and Excel exports allow your CA or accountant to file GSTR-1, GSTR-3B, or corporate income tax returns effortlessly.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">How much does Cod Xpert cost for small businesses?</h6>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">Can we manage multi-location branches and separate GSTINs?</h6>
                    <p class="text-muted fs-7">Yes. You can configure multiple company profiles and branch addresses with their respective state GSTINs, state jurisdiction codes, and dedicated invoice numbering sequences.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">How does Cod Xpert maintain audit trails for company auditors?</h6>
                    <p class="text-muted fs-7">Every invoice created, modified, sent, or settled has an immutable system audit trail recording the timestamp, IP address, user account, and exact revision history for seamless annual auditing.</p>
                </div>

                    <p class="text-muted fs-7">We are offering full access on a free trial with zero credit card required. Generate unlimited invoices and scale without subscription pressure.</p>
                </div>
            </div>
        </div>


        <!-- 4-Stage Financial Workflow Section -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h3 class="fw-bold text-dark mb-4 text-center">A Complete Financial Operations Lifecycle for Growing Businesses</h3>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="p-3 rounded-3 bg-light h-100 border">
                        <div class="badge bg-primary text-white rounded-pill mb-2 px-3 py-1">Phase 1</div>
                        <h6 class="fw-bold text-dark mb-2">Estimates & Quotations</h6>
                        <p class="text-muted fs-8 mb-2">Draft accurate client proposals with custom tax tiers and catalog pricing using our <a href="{{ route('features.quotations') }}" class="text-primary fw-semibold text-decoration-none">Quotations to Invoices</a> module. Secure client sign-off with immutable revision tracking.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 rounded-3 bg-light h-100 border">
                        <div class="badge bg-primary text-white rounded-pill mb-2 px-3 py-1">Phase 2</div>
                        <h6 class="fw-bold text-dark mb-2">Multi-Currency Invoicing</h6>
                        <p class="text-muted fs-8 mb-2">Convert accepted quotes into statutory tax invoices in 1-click. Apply live exchange rate benchmarks via our <a href="{{ route('features.multi-currency') }}" class="text-primary fw-semibold text-decoration-none">Multi-Currency Engine</a> and lock currency conversion rates on invoice date.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 rounded-3 bg-light h-100 border">
                        <div class="badge bg-primary text-white rounded-pill mb-2 px-3 py-1">Phase 3</div>
                        <h6 class="fw-bold text-dark mb-2">Automated Tracking & Reminders</h6>
                        <p class="text-muted fs-8 mb-2">Monitor settlement velocity in real time. Deploy non-intrusive payment notifications via <a href="{{ route('features.invoice-tracking') }}" class="text-primary fw-semibold text-decoration-none">Invoice Tracking</a> and dispatch from your verified corporate domain with zero spam penalties.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 rounded-3 bg-light h-100 border">
                        <div class="badge bg-primary text-white rounded-pill mb-2 px-3 py-1">Phase 4</div>
                        <h6 class="fw-bold text-dark mb-2">GSTR-1 & Audit Closure</h6>
                        <p class="text-muted fs-8 mb-2">Generate export-ready GSTR-1 Table 6A CSV returns automatically. Match foreign inflows against bank remittances in line with <a href="{{ route('guides.fema-23r') }}" class="text-primary fw-semibold text-decoration-none">FEMA 23(R) Guidelines</a> and prepare for annual CA reviews.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statutory Compliance & Tax Architecture for Indian MSMEs -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h3 class="fw-bold text-dark mb-3 text-center">Statutory Compliance Built for Indian MSMEs and Exporters</h3>
            <p class="text-muted text-center fs-7 mx-auto mb-4" style="max-width: 720px;">
                Operating a growing business requires rigorous adherence to statutory regulations. Cod Xpert automates tax calculations and regulatory declarations, shielding your enterprise from hefty penalties.
            </p>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="border rounded-3 p-4 h-100">
                        <h5 class="fw-bold text-dark mb-2">Zero-Rated Export Billing Under Rule 96A</h5>
                        <p class="text-muted fs-7 mb-3">If your business delivers software development, consulting, design, or engineering services to foreign clients, you are entitled to export with 0% IGST under a valid Letter of Undertaking (LUT). Cod Xpert embeds the mandatory statutory declaration required by the GST Department directly into your PDF invoices, eliminating manual paperwork errors.</p>
                        <a href="{{ route('guides.gst-lut') }}" class="text-primary fw-bold fs-7 text-decoration-none">Read the Complete GST LUT Rule 96A Guide →</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="border rounded-3 p-4 h-100">
                        <h5 class="fw-bold text-dark mb-2">Foreign Remittance & Bank Realization Tracking</h5>
                        <p class="text-muted fs-7 mb-3">Inward remittances received via international wire or payment gateways must be reconciled with your invoice value to obtain a Foreign Inward Remittance Certificate (FIRC) or electronic Bank Realisation Certificate (e-BRC). Our built-in ledger matches payments against benchmark rates to ensure error-free documentation.</p>
                        <a href="{{ route('guides.firc-e-brc') }}" class="text-primary fw-bold fs-7 text-decoration-none">Read the FIRC & e-BRC Reconciliation Guide →</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Inter-Connected Resource Hub -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h4 class="fw-bold text-dark mb-3 text-center">Explore Related Solutions, Specialized Guides & Free Tools</h4>
            <div class="row g-3 text-center">
                <div class="col-6 col-md-3">
                    <a href="{{ route('solutions.agencies') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">For Digital Agencies</div>
                        <span class="text-muted fs-8">Retainers & project billing</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('solutions.consultants') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">For Consultants</div>
                        <span class="text-muted fs-8">Hourly & milestone invoices</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('tools.forex-calculator') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">Live Forex Calculator</div>
                        <span class="text-muted fs-8">Real-time currency converter</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('templates.excel') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">Free Excel Templates</div>
                        <span class="text-muted fs-8">Automated tax spreadsheets</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- CTA Banner -->
        <div class="p-5 rounded-4 text-center text-white" style="background: linear-gradient(135deg, #0f172a, #1e293b);">
            <h2 class="fw-extrabold mb-3">Upgrade Your Small Business Billing Today</h2>
            <p class="text-slate-300 fs-6 mx-auto mb-4" style="max-width: 600px;">Save time, get paid faster, and stay 100% tax compliant.</p>
            <a href="{{ route('register') }}" class="btn-brand-primary">Create Free Account</a>
        </div>
    </main>

    <!-- Footer -->
    @include('partials.public_footer')

</body>
</html>
