<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recurring Invoices & Retainer Billing Software | Cod Xpert</title>
    <meta name="description" content="Automate client retainers and recurring billing schedules. Send scheduled invoices with custom SMTP delivery and automated payment follow-ups.">
    <link rel="canonical" href="{{ url('/features/recurring-invoices') }}">

    <!-- Open Graph / Social Media -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/features/recurring-invoices') }}">
    <meta property="og:title" content="Recurring Invoices & Retainer Billing Software | Cod Xpert">
    <meta property="og:description" content="Automate client retainers and recurring billing schedules. Send scheduled invoices with custom SMTP delivery and automated payment follow-ups.">
    <meta property="og:image" content="https://invoice.codxpert.com/images/invoice_pdf.png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Cod Xpert Invoices">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url('/features/recurring-invoices') }}">
    <meta name="twitter:title" content="Recurring Invoices & Retainer Billing Software | Cod Xpert">
    <meta name="twitter:description" content="Automate client retainers and recurring billing schedules. Send scheduled invoices with custom SMTP delivery and automated payment follow-ups.">
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
    "name": "Cod Xpert Recurring Invoice Engine",
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
    "sku": "CODXPERT-INV-FEATURES_RECURRING_INVOICES",
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
        .btn-brand-secondary {
            background: #ffffff;
            color: #0f172a;
            font-weight: 700;
            padding: 12px 28px;
            border-radius: 50px;
            border: 1px solid #cbd5e1;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
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
            <span class="badge bg-primary-subtle text-primary px-3 py-1.5 rounded-pill fw-bold fs-7 mb-3">Recurring & Retainer Automation</span>
            <h1 class="display-4 fw-extrabold text-dark mb-3">Recurring Invoice Software for Automatic Billing</h1>
            <p class="lead text-muted mx-auto mb-4" style="max-width: 720px;">
                Bill monthly client retainers, SaaS licenses, and maintenance contracts automatically. Scheduled generation, automated payment reminders, and multi-currency exchange rate lock.
            </p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="{{ route('register') }}" class="btn-brand-primary">Start Free Trial Now</a>
                <a href="{{ route('tools.invoice-generator') }}" class="btn-brand-secondary">Try Live Generator</a>
            </div>
            <p class="text-muted fs-8 mt-3 mb-0">⚡ 100% Free during open beta · No credit card required</p>
        </div>
    </header>

    <!-- Main Content Grid -->
    <main class="container py-5">
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="card-icon">🔄</div>
                    <h4 class="fw-bold text-dark mb-2">Automated Dispatch</h4>
                    <p class="text-muted fs-7 mb-0">Set your billing frequency (Weekly, Monthly, Quarterly) and let the engine issue PDF invoices directly to your client's inbox on schedule.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="card-icon">💱</div>
                    <h4 class="fw-bold text-dark mb-2">Live Forex Lock</h4>
                    <p class="text-muted fs-7 mb-0">Invoices billed in USD, EUR, or AED automatically capture the interbank rate on the exact generation date for compliant book entries.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="card-icon">⏰</div>
                    <h4 class="fw-bold text-dark mb-2">Chaser Automation</h4>
                    <p class="text-muted fs-7 mb-0">Gentle automated email reminders dispatched 3 days before due date, on due date, and after overdue status to eliminate unpaid delays.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="card-icon">📜</div>
                    <h4 class="fw-bold text-dark mb-2">GST LUT Compliance</h4>
                    <p class="text-muted fs-7 mb-0">Automatic Rule 96A zero-rated export declarations printed on every recurring international invoice to keep your CA filings smooth.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="card-icon">📊</div>
                    <h4 class="fw-bold text-dark mb-2">Retainer Forecasting</h4>
                    <p class="text-muted fs-7 mb-0">Predict monthly recurring revenue (MRR) and track payment history across all active retainer clients in one visual dashboard.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="card-icon">🛡️</div>
                    <h4 class="fw-bold text-dark mb-2">Custom Domain SMTP</h4>
                    <p class="text-muted fs-7 mb-0">Deliver invoices from your own professional domain (`billing@yourfirm.com`) with zero spam flags and 100% inbox delivery.</p>
                </div>
            </div>
        </div>

        <!-- How It Works Section -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <div class="row align-items-center g-4">
                <div class="col-lg-6">
                    <span class="badge bg-primary-subtle text-primary px-3 py-1 rounded-pill fw-bold fs-8 mb-2">3-Step Workflow</span>
                    <h2 class="fw-bold text-dark mb-3">How Recurring Invoicing Works</h2>
                    <ul class="list-unstyled d-flex flex-column gap-3 mb-0">
                        <li class="d-flex align-items-start gap-3">
                            <span class="badge bg-primary text-white rounded-circle p-2 mt-1">1</span>
                            <div>
                                <h6 class="fw-bold text-dark mb-1">Create Retainer Template</h6>
                                <p class="text-muted fs-7 mb-0">Set your client, currency (USD, AED, EUR, INR), items, and fixed retainer amounts.</p>
                            </div>
                        </li>
                        <li class="d-flex align-items-start gap-3">
                            <span class="badge bg-primary text-white rounded-circle p-2 mt-1">2</span>
                            <div>
                                <h6 class="fw-bold text-dark mb-1">Define Schedule & Cadence</h6>
                                <p class="text-muted fs-7 mb-0">Select generation day (e.g. 1st of every month) and invoice payment terms.</p>
                            </div>
                        </li>
                        <li class="d-flex align-items-start gap-3">
                            <span class="badge bg-primary text-white rounded-circle p-2 mt-1">3</span>
                            <div>
                                <h6 class="fw-bold text-dark mb-1">Automated Dispatch & Reminders</h6>
                                <p class="text-muted fs-7 mb-0">The system executes in the background, attaches the PDF, and chases overdue payments.</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="p-4 bg-light rounded-4 border text-start font-mono fs-8">
                        <div class="text-primary fw-bold mb-2">// Sample Recurring Schedule</div>
                        <div class="text-muted">Client: Apex Global LLC (Delaware)</div>
                        <div class="text-muted">Cadence: Monthly (1st of Month)</div>
                        <div class="text-muted">Retainer: $4,500.00 USD</div>
                        <div class="text-success fw-bold mt-2">✓ Next Run: {{ date('M 01, Y', strtotime('+1 month')) }}</div>
                        <div class="text-success fw-bold">✓ Status: Active & Synced with Live Forex</div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Managing Retainer Proration & Failed Collections -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h3 class="fw-bold text-dark mb-3 text-center">Handling Mid-Month Prorations & Scope Addendums</h3>
            <p class="text-muted text-center fs-7 mx-auto mb-4" style="max-width: 720px;">
                When clients onboard mid-cycle or adjust their monthly engagement scope, Cod Xpert manages billing variations cleanly.
            </p>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-4 border rounded-3 h-100 bg-light">
                        <h5 class="fw-bold text-dark mb-2">Automated Mid-Month Prorations</h5>
                        <p class="text-muted fs-7 mb-0">Easily generate partial-period invoices for clients who start mid-month, aligning future billings seamlessly with the first of each subsequent calendar month with zero manual math errors.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 border rounded-3 h-100 bg-light">
                        <h5 class="fw-bold text-dark mb-2">Scope Addendums & Ad-Hoc Charges</h5>
                        <p class="text-muted fs-7 mb-0">Need to bill for out-of-scope work or bonus milestones? Attach ad-hoc line items to upcoming recurring runs or generate one-off supplemental invoices in 1-click via <a href="{{ route('features.quotations') }}">Quotations</a>.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statutory Requirements for Continuous Supply of Services -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h3 class="fw-bold text-dark mb-3 text-center">Continuous Supply of Services under GST Law (Section 31(5))</h3>
            <p class="text-muted text-center fs-7 mx-auto mb-4" style="max-width: 720px;">
                When delivering ongoing digital marketing, software maintenance, or consulting services under long-term retainers, Indian GST legislation defines strict rules for continuous supply.
            </p>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="border rounded-3 p-4 h-100 bg-light">
                        <h5 class="fw-bold text-dark mb-2">Section 31(5)(a) Due Date Determination</h5>
                        <p class="text-muted fs-7 mb-3">Where the contract provides for a predetermined date of payment (e.g., 1st or 5th of every month), the invoice must be issued on or before that due date. Cod Xpert's automated background scheduler executes on your designated schedule so invoices are legally dated and dispatched on time.</p>
                        <a href="{{ route('guides.gst-lut') }}" class="text-primary fw-bold fs-7 text-decoration-none">Read the GST LUT Rule 96A Retainer Guide →</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="border rounded-3 p-4 h-100 bg-light">
                        <h5 class="fw-bold text-dark mb-2">Recurring Exchange Rate Freezes</h5>
                        <p class="text-muted fs-7 mb-3">For international retainers denominated in USD, EUR, or GBP, each recurring generation captures the official interbank rate on that specific generation date. This guarantees accurate financial reporting under <a href="{{ route('features.multi-currency') }}">Multi-Currency Standards</a> and simplifies year-end CA audits.</p>
                        <a href="{{ route('tools.forex-calculator') }}" class="text-primary fw-bold fs-7 text-decoration-none">Check Exchange Rate Calculation Mechanics →</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recurring Invoicing FAQs -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h3 class="fw-bold text-dark mb-4 text-center">Frequently Asked Questions on Recurring Invoices</h3>
            <div class="row g-4">
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">What scheduling frequencies are supported?</h6>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">Can I attach static terms or service level agreements (SLAs) to recurring invoices?</h6>
                    <p class="text-muted fs-7">Yes. You can define static boilerplate terms, SLA commitments, and payment wire details that append automatically to each recurring monthly generation.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">What happens if an automated recurring dispatch fails due to an invalid email?</h6>
                    <p class="text-muted fs-7">The system logs the delivery failure in your dashboard audit queue, highlights the affected client record, and alerts your billing administrator immediately.</p>
                </div>

                    <p class="text-muted fs-7">You can set up recurring invoice schedules on weekly, bi-weekly, monthly, quarterly, semi-annual, or annual cadences. You can also specify an optional end date or total occurrence limit.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">Can recurring invoices be sent automatically without manual review?</h6>
                    <p class="text-muted fs-7">Yes. You can configure full auto-pilot mode where Cod Xpert generates the PDF and emails it directly to your client via your authenticated corporate SMTP domain on the scheduled date.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">How do automated overdue reminders work?</h6>
                    <p class="text-muted fs-7">If a client fails to settle an invoice within the designated payment window (e.g., Net-15 or Net-30), our <a href="{{ route('features.invoice-tracking') }}">Invoice Tracking System</a> dispatches gentle follow-ups at 7, 14, and 21 days past due.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">Can I pause or edit an active recurring retainer schedule?</h6>
                    <p class="text-muted fs-7">Yes. You can pause, adjust monthly fees, update line items, or cancel an active recurring profile at any time with immediate effect.</p>
                </div>
            </div>
        </div>

        <!-- Recurring Resource Hub -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h4 class="fw-bold text-dark mb-3 text-center">Related Features, Solutions & Templates</h4>
            <div class="row g-3 text-center">
                <div class="col-6 col-md-3">
                    <a href="{{ route('solutions.agencies') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">For Agencies</div>
                        <span class="text-muted fs-8">Retainer & campaign billing</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('features.quotations') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">Quotations</div>
                        <span class="text-muted fs-8">Convert accepted estimates</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('features.e-invoicing') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">E-Invoicing</div>
                        <span class="text-muted fs-8">Statutory GST compliance</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('templates.excel') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">Excel Templates</div>
                        <span class="text-muted fs-8">Download recurring sheets</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- CTA Banner -->
        <div class="p-5 rounded-4 text-center text-white" style="background: linear-gradient(135deg, #0f172a, #1e293b);">
            <h2 class="fw-extrabold mb-3">Put Your Monthly Client Billing on Autopilot</h2>
            <p class="text-slate-300 fs-6 mx-auto mb-4" style="max-width: 600px;">Join global exporters, IT consultants, and design agencies who save 10+ hours every month.</p>
            <a href="{{ route('register') }}" class="btn-brand-primary">Create Free Account</a>
        </div>
    </main>

    <!-- Footer -->
    @include('partials.public_footer')

</body>
</html>
