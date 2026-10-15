<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Freelancer Invoicing Software | GST LUT & Forex | Cod Xpert</title>
    <meta name="description" content="Invoicing software for freelancers and remote contractors. Bill global clients in USD, EUR, or GBP with automated GST LUT 0% IGST export zero-rating.">
    <link rel="canonical" href="{{ url('/solutions/freelancers') }}">

    <!-- Open Graph / Social Media -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/solutions/freelancers') }}">
    <meta property="og:title" content="Freelancer Invoicing Software | GST LUT & Forex | Cod Xpert">
    <meta property="og:description" content="Invoicing software for freelancers and remote contractors. Bill global clients in USD, EUR, or GBP with automated GST LUT 0% IGST export zero-rating.">
    <meta property="og:image" content="https://invoice.codxpert.com/images/invoice_pdf.png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Cod Xpert Invoices">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url('/solutions/freelancers') }}">
    <meta name="twitter:title" content="Freelancer Invoicing Software | GST LUT & Forex | Cod Xpert">
    <meta name="twitter:description" content="Invoicing software for freelancers and remote contractors. Bill global clients in USD, EUR, or GBP with automated GST LUT 0% IGST export zero-rating.">
    <meta name="twitter:image" content="https://invoice.codxpert.com/images/invoice_pdf.png">


    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon-192x192.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Schema.org SoftwareApplication for Freelancers -->
    <script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "SoftwareApplication",
    "name": "Cod Xpert Invoices for Freelancers",
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
    "description": "Cross-border multi-currency invoicing software tailored for independent freelancers, remote consultants, and international creators.",
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
    "sku": "CODXPERT-INV-FOR_FREELANCERS",
    "mpn": "CXP-INV-2026"
}
    </script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;600;700&display=swap" rel="stylesheet">
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
            background: linear-gradient(135deg, #f0fdf4 0%, #e0f2fe 50%, #ffffff 100%);
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
            background: #e0f2fe;
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
            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-semibold mb-3">Engineered for Solo Creators & Freelancers</span>
            <h1 class="display-5 fw-extrabold text-dark mb-3">Bill Overseas Clients in Any Currency.<br>Get Paid Faster Without Accounting Headaches.</h1>
            <p class="text-muted fs-6 mx-auto mb-4" style="max-width: 650px;">
                Traditional accounting tools (QuickBooks, Tally) are bloated with inventory and payroll modules you don't need. Cod Xpert gives freelancers razor-sharp multi-currency billing, automated payment reminders, and 0% IGST export compliance.
            </p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('register') }}" class="btn-brand-primary">Start Invoicing Free →</a>
                <a href="{{ route('tools.invoice-generator') }}" class="btn btn-outline-primary py-3 px-4 rounded-3 fw-semibold">Try Free Generator</a>
            </div>
        </div>
    </header>

    <!-- Pillars for Freelancers -->
    <main class="container py-5">
        <div class="row g-4 mb-5">
            
            <div class="col-md-4">
                <div class="card-custom p-4 h-100">
                    <div class="feature-icon-box">🌍</div>
                    <h5 class="fw-bold text-dark mb-2">Multi-Currency & Real-Time Rates</h5>
                    <p class="text-muted fs-7 mb-0">
                        Invoice US, European, UAE, or Australian clients in their local currency (`$ USD`, `€ EUR`, `£ GBP`, `AED`). Daily interbank rates are automatically locked so you know your exact INR realization.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-custom p-4 h-100">
                    <div class="feature-icon-box">⏰</div>
                    <h5 class="fw-bold text-dark mb-2">Automated Payment Reminders</h5>
                    <p class="text-muted fs-7 mb-0">
                        No more awkward follow-ups. The scheduler gently reminds clients at due dates and 7-day intervals with your branded template and wire instructions.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-custom p-4 h-100">
                    <div class="feature-icon-box">📜</div>
                    <h5 class="fw-bold text-dark mb-2">Statutory GST LUT Exemption</h5>
                    <p class="text-muted fs-7 mb-0">
                        Export your software, design, or writing services legally under Rule 96A without paying 18% IGST upfront. Cod Xpert automatically stamps the required statutory declaration onto your PDFs.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-custom p-4 h-100">
                    <div class="feature-icon-box">💳</div>
                    <h5 class="fw-bold text-dark mb-2">Global Wire & Payment Details</h5>
                    <p class="text-muted fs-7 mb-0">
                        Include your Wise, Payoneer, SWIFT/BIC, IBAN, and domestic bank details neatly on every invoice so international clients pay you without back-and-forth emails.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-custom p-4 h-100">
                    <div class="feature-icon-box">📥</div>
                    <h5 class="fw-bold text-dark mb-2">Expense & Receipt Tracking</h5>
                    <p class="text-muted fs-7 mb-0">
                        Track SaaS subscriptions, cloud hosting, and laptop expenses with receipt image attachments. Export a clean spreadsheet for tax filing in one click.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-custom p-4 h-100">
                    <div class="feature-icon-box">✉️</div>
                    <h5 class="fw-bold text-dark mb-2">Custom Domain SMTP (Zero Spam)</h5>
                    <p class="text-muted fs-7 mb-0">
                        Connect your own Google Workspace or domain email. Invoices land directly in your client's primary inbox, not their junk or spam folders.
                    </p>
                </div>
            </div>

        </div>


        <!-- Step-by-Step Freelancer Invoicing Lifecycle -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h3 class="fw-bold text-dark mb-4 text-center">Step-by-Step Cross-Border Billing Lifecycle for Freelancers</h3>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="p-3 rounded-3 bg-light h-100 border">
                        <div class="badge bg-primary text-white rounded-pill mb-2 px-3 py-1">Step 1</div>
                        <h6 class="fw-bold text-dark mb-2">Proposal & Scoping</h6>
                        <p class="text-muted fs-8 mb-2">Send professional client estimates using <a href="{{ route('features.quotations') }}" class="text-primary fw-semibold text-decoration-none">Quotations</a>. Lock deliverable specifications, payment milestones, and currency terms upfront.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 rounded-3 bg-light h-100 border">
                        <div class="badge bg-primary text-white rounded-pill mb-2 px-3 py-1">Step 2</div>
                        <h6 class="fw-bold text-dark mb-2">Multi-Currency Invoice</h6>
                        <p class="text-muted fs-8 mb-2">Bill foreign clients in USD, EUR, GBP, or AED with automated live rate conversions via our <a href="{{ route('features.multi-currency') }}" class="text-primary fw-semibold text-decoration-none">Multi-Currency Feature</a>.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 rounded-3 bg-light h-100 border">
                        <div class="badge bg-primary text-white rounded-pill mb-2 px-3 py-1">Step 3</div>
                        <h6 class="fw-bold text-dark mb-2">LUT Zero-Rating</h6>
                        <p class="text-muted fs-8 mb-2">Automatically append statutory export declarations pursuant to <a href="{{ route('guides.gst-lut') }}" class="text-primary fw-semibold text-decoration-none">Rule 96A CGST Rules</a>. Eliminate 18% IGST cash flow blockage.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 rounded-3 bg-light h-100 border">
                        <div class="badge bg-primary text-white rounded-pill mb-2 px-3 py-1">Step 4</div>
                        <h6 class="fw-bold text-dark mb-2">FIRC & Tax Closure</h6>
                        <p class="text-muted fs-8 mb-2">Track inward wire settlements from Wise, Payoneer, or direct bank transfer and reconcile for <a href="{{ route('guides.firc-e-brc') }}" class="text-primary fw-semibold text-decoration-none">e-BRC Realization Certificates</a>.</p>
                    </div>
                </div>
            </div>
        </div>


        <!-- Wise/Payoneer/SWIFT Remittance Reconciliation -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h3 class="fw-bold text-dark mb-3 text-center">Handling International Inflows: Wise, Payoneer & Direct SWIFT</h3>
            <p class="text-muted text-center fs-7 mx-auto mb-4" style="max-width: 720px;">
                Understanding how foreign remittances clear through intermediary correspondent banks ensures accurate tax reporting and complete statutory protection.
            </p>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="p-3 border rounded-3 h-100 bg-light">
                        <h6 class="fw-bold text-dark mb-2">Direct SWIFT Wire Transfers</h6>
                        <p class="text-muted fs-8 mb-0">Direct wire to your Indian bank account gives you a clean bank realization with your Authorised Dealer (AD) issuing the FIRC/FIRA document directly under your RBI purpose code (e.g., P0802 for software services).</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 border rounded-3 h-100 bg-light">
                        <h6 class="fw-bold text-dark mb-2">Wise Business Inflows</h6>
                        <p class="text-muted fs-8 mb-0">Wise routes funds via partner banks in India (such as HDFC or Yes Bank). You must download the partner bank Foreign Inward Remittance Advice (FIRA) from Wise to substantiate zero-rated export zero-tax status.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 border rounded-3 h-100 bg-light">
                        <h6 class="fw-bold text-dark mb-2">Payoneer & Upwork Remittances</h6>
                        <p class="text-muted fs-8 mb-0">Platform withdrawals require matching your Cod Xpert invoice number against the platform settlement statement. Cod Xpert records platform fee deductions so your net and gross receipts match for annual tax audits.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Freelancer Statutory Compliance Matrix -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h3 class="fw-bold text-dark mb-3 text-center">Freelancer Statutory Compliance Matrix: GST, e-BRC & FEMA</h3>
            <p class="text-muted text-center fs-7 mx-auto mb-4" style="max-width: 720px;">
                Operating as an independent developer, designer, or writer in India requires strict adherence to banking and tax codes when receiving overseas remittances.
            </p>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="border rounded-3 p-4 h-100">
                        <h5 class="fw-bold text-dark mb-2">FEMA 23(R) Export Declarations</h5>
                        <p class="text-muted fs-7 mb-3">Under the Reserve Bank of India's Foreign Exchange Management Act (FEMA 23(R)), every cross-border service export requires documentation connecting the invoice with the inward remittance reference. Cod Xpert generates standardized declarations for HDFC, ICICI, SBI, and Axis Bank AD desks.</p>
                        <a href="{{ route('guides.fema-23r') }}" class="text-primary fw-bold fs-7 text-decoration-none">Read the FEMA 23(R) Service Export Guide →</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="border rounded-3 p-4 h-100">
                        <h5 class="fw-bold text-dark mb-2">Third-Party Gateway Inward Advice</h5>
                        <p class="text-muted fs-7 mb-3">When receiving international payments through Stripe, PayPal, or Wise, intermediary partner banks issue Foreign Inward Remittance Advices (FIRA/FIRC). Cod Xpert records gross invoice amounts and platform deductions to give your CA exact audit schedules.</p>
                        <a href="{{ route('guides.firc-e-brc') }}" class="text-primary fw-bold fs-7 text-decoration-none">Learn How to Obtain FIRCs from Wise & Stripe →</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Freelancer FAQs -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h3 class="fw-bold text-dark mb-4 text-center">Frequently Asked Questions for Freelancers</h3>
            <div class="row g-4">
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">Do I need a GST number to invoice international clients?</h6>
                    <p class="text-muted fs-7">Under Indian GST law, export of services is treated as an inter-state supply. While the threshold exemption of ₹20 Lakhs turnover exists, filing a Letter of Undertaking (LUT) to supply zero-rated services without paying 18% IGST requires a valid GSTIN registration.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">Can I include my Wise or Payoneer account details on invoices?</h6>
                    <p class="text-muted fs-7">Yes. Cod Xpert allows you to format domestic bank details (NEFT/RTGS/UPI) alongside international virtual bank accounts (SWIFT, IBAN, routing numbers) directly on your branded PDF.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">How do I track foreign exchange rate fluctuations?</h6>
                    <p class="text-muted fs-7">Cod Xpert captures the interbank exchange rate on the date of invoice issuance. Use our <a href="{{ route('tools.forex-calculator') }}" class="text-primary fw-semibold text-decoration-none">Live Forex Calculator</a> to calculate estimated bank spread loss and net INR realization.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">Can I automate follow-up reminders for unpaid invoices?</h6>
                    <p class="text-muted fs-7">Yes. Our <a href="{{ route('features.invoice-tracking') }}" class="text-primary fw-semibold text-decoration-none">Invoice Tracking Engine</a> dispatches automated, polite payment reminders at scheduled intervals directly from your verified email address.</p>
                </div>
            </div>
        </div>

        <!-- Freelancer Resource Hub -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h4 class="fw-bold text-dark mb-3 text-center">Explore Freelance Invoicing Resources & Free Tools</h4>
            <div class="row g-3 text-center">
                <div class="col-6 col-md-3">
                    <a href="{{ route('tools.invoice-generator') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">Instant Generator</div>
                        <span class="text-muted fs-8">Free no-login PDF maker</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('templates.excel') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">Excel Templates</div>
                        <span class="text-muted fs-8">Automated math formulas</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('guides.gst-lut') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">GST LUT Guide</div>
                        <span class="text-muted fs-8">0% IGST export compliance</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('pricing') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">Pricing & Plans</div>
                        <span class="text-muted fs-8">Start free without a credit card</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Call to Action Banner -->
        <div class="p-5 rounded-4 text-center text-white" style="background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);">
            <h2 class="display-6 fw-bold mb-3">Ready to Upgrade Your Freelance Invoicing?</h2>
            <p class="fs-6 opacity-90 mx-auto mb-4" style="max-width: 550px;">
                Join hundreds of software engineers, UI/UX designers, and cross-border consultants who save hours each month on billing and statutory compliance.
            </p>
            <a href="{{ route('register') }}" class="btn btn-light text-primary fw-bold py-3 px-5 rounded-pill shadow">Create Free Account →</a>
        </div>
    </main>

    <!-- Footer -->
    @include('partials.public_footer')
</body>
</html>
