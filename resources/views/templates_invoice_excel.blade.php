<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Free Excel Invoice Templates (.xlsx) | Automated Tax Formulas | Cod Xpert</title>
    <meta name="description" content="Download free automated Excel invoice templates (.xlsx) with pre-built math formulas for GST (CGST/SGST/IGST), foreign currency conversion, and consulting timesheets. Open in Excel or Google Sheets.">
    <meta name="keywords" content="excel invoice template, free invoice template xlsx, automated gst invoice excel, excel spreadsheet invoice with formulas, download excel invoice format, forex invoice excel">
    <link rel="canonical" href="{{ url('/templates/excel-invoice-template') }}">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/templates/excel-invoice-template') }}">
    <meta property="og:title" content="Free Excel Invoice Templates (.xlsx) | Automated Tax Formulas | Cod Xpert">
    <meta property="og:description" content="Download free Microsoft Excel invoice templates (.xlsx) with pre-configured formulas for GST tax split, subtotal calculations, and forex conversion.">
    <meta property="og:image" content="{{ asset('favicon-192x192.png') }}">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon-192x192.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Schema.org SoftwareApplication / CreativeWork & FAQPage -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@graph": [
            {
                "@type": "CreativeWork",
                "name": "Automated Excel Invoice Templates Collection (.xlsx)",
                "description": "Pre-configured Microsoft Excel invoice spreadsheets with automated formulas for Indian GST, foreign remittance, and hourly billing.",
                "publisher": {
                    "@type": "Organization",
                    "name": "CodXpert",
                    "url": "https://codxpert.com/"
                }
            },
            {
                "@type": "FAQPage",
                "mainEntity": [
                    {
                        "@type": "Question",
                        "name": "Do these Excel templates have built-in formulas?",
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": "Yes, all Excel (.xlsx) templates come with pre-written active formulas for line totals (=Qty*Rate), subtotal sums, split CGST/SGST, and balance due."
                        }
                    },
                    {
                        "@type": "Question",
                        "name": "Can I open these files in Google Sheets?",
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": "Yes, our .xlsx files are 100% compatible with Google Sheets, Microsoft 365, Apple Numbers, and LibreOffice Calc without formula errors."
                        }
                    },
                    {
                        "@type": "Question",
                        "name": "Are the Excel invoice templates free to download?",
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": "Yes, all spreadsheet templates are completely free with direct download links and no login required."
                        }
                    }
                ]
            }
        ]
    }
    </script>

    <!-- Google Fonts & Bootstrap -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --brand-excel: #16a34a;
            --brand-excel-dark: #15803d;
            --brand-primary: #0284c7;
            --brand-dark: #0f172a;
            --font-heading: 'Outfit', sans-serif;
            --font-main: 'Plus Jakarta Sans', sans-serif;
            --font-mono: 'JetBrains Mono', monospace;
        }
        body {
            font-family: var(--font-main);
            color: #334155;
            background-color: #f8fafc;
            padding-top: 80px;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: var(--font-heading);
        }
        .font-mono {
            font-family: var(--font-mono);
        }
        .hero-section {
            background: radial-gradient(circle at 50% 0%, #dcfce7 0%, #f8fafc 70%);
            border-bottom: 1px solid #e2e8f0;
            padding: 4.5rem 0 3.5rem;
        }
        .excel-badge {
            background: linear-gradient(135deg, #15803d, #16a34a);
            color: #ffffff;
            font-weight: 700;
            font-size: 0.82rem;
            letter-spacing: 0.03em;
            padding: 6px 14px;
            border-radius: 9999px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .template-card {
            background: #ffffff;
            border-radius: 18px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        .template-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 35px -10px rgba(15, 23, 42, 0.12);
            border-color: #4ade80;
        }
        .formula-box {
            background: #0f172a;
            border: 1px solid #1e293b;
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 0.73rem;
            line-height: 1.5;
            color: #38bdf8;
            font-family: var(--font-mono);
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.2);
        }
        .formula-box .formula-label {
            color: #94a3b8;
            font-size: 0.68rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .formula-box .formula-code {
            color: #4ade80;
            font-weight: 600;
        }
        .btn-download-excel {
            background: linear-gradient(135deg, #15803d, #16a34a);
            color: #ffffff;
            font-weight: 700;
            border-radius: 50px;
            padding: 11px 22px;
            font-size: 0.92rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: none;
            transition: all 0.2s ease;
        }
        .btn-download-excel:hover {
            background: linear-gradient(135deg, #166534, #15803d);
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(22, 163, 74, 0.35);
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
        .step-icon-bubble {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #dcfce7;
            color: #15803d;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.1rem;
            flex-shrink: 0;
        }
    </style>
</head>
<body>

    <!-- Header Navigation -->
    @include('partials.public_navbar')

    <!-- Hero Section -->
    <header class="hero-section text-center">
        <div class="container">
            <div class="mb-3">
                <span class="excel-badge shadow-sm">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zm4 18H6V4h7v5h5v11zM8.5 15.5l2-3-2-3h1.6l1.2 2 1.2-2h1.6l-2 3 2 3h-1.6l-1.2-2-1.2 2H8.5z"/>
                    </svg>
                    Microsoft Excel (.xlsx) Spreadsheets with Formulas
                </span>
            </div>
            <h1 class="display-4 fw-extrabold text-dark mb-3">
                Free Automated Excel Invoice Templates
            </h1>
            <p class="lead text-muted mx-auto mb-4" style="max-width: 760px;">
                Download pre-configured Microsoft Excel spreadsheets (<strong class="text-dark">.xlsx</strong>) with built-in math formulas for automated line totals, Indian GST tax splits (CGST, SGST, IGST), foreign exchange conversion, and hourly billing.
            </p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="#templates-grid" class="btn btn-download-excel px-4 py-2.5">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                    Browse Excel Files (.xlsx)
                </a>
                <a href="{{ route('templates.word') }}" class="btn btn-outline-primary rounded-pill px-4 py-2.5 fw-bold d-inline-flex align-items-center gap-2">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zm4 18H6V4h7v5h5v11zM8 15.5l1.5-6h1.2l1.3 4.2 1.3-4.2h1.2l1.5 6h-1.2l-.9-4-1.2 4h-1.4l-1.2-4-.9 4H8z"/>
                    </svg>
                    Word Templates (.docx)
                </a>
                <a href="{{ route('free-invoice-generator') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2.5 fw-semibold">
                    Free Web Generator (Instant PDF)
                </a>
            </div>
        </div>
    </header>

    <!-- Templates Download Section -->
    <main class="container py-5" id="templates-grid">
        <div class="text-center mb-5">
            <span class="badge bg-success-subtle text-success px-3 py-1.5 rounded-pill fw-bold fs-7">Pre-Loaded Formulas</span>
            <h2 class="display-6 fw-bold text-dark mt-2 mb-2">Select Your Excel Spreadsheet Template</h2>
            <p class="text-muted">Direct downloads with zero watermark or registration. Compatible with Excel 2016+, Office 365, Google Sheets, and Calc.</p>
        </div>

        <div class="row g-4 mb-5">
            <!-- Template 1: Automated GST Excel -->
            <div class="col-lg-4 col-md-6">
                <div class="template-card p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="badge bg-success px-3 py-1.5 rounded-pill fw-bold">GST Formulas</span>
                        <span class="badge bg-light text-muted border">.XLSX &bull; 6.4 KB</span>
                    </div>
                    <h3 class="h5 fw-bold text-dark mb-2">Automated GST Excel Sheet</h3>
                    <p class="text-muted fs-7 mb-3">
                        Pre-programmed mathematical formulas that calculate line totals, subtotal sums, intra-state split (CGST 9% + SGST 9%) or inter-state IGST (18%), and final invoice grand totals.
                    </p>

                    <!-- Formula Showcase -->
                    <div class="formula-box mb-3">
                        <div class="formula-label mb-1">Active Excel Formulas in Sheet</div>
                        <div class="d-flex justify-content-between py-0.5">
                            <span class="text-light">Line Total:</span>
                            <span class="formula-code">=D14*E14</span>
                        </div>
                        <div class="d-flex justify-content-between py-0.5">
                            <span class="text-light">Subtotal:</span>
                            <span class="formula-code">=SUM(G14:G17)</span>
                        </div>
                        <div class="d-flex justify-content-between py-0.5">
                            <span class="text-light">CGST (9%):</span>
                            <span class="formula-code">=G18*0.09</span>
                        </div>
                        <div class="d-flex justify-content-between py-0.5">
                            <span class="text-light">Grand Total:</span>
                            <span class="formula-code">=SUM(G18:G20)-G21</span>
                        </div>
                    </div>

                    <ul class="list-unstyled text-muted fs-8 mb-4 d-flex flex-column gap-1">
                        <li><span class="text-success fw-bold">✓</span> Auto-calculates without manual arithmetic errors</li>
                        <li><span class="text-success fw-bold">✓</span> Configurable tax rate percentages (5%, 12%, 18%, 28%)</li>
                        <li><span class="text-success fw-bold">✓</span> Includes HSN/SAC columns & Seller/Buyer GSTIN blocks</li>
                    </ul>

                    <div class="mt-auto">
                        <a href="{{ route('templates.download', 'codxpert-automated-gst-invoice-template.xlsx') }}" class="btn-download-excel w-100 mb-2">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Download GST Excel (.xlsx)
                        </a>
                        <div class="text-center text-muted fs-8">Free direct download &bull; No login required</div>
                    </div>
                </div>
            </div>

            <!-- Template 2: Multi-Currency Forex Spreadsheet -->
            <div class="col-lg-4 col-md-6">
                <div class="template-card p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="badge bg-primary px-3 py-1.5 rounded-pill fw-bold">Forex & Remittance</span>
                        <span class="badge bg-light text-muted border">.XLSX &bull; 6.2 KB</span>
                    </div>
                    <h3 class="h5 fw-bold text-dark mb-2">Multi-Currency Forex Exporter</h3>
                    <p class="text-muted fs-7 mb-3">
                        Tailored for Indian IT exporters and remote contractors. Input your foreign invoice value in USD, EUR, or GBP, specify the exchange rate, and auto-calculate net INR realization.
                    </p>

                    <!-- Formula Showcase -->
                    <div class="formula-box mb-3">
                        <div class="formula-label mb-1">Active Excel Formulas in Sheet</div>
                        <div class="d-flex justify-content-between py-0.5">
                            <span class="text-light">Total Foreign:</span>
                            <span class="formula-code">=SUM(D14:D16)</span>
                        </div>
                        <div class="d-flex justify-content-between py-0.5">
                            <span class="text-light">Gross INR:</span>
                            <span class="formula-code">=D17*E18</span>
                        </div>
                        <div class="d-flex justify-content-between py-0.5">
                            <span class="text-light">Bank Spread:</span>
                            <span class="formula-code">=D19*(E20/100)</span>
                        </div>
                        <div class="d-flex justify-content-between py-0.5">
                            <span class="text-light">Net Inflow (INR):</span>
                            <span class="formula-code">=D19-D21</span>
                        </div>
                    </div>

                    <ul class="list-unstyled text-muted fs-8 mb-4 d-flex flex-column gap-1">
                        <li><span class="text-primary fw-bold">✓</span> Dual currency tracking (Foreign Bill & Realized INR)</li>
                        <li><span class="text-primary fw-bold">✓</span> Pre-built bank conversion spread margin deductions</li>
                        <li><span class="text-primary fw-bold">✓</span> Ideal for FIRC & e-BRC inward remittance matching</li>
                    </ul>

                    <div class="mt-auto">
                        <a href="{{ route('templates.download', 'codxpert-multi-currency-forex-invoice-template.xlsx') }}" class="btn-download-excel w-100 mb-2">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Download Forex Excel (.xlsx)
                        </a>
                        <div class="text-center text-muted fs-8">Free direct download &bull; No login required</div>
                    </div>
                </div>
            </div>

            <!-- Template 3: Consulting Timesheet & Hourly Billing -->
            <div class="col-lg-4 col-md-6">
                <div class="template-card p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="badge bg-dark px-3 py-1.5 rounded-pill fw-bold">Hourly Timesheet</span>
                        <span class="badge bg-light text-muted border">.XLSX &bull; 6.1 KB</span>
                    </div>
                    <h3 class="h5 fw-bold text-dark mb-2">Consulting Timesheet Billing</h3>
                    <p class="text-muted fs-7 mb-3">
                        Created for software developers, agencies, and fractional consultants. Log hours worked, apply billable rates, offset prepaid retainers, and calculate net due.
                    </p>

                    <!-- Formula Showcase -->
                    <div class="formula-box mb-3">
                        <div class="formula-label mb-1">Active Excel Formulas in Sheet</div>
                        <div class="d-flex justify-content-between py-0.5">
                            <span class="text-light">Task Charge:</span>
                            <span class="formula-code">=D14*E14</span>
                        </div>
                        <div class="d-flex justify-content-between py-0.5">
                            <span class="text-light">Total Labor:</span>
                            <span class="formula-code">=SUM(F14:F17)</span>
                        </div>
                        <div class="d-flex justify-content-between py-0.5">
                            <span class="text-light">Retainer Offset:</span>
                            <span class="formula-code">=F19</span>
                        </div>
                        <div class="d-flex justify-content-between py-0.5">
                            <span class="text-light">Balance Payable:</span>
                            <span class="formula-code">=F18-F19</span>
                        </div>
                    </div>

                    <ul class="list-unstyled text-muted fs-8 mb-4 d-flex flex-column gap-1">
                        <li><span class="text-dark fw-bold">✓</span> Detailed date & task-wise hourly logging rows</li>
                        <li><span class="text-dark fw-bold">✓</span> Advance retainer deposit deduction arithmetic</li>
                        <li><span class="text-dark fw-bold">✓</span> Clean printable borders configured for PDF export</li>
                    </ul>

                    <div class="mt-auto">
                        <a href="{{ route('templates.download', 'codxpert-timesheet-hourly-billing-invoice-template.xlsx') }}" class="btn-download-excel w-100 mb-2">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Download Timesheet Excel (.xlsx)
                        </a>
                        <div class="text-center text-muted fs-8">Free direct download &bull; No login required</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- How Excel Formulas Work Section -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <div class="text-center mb-4">
                <span class="badge bg-success-subtle text-success px-3 py-1 rounded-pill fw-bold fs-8">Under the Hood</span>
                <h3 class="fw-bold text-dark mt-2 mb-2">How Excel Invoicing Formulas Save Time</h3>
                <p class="text-muted fs-7">Understand the key spreadsheet functions embedded in every CodXpert template.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="p-3 bg-light rounded-3 h-100 border">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="badge bg-success text-white font-mono fs-8">=PRODUCT / Multi</span>
                            <h6 class="fw-bold text-dark mb-0">Line Item Calculation</h6>
                        </div>
                        <p class="text-muted fs-8 mb-0">
                            Instead of hand-calculating <code>15 hours &times; ₹2,500/hr</code>, each row uses <code>=D14*E14</code> so when you change quantities, the entire sheet recalculates in real-time.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 bg-light rounded-3 h-100 border">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="badge bg-success text-white font-mono fs-8">=SUM / Tax Split</span>
                            <h6 class="fw-bold text-dark mb-0">GST Auto Calculation</h6>
                        </div>
                        <p class="text-muted fs-8 mb-0">
                            Tax cells reference the total taxable value: <code>=Taxable*0.09</code> for CGST and SGST respectively. No need to open a calculator to figure out your 18% tax split.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 bg-light rounded-3 h-100 border">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="badge bg-success text-white font-mono fs-8">=ROUND / Export</span>
                            <h6 class="fw-bold text-dark mb-0">Print & PDF Ready</h6>
                        </div>
                        <p class="text-muted fs-8 mb-0">
                            Every sheet comes pre-configured with print margins fit to 1-page A4. Simply press <em>Ctrl + P (Cmd + P)</em> to save a crisp PDF invoice for your clients.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Excel Spreadsheets vs Cloud Invoicing -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <div class="row align-items-center g-4">
                <div class="col-lg-6">
                    <span class="badge bg-warning-subtle text-warning px-3 py-1 rounded-pill fw-bold fs-8 mb-2">The Limit of Spreadsheets</span>
                    <h3 class="fw-bold text-dark mb-3">Why Growing Businesses Upgrade from Excel</h3>
                    <p class="text-muted fs-7 mb-4">Excel is vastly better than Word for billing, but spreadsheet invoicing still carries significant risks:</p>
                    <ul class="list-unstyled d-flex flex-column gap-3 text-muted fs-7 mb-0">
                        <li class="d-flex align-items-start gap-2">
                            <span class="text-danger fw-bold">✕</span>
                            <span><strong>Accidental Formula Overwrites:</strong> Typing an invoice amount over a formula cell silently destroys calculations in future invoices.</span>
                        </li>
                        <li class="d-flex align-items-start gap-2">
                            <span class="text-danger fw-bold">✕</span>
                            <span><strong>No Invoice Number Sequencing:</strong> Easy to duplicate invoice numbers accidentally across different clients, violating tax audit rules.</span>
                        </li>
                        <li class="d-flex align-items-start gap-2">
                            <span class="text-danger fw-bold">✕</span>
                            <span><strong>No Live Forex Feeds:</strong> Exporters must browse RBI tables manually to locate foreign currency rates.</span>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="p-4 bg-success-subtle rounded-4 border border-success-subtle">
                        <span class="badge bg-success text-white px-2 py-1 rounded mb-2 fs-9">Automated Alternative</span>
                        <h4 class="fw-bold text-success mb-2">Upgrade to CodXpert Cloud Invoicing</h4>
                        <p class="text-dark fs-7 mb-3">Eliminate broken spreadsheet formulas forever. CodXpert automates GST compliance, live forex tracking, and sequential numbering effortlessly:</p>
                        <ul class="list-unstyled text-dark fs-8 d-flex flex-column gap-2 mb-4">
                            <li><strong class="text-success">✓</strong> Zero broken formulas — robust cloud calculation engine</li>
                            <li><strong class="text-success">✓</strong> Automatic sequential invoice numbers with prefix customization</li>
                            <li><strong class="text-success">✓</strong> 1-Click instant PDF export and client status tracking</li>
                        </ul>
                        <a href="{{ route('free-invoice-generator') }}" class="btn btn-success rounded-pill px-4 py-2.5 fw-bold d-inline-flex align-items-center gap-2">
                            <span>Use Free Online Generator</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h3 class="fw-bold text-dark text-center mb-4">Frequently Asked Questions</h3>
            <div class="accordion accordion-flush" id="faqExcelTemplates">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                            Do these Excel templates contain macros or VBA scripts?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#faqExcelTemplates">
                        <div class="accordion-body text-muted fs-7">
                            No. All templates use clean, native spreadsheet formulas (<code>=SUM</code>, <code>=PRODUCT</code>, etc.) saved in standard <code>.xlsx</code> format. There are no risky macros, ensuring zero security warnings when opening in Excel or Google Sheets.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                            Can I use these spreadsheets in Google Sheets or LibreOffice Calc?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqExcelTemplates">
                        <div class="accordion-body text-muted fs-7">
                            Yes! Simply drag and drop the downloaded <code>.xlsx</code> file into Google Drive or open it directly in Google Sheets or LibreOffice Calc. All formulas and cell formatting translate 100% accurately.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                            How do I change the GST percentage rate in the template?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqExcelTemplates">
                        <div class="accordion-body text-muted fs-7">
                            In the GST summary section, look for the tax rate cell (default is 18%, or 9% CGST + 9% SGST). You can update the multiplier in the formula bar to any applicable slab: <code>0.05</code> for 5%, <code>0.12</code> for 12%, or <code>0.28</code> for 28%.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom CTA -->
        <div class="p-5 rounded-4 text-center text-white" style="background: linear-gradient(135deg, #0f172a, #14532d);">
            <span class="badge bg-success px-3 py-1.5 rounded-pill fw-bold fs-8 mb-3">Formula Powered</span>
            <h2 class="display-6 fw-extrabold mb-3">Generate Flawless Invoices Without Spreadsheets</h2>
            <p class="text-slate-300 fs-6 mx-auto mb-4" style="max-width: 620px;">
                Tired of managing spreadsheets? Use CodXpert's free browser-based generator for automatic calculations, live currency rates, and instant PDF delivery.
            </p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="{{ route('free-invoice-generator') }}" class="btn btn-success rounded-pill px-4 py-2.5 fw-bold shadow-sm">
                    Open Free Online Generator
                </a>
                <a href="{{ route('templates.word') }}" class="btn btn-outline-light rounded-pill px-4 py-2.5 fw-semibold">
                    Download Word Templates (.docx)
                </a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    @include('partials.public_footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
