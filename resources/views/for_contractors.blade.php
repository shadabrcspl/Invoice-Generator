<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Invoicing Software for Contractors & Consultants | Cod Xpert Invoices</title>
    <meta name="description" content="Professional invoicing software built for independent contractors, IT consultants, and commercial service providers. Milestone billing, multi-currency support, and expense tracking.">
    <meta name="keywords" content="contractor invoicing software, best invoicing software for contractors, template invoice contractor, commercial contractor billing, independent contractor invoice">
    <link rel="canonical" href="{{ url('/for/contractors') }}">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/for/contractors') }}">
    <meta property="og:title" content="Contractor Invoicing Software | Cod Xpert Invoices">
    <meta property="og:description" content="Milestone billing, multi-currency support, expense tracking, and clean professional PDF generation for contractors.">

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
            "priceCurrency": "USD"
        },
        "description": "Enterprise-grade milestone and project invoicing platform designed for independent contractors, technical consultants, and service firms."
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
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 text-decoration-none" href="{{ url('/') }}">
                <div class="brand-badge">EX</div>
                <span class="fw-bold text-dark fs-5">Cod Xpert Invoices</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link text-muted" href="{{ url('/') }}#features">Architecture</a></li>
                    <li class="nav-item"><a class="nav-link text-muted" href="{{ route('pricing') }}">Pricing</a></li>
                    <li class="nav-item"><a class="nav-link text-primary fw-semibold" href="{{ route('free-invoice-generator') }}"><span class="badge bg-primary-subtle text-primary me-1">Free</span> Generator</a></li>
                    <li class="nav-item"><a class="nav-link text-muted" href="{{ route('for.freelancers') }}">For Freelancers</a></li>
                    <li class="nav-item"><a class="nav-link text-primary fw-bold" href="{{ route('for.contractors') }}">For Contractors</a></li>
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
            <span class="badge bg-secondary-subtle text-secondary px-3 py-2 rounded-pill fw-semibold mb-3">Engineered for Technical Contractors & Consultancies</span>
            <h1 class="display-5 fw-extrabold text-dark mb-3">Accurate Contractor Billing.<br>Zero Payment Delays or Compliance Audits.</h1>
            <p class="text-muted fs-6 mx-auto mb-4" style="max-width: 650px;">
                Whether delivering enterprise software deliverables, technical staffing, or commercial advisory, Cod Xpert provides milestone billing, itemized expense reimbursement, and statutory GST export declarations.
            </p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('register') }}" class="btn-brand-primary">Start Contractor Plan Free →</a>
                <a href="{{ route('free-invoice-generator') }}" class="btn btn-outline-secondary py-3 px-4 rounded-3 fw-semibold">Instant Sample Invoice</a>
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
    <footer class="footer-modern">
        <div class="container text-center text-md-start">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                <div class="text-muted fs-8">
                    © {{ date('Y') }} <a href="https://codxpert.com/" target="_blank" rel="noopener" class="text-primary text-decoration-none fw-semibold">CodXpert</a>. All rights reserved. · Statutory Compliance: GST LUT & DPDP Act, 2023 Certified
                </div>
                <div class="d-flex gap-3 fs-8">
                    <a href="{{ url('/') }}" class="text-muted text-decoration-none">Home</a>
                    <a href="{{ route('pricing') }}" class="text-muted text-decoration-none">Pricing</a>
                    <a href="{{ route('for.freelancers') }}" class="text-muted text-decoration-none">For Freelancers</a>
                    <a href="{{ route('terms') }}" class="text-muted text-decoration-none">Terms</a>
                    <a href="{{ route('privacy') }}" class="text-muted text-decoration-none">Privacy</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
