<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FEMA 23(R) Service Export Declaration & HDFC EDF Guide (2026) | Cod Xpert</title>
    <meta name="description" content="Master guide to FEMA 23(R) Service Export Declaration and HDFC Bank EDF compliance for Indian IT exporters, freelancers, and software agencies. Learn how to clear inward remittances, reconcile SAC codes, and generate e-BRCs.">
    <meta name="keywords" content="FEMA 23R, Service Export Declaration, HDFC EDF declaration, inward remittance clearance, IT export compliance India, SAC code 998314, FIRC eBRC, Softex vs FEMA declaration, RBI EDPMS IRM">
    <link rel="canonical" href="{{ url('/guides/fema-23r') }}">

    <!-- Open Graph -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url('/guides/fema-23r') }}">
    <meta property="og:title" content="FEMA 23(R) Service Export Declaration & HDFC EDF Guide (2026) | Cod Xpert">
    <meta property="og:description" content="Step-by-step compliance playbook on clearing foreign currency wires, filling the HDFC Service Export Declaration & Request Letter, SAC codes, and avoiding RBI remittance holds.">
    <meta property="og:image" content="{{ asset('favicon-192x192.png') }}">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon-192x192.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Schema.org Article & FAQPage JSON-LD -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@graph": [
            {
                "@type": "Article",
                "headline": "FEMA 23(R) Service Export Declaration & HDFC EDF Guide for Indian Exporters",
                "description": "Comprehensive compliance playbook on Foreign Exchange Management (Export of Goods and Services) Regulations FEMA 23(R), HDFC Bank Service Export Declarations, and FIRC/e-BRC reconciliation.",
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
                "datePublished": "2026-10-14",
                "dateModified": "2026-10-14",
                "mainEntityOfPage": {
                    "@type": "WebPage",
                    "@id": "{{ url('/guides/fema-23r') }}"
                }
            },
            {
                "@type": "FAQPage",
                "mainEntity": [
                    {
                        "@type": "Question",
                        "name": "What is FEMA 23(R) and why do banks require a Service Export Declaration?",
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": "Under the Foreign Exchange Management (Export of Goods and Services) Regulations (FEMA 23(R)), cross-border service exports do not have physical shipping bills. Authorized Dealer (AD Category-I) banks such as HDFC Bank are required under Regulation 3 and Regulation 6 to collect a formal Service Export Declaration (EDF equivalent) and Request Letter before disposing of inward remittances to verify genuine export realization."
                        }
                    },
                    {
                        "@type": "Question",
                        "name": "Do IT service exporters and freelancers need Softex or FEMA 23(R) declaration?",
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": "Pure software product exporters registered with STPI must file Softex forms. However, IT consultants, custom software developers, freelancers, and digital agencies not registered with STPI file the FEMA 23(R) Service Export Declaration directly with their Authorized Dealer bank to regularize inward forex payments."
                        }
                    },
                    {
                        "@type": "Question",
                        "name": "What is the statutory realization timeframe under Regulation 9 of FEMA 23(R)?",
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": "Under Regulation 9 of FEMA 23(R), the full export value of goods or services must be realized and repatriated to India within nine (9) months from the date of the invoice, unless a specific extension is granted by the Authorized Dealer bank."
                        }
                    },
                    {
                        "@type": "Question",
                        "name": "Can multiple export invoices be combined into a single FEMA declaration?",
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": "Yes. If an overseas client sends a single wire transfer covering multiple invoices, you must submit a Consolidated FEMA Declaration listing each underlying invoice number, date, and amount so the total matches the net inward remittance."
                        }
                    }
                ]
            }
        ]
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
            padding: 44px;
        }
        .callout-box {
            background: #eff6ff;
            border-left: 4px solid #0284c7;
            padding: 22px;
            border-radius: 8px;
            margin: 26px 0;
        }
        .callout-warning {
            background: #fffbeb;
            border-left: 4px solid #f59e0b;
            padding: 22px;
            border-radius: 8px;
            margin: 26px 0;
        }
        .table-custom {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
            font-size: 13.5px;
        }
        .table-custom th {
            background-color: #f1f5f9;
            color: #1e293b;
            font-weight: 700;
        }
        .step-badge {
            width: 32px;
            height: 32px;
            background: #0284c7;
            color: #fff;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
            flex-shrink: 0;
        }
    </style>
</head>
<body>

    <!-- Navigation -->
    @include('partials.public_navbar')

    <!-- Header -->
    <header class="py-5 text-center bg-white border-bottom">
        <div class="container py-4">
            <span class="badge bg-primary-subtle text-primary px-3 py-1.5 rounded-pill fw-bold fs-7 mb-3">Statutory Banking & RBI Compliance</span>
            <h1 class="display-4 fw-extrabold text-dark mb-3">FEMA 23(R) Service Export Declaration & HDFC EDF Guide</h1>
            <p class="lead text-muted mx-auto mb-0" style="max-width: 760px;">
                The complete inward remittance playbook for Indian IT exporters, freelancers, and software agencies. Learn how to satisfy bank requirements, reconcile SAC codes, and prevent payment holds under RBI regulations.
            </p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <article class="guide-article">
                    <div class="d-flex align-items-center gap-3 text-muted fs-8 pb-3 mb-4 border-bottom">
                        <span>Effective: <strong>October 1, 2026</strong></span>
                        <span>•</span>
                        <span>Reading time: <strong>8 min read</strong></span>
                        <span>•</span>
                        <span>RBI Notification: <strong>FEMA 23(R) Guidelines</strong></span>
                    </div>

                    <!-- Key Takeaways Box -->
                    <div class="callout-box">
                        <h5 class="fw-bold text-primary mb-2">⚡ Executive Summary for Indian Exporters</h5>
                        <p class="mb-2 text-dark fs-7">Under the Foreign Exchange Management (Export of Goods & Services) Regulations — <strong>FEMA 23(R)</strong> — Authorized Dealer Category-I (AD Cat-I) banks such as HDFC Bank, ICICI Bank, and SBI mandate a formal <strong>Service Export Declaration & Request Letter</strong> before clearing inward foreign remittances.</p>
                        <p class="mb-0 text-dark fs-7">Failing to submit this declaration within the statutory realization window risks remittance holds in Nostro accounts, EDPMS/IRMS discrepancy flags, and caution-listing by the Reserve Bank of India.</p>
                    </div>

                    <h2 class="fw-bold text-dark mt-5 mb-3">1. Why Are Banks Requiring This Declaration?</h2>
                    <p class="text-secondary leading-relaxed">
                        When physical goods leave India, customs officers generate an electronic <strong>Shipping Bill</strong>, which automatically flows into the RBI's <strong>Export Data Processing and Monitoring System (EDPMS)</strong>.
                    </p>
                    <p class="text-secondary leading-relaxed">
                        However, when a software developer, SaaS company, or digital agency delivers services over the internet (APIs, code commits, cloud consulting), no customs shipping bill exists. To fulfill RBI's statutory monitoring under <strong>Regulation 3 and Regulation 6 of FEMA 23(R)</strong>, AD Category-I banks are required to collect an electronic/physical <strong>Export Declaration Form (EDF) equivalent</strong> and <strong>Customer Request Letter</strong> from the beneficiary before disposing of foreign currency funds. As explored in our deep-dive on <a href="https://codxpert.com/industries/fintech/" target="_blank" rel="noopener" class="text-primary fw-semibold text-decoration-none">FinTech &amp; Financial Services Solutions</a>, cross-border banking integrations demand rigorous data synchronization to reconcile client payments without manual administrative friction.
                    </p>

                    <h2 class="fw-bold text-dark mt-5 mb-3">2. FEMA 23(R) Declaration vs Softex Form: Which One Do You Need?</h2>
                    <p class="text-secondary leading-relaxed">
                        A frequent question among Indian technology founders is whether they must register with the Software Technology Parks of India (STPI) to file a Softex form, or if a bank FEMA declaration is sufficient.
                    </p>

                    <div class="table-responsive my-4">
                        <table class="table table-custom table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Criteria</th>
                                    <th>STPI Softex Form</th>
                                    <th>FEMA 23(R) Bank Declaration</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="fw-semibold">Governing Body</td>
                                    <td>STPI / SEZ Development Commissioner</td>
                                    <td>Authorized Dealer Bank / RBI</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Applicability</td>
                                    <td>Packaged software IP export, STPI units</td>
                                    <td>Custom software, IT consulting, SaaS, design, marketing</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Exporter Registration</td>
                                    <td>Mandatory Non-STPI or STPI registration</td>
                                    <td>All registered businesses, LLPs, and individual proprietorships</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Submission Window</td>
                                    <td>Within 30 days of invoice date</td>
                                    <td>At or before inward remittance disposal</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Target Exporter</td>
                                    <td>Pure software product exporters with STPI membership</td>
                                    <td>Freelancers, service agencies, digital consultants</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="callout-warning">
                        <h6 class="fw-bold text-warning-emphasis mb-1">💡 Practical Rule of Thumb</h6>
                        <p class="mb-0 text-dark fs-7">If you deliver <strong>custom software engineering, UI/UX design, DevOps, or remote consulting</strong> without an STPI registration, your bank's <strong>FEMA 23(R) Service Export Declaration</strong> is the legally required instrument to clear your inward forex.</p>
                    </div>

                    <h2 class="fw-bold text-dark mt-5 mb-3">3. Breakdown of the HDFC FEMA 23(R) Package</h2>
                    <p class="text-secondary leading-relaxed">
                        The standard HDFC Bank declaration workbook comprises two primary worksheets that must cross-reconcile with 100% precision:
                    </p>

                    <div class="d-flex flex-column gap-3 mb-4">
                        <div class="p-3 bg-light rounded-3 border d-flex gap-3 align-items-start">
                            <span class="step-badge">1</span>
                            <div>
                                <h6 class="fw-bold text-dark mb-1">Worksheet 1: REQUEST LETTER (Covering Mandate)</h6>
                                <p class="mb-0 text-secondary fs-7">
                                    Authorizes the bank to convert foreign exchange and credit your current or EEFC account. Includes AD branch details, exporter PAN, GSTIN, IEC, remittance currency, realized value in numbers and words, and the mandatory 9-month realization declaration under <strong>Regulation 9</strong>.
                                </p>
                            </div>
                        </div>

                        <div class="p-3 bg-light rounded-3 border d-flex gap-3 align-items-start">
                            <span class="step-badge">2</span>
                            <div>
                                <h6 class="fw-bold text-dark mb-1">Worksheet 2: Invoice Details (Line-Item Schedule)</h6>
                                <p class="mb-0 text-secondary fs-7">
                                    Lists individual invoices covered by the wire. Requires invoice number, invoice date, client name, full overseas address, client country, service description, GST SAC code, and foreign currency value.
                                </p>
                            </div>
                        </div>
                    </div>

                    <h2 class="fw-bold text-dark mt-5 mb-3">4. Essential SAC Codes for Technology Exporters</h2>
                    <p class="text-secondary leading-relaxed">
                        Using incorrect Service Accounting Codes (SAC) can result in bank rejection or audit issues when claiming 0% export benefits under GST. Always ensure your invoice SAC code matches your FEMA declaration:
                    </p>

                    <div class="table-responsive my-4">
                        <table class="table table-custom table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>SAC Code</th>
                                    <th>Official Description</th>
                                    <th>Common Use Cases</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><code class="text-primary fw-bold">998314</code></td>
                                    <td>IT Design & Development Services</td>
                                    <td>Custom coding, web apps, mobile apps, frontend/backend engineering</td>
                                </tr>
                                <tr>
                                    <td><code class="text-primary fw-bold">998313</code></td>
                                    <td>IT Infrastructure & Network Management</td>
                                    <td>DevOps engineering, AWS/GCP server maintenance, security auditing</td>
                                </tr>
                                <tr>
                                    <td><code class="text-primary fw-bold">998311</code></td>
                                    <td>Management & Technical Consulting</td>
                                    <td>Fractional CTO advisory, architecture planning, agile strategy</td>
                                </tr>
                                <tr>
                                    <td><code class="text-primary fw-bold">998315</code></td>
                                    <td>Hosting and Infrastructure Provisioning</td>
                                    <td>SaaS platform subscriptions, managed database hosting</td>
                                </tr>
                                <tr>
                                    <td><code class="text-primary fw-bold">998361</code></td>
                                    <td>Digital Marketing & Lead Generation</td>
                                    <td>SEO consulting, conversion rate optimization, digital campaigns</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h2 class="fw-bold text-dark mt-5 mb-3">5. The Unbroken Compliance Chain: Invoice to e-BRC</h2>
                    <p class="text-secondary leading-relaxed">
                        Under Section 16 of the IGST Act, exported services are <strong>Zero-Rated Supplies</strong> when executed under a <strong>Letter of Undertaking (LUT)</strong>. To protect your zero-tax status from GST scrutiny, maintain this 5-step compliance chain:
                    </p>

                    <div class="p-4 bg-light rounded-4 border mb-4">
                        <ol class="mb-0 text-secondary fs-7 d-flex flex-column gap-3">
                            <li><strong>Issue Export Invoice:</strong> Quote your valid GST LUT ARN, SAC code, overseas client address, and foreign currency value.</li>
                            <li><strong>Submit FEMA 23(R) Declaration:</strong> Provide the completed HDFC / bank declaration workbook along with the invoice PDF to your Authorized Dealer.</li>
                            <li><strong>Bank Generates IRM (Inward Remittance Message):</strong> Upon disposal, your bank issues an official Inward Remittance Advice (FIRA) containing the IRM reference number. For a step-by-step wire reconciliation roadmap, consult our <a href="https://codxpert.com/firc-explained-freelancers-exporters-guide/" target="_blank" rel="noopener" class="text-primary fw-semibold text-decoration-none">FIRC &amp; Inward Remittance Guide</a>.</li>
                            <li><strong>Self-Certify e-BRC on DGFT Portal:</strong> Log in to <code>dgft.gov.in</code>, navigate to <code>e-BRC Self-Certification</code>, map the IRM to your invoice number, and e-sign the certificate.</li>
                            <li><strong>Report on GSTR-1 (Table 6A):</strong> Report the export invoice as <code>WOPAY</code> (Export without payment of tax) on the GST portal. For comprehensive Table 6A compliance instructions, refer to our <a href="https://codxpert.com/gstr-1-filing-export-invoices-step-by-step/" target="_blank" rel="noopener" class="text-primary fw-semibold text-decoration-none">GSTR-1 Export Invoice Filing Guide</a>.</li>
                        </ol>
                    </div>

                    <h2 class="fw-bold text-dark mt-5 mb-3">6. Common Mistakes That Cause Payment Holds</h2>
                    <ul class="text-secondary leading-relaxed mb-4">
                        <li><strong>Third-Party Remitters:</strong> If your invoice is billed to <em>Acme Inc (USA)</em>, but funds arrive from <em>Acme Holding Ltd (UK)</em> without contractual documentation, the bank will freeze the funds under third-party AML rules.</li>
                        <li><strong>Unaccounted Intermediary Bank Fees:</strong> When a client sends $5,000 and you receive $4,970 due to a $30 intermediary correspondent fee, your declaration must reconcile the gross invoice with net realization.</li>
                        <li><strong>Invoice Date vs Realization Date Exchange Rate Variance:</strong> The foreign exchange rate on the date of billing rarely matches the interbank rate on the date of bank disposal. Failing to track realized forex gains or losses can create accounting discrepancies; follow our <a href="https://codxpert.com/exchange-rate-gst-invoice-date-vs-payment-date/" target="_blank" rel="noopener" class="text-primary fw-semibold text-decoration-none">Invoice Date vs Payment Date Exchange Rate Guide</a> for seamless tax audit reconciliation.</li>
                        <li><strong>Missing Client Country / Address:</strong> FEMA mandates identifying the destination country of the service consumption to confirm cross-border supply.</li>
                        <li><strong>Exceeding the 9-Month Realization Period:</strong> Invoices outstanding past 9 months require formal bank extension or RBI write-off approval.</li>
                    </ul>

                    <h2 class="fw-bold text-dark mt-5 mb-3">7. How CodXpert Invoices Automates FEMA Compliance</h2>
                    <p class="text-secondary leading-relaxed">
                        Instead of manually editing complex Excel spreadsheets, calculating currency words, and looking up SAC codes, the <a href="https://codxpert.com/invoice-generator/" target="_blank" rel="noopener" class="text-primary fw-semibold text-decoration-none">CodXpert GST Invoice Generator</a> automates the entire statutory workflow with native 1-click FEMA export capabilities:
                    </p>
                    <ul class="text-secondary leading-relaxed mb-4">
                        <li><strong>1-Click FEMA 23(R) Export:</strong> Download official, bank-ready HDFC Excel workbooks with both the Request Letter and Invoice Details sheets pre-filled directly from the <a href="https://codxpert.com/invoice-generator/" target="_blank" rel="noopener" class="text-primary fw-semibold text-decoration-none">CodXpert GST Invoice Generator</a>.</li>
                        <li><strong>Multi-Invoice Consolidation:</strong> Select multiple foreign currency invoices in your dashboard to generate an aggregated monthly EDF declaration.</li>
                        <li><strong>Native Excel Validations Preserved:</strong> Keeps all cell dropdowns and formulas intact so your bank's automated ingestion system accepts the file without errors.</li>
                        <li><strong>Automated Numbers-to-Words Engine:</strong> Converts foreign currency amounts (e.g., <em>USD Twelve Thousand Four Hundred Fifty and Cents Zero Only</em>) without manual typing.</li>
                    </ul>

                    <!-- Strategic Resources Box -->
                    <div class="p-4 bg-light rounded-4 border my-4">
                        <h5 class="fw-bold text-dark mb-3">📚 Strategic Exporter Resources Across the CodXpert Ecosystem</h5>
                        <ul class="text-secondary leading-relaxed mb-0 fs-7">
                            <li class="mb-2"><a href="https://codxpert.com/invoice-generator/" target="_blank" rel="noopener" class="text-primary fw-semibold text-decoration-none">CodXpert GST Invoice Generator ↗</a> — Primary commercial anchor for 1-click FEMA 23(R) export.</li>
                            <li class="mb-2"><a href="https://codxpert.com/industries/fintech/" target="_blank" rel="noopener" class="text-primary fw-semibold text-decoration-none">FinTech &amp; Financial Services Solutions ↗</a> — Contextual trust signals for cross-border banking integrations.</li>
                            <li class="mb-2"><a href="https://codxpert.com/firc-explained-freelancers-exporters-guide/" target="_blank" rel="noopener" class="text-primary fw-semibold text-decoration-none">FIRC &amp; Inward Remittance Guide ↗</a> — Supporting resource for bank wire &amp; IRM reconciliation.</li>
                            <li class="mb-2"><a href="https://codxpert.com/gstr-1-filing-export-invoices-step-by-step/" target="_blank" rel="noopener" class="text-primary fw-semibold text-decoration-none">GSTR-1 Export Invoice Filing Guide ↗</a> — Practical steps for Table 6A WOPAY export reporting.</li>
                            <li><a href="https://codxpert.com/exchange-rate-gst-invoice-date-vs-payment-date/" target="_blank" rel="noopener" class="text-primary fw-semibold text-decoration-none">Invoice Date vs Payment Date Exchange Rate Guide ↗</a> — Complete forex gain/loss accounting guide.</li>
                        </ul>
                    </div>

                    <!-- In-article CTA -->
                    <div class="p-4 bg-primary text-white rounded-4 text-center my-5 shadow-sm">
                        <h4 class="fw-bold text-white mb-2">Automate Your FEMA & Export Invoicing</h4>
                        <p class="text-white-50 fs-7 mb-3">Generate bank-ready FEMA 23(R) declarations, GST LUT-compliant invoices, and automated multi-currency billing with CodXpert.</p>
                        <a href="{{ route('register') }}" class="btn btn-light text-primary px-4 py-2 rounded-pill fw-bold shadow-sm">Create Free Account</a>
                    </div>

                    <!-- FAQ Section -->
                    <h2 class="fw-bold text-dark mt-5 mb-3">Frequently Asked Questions</h2>
                    <div class="accordion accordion-flush" id="faqAccordion">
                        <div class="accordion-item border rounded-3 mb-2">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Is Import Export Code (IEC) required for service exporters?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-secondary fs-7">
                                    While DGFT exempts service providers from mandatory IEC if they do not claim foreign trade benefits, Authorized Dealer banks (such as HDFC) strongly require an IEC to log Inward Remittance Messages (IRMs) in their automated trade systems. Registering for an IEC takes under 15 minutes online at <code>dgft.gov.in</code>.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border rounded-3 mb-2">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    What RBI Purpose Code should I specify for IT services?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-secondary fs-7">
                                    The standard RBI purpose codes are <strong>P0802</strong> for software implementation and custom coding, <strong>P0801</strong> for IT hardware and systems consultancy, and <strong>P0803</strong> for data processing and cloud hosting services.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border rounded-3 mb-2">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Can I combine multiple invoices in one FEMA declaration?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-secondary fs-7">
                                    Yes. If an international client pays multiple milestones or invoices in a single bank wire, you can use CodXpert's Consolidated FEMA Export feature to list all relevant invoices on rows 3 to 12 of the Invoice Details sheet.
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </main>

    <!-- Footer -->
    @include('partials.public_footer')

</body>
</html>
