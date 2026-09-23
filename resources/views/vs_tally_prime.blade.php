<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CodXpert vs Tally Prime | Cloud Invoicing for Modern Businesses | Cod Xpert</title>
    <meta name="description" content="Compare CodXpert with Tally Prime. Experience fast cloud invoicing, automatic GST LUT export zero-rating, multi-currency live conversions, and anywhere access without desktop hardware locks.">
    <meta name="keywords" content="CodXpert vs Tally Prime, Tally Prime alternative, cloud invoicing vs Tally, online GST billing software, Tally Prime comparison">
    <link rel="canonical" href="{{ url('/vs/tally-prime') }}">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/vs/tally-prime') }}">
    <meta property="og:title" content="CodXpert vs Tally Prime | Cloud Invoicing for Modern Businesses | Cod Xpert">
    <meta property="og:description" content="Tired of desktop dongles, slow local backups, and complicated hotkeys? Discover why modern businesses choose CodXpert's cloud invoicing.">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon-192x192.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Schema.org Product / Comparison -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Product",
        "name": "CodXpert Cloud Invoicing Platform",
        "description": "Cloud-native GST and export billing alternative to desktop accounting suites.",
        "brand": {
            "@type": "Brand",
            "name": "CodXpert"
        },
        "offers": {
            "@type": "Offer",
            "price": "0.00",
            "priceCurrency": "USD"
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
        .comparison-table {
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }
        .comparison-table th {
            background: #f1f5f9;
            padding: 18px 24px;
            font-size: 0.95rem;
        }
        .comparison-table td {
            padding: 18px 24px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
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
            <span class="badge bg-primary-subtle text-primary px-3 py-1.5 rounded-pill fw-bold fs-7 mb-3">Cloud vs Desktop ERP</span>
            <h1 class="display-4 fw-extrabold text-dark mb-3">CodXpert vs Tally Prime</h1>
            <p class="lead text-muted mx-auto mb-4" style="max-width: 720px;">
                Tally Prime is a heavy-duty accounting package built for desktop operators. CodXpert is a lightning-fast, cloud-native invoicing tool engineered for modern founders, service firms, and global exporters.
            </p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('register') }}" class="btn-brand-primary">Try CodXpert Free</a>
                <a href="{{ route('pricing') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-semibold">View Free Plan</a>
            </div>
        </div>
    </header>

    <!-- Comparison Table -->
    <main class="container py-5">
        <div class="table-responsive comparison-table shadow-sm mb-5">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th style="width: 40%;">Core Capabilities</th>
                        <th style="width: 30%;" class="text-primary fw-bold fs-6">CodXpert</th>
                        <th style="width: 30%;" class="text-muted fw-bold fs-6">Tally Prime</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Cloud & Mobile Access</strong><br><span class="text-muted fs-8">Bill clients from your phone, Mac, or PC anywhere</span></td>
                        <td><span class="badge bg-success-subtle text-success p-2">✓ 100% Cloud-Native</span></td>
                        <td><span class="badge bg-danger-subtle text-danger p-2">✗ Desktop-Bound (Windows-first)</span></td>
                    </tr>
                    <tr>
                        <td><strong>Learning Curve</strong><br><span class="text-muted fs-8">Time needed to create your first professional invoice</span></td>
                        <td><span class="badge bg-success-subtle text-success p-2">✓ Less than 2 minutes</span></td>
                        <td><span class="badge bg-secondary-subtle text-muted p-2">Requires accounting training / hotkeys</span></td>
                    </tr>
                    <tr>
                        <td><strong>Multi-Currency with Live Forex</strong><br><span class="text-muted fs-8">Auto-updated currency rates for overseas exports</span></td>
                        <td><span class="badge bg-success-subtle text-success p-2">✓ Built-in Live Feed</span></td>
                        <td><span class="badge bg-secondary-subtle text-muted p-2">Manual currency rate entry</span></td>
                    </tr>
                    <tr>
                        <td><strong>Client PDF Design Quality</strong><br><span class="text-muted fs-8">Contemporary typography, brand colors, modern layouts</span></td>
                        <td><span class="badge bg-success-subtle text-success p-2">✓ Polished International PDFs</span></td>
                        <td><span class="badge bg-light text-muted p-2">Traditional monolithic dot-matrix styling</span></td>
                    </tr>
                    <tr>
                        <td><strong>Automatic Client Reminders</strong><br><span class="text-muted fs-8">Track status and chase late payments automatically</span></td>
                        <td><span class="badge bg-success-subtle text-success p-2">✓ Automated Email Cadence</span></td>
                        <td><span class="badge bg-danger-subtle text-danger p-2">✗ Manual ledger statement emailing</span></td>
                    </tr>
                    <tr>
                        <td><strong>License & Upfront Cost</strong><br><span class="text-muted fs-8">Hardware locks, TSS renewal fees, and initial purchase</span></td>
                        <td><span class="badge bg-success-subtle text-success p-2">✓ Free Starter Access</span></td>
                        <td><span class="badge bg-danger-subtle text-danger p-2">₹22,500+ Silver License + Annual TSS</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Co-existence Narrative -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h3 class="fw-bold text-dark mb-3 text-center">Can CodXpert Work Alongside Your CA's Tally?</h3>
            <p class="text-secondary text-center mx-auto mb-4" style="max-width: 700px;">
                Yes! Hundreds of founders use CodXpert on the front-lines to invoice clients, look professional, and get paid faster. At month-end, simply export the clean CSV ledger for your CA to import into their internal Tally ledger.
            </p>
            <div class="row g-3 justify-content-center text-center">
                <div class="col-md-3">
                    <div class="p-3 bg-light rounded-3 border">
                        <div class="fw-bold text-dark">Fast Billing</div>
                        <div class="text-muted fs-8">Send bills in 60s from anywhere</div>
                    </div>
                </div>
                <div class="col-md-1 d-flex align-items-center justify-content-center text-primary fs-4 fw-bold">→</div>
                <div class="col-md-3">
                    <div class="p-3 bg-light rounded-3 border">
                        <div class="fw-bold text-dark">One-Click CSV Export</div>
                        <div class="text-muted fs-8">All HSN, SAC, GST, and LUT details</div>
                    </div>
                </div>
                <div class="col-md-1 d-flex align-items-center justify-content-center text-primary fs-4 fw-bold">→</div>
                <div class="col-md-3">
                    <div class="p-3 bg-light rounded-3 border">
                        <div class="fw-bold text-dark">Happy CA</div>
                        <div class="text-muted fs-8">Seamless GSTR-1 & 3B filing</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Banner -->
        <div class="p-5 rounded-4 text-center text-white" style="background: linear-gradient(135deg, #0f172a, #1e293b);">
            <h2 class="fw-extrabold mb-3">Experience Next-Generation Invoicing</h2>
            <p class="text-slate-300 fs-6 mx-auto mb-4" style="max-width: 600px;">No software downloads. No hardware licenses. Start in your browser today.</p>
            <a href="{{ route('register') }}" class="btn-brand-primary">Get Started Free</a>
        </div>
    </main>

    <!-- Footer -->
    @include('partials.public_footer')

</body>
</html>
