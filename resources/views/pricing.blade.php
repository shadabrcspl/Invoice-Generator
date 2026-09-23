<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Transparent Pricing & Plans | Cod Xpert Invoices</title>
    <meta name="description" content="Simple, transparent pricing for exporters, freelancers, and businesses. Start free with 0% IGST GST LUT export billing, or upgrade for automated Forex ledgers and custom SMTP.">
    <meta name="keywords" content="invoicing software pricing, free invoice software, export billing cost, GST LUT software plans, multi currency invoice pricing">
    <link rel="canonical" href="{{ url('/pricing') }}">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/pricing') }}">
    <meta property="og:title" content="Transparent Pricing & Plans | Cod Xpert Invoices">
    <meta property="og:description" content="Start free with GST LUT invoicing or unlock automated Forex variance and GSTR-1 exports.">

    <link rel="icon" type="image/png" href="{{ asset('images/codxpert-logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/codxpert-logo.png') }}">

    <!-- Schema.org Pricing Product -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Product",
        "name": "Cod Xpert Invoices",
        "description": "Statutory export invoicing, GST LUT exemption, and Forex variance software.",
        "offers": [
            {
                "@type": "Offer",
                "name": "Starter Exporter",
                "price": "0.00",
                "priceCurrency": "INR",
                "availability": "https://schema.org/InStock",
                "url": "https://invoice.codxpert.com/pricing"
            },
            {
                "@type": "Offer",
                "name": "Pro Exporter",
                "price": "999.00",
                "priceCurrency": "INR",
                "availability": "https://schema.org/InStock",
                "url": "https://invoice.codxpert.com/pricing"
            }
        ]
    }
    </script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --font-main: 'Plus Jakarta Sans', sans-serif;
            --font-heading: 'Outfit', sans-serif;
            --font-mono: 'JetBrains Mono', monospace;
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
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 50%, #ffffff 100%);
            padding: 90px 0 60px;
            border-bottom: 1px solid #e2e8f0;
        }

        .pricing-card {
            background: #ffffff;
            border: 1.5px solid #e2e8f0;
            border-radius: 24px;
            padding: 40px 32px;
            box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.05);
            transition: all 0.3s ease;
            position: relative;
            height: 100%;
            display: flex;
            flex-column: column;
            justify-content: space-between;
        }

        .pricing-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -15px rgba(2, 132, 199, 0.12);
        }

        .pricing-card.featured {
            border-color: #0284c7;
            box-shadow: 0 20px 40px -10px rgba(2, 132, 199, 0.15);
            background: linear-gradient(180deg, #ffffff 0%, #f0f9ff 100%);
        }

        .popular-badge {
            position: absolute;
            top: -14px;
            left: 50%;
            transform: translateX(-50%);
            background: #0284c7;
            color: #ffffff;
            padding: 4px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .price-amount {
            font-family: var(--font-heading);
            font-size: 48px;
            font-weight: 800;
            color: #0f172a;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
            font-size: 14px;
            color: #334155;
        }

        .feature-icon-check {
            color: #16a34a;
            font-weight: bold;
            flex-shrink: 0;
        }

        .btn-brand-primary {
            background: #0284c7;
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 14px 24px;
            font-weight: 600;
            transition: all 0.2s ease;
            text-decoration: none;
            text-align: center;
            display: block;
        }

        .btn-brand-primary:hover {
            background: #0369a1;
            color: #fff;
        }

        .btn-brand-secondary {
            background: #f1f5f9;
            color: #0f172a;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            padding: 14px 24px;
            font-weight: 600;
            transition: all 0.2s ease;
            text-decoration: none;
            text-align: center;
            display: block;
        }

        .btn-brand-secondary:hover {
            background: #e2e8f0;
            color: #0f172a;
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
                    <li class="nav-item"><a class="nav-link text-primary fw-bold" href="{{ route('pricing') }}">Pricing</a></li>
                    <li class="nav-item"><a class="nav-link text-primary fw-semibold" href="{{ route('free-invoice-generator') }}"><span class="badge bg-primary-subtle text-primary me-1">Free</span> Generator</a></li>
                    <li class="nav-item"><a class="nav-link text-muted" href="{{ route('for.freelancers') }}">For Freelancers</a></li>
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

    <!-- Header Banner -->
    <header class="hero-banner mt-5 text-center">
        <div class="container pt-4">
            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-semibold mb-3">Honest, Predictable Pricing</span>
            <h1 class="display-5 fw-extrabold text-dark mb-3">Pick the Right Plan for Your Export Business</h1>
            <p class="text-muted fs-6 mx-auto" style="max-width: 620px;">
                No hidden charges, per-invoice fees, or currency conversion penalties. Get complete statutory compliance, GST LUT automation, and real-time Forex accounting out of the box.
            </p>
        </div>
    </header>

    <!-- Pricing Cards Grid -->
    <main class="container py-5">
        <div class="row g-4 align-items-stretch justify-content-center">
            
            <!-- Tier 1: Free Forever -->
            <div class="col-lg-4 col-md-6">
                <div class="pricing-card">
                    <div>
                        <h4 class="fw-bold text-dark mb-1">Starter Exporter</h4>
                        <p class="text-muted fs-7 mb-4">Ideal for solo exporters, freelancers, and early startups.</p>
                        
                        <div class="d-flex align-items-baseline mb-4">
                            <span class="price-amount">₹0</span>
                            <span class="text-muted ms-2 fs-7">/ free forever</span>
                        </div>

                        <div class="border-top pt-4">
                            <div class="feature-item"><span class="feature-icon-check">✓</span> Up to 15 invoices per month</div>
                            <div class="feature-item"><span class="feature-icon-check">✓</span> GST LUT 0% IGST Rule 96A declarations</div>
                            <div class="feature-item"><span class="feature-icon-check">✓</span> Multi-currency engine (USD, AED, EUR, GBP)</div>
                            <div class="feature-item"><span class="feature-icon-check">✓</span> Live interbank exchange rate sync</div>
                            <div class="feature-item"><span class="feature-icon-check">✓</span> Pixel-perfect DomPDF generation</div>
                            <div class="feature-item"><span class="feature-icon-check">✓</span> 100% DPDP Act 2023 data compliance</div>
                        </div>
                    </div>

                    <div class="pt-4">
                        <a href="{{ route('register') }}" class="btn-brand-secondary">Get Started Free</a>
                    </div>
                </div>
            </div>

            <!-- Tier 2: Pro Exporter (Featured) -->
            <div class="col-lg-4 col-md-6">
                <div class="pricing-card featured">
                    <span class="popular-badge">Most Popular</span>
                    <div>
                        <h4 class="fw-bold text-primary mb-1">Pro Exporter</h4>
                        <p class="text-muted fs-7 mb-4">Complete compliance suite for growing exporters and agencies.</p>
                        
                        <div class="d-flex align-items-baseline mb-4">
                            <span class="price-amount">₹999</span>
                            <span class="text-muted ms-2 fs-7">/ month (or $12)</span>
                        </div>

                        <div class="border-top pt-4">
                            <div class="feature-item"><span class="feature-icon-check">✓</span> <strong>Unlimited</strong> multi-currency invoices</div>
                            <div class="feature-item"><span class="feature-icon-check">✓</span> <strong>Automated Forex Gain/Loss ledger</strong></div>
                            <div class="feature-item"><span class="feature-icon-check">✓</span> <strong>FIRC & e-BRC reference reconciliation</strong></div>
                            <div class="feature-item"><span class="feature-icon-check">✓</span> <strong>GSTR-1 Table 6A CSV exports</strong> for CA filing</div>
                            <div class="feature-item"><span class="feature-icon-check">✓</span> Business Expense & Input Tax Credit (ITC) tracker</div>
                            <div class="feature-item"><span class="feature-icon-check">✓</span> <strong>Custom Domain SMTP Mailer</strong> (Zero spam)</div>
                            <div class="feature-item"><span class="feature-icon-check">✓</span> Automated client payment reminder scheduler</div>
                        </div>
                    </div>

                    <div class="pt-4">
                        <a href="{{ route('register') }}" class="btn-brand-primary">Start Pro Exporter Plan</a>
                    </div>
                </div>
            </div>

            <!-- Tier 3: Enterprise Custom -->
            <div class="col-lg-4 col-md-6">
                <div class="pricing-card">
                    <div>
                        <h4 class="fw-bold text-dark mb-1">Enterprise Custom</h4>
                        <p class="text-muted fs-7 mb-4">For established export houses, CA firms, and corporate fleets.</p>
                        
                        <div class="d-flex align-items-baseline mb-4">
                            <span class="price-amount">Custom</span>
                            <span class="text-muted ms-2 fs-7">/ tailored deployment</span>
                        </div>

                        <div class="border-top pt-4">
                            <div class="feature-item"><span class="feature-icon-check">✓</span> Everything in Pro Exporter</div>
                            <div class="feature-item"><span class="feature-icon-check">✓</span> Dedicated cloud server VM instance</div>
                            <div class="feature-item"><span class="feature-icon-check">✓</span> Multi-user role hierarchy & CA audit access</div>
                            <div class="feature-item"><span class="feature-icon-check">✓</span> Custom ERP / Accounting API integrations</div>
                            <div class="feature-item"><span class="feature-icon-check">✓</span> Guaranteed 99.9% uptime SLA</div>
                            <div class="feature-item"><span class="feature-icon-check">✓</span> Dedicated account manager & WhatsApp desk</div>
                        </div>
                    </div>

                    <div class="pt-4">
                        <a href="{{ route('contact.view') }}" class="btn-brand-secondary">Request Architecture Demo</a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Trust Guarantee Section -->
        <div class="mt-5 p-4 rounded-4 bg-white border text-center">
            <div class="row g-4 align-items-center">
                <div class="col-md-4">
                    <div class="fw-bold text-dark fs-6">🔒 Statutory Guarantee</div>
                    <p class="text-muted fs-8 mb-0">Automatic Rule 96A wording to protect from IGST blocking.</p>
                </div>
                <div class="col-md-4 border-start border-end">
                    <div class="fw-bold text-dark fs-6">⚡ Instant Activation</div>
                    <p class="text-muted fs-8 mb-0">No credit card required. Register and generate in 2 minutes.</p>
                </div>
                <div class="col-md-4">
                    <div class="fw-bold text-dark fs-6">🛡️ DPDP Act 2023 Certified</div>
                    <p class="text-muted fs-8 mb-0">AES-256 encrypted SMTP and full data privacy governance.</p>
                </div>
            </div>
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
                    <a href="{{ route('free-invoice-generator') }}" class="text-muted text-decoration-none">Free Generator</a>
                    <a href="{{ route('for.freelancers') }}" class="text-muted text-decoration-none">For Freelancers</a>
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
