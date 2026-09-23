<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Invoicing Software for Freelancers & Remote Professionals | Cod Xpert Invoices</title>
    <meta name="description" content="The best invoicing software for freelancers working with international clients. Multi-currency billing (USD, EUR, GBP), automated payment reminders, and zero accounting clutter.">
    <meta name="keywords" content="invoicing software for freelancers, best invoicing software for freelancers, freelance invoice generator, international freelance billing, cross border freelancer invoice">
    <link rel="canonical" href="{{ url('/for/freelancers') }}">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/for/freelancers') }}">
    <meta property="og:title" content="Invoicing Software for Freelancers | Cod Xpert Invoices">
    <meta property="og:description" content="Effortless multi-currency billing, automated payment reminders, and statutory GST LUT compliance for global freelancers.">

    <link rel="icon" type="image/png" href="{{ asset('images/codxpert-logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/codxpert-logo.png') }}">

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
            "priceCurrency": "USD"
        },
        "description": "Cross-border multi-currency invoicing software tailored for independent freelancers, remote consultants, and international creators."
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
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 text-decoration-none" href="{{ url('/') }}">
                <img src="{{ asset('images/codxpert-logo.png') }}" alt="CodXpert" style="height: 38px; width: auto; object-fit: contain;">
                <span class="fw-bold text-dark fs-5">Invoices</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link text-muted" href="{{ url('/') }}#features">Architecture</a></li>
                    <li class="nav-item"><a class="nav-link text-muted" href="{{ route('pricing') }}">Pricing</a></li>
                    <li class="nav-item"><a class="nav-link text-primary fw-semibold" href="{{ route('free-invoice-generator') }}"><span class="badge bg-primary-subtle text-primary me-1">Free</span> Generator</a></li>
                    <li class="nav-item"><a class="nav-link text-primary fw-bold" href="{{ route('for.freelancers') }}">For Freelancers</a></li>
                    <li class="nav-item"><a class="nav-link text-muted" href="{{ route('for.contractors') }}">For Contractors</a></li>
                    <li class="nav-item"><a class="nav-link text-muted" href="{{ route('contact.view') }}">Contact</a></li>
                </ul>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-sm px-3 rounded-pill">Sign In</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm px-3 rounded-pill">Get Started</a>
                </div>
            </div>
        </div>
    </nav>

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
                <a href="{{ route('free-invoice-generator') }}" class="btn btn-outline-primary py-3 px-4 rounded-3 fw-semibold">Try Free Generator</a>
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
    <footer class="footer-modern">
        <div class="container text-center text-md-start">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                <div class="text-muted fs-8">
                    © {{ date('Y') }} <a href="https://codxpert.com/" target="_blank" rel="noopener" class="text-primary text-decoration-none fw-semibold">CodXpert</a>. All rights reserved. · Statutory Compliance: GST LUT & DPDP Act, 2023 Certified
                </div>
                <div class="d-flex gap-3 fs-8">
                    <a href="{{ url('/') }}" class="text-muted text-decoration-none">Home</a>
                    <a href="{{ route('pricing') }}" class="text-muted text-decoration-none">Pricing</a>
                    <a href="{{ route('free-invoice-generator') }}" class="text-muted text-decoration-none">Free Generator</a>
                    <a href="{{ route('for.contractors') }}" class="text-muted text-decoration-none">For Contractors</a>
                    <a href="{{ route('terms') }}" class="text-muted text-decoration-none">Terms</a>
                    <a href="{{ route('privacy') }}" class="text-muted text-decoration-none">Privacy</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
