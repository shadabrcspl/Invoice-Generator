<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FIRC & e-BRC Guide for Indian Exporters | Reconciliation & DGFT Portal | Cod Xpert</title>
    <meta name="description" content="Comprehensive guide to Foreign Inward Remittance Certificates (FIRC) and electronic Bank Realisation Certificates (e-BRC) for software, service, and goods exporters in India.">
    <meta name="keywords" content="FIRC guide, e-BRC generation process, Foreign Inward Remittance Certificate, DGFT eBRC self certification, export remittance reconciliation, EDPMS IRMS">
    <link rel="canonical" href="{{ url('/firc-e-brc-guide') }}">

    <!-- Open Graph -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url('/firc-e-brc-guide') }}">
    <meta property="og:title" content="FIRC & e-BRC Guide for Indian Exporters | Reconciliation & DGFT Portal | Cod Xpert">
    <meta property="og:description" content="Step-by-step masterclass on reconciling foreign wire remittances, inward advices, IRIS/EDPMS matching, and self-generating e-BRCs on DGFT.">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon-192x192.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Schema.org Article -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Article",
        "headline": "FIRC and e-BRC Reconciliation Guide for Indian Software & Service Exporters",
        "description": "In-depth guide on handling foreign bank remittances, Foreign Inward Remittance Advice (FIRA), EDPMS/IRM reporting, and DGFT e-BRC generation.",
        "author": {
            "@type": "Organization",
            "name": "CodXpert Cross-Border Banking Specialists",
            "url": "https://codxpert.com/"
        },
        "publisher": {
            "@type": "Organization",
            "name": "CodXpert",
            "url": "https://codxpert.com/"
        },
        "datePublished": "2026-02-10",
        "dateModified": "2026-09-23"
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
        .guide-article {
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            padding: 40px;
        }
        .callout-box {
            background: #eff6ff;
            border-left: 4px solid #0284c7;
            padding: 20px;
            border-radius: 8px;
            margin: 24px 0;
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
            <span class="badge bg-primary-subtle text-primary px-3 py-1.5 rounded-pill fw-bold fs-7 mb-3">Statutory Banking & Compliance</span>
            <h1 class="display-4 fw-extrabold text-dark mb-3">FIRC & e-BRC Guide for Exporters in India</h1>
            <p class="lead text-muted mx-auto mb-0" style="max-width: 720px;">
                Everything you need to know about inward remittance documentation, IRM numbers, EDPMS closure, and self-certifying e-BRCs on the DGFT portal.
            </p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <article class="guide-article">
                    <div class="d-flex align-items-center gap-3 text-muted fs-8 pb-3 mb-4 border-bottom">
                        <span>Updated: <strong>September 2026</strong></span>
                        <span>•</span>
                        <span>Reading time: <strong>7 min read</strong></span>
                        <span>•</span>
                        <span>Verified for: <strong>DGFT & RBI FEMA Norms</strong></span>
                    </div>

                    <h2 class="fw-bold text-dark mb-3">1. Understanding FIRC vs FIRA vs NOC</h2>
                    <p class="text-secondary leading-relaxed">
                        When an Indian business receives funds from an overseas client (via SWIFT, Wise, Payoneer, Stripe, or PayPal), banking authorities require statutory proof that the funds represent genuine export earnings:
                    </p>
                    <ul class="text-secondary leading-relaxed mb-4">
                        <li><strong>FIRC (Foreign Inward Remittance Certificate):</strong> Historically issued by Authorized Dealer (AD Category-I) banks as physical proof. Since 2016, physical FIRCs are restricted strictly to FDI (Foreign Direct Investment) and capital accounts.</li>
                        <li><strong>FIRA (Foreign Inward Remittance Advice):</strong> The modern document issued by banks for export of goods and services. It confirms the remitter's details, currency, purpose code (e.g., P0802 for software consultancy), and realized INR value.</li>
                        <li><strong>NOC (No Objection Certificate):</strong> Issued by intermediaries (e.g. Citibank or Deutsche Bank) when they route foreign exchange to your local beneficiary bank.</li>
                    </ul>

                    <div class="callout-box">
                        <h5 class="fw-bold text-primary mb-2">⚡ Crucial Compliance Requirement</h5>
                        <p class="mb-0 text-dark fs-7">Under RBI guidelines, failing to reconcile an export invoice with an Inward Remittance Message (IRM) within 9 months can cause your firm to be flagged on the RBI Export Data Processing and Monitoring System (EDPMS).</p>
                    </div>

                    <h2 class="fw-bold text-dark mt-5 mb-3">2. What is an e-BRC (Electronic Bank Realisation Certificate)?</h2>
                    <p class="text-secondary leading-relaxed">
                        An <strong>e-BRC</strong> is digital proof issued through the Directorate General of Foreign Trade (DGFT) system confirming that an exporter has received payment from abroad against an exported consignment or service invoice.
                    </p>
                    <p class="text-secondary leading-relaxed">
                        Under the modernized DGFT e-BRC framework, AD Banks upload Inward Remittance Messages (IRMs) directly to the DGFT server. Exporters can then log into the DGFT portal and self-certify the electronic BRC by mapping the bank's IRM to their specific invoice number and Shipping Bill / GST invoice.
                    </p>

                    <h2 class="fw-bold text-dark mt-5 mb-3">3. Step-by-Step e-BRC Generation Process</h2>
                    <div class="p-3 bg-light rounded-3 border mb-4">
                        <ol class="mb-0 text-secondary fs-7 d-flex flex-column gap-2">
                            <li><strong>Receive Inward Remittance:</strong> Overseas wire arrives in your bank account with the appropriate Purpose Code (e.g., <code>P0802</code> - Software development, <code>P0803</code> - Data processing).</li>
                            <li><strong>Bank Generates IRM:</strong> Your AD Bank logs the remittance and generates an Inward Remittance Message (IRM) reference number uploaded to EDPMS / DGFT.</li>
                            <li><strong>Log in to DGFT Portal:</strong> Access <code>dgft.gov.in</code> with your IEC (Import Export Code) linked login.</li>
                            <li><strong>Navigate to e-BRC Self-Certification:</strong> Select <code>Services > e-BRC > Self-Certify e-BRC</code>.</li>
                            <li><strong>Match IRM to CodXpert Invoice:</strong> Match the bank's IRM record with your corresponding CodXpert invoice number, billed amount, and date.</li>
                            <li><strong>Submit & Download e-BRC:</strong> Digitally sign via Aadhaar e-Sign or DSC. The DGFT system generates the official downloadable e-BRC certificate instantly.</li>
                        </ol>
                    </div>

                    <h2 class="fw-bold text-dark mt-5 mb-3">4. Best Practices for Software & Agency Exporters</h2>
                    <ul class="text-secondary leading-relaxed mb-4">
                        <li><strong>Always include your Purpose Code</strong> in remittance instructions given to international clients.</li>
                        <li><strong>Specify the exact invoice number</strong> in the SWIFT MT103 field 70 (Remittance Information).</li>
                        <li><strong>Store Inward Advice PDFs alongside invoices</strong> inside your Cod Xpert workspace for audit-ready CA verification.</li>
                    </ul>

                    <!-- In-article CTA -->
                    <div class="p-4 bg-light rounded-4 border text-center my-5">
                        <h4 class="fw-bold text-dark mb-2">Issue Remittance-Ready Export Invoices</h4>
                        <p class="text-muted fs-7 mb-3">Cod Xpert structures your export invoices with SWIFT details, purpose codes, and LUT numbers for painless bank clearance.</p>
                        <a href="{{ route('register') }}" class="btn btn-primary px-4 py-2 rounded-pill fw-bold">Sign Up Free</a>
                    </div>
                </article>
            </div>
        </div>
    </main>

    <!-- Footer -->
    @include('partials.public_footer')

</body>
</html>
