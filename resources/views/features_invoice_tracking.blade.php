<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice Tracking & Payment Reconciliation | Cod Xpert</title>
    <meta name="description" content="Never lose track of unpaid invoices. Real-time status monitoring, automated overdue reminders, and complete export remittance payment audit trails.">
    <link rel="canonical" href="{{ url('/features/invoice-tracking') }}">

    <!-- Open Graph / Social Media -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/features/invoice-tracking') }}">
    <meta property="og:title" content="Invoice Tracking & Payment Reconciliation | Cod Xpert">
    <meta property="og:description" content="Never lose track of unpaid invoices. Real-time status monitoring, automated overdue reminders, and complete export remittance payment audit trails.">
    <meta property="og:image" content="https://invoice.codxpert.com/images/invoice_pdf.png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Cod Xpert Invoices">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url('/features/invoice-tracking') }}">
    <meta name="twitter:title" content="Invoice Tracking & Payment Reconciliation | Cod Xpert">
    <meta name="twitter:description" content="Never lose track of unpaid invoices. Real-time status monitoring, automated overdue reminders, and complete export remittance payment audit trails.">
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
    "name": "Cod Xpert Invoice Tracking Suite",
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
    "sku": "CODXPERT-INV-FEATURES_INVOICE_TRACKING",
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
        body {
            font-family: var(--font-main);
            color: #334155;
            background-color: #f8fafc;
            padding-top: 80px;
        }
        h1, h2, h3, h4, h5 { font-family: var(--font-heading); }
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
            <span class="badge bg-primary-subtle text-primary px-3 py-1.5 rounded-pill fw-bold fs-7 mb-3">Live Status & Aging Audits</span>
            <h1 class="display-4 fw-extrabold text-dark mb-3">Complete Invoice Tracking & Payment Monitoring</h1>
            <p class="lead text-muted mx-auto mb-4" style="max-width: 720px;">
                Gain 100% visibility over every sent bill. Track open, paid, and overdue balances, record partial bank transfers, and eliminate collection delays with automated chasers.
            </p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="{{ route('register') }}" class="btn-brand-primary">Start Tracking Free</a>
                <a href="{{ route('pricing') }}" class="btn-brand-secondary">View Free Trial Plans</a>
            </div>
            <p class="text-muted fs-8 mt-3 mb-0">⚡ 100% Free during open beta · No credit card required</p>
        </div>
    </header>

    <!-- Main Features -->
    <main class="container py-5">
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="card-icon">📌</div>
                    <h4 class="fw-bold text-dark mb-2">Live Status Lifecycle</h4>
                    <p class="text-muted fs-7 mb-0">Instant color-coded status badges: Draft, Issued, Sent, Paid, Partially Paid, and Overdue so you never guess where your money is.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="card-icon">💵</div>
                    <h4 class="fw-bold text-dark mb-2">Partial Payment Logging</h4>
                    <p class="text-muted fs-7 mb-0">Record advance deposits, bank wire milestones, and remaining balances with automated balance recalculation in real-time.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="card-icon">🔔</div>
                    <h4 class="fw-bold text-dark mb-2">Automated Overdue Alerts</h4>
                    <p class="text-muted fs-7 mb-0">Smart cron engines detect due dates and fire professional reminder emails to international and domestic clients before late fees occur.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="card-icon">📅</div>
                    <h4 class="fw-bold text-dark mb-2">Aging Reports</h4>
                    <p class="text-muted fs-7 mb-0">Group outstanding balances by 30, 60, and 90+ days aging buckets to identify slow-paying accounts and maintain healthy cash flow.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="card-icon">🏦</div>
                    <h4 class="fw-bold text-dark mb-2">Bank Reconciliation & FIRC</h4>
                    <p class="text-muted fs-7 mb-0">Attach bank realization reference numbers, UTR codes, and foreign remittance receipts directly to individual invoices for audit readiness.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="card-icon">📈</div>
                    <h4 class="fw-bold text-dark mb-2">GSTR-1 Realization CSV</h4>
                    <p class="text-muted fs-7 mb-0">Export fully reconciled monthly payment summaries with 1 click to hand directly to your chartered accountant for tax filings.</p>
                </div>
            </div>
        </div>

        <!-- Sample Tracking Table Mockup -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h3 class="fw-bold text-dark mb-3">Live Invoice Tracking Dashboard</h3>
            <p class="text-muted fs-7 mb-4">A unified, clutter-free ledger giving you full control over incoming export remittances.</p>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr class="fs-8 text-uppercase text-muted">
                            <th>Invoice #</th>
                            <th>Client</th>
                            <th>Amount</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="fs-7">
                        <tr>
                            <td><strong class="text-dark">INV-2026-089</strong></td>
                            <td>Krypton Tech LLC (California)</td>
                            <td>$5,200.00 USD <span class="text-muted fs-8">(₹4,94,780)</span></td>
                            <td>{{ date('M 28, Y') }}</td>
                            <td><span class="badge bg-success-subtle text-success rounded-pill px-2.5 py-1">PAID IN FULL</span></td>
                            <td><span class="text-muted">Reconciled</span></td>
                        </tr>
                        <tr>
                            <td><strong class="text-dark">INV-2026-092</strong></td>
                            <td>Dubai FinTech FZCO</td>
                            <td>AED 12,000.00 <span class="text-muted fs-8">(₹3,10,800)</span></td>
                            <td>{{ date('M 30, Y') }}</td>
                            <td><span class="badge bg-warning-subtle text-warning rounded-pill px-2.5 py-1">PARTIAL (50%)</span></td>
                            <td><span class="text-primary fw-semibold">Log Payment</span></td>
                        </tr>
                        <tr>
                            <td><strong class="text-dark">INV-2026-095</strong></td>
                            <td>Nordic Cloud AB (Sweden)</td>
                            <td>€3,400.00 EUR <span class="text-muted fs-8">(₹3,73,014)</span></td>
                            <td>{{ date('M 20, Y') }}</td>
                            <td><span class="badge bg-danger-subtle text-danger rounded-pill px-2.5 py-1">OVERDUE</span></td>
                            <td><span class="text-danger fw-semibold">Chaser Sent</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Payment Velocity & Aging Reports -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h3 class="fw-bold text-dark mb-4 text-center">Accounts Receivable Aging & Cash Velocity Framework</h3>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="p-4 rounded-3 bg-light h-100 border">
                        <div class="badge bg-primary text-white rounded-pill mb-2 px-3 py-1">Tier 1 (0-30 Days)</div>
                        <h5 class="fw-bold text-dark mb-2">Active & On-Time Settlement</h5>
                        <p class="text-muted fs-7 mb-0">Monitor open invoices with clear due date indicators. Clients receive professional notifications with embedded payment links, domestic bank details, and international SWIFT instructions.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 rounded-3 bg-light h-100 border">
                        <div class="badge bg-warning text-dark rounded-pill mb-2 px-3 py-1">Tier 2 (31-60 Days)</div>
                        <h5 class="fw-bold text-dark mb-2">Automated Grace Follow-Up</h5>
                        <p class="text-muted fs-7 mb-0">When bills cross their due date, our non-intrusive scheduler triggers reminder dispatches from your verified domain, escalating priority without burning client goodwill.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 rounded-3 bg-light h-100 border">
                        <div class="badge bg-danger text-white rounded-pill mb-2 px-3 py-1">Tier 3 (60+ Days)</div>
                        <h5 class="fw-bold text-dark mb-2">Critical Audit & Escalation</h5>
                        <p class="text-muted fs-7 mb-0">Under Indian GST Rule 96A(1)(b), export payments must be realized within one year to protect your zero-rated 0% IGST status. Automated aging logs alert your finance team in advance.</p>
                    </div>
                </div>
            </div>
        </div>


        <!-- Dispute Resolution & Discrepancy Workflows -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h3 class="fw-bold text-dark mb-3 text-center">Handling Client Discrepancies & Credit Notes</h3>
            <p class="text-muted text-center fs-7 mx-auto mb-4" style="max-width: 720px;">
                Clear dispute resolution protocols protect your client relationships while keeping your accounts receivable aging accurate.
            </p>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-4 border rounded-3 h-100 bg-light">
                        <h5 class="fw-bold text-dark mb-2">Discrepancy Notes & Internal Logs</h5>
                        <p class="text-muted fs-7 mb-0">If a client disputes a specific deliverable or wire fee deduction, log internal dispute notes directly against the invoice record so your accounting team has context before sending escalation reminders.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 border rounded-3 h-100 bg-light">
                        <h5 class="fw-bold text-dark mb-2">Payment Receipt Acknowledgments</h5>
                        <p class="text-muted fs-7 mb-0">Once an invoice is marked as Paid, Cod Xpert can automatically dispatch a clean, branded payment receipt acknowledgment to your client, confirming full settlement and closing open receivables.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bank Reconciliation & Realization Matching -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h3 class="fw-bold text-dark mb-3 text-center">Bank Reconciliation & Export Inward Remittance Matching</h3>
            <p class="text-muted text-center fs-7 mx-auto mb-4" style="max-width: 720px;">
                Tracking invoice status goes beyond knowing who paid—it requires recording exact realized bank values for statutory e-BRC closure.
            </p>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="border rounded-3 p-4 h-100 bg-light">
                        <h5 class="fw-bold text-dark mb-2">Partial & Milestone Payments</h5>
                        <p class="text-muted fs-7 mb-3">Enterprise clients frequently settle invoices across multiple tranches or deduct withholding taxes (TDS under Section 194J). Cod Xpert logs partial receipts with specific transaction IDs, leaving an audit-ready unpaid balance.</p>
                        <a href="{{ route('guides.firc-e-brc') }}" class="text-primary fw-bold fs-7 text-decoration-none">Read the FIRC & Bank Reconciliation Guide →</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="border rounded-3 p-4 h-100 bg-light">
                        <h5 class="fw-bold text-dark mb-2">Realized Exchange Variance Ledgers</h5>
                        <p class="text-muted fs-7 mb-3">When a $10,000 USD invoice is issued at ₹83.50/$ but realized at ₹83.80/$, currency movement generates a foreign exchange gain. Our tracking ledger captures both numbers so your accountant records exchange gains correctly under Section 43AA.</p>
                        <a href="{{ route('tools.forex-calculator') }}" class="text-primary fw-bold fs-7 text-decoration-none">Calculate Foreign Exchange Variance →</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tracking FAQs -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h3 class="fw-bold text-dark mb-4 text-center">Frequently Asked Questions on Invoice Tracking</h3>
            <div class="row g-4">
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">Can I customize the email text of overdue reminders?</h6>
                    <p class="text-muted fs-7">Yes. You can edit the tone, subject lines, and schedule of payment reminders to ensure they reflect your brand's communication style and client relationship.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">Do clients need an account to view and download their invoice?</h6>
                    <p class="text-muted fs-7">No. Invoices are attached as standard PDF documents and include direct download links that require zero client registration or login hassle.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">Can our finance team filter by overdue status?</h6>
                    <p class="text-muted fs-7">Yes. The invoice directory features instant filters for Paid, Unpaid, Partial, and Overdue statuses, complete with date range and client search filters.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">Does Cod Xpert alert me when an invoice is overdue?</h6>
                    <p class="text-muted fs-7">Yes. The dashboard highlights overdue invoices with visual KPI badges and generates automated status summaries for your finance manager.</p>
                </div>
            </div>
        </div>

        <!-- Tracking Resource Hub -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h4 class="fw-bold text-dark mb-3 text-center">Related Features, Solutions & Tools</h4>
            <div class="row g-3 text-center">
                <div class="col-6 col-md-3">
                    <a href="{{ route('features.recurring-invoices') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">Recurring Invoices</div>
                        <span class="text-muted fs-8">Automate retainer schedules</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('features.multi-currency') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">Multi-Currency</div>
                        <span class="text-muted fs-8">Live global forex sync</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('guides.gst-lut') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">GST LUT Guide</div>
                        <span class="text-muted fs-8">Rule 96A export zero-rating</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('solutions.consultants') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">For Consultants</div>
                        <span class="text-muted fs-8">Hourly advisory invoices</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- CTA Banner -->
        <div class="p-5 rounded-4 text-center text-white" style="background: linear-gradient(135deg, #0f172a, #1e293b);">
            <h2 class="fw-extrabold mb-3">Stop Wondering When Invoices Will Be Paid</h2>
            <p class="text-slate-300 fs-6 mx-auto mb-4" style="max-width: 600px;">Take control of your receivables with real-time tracking, payment logs, and automated reminders.</p>
            <a href="{{ route('register') }}" class="btn-brand-primary">Start Tracking Free</a>
        </div>
    </main>

    <!-- Footer -->
    @include('partials.public_footer')

</body>
</html>
