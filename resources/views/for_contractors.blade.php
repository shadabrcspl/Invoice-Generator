<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Contractor Invoicing Software | Milestone Billing | Cod Xpert</title>
    <meta name="description" content="Invoicing software built for contractors. Handle milestone billing, timesheets, statutory GST compliance, and multi-currency international wire receipts.">
    <link rel="canonical" href="{{ url('/solutions/contractors') }}">

    <!-- Open Graph / Social Media -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/solutions/contractors') }}">
    <meta property="og:title" content="Contractor Invoicing Software | Milestone Billing | Cod Xpert">
    <meta property="og:description" content="Invoicing software built for contractors. Handle milestone billing, timesheets, statutory GST compliance, and multi-currency international wire receipts.">
    <meta property="og:image" content="https://invoice.codxpert.com/images/invoice_pdf.png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Cod Xpert Invoices">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url('/solutions/contractors') }}">
    <meta name="twitter:title" content="Contractor Invoicing Software | Milestone Billing | Cod Xpert">
    <meta name="twitter:description" content="Invoicing software built for contractors. Handle milestone billing, timesheets, statutory GST compliance, and multi-currency international wire receipts.">
    <meta name="twitter:image" content="https://invoice.codxpert.com/images/invoice_pdf.png">


    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon-192x192.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Schema.org SoftwareApplication for Contractors -->
    <script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "SoftwareApplication",
    "name": "Cod Xpert Invoices for Contractors",
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
    "description": "Enterprise-grade milestone and project invoicing platform designed for independent contractors, technical consultants, and service firms.",
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
    "sku": "CODXPERT-INV-FOR_CONTRACTORS",
    "mpn": "CXP-INV-2026"
}
    </script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --font-main: 'Plus Jakarta Sans', sans-serif;
            --font-heading: 'Outfit', sans-serif;
            --bg-body: #f8fafc;
            --color-primary: #0284c7;
            --color-primary-hover: #0369a1;
            --color-text-main: #0f172a;
        }

        body {
            font-family: var(--font-main);
            background-color: var(--bg-body);
            color: var(--color-text-main);
            line-height: 1.6;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: var(--font-heading);
            font-weight: 700;
        }

        .navbar-custom {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        }

        .brand-badge {
            background: #0284c7;
            color: #fff;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 14px;
        }

        .hero-banner {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 50%, #ffffff 100%);
            padding: 90px 0 60px;
            border-bottom: 1px solid #e2e8f0;
        }

        .card-custom {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.05);
            transition: all 0.2s ease;
        }

        .card-custom:hover {
            box-shadow: 0 20px 40px -15px rgba(2, 132, 199, 0.1);
            transform: translateY(-2px);
        }

        .feature-icon-box {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: #f1f5f9;
            color: #0284c7;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 16px;
        }

        .btn-brand-primary {
            background: #0284c7;
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 14px 28px;
            font-weight: 600;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-brand-primary:hover {
            background: #0369a1;
            color: #fff;
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

    <!-- Hero Banner -->
    <header class="hero-banner mt-5">
        <div class="container text-center pt-4">
            <span class="badge bg-secondary-subtle text-secondary px-3 py-2 rounded-pill fw-semibold mb-3">Engineered for Technical Contractors & Consultancies</span>
            <h1 class="display-5 fw-extrabold text-dark mb-3">Accurate Contractor Billing.<br>Zero Payment Delays or Compliance Audits.</h1>
            <p class="text-muted fs-6 mx-auto mb-4" style="max-width: 650px;">
                Whether delivering enterprise software deliverables, technical staffing, or commercial advisory, Cod Xpert provides milestone billing, itemized expense reimbursement, and statutory GST export declarations.
            </p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('register') }}" class="btn-brand-primary">Start Contractor Plan Free →</a>
                <a href="{{ route('tools.invoice-generator') }}" class="btn btn-outline-secondary py-3 px-4 rounded-3 fw-semibold">Instant Sample Invoice</a>
            </div>
        </div>
    </header>

    <!-- Key Contractor Advantages -->
    <main class="container py-5">
        <div class="row g-4 mb-5">
            
            <div class="col-md-4">
                <div class="card-custom p-4 h-100">
                    <div class="feature-icon-box">📊</div>
                    <h5 class="fw-bold text-dark mb-2">Milestone & Deliverable Billing</h5>
                    <p class="text-muted fs-7 mb-0">
                        Clearly outline project phases, sprints, and contractual deliverables. Avoid client confusion and speed up sign-offs with line-item detail and tax splits.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-custom p-4 h-100">
                    <div class="feature-icon-box">🧾</div>
                    <h5 class="fw-bold text-dark mb-2">Project Expense Pass-Through</h5>
                    <p class="text-muted fs-7 mb-0">
                        Easily bill client-approved travel, tooling, and infrastructure expenses alongside your core contractor fee with digital receipt proof attached.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-custom p-4 h-100">
                    <div class="feature-icon-box">🏦</div>
                    <h5 class="fw-bold text-dark mb-2">FIRC & e-BRC Reconciliation</h5>
                    <p class="text-muted fs-7 mb-0">
                        Working with offshore clients in the US, UK, or EU? Log bank realization numbers, track exchange rate differentials, and ensure clean statutory records for your CA.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-custom p-4 h-100">
                    <div class="feature-icon-box">🖨️</div>
                    <h5 class="fw-bold text-dark mb-2">Corporate-Ready PDF Invoices</h5>
                    <p class="text-muted fs-7 mb-0">
                        Pixel-perfect styling featuring your corporate branding, GSTIN, PAN, LUT number, and complete bank wiring coordinates ready for accounts payable departments.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-custom p-4 h-100">
                    <div class="feature-icon-box">🛡️</div>
                    <h5 class="fw-bold text-dark mb-2">Rule 96A Zero IGST Certification</h5>
                    <p class="text-muted fs-7 mb-0">
                        Never worry about whether your foreign currency contract requires domestic tax withholding. Automatic statutory wording keeps you 100% compliant with Indian tax authorities.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-custom p-4 h-100">
                    <div class="feature-icon-box">⚡</div>
                    <h5 class="fw-bold text-dark mb-2">Instant e-Delivery & Tracking</h5>
                    <p class="text-muted fs-7 mb-0">
                        Dispatch invoices directly from your authenticated corporate email domain with automatic payment reminders sent on your schedule.
                    </p>
                </div>
            </div>

        </div>


        <!-- Contractor Milestone & Statutory Workflow -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h3 class="fw-bold text-dark mb-4 text-center">Contractor Project Billing & Milestone Verification Architecture</h3>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="p-4 rounded-3 bg-light h-100 border">
                        <div class="badge bg-primary text-white rounded-pill mb-2 px-3 py-1">Feature 1</div>
                        <h5 class="fw-bold text-dark mb-2">Milestone Completion Billing</h5>
                        <p class="text-muted fs-7 mb-0">Invoice enterprise clients against specific Statement of Work (SOW) deliverables. Attach timesheets, milestone sign-offs, and expense receipts in one unified dispatch.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 rounded-3 bg-light h-100 border">
                        <div class="badge bg-primary text-white rounded-pill mb-2 px-3 py-1">Feature 2</div>
                        <h5 class="fw-bold text-dark mb-2">Multi-Currency Global Remittances</h5>
                        <p class="text-muted fs-7 mb-0">Contracting with overseas tech firms? Bill in USD, EUR, or GBP with real-time exchange rates powered by our <a href="{{ route('features.multi-currency') }}" class="text-primary fw-semibold text-decoration-none">Multi-Currency Engine</a> and track realized bank spreads.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 rounded-3 bg-light h-100 border">
                        <div class="badge bg-primary text-white rounded-pill mb-2 px-3 py-1">Feature 3</div>
                        <h5 class="fw-bold text-dark mb-2">Automated Payment Velocity</h5>
                        <p class="text-muted fs-7 mb-0">Keep enterprise accounts payable departments on track with non-intrusive automated notifications via <a href="{{ route('features.invoice-tracking') }}" class="text-primary fw-semibold text-decoration-none">Invoice Tracking</a> sent from your own domain.</p>
                    </div>
                </div>
            </div>
        </div>


        <!-- SOW & Work Order Verification -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h3 class="fw-bold text-dark mb-3 text-center">Statement of Work (SOW) & Acceptance Certificate Reconciliation</h3>
            <p class="text-muted text-center fs-7 mx-auto mb-4" style="max-width: 720px;">
                Enterprise contractors frequently deal with multi-tier procurement processes where payment depends on verified deliverables and matching purchase orders (POs).
            </p>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="border rounded-3 p-4 h-100 bg-light">
                        <h5 class="fw-bold text-dark mb-2">Purchase Order (PO) Matching</h5>
                        <p class="text-muted fs-7 mb-0">Every invoice generated in Cod Xpert allows you to reference enterprise client PO numbers, project codes, cost centers, and contracting work orders. This ensures accounts payable teams match invoices against approved purchase commitments without delays.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="border rounded-3 p-4 h-100 bg-light">
                        <h5 class="fw-bold text-dark mb-2">Multi-Currency Bank Account Options</h5>
                        <p class="text-muted fs-7 mb-0">Contractors operating across jurisdictions can include multiple remittance destinations on a single invoice layout: Indian INR bank accounts (RTGS/NEFT/UPI) alongside international virtual receiving accounts (SWIFT, IBAN, ACH routing).</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statutory Compliance & TDS/GST Rules for Contractors -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h3 class="fw-bold text-dark mb-3 text-center">TDS Withholding & Statutory Export Invoicing for Independent Contractors</h3>
            <p class="text-muted text-center fs-7 mx-auto mb-4" style="max-width: 720px;">
                Domestic and international contracting contracts carry distinct statutory obligations under the Indian Income Tax and GST Acts.
            </p>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="border rounded-3 p-4 h-100">
                        <h5 class="fw-bold text-dark mb-2">Domestic TDS Withholding (Section 194J vs 194C)</h5>
                        <p class="text-muted fs-7 mb-3">When billing domestic clients, corporate payers deduct Tax Deducted at Source (TDS) under Section 194J (10% or 2% for technical services) or Section 194C (contractors). Cod Xpert records TDS deductions cleanly so your annual Form 26AS matches your invoicing ledger.</p>
                        <a href="{{ route('features.e-invoicing') }}" class="text-primary fw-bold fs-7 text-decoration-none">Explore E-Invoicing & Compliance Capabilities →</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="border rounded-3 p-4 h-100">
                        <h5 class="fw-bold text-dark mb-2">Overseas Contracting Under GST Rule 96A</h5>
                        <p class="text-muted fs-7 mb-3">If you contract for overseas tech firms, your services represent cross-border exports. File a valid Letter of Undertaking (LUT) to supply zero-rated services without paying 18% IGST upfront, and maintain banking documentation for e-BRC realization.</p>
                        <a href="{{ route('guides.gst-lut') }}" class="text-primary fw-bold fs-7 text-decoration-none">Review the Complete GST LUT Rule 96A Guide →</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contractor FAQs -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h3 class="fw-bold text-dark mb-4 text-center">Frequently Asked Questions for Independent Contractors</h3>
            <div class="row g-4">
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">Can I issue milestone-based invoices?</h6>
                    <p class="text-muted fs-7">Yes. You can create customized line items with progress milestones (e.g., 30% advance on signing, 40% on UAT delivery, 30% upon production deployment).</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">How do I handle expense reimbursements?</h6>
                    <p class="text-muted fs-7">Our expense tracker lets you log reimbursable travel, software licenses, or hardware purchases and add them directly as billed line items with receipt attachments.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">What banking information can I display?</h6>
                    <p class="text-muted fs-7">You can include domestic bank accounts (NEFT/RTGS/UPI) alongside international wire details (SWIFT/BIC code, IBAN, bank name, intermediary routing numbers).</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">Can our Chartered Accountant download my tax data?</h6>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">What is the distinction between Section 194J and Section 194C for tech contractors?</h6>
                    <p class="text-muted fs-7">Section 194J applies to professional and technical services (carrying a 10% or 2% rate), whereas Section 194C applies to general works and labor contracts (carrying 1% or 2%). Cod Xpert lets you specify exact service classifications to avoid misclassification notices.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">How do I account for international client currency fluctuations?</h6>
                    <p class="text-muted fs-7">Our <a href="{{ route('tools.forex-calculator') }}">Live Forex Engine</a> records the interbank exchange rate on the date of supply, giving you an exact baseline to calculate realized forex gain or loss when payment lands in your bank account.</p>
                </div>

                    <p class="text-muted fs-7">Yes. Download pre-formatted spreadsheets for GSTR-1, GSTR-3B, and Income Tax profit & loss accounting with one click.</p>
                </div>
            </div>
        </div>

        <!-- Contractor Resource Hub -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h4 class="fw-bold text-dark mb-3 text-center">Related Solutions, Calculators & Invoicing Tools</h4>
            <div class="row g-3 text-center">
                <div class="col-6 col-md-3">
                    <a href="{{ route('solutions.consultants') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">For Consultants</div>
                        <span class="text-muted fs-8">Advisory & hourly billing</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('tools.forex-calculator') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">Forex Calculator</div>
                        <span class="text-muted fs-8">Real-time wire conversion</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('guides.fema-23r') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">FEMA 23(R) Guide</div>
                        <span class="text-muted fs-8">Statutory export declaration</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('templates.excel') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">Excel Templates</div>
                        <span class="text-muted fs-8">Download free tax sheets</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Banner -->
        <div class="p-5 rounded-4 text-center text-white" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);">
            <h2 class="display-6 fw-bold mb-3">Streamline Your Consulting & Contract Billing</h2>
            <p class="fs-6 opacity-90 mx-auto mb-4" style="max-width: 550px;">
                Spend less time dealing with manual invoicing spreadsheets and more time delivering high-impact consulting services.
            </p>
            <a href="{{ route('register') }}" class="btn btn-primary fw-bold py-3 px-5 rounded-pill shadow">Get Started Now →</a>
        </div>
    </main>

    <!-- Footer -->
    @include('partials.public_footer')
</body>
</html>
