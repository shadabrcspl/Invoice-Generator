<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Free Excel Invoice Templates with Formulas | Download XLSX & Online Formats | Cod Xpert</title>
    <meta name="description" content="Download free automated Excel invoice templates (.xlsx) with built-in tax formulas, GST calculation, and multi-currency formats. Or generate instant PDF invoices online with Cod Xpert.">
    <meta name="keywords" content="excel invoice template, free excel invoice template with formulas, GST invoice format excel xlsx, automated invoice excel sheet, download invoice template excel">
    <link rel="canonical" href="{{ url('/templates/excel-invoice-template') }}">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/templates/excel-invoice-template') }}">
    <meta property="og:title" content="Free Excel Invoice Templates with Formulas | Download XLSX & Online Formats | Cod Xpert">
    <meta property="og:description" content="Automated Excel invoice templates with pre-configured formulas for GST, discounts, and currency conversion.">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon-192x192.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Schema.org SoftwareApplication / CreativeWork -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "CreativeWork",
        "name": "Automated Excel Invoice Templates Collection",
        "description": "Downloadable Microsoft Excel spreadsheet templates with dynamic tax calculation formulas for billing.",
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
        .template-preview-card {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .template-preview-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 32px -8px rgba(15, 23, 42, 0.08);
            border-color: #38bdf8;
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

    <!-- Header -->
    <header class="py-5 text-center bg-white border-bottom">
        <div class="container py-4">
            <span class="badge bg-primary-subtle text-primary px-3 py-1.5 rounded-pill fw-bold fs-7 mb-3">Formulas & Spreadsheets</span>
            <h1 class="display-4 fw-extrabold text-dark mb-3">Free Excel Invoice Templates with Auto Formulas</h1>
            <p class="lead text-muted mx-auto mb-4" style="max-width: 720px;">
                Download pre-configured Excel spreadsheets with formulas for CGST, SGST, IGST, discounts, and totals. Or upgrade to Cod Xpert for cloud sync and live forex tracking.
            </p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('free-invoice-generator') }}" class="btn-brand-primary">Create Instant Online Invoice</a>
                <a href="{{ route('templates.word') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-semibold">View Word Templates</a>
            </div>
        </div>
    </header>

    <!-- Templates Grid -->
    <main class="container py-5">
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="template-preview-card p-4">
                    <div class="badge bg-success text-white mb-3">Formulas Included</div>
                    <h5 class="fw-bold text-dark mb-2">Automated GST Excel Sheet</h5>
                    <p class="text-muted fs-7 mb-3">Formulas for 5%, 12%, 18%, and 28% tax rates. Auto-calculates split CGST/SGST for intra-state or IGST for inter-state deals.</p>
                    <a href="{{ route('free-invoice-generator') }}" class="btn btn-outline-primary btn-sm w-100 rounded-pill fw-semibold">Generate in Browser →</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="template-preview-card p-4">
                    <div class="badge bg-primary text-white mb-3">Multi-Currency</div>
                    <h5 class="fw-bold text-dark mb-2">Export Remittance Spreadsheet</h5>
                    <p class="text-muted fs-7 mb-3">Formulas for foreign invoice currency totals, exchange rate conversion cells, and net realization estimates in INR.</p>
                    <a href="{{ route('tools.forex-calculator') }}" class="btn btn-outline-primary btn-sm w-100 rounded-pill fw-semibold">Try Forex Calculator →</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="template-preview-card p-4">
                    <div class="badge bg-dark text-white mb-3">Services & Hours</div>
                    <h5 class="fw-bold text-dark mb-2">Timesheet & Hourly Excel Format</h5>
                    <p class="text-muted fs-7 mb-3">Input hours worked and hourly billable rate. Automatically calculates subtotal, applied retainer credit, and balance due.</p>
                    <a href="{{ route('free-invoice-generator') }}" class="btn btn-outline-primary btn-sm w-100 rounded-pill fw-semibold">Generate in Browser →</a>
                </div>
            </div>
        </div>

        <!-- Excel Limitations Section -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <div class="row align-items-center g-4">
                <div class="col-lg-6">
                    <span class="badge bg-primary-subtle text-primary px-3 py-1 rounded-pill fw-bold fs-8 mb-2">Spreadsheet Risks</span>
                    <h2 class="fw-bold text-dark mb-3">Why 84% of Small Businesses Move Away from Excel</h2>
                    <ul class="list-unstyled d-flex flex-column gap-3 text-muted fs-7 mb-0">
                        <li class="d-flex align-items-start gap-2">
                            <span class="text-danger fw-bold">✕</span>
                            <span><strong>Broken Formulas:</strong> A deleted cell or misplaced bracket can silently zero out a tax line, creating compliance penalties.</span>
                        </li>
                        <li class="d-flex align-items-start gap-2">
                            <span class="text-danger fw-bold">✕</span>
                            <span><strong>Static Currency Rates:</strong> Excel cannot pull live RBI/ECB exchange rates without complex third-party macros.</span>
                        </li>
                        <li class="d-flex align-items-start gap-2">
                            <span class="text-danger fw-bold">✕</span>
                            <span><strong>Zero Audit Trail:</strong> Multiple versions floating around team desktops lead to duplicate invoice numbers and billing chaos.</span>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="p-4 bg-primary-subtle rounded-4 border border-primary-subtle">
                        <h4 class="fw-bold text-primary mb-2">Upgrade to Cod Xpert Cloud Invoicing</h4>
                        <p class="text-dark fs-7 mb-3">All the flexibility of a spreadsheet, backed by database validation, automatic sequential numbering, live forex rates, and 1-click PDF generation.</p>
                        <a href="{{ route('register') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-semibold">Start Free Trial</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Banner -->
        <div class="p-5 rounded-4 text-center text-white" style="background: linear-gradient(135deg, #0f172a, #1e293b);">
            <h2 class="fw-extrabold mb-3">Upgrade Your Spreadsheet Workflow Today</h2>
            <p class="text-slate-300 fs-6 mx-auto mb-4" style="max-width: 600px;">Save time, prevent formula errors, and impress clients with professional invoices.</p>
            <a href="{{ route('free-invoice-generator') }}" class="btn-brand-primary">Generate Free Invoice Online</a>
        </div>
    </main>

    <!-- Footer -->
    @include('partials.public_footer')

</body>
</html>
