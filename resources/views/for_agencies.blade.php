<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoicing Software for Digital Agencies | Retainers & Client Billing | Cod Xpert</title>
    <meta name="description" content="Purpose-built agency invoicing software. Manage monthly client retainers, project milestone billing, multi-currency foreign accounts, and automatic payment tracking.">
    <meta name="keywords" content="invoicing software for agencies, agency billing software, digital agency retainer billing, marketing agency invoicing, multi-currency agency billing">
    <link rel="canonical" href="{{ url('/for/agencies') }}">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/for/agencies') }}">
    <meta property="og:title" content="Invoicing Software for Digital Agencies | Retainers & Client Billing | Cod Xpert">
    <meta property="og:description" content="Put your agency's retainer billing on autopilot. Multi-currency, automated payment tracking, and zero manual hassle.">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon-192x192.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Schema.org SoftwareApplication -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "SoftwareApplication",
        "name": "Cod Xpert Agency Invoicing & Retainer Platform",
        "applicationCategory": "BusinessApplication",
        "operatingSystem": "All",
        "offers": {
            "@type": "Offer",
            "price": "0.00",
            "priceCurrency": "USD"
        },
        "publisher": {
            "@type": "Organization",
            "name": "CodXpert",
            "url": "https://codxpert.com/"
        }
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
            <span class="badge bg-primary-subtle text-primary px-3 py-1.5 rounded-pill fw-bold fs-7 mb-3">Tailored for Creative, Dev & Marketing Agencies</span>
            <h1 class="display-4 fw-extrabold text-dark mb-3">Invoicing Software Built for High-Growth Agencies</h1>
            <p class="lead text-muted mx-auto mb-4" style="max-width: 720px;">
                Manage complex retainer agreements, bill international clients in USD, AED, or EUR, and eliminate payment chasing with automated recurring dispatch and status telemetry.
            </p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('register') }}" class="btn-brand-primary">Start Free for Your Agency</a>
                <a href="{{ route('features.recurring-invoices') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-semibold">Explore Recurring Billing</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container py-5">
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="card-icon">🔄</div>
                    <h4 class="fw-bold text-dark mb-2">Automated Monthly Retainers</h4>
                    <p class="text-muted fs-7 mb-0">Set recurring monthly retainer contracts once. Invoices generate automatically on your chosen date with customized service descriptions and payment terms.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="card-icon">🌐</div>
                    <h4 class="fw-bold text-dark mb-2">Cross-Border Agency Billing</h4>
                    <p class="text-muted fs-7 mb-0">Seamlessly invoice overseas clients with automatic GST zero-rating under LUT Rule 96A, multi-currency live conversions, and foreign wire details (IBAN/SWIFT).</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="card-icon">📊</div>
                    <h4 class="fw-bold text-dark mb-2">Client Portfolio Management</h4>
                    <p class="text-muted fs-7 mb-0">Maintain detailed records across dozens of clients, track lifetime billed amounts, monitor overdue receivables, and send polite automated payment nudges.</p>
                </div>
            </div>
        </div>

        <!-- Agency Workflow Featurette -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <div class="row align-items-center g-4">
                <div class="col-lg-6">
                    <span class="badge bg-primary-subtle text-primary px-3 py-1 rounded-pill fw-bold fs-8 mb-2">Agency Operations</span>
                    <h2 class="fw-bold text-dark mb-3">Scale Your Agency Revenue, Not Your Billing Overhead</h2>
                    <p class="text-muted fs-7 mb-3">Running an agency means balancing client deliverables, talent payroll, and client communications. Administrative friction in billing eats up valuable billable hours.</p>
                    <ul class="list-unstyled d-flex flex-column gap-2 text-dark fs-7 mb-0">
                        <li class="d-flex align-items-center gap-2">✓ <strong>Custom Branding:</strong> Deliver sleek, branded PDFs that elevate your agency's professional polish.</li>
                        <li class="d-flex align-items-center gap-2">✓ <strong>Milestone Scopes:</strong> Bill 50% on project kickoff and remaining 50% on client acceptance.</li>
                        <li class="d-flex align-items-center gap-2">✓ <strong>Tax Accuracy:</strong> Automated SAC code mapping (998311 for IT consultancy, 998314 for design).</li>
                        <li class="d-flex align-items-center gap-2">✓ <strong>FIRC & e-BRC Readiness:</strong> Every export invoice ready for outward remittance compliance.</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="p-4 bg-light rounded-4 border font-mono fs-8">
                        <div class="text-primary fw-bold mb-2">// Agency Retainer Profile</div>
                        <div class="text-muted">Agency: Nexus Creative Studio Pvt Ltd</div>
                        <div class="text-muted">Active Retainers: 14 Clients ($42,500/month)</div>
                        <div class="text-muted">Currencies Handled: USD, EUR, GBP, AED, SGD</div>
                        <div class="text-muted">Tax Framework: GST LUT Zero-Rated (ARN: AD270126002931P)</div>
                        <hr class="my-2 text-secondary">
                        <div class="text-success fw-bold">✓ Automated Dispatch: 1st of every month</div>
                        <div class="text-success fw-bold">✓ Average Payment Velocity: 4.2 days</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h3 class="fw-bold text-dark mb-4 text-center">Frequently Asked Questions for Agencies</h3>
            <div class="row g-4">
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">Can we manage multiple brands or agency subsidiaries?</h6>
                    <p class="text-muted fs-7">Yes. You can manage multiple business profiles, each with its own logo, currency, address, and bank disbursement information.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">Do client invoices include payment links?</h6>
                    <p class="text-muted fs-7">Yes. You can embed international wire instructions, Stripe payment links, or domestic UPI QR codes directly onto the invoice PDF and client view.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">How are hourly vs fixed-fee contracts billed?</h6>
                    <p class="text-muted fs-7">Cod Xpert supports both hourly rate line items with quantity hours worked, as well as fixed milestone or monthly retainer packages.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">Are export remittances documented for bank e-BRC?</h6>
                    <p class="text-muted fs-7">Yes. All necessary fields (FIRC number, realized currency, RBI reference rate) are captured for your CA and Authorized Dealer bank.</p>
                </div>
            </div>
        </div>

        <!-- CTA Banner -->
        <div class="p-5 rounded-4 text-center text-white" style="background: linear-gradient(135deg, #0f172a, #1e293b);">
            <h2 class="fw-extrabold mb-3">Modernize Your Agency Invoicing Today</h2>
            <p class="text-slate-300 fs-6 mx-auto mb-4" style="max-width: 600px;">Zero setup fees. Free trial with complete feature access.</p>
            <a href="{{ route('register') }}" class="btn-brand-primary">Sign Up for Free</a>
        </div>
    </main>

    <!-- Footer -->
    @include('partials.public_footer')

</body>
</html>
