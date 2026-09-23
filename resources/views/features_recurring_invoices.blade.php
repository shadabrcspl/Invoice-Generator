<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recurring Invoice Software | Automated Retainer Billing | Cod Xpert</title>
    <meta name="description" content="Automate client retainers and recurring billing with Cod Xpert. Scheduled multi-currency invoices, automatic payment reminders, and zero manual hassle.">
    <meta name="keywords" content="recurring invoice software, automated recurring billing, retainer invoice software, subscription billing, schedule invoices online">
    <link rel="canonical" href="{{ url('/features/recurring-invoices') }}">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/features/recurring-invoices') }}">
    <meta property="og:title" content="Recurring Invoice Software | Automated Retainer Billing | Cod Xpert">
    <meta property="og:description" content="Set it and forget it. Automated monthly client retainers, scheduled email delivery, and multi-currency exchange rate lock.">

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
                <a href="{{ route('free-invoice-generator') }}" class="btn-brand-secondary">Try Live Generator</a>
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
