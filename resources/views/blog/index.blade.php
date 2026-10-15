<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cod Xpert Blog | Exporter Invoicing, GST & FEMA Insights</title>
    <meta name="description" content="Expert insights and compliance tutorials for Indian IT exporters and freelancers. Master GST LUT, FEMA 23(R), RBI purpose codes, and forex invoicing.">
    <link rel="canonical" href="{{ url('/blog') }}">

    <!-- Open Graph / Social Media -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/blog') }}">
    <meta property="og:title" content="Cod Xpert Blog | Exporter Invoicing, GST & FEMA Insights">
    <meta property="og:description" content="Expert insights and compliance tutorials for Indian IT exporters and freelancers. Master GST LUT, FEMA 23(R), RBI purpose codes, and forex invoicing.">
    <meta property="og:image" content="https://invoice.codxpert.com/images/forex_dashboard.png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Cod Xpert Invoices">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url('/blog') }}">
    <meta name="twitter:title" content="Cod Xpert Blog | Exporter Invoicing, GST & FEMA Insights">
    <meta name="twitter:description" content="Expert insights and compliance tutorials for Indian IT exporters and freelancers. Master GST LUT, FEMA 23(R), RBI purpose codes, and forex invoicing.">
    <meta name="twitter:image" content="https://invoice.codxpert.com/images/forex_dashboard.png">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon-192x192.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Schema.org Blog Markup -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Blog",
        "name": "Cod Xpert Export Compliance & Invoicing Blog",
        "url": "https://invoice.codxpert.com/blog",
        "description": "Regulatory guides, practical tutorials, and financial insights for cross-border software exporters, freelancers, and digital agencies.",
        "publisher": {
            "@type": "Organization",
            "name": "COD XPERT",
            "url": "https://codxpert.com/",
            "logo": {
                "@type": "ImageObject",
                "url": "https://invoice.codxpert.com/images/codxpert-logo.png"
            }
        },
        "blogPost": [
            {
                "@type": "BlogPosting",
                "headline": "How to File GST LUT (RFD-11) Online: Step-by-Step Guide",
                "url": "https://invoice.codxpert.com/blog/how-to-file-gst-lut-rfd-11-2026",
                "datePublished": "2026-04-01",
                "dateModified": "2026-10-15",
                "description": "Step-by-step tutorial on filing Form GST RFD-11 online on the GST portal for FY 2026-27. Export services with 0% IGST, witness rules, and avoid errors."
            },
            {
                "@type": "BlogPosting",
                "headline": "RBI Purpose Codes for Software & IT Exporters (2026)",
                "url": "https://invoice.codxpert.com/blog/top-rbi-purpose-codes-software-exporters",
                "datePublished": "2026-05-10",
                "dateModified": "2026-10-15",
                "description": "Complete guide to RBI purpose codes for software exporters and freelancers in India. Learn the difference between P0801, P0802, P0803, P0807, and e-BRC."
            },
            {
                "@type": "BlogPosting",
                "headline": "SAC Code 998311 vs 998312: IT Exporter GST Guide",
                "url": "https://invoice.codxpert.com/blog/sac-code-998311-vs-998312",
                "datePublished": "2026-06-18",
                "dateModified": "2026-10-15",
                "description": "Clear guide comparing SAC Code 998311 vs 998312 for IT consultants and software developers under GST. Invoicing rules, tax rates, and export classification."
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
            --brand-secondary: #0f172a;
            --brand-accent: #38bdf8;
            --surface-bg: #f8fafc;
            --card-border: #e2e8f0;
            --font-heading: 'Outfit', sans-serif;
            --font-body: 'Plus Jakarta Sans', sans-serif;
        }
        body {
            font-family: var(--font-body);
            color: #334155;
            background-color: var(--surface-bg);
            line-height: 1.65;
            padding-top: 76px;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: var(--font-heading);
            color: var(--brand-secondary);
            font-weight: 700;
        }
        .hero-blog {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 60%, #0369a1 100%);
            color: #ffffff;
            padding: 70px 0 60px;
            position: relative;
            overflow: hidden;
        }
        .hero-blog::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.15) 0%, rgba(2, 132, 199, 0) 70%);
            border-radius: 50%;
            pointer-events: none;
        }
        .category-pill {
            display: inline-block;
            padding: 8px 18px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            color: #475569;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
        }
        .category-pill:hover,
        .category-pill.active {
            background: #0284c7;
            color: #ffffff;
            border-color: #0284c7;
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.25);
        }
        .article-card {
            background: #ffffff;
            border: 1px solid var(--card-border);
            border-radius: 16px;
            transition: all 0.25s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(15, 23, 42, 0.03);
        }
        .article-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 32px -8px rgba(15, 23, 42, 0.1);
            border-color: #bae6fd;
        }
        .badge-tag {
            font-size: 11.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 4px 10px;
            border-radius: 6px;
        }
        .badge-gst { background: #e0f2fe; color: #0369a1; }
        .badge-fema { background: #fef3c7; color: #92400e; }
        .badge-sac { background: #ede9fe; color: #6b21a8; }
        .badge-guide { background: #dcfce7; color: #166534; }
        .statutory-card {
            background: #ffffff;
            border: 1px solid var(--card-border);
            border-radius: 16px;
            padding: 32px;
            margin-bottom: 30px;
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04);
        }
        .checklist-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 14px;
        }
        .checklist-icon {
            color: #0284c7;
            background: #e0f2fe;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            flex-shrink: 0;
            margin-top: 2px;
        }
    </style>
</head>
<body>

    @include('partials.public_navbar')

    <!-- Hero Section -->
    <header class="hero-blog">
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <span class="badge bg-info text-dark fw-bold px-3 py-2 rounded-pill mb-3">Statutory Regulatory Hub</span>
                    <h1 class="display-5 fw-bold text-white mb-3">COD XPERT Exporter Blog & Regulatory Knowledge Base</h1>
                    <p class="lead text-slate-300 mb-4 fs-6" style="max-width: 720px;">
                        Practical, statutory compliance tutorials, GST Letter of Undertaking masterclasses, RBI purpose code classifications, and cross-border billing playbooks engineered for Indian software developers, digital agencies, and independent consultants.
                    </p>
                    
                    <!-- Search Input Filter -->
                    <div class="p-2 bg-white rounded-4 shadow-lg d-flex align-items-center gap-2" style="max-width: 580px;">
                        <span class="ps-3 text-muted">🔍</span>
                        <input type="text" id="blogSearchInput" class="form-control border-0 shadow-none ps-2" placeholder="Search by topic, SAC code, FEMA rule, or keyword..." onkeyup="filterArticles()">
                        <button class="btn btn-primary px-4 rounded-3 fw-semibold" style="background:#0284c7; border:none;" onclick="filterArticles()">Search</button>
                    </div>
                </div>
                <div class="col-lg-4 d-none d-lg-block text-end">
                    <div class="p-4 rounded-4 bg-white bg-opacity-10 border border-white border-opacity-10 backdrop-blur text-start">
                        <div class="d-flex align-items-center gap-2 mb-2 text-info">
                            <span class="fs-4">🛡️</span>
                            <span class="fw-bold fs-7 uppercase tracking-wider">Statutory Verified</span>
                        </div>
                        <p class="small text-white-50 mb-3">
                            All guides are authored according to current CGST Rules 2017, RBI Master Directions on Export of Goods and Services, and FEMA Notification No. FEMA 23(R)/2015-RB.
                        </p>
                        <div class="d-flex align-items-center gap-3 text-white small">
                            <div><span class="fw-bold text-white">100%</span> Free Access</div>
                            <div>·</div>
                            <div><span class="fw-bold text-white">FY 2026-27</span> Updated</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Category Filters -->
    <section class="py-4 border-bottom bg-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center gap-2">
                <span class="fw-bold fs-7 text-uppercase text-muted me-2">Browse Category:</span>
                <button class="category-pill active" onclick="setCategory('all', this)">All Topics</button>
                <button class="category-pill" onclick="setCategory('gst-lut', this)">GST & LUT (Rule 96A)</button>
                <button class="category-pill" onclick="setCategory('rbi-fema', this)">RBI & FEMA Regulations</button>
                <button class="category-pill" onclick="setCategory('sac-tax', this)">SAC Codes & Taxation</button>
                <button class="category-pill" onclick="setCategory('guides', this)">Exporter Guides</button>
            </div>
        </div>
    </section>

    <!-- Main Content & Cards -->
    <main class="py-5">
        <div class="container">

            <!-- Featured Highlight Card -->
            <div class="statutory-card border-primary border-opacity-25 bg-gradient mb-5 p-4 p-lg-5" style="background: linear-gradient(135deg, #f0f9ff 0%, #ffffff 100%);">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="badge badge-tag badge-gst">Featured Regulatory Guide</span>
                            <span class="text-muted small">Updated for FY 2026-27</span>
                        </div>
                        <h2 class="h3 fw-bold mb-3">
                            <a href="{{ route('blog.gst-lut-rfd-11') }}" class="text-decoration-none text-dark hover-primary">
                                How to File GST LUT (RFD-11) Online for FY 2026-27: Step-by-Step Guide
                            </a>
                        </h2>
                        <p class="text-slate-600 mb-4">
                            Step-by-step walkthrough on filing Form GST RFD-11 on the official GST portal. Learn how to legally export software, consulting, and SaaS services without paying 18% Integrated GST upfront, avoid capital blockage, and comply with witness and DSC/EVC signing rules.
                        </p>
                        <div class="d-flex flex-wrap align-items-center gap-3">
                            <a href="{{ route('blog.gst-lut-rfd-11') }}" class="btn btn-primary rounded-pill px-4 fw-semibold" style="background:#0284c7; border:none;">
                                Read Complete Tutorial →
                            </a>
                            <span class="text-muted small">⏱️ 8 Min Read · Rule 96A CGST Compliance</span>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center">
                        <div class="p-4 bg-white rounded-3 shadow-sm border border-slate-100 text-start">
                            <h6 class="fw-bold text-dark mb-2">Key Takeaways Covered:</h6>
                            <ul class="list-unstyled small text-slate-600 mb-0 d-flex flex-column gap-2">
                                <li>✅ Zero working capital lockup on exports</li>
                                <li>✅ Two independent witness requirements</li>
                                <li>✅ Realization within 9 months under FEMA</li>
                                <li>✅ Invoicing endorsement text requirements</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Articles Grid -->
            <div class="row g-4 mb-5" id="articlesGrid">
                
                <!-- Article 1: GST LUT RFD-11 -->
                <div class="col-md-6 col-lg-4 article-item" data-category="gst-lut" data-title="How to File GST LUT RFD-11 Online Step-by-Step Guide FY 2026-27 Rule 96A zero rated export">
                    <div class="article-card">
                        <div class="p-4 flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge badge-tag badge-gst">GST & LUT</span>
                                <span class="text-muted small">April 2026</span>
                            </div>
                            <h3 class="h5 fw-bold mb-3">
                                <a href="{{ route('blog.gst-lut-rfd-11') }}" class="text-decoration-none text-dark hover-primary">
                                    How to File GST LUT (RFD-11) Online: Step-by-Step Guide
                                </a>
                            </h3>
                            <p class="text-slate-600 small mb-0">
                                Detailed walkthrough on filing Form GST RFD-11 to export software and services without paying 18% IGST. Includes eligibility criteria, witness verification rules, and common portal mistakes.
                            </p>
                        </div>
                        <div class="px-4 py-3 bg-slate-50 border-top d-flex justify-content-between align-items-center">
                            <a href="{{ route('blog.gst-lut-rfd-11') }}" class="text-primary fw-semibold small text-decoration-none">Read Guide →</a>
                            <span class="text-muted small">8 min read</span>
                        </div>
                    </div>
                </div>

                <!-- Article 2: RBI Purpose Codes -->
                <div class="col-md-6 col-lg-4 article-item" data-category="rbi-fema" data-title="RBI Purpose Codes for Software & IT Exporters P0801 P0802 P0803 P0807 e-BRC FIRC EDPMS">
                    <div class="article-card">
                        <div class="p-4 flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge badge-tag badge-fema">RBI & FEMA</span>
                                <span class="text-muted small">May 2026</span>
                            </div>
                            <h3 class="h5 fw-bold mb-3">
                                <a href="{{ route('blog.rbi-purpose-codes') }}" class="text-decoration-none text-dark hover-primary">
                                    RBI Purpose Codes for Software & IT Exporters (2026)
                                </a>
                            </h3>
                            <p class="text-slate-600 small mb-0">
                                Comprehensive breakdown of RBI purpose codes P0801, P0802, P0803, and P0807. Discover how to instruct foreign clients and banks to ensure seamless EDPMS reconciliation and e-BRC generation.
                            </p>
                        </div>
                        <div class="px-4 py-3 bg-slate-50 border-top d-flex justify-content-between align-items-center">
                            <a href="{{ route('blog.rbi-purpose-codes') }}" class="text-primary fw-semibold small text-decoration-none">Read Guide →</a>
                            <span class="text-muted small">9 min read</span>
                        </div>
                    </div>
                </div>

                <!-- Article 3: SAC Code 998311 vs 998312 -->
                <div class="col-md-6 col-lg-4 article-item" data-category="sac-tax" data-title="SAC Code 998311 vs 998312 IT Exporter GST Classification IT Consulting Custom Software Development">
                    <div class="article-card">
                        <div class="p-4 flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge badge-tag badge-sac">SAC & Taxation</span>
                                <span class="text-muted small">June 2026</span>
                            </div>
                            <h3 class="h5 fw-bold mb-3">
                                <a href="{{ route('blog.sac-code-comparison') }}" class="text-decoration-none text-dark hover-primary">
                                    SAC Code 998311 vs 998312: IT Exporter GST Guide
                                </a>
                            </h3>
                            <p class="text-slate-600 small mb-0">
                                Demystifying SAC 998311 (IT consulting) vs SAC 998312 (software development). Learn how to classify contracts, structure invoice line items, and defend your classification during GST audits.
                            </p>
                        </div>
                        <div class="px-4 py-3 bg-slate-50 border-top d-flex justify-content-between align-items-center">
                            <a href="{{ route('blog.sac-code-comparison') }}" class="text-primary fw-semibold small text-decoration-none">Read Guide →</a>
                            <span class="text-muted small">7 min read</span>
                        </div>
                    </div>
                </div>

                <!-- Article 4: FEMA 23(R) Master Guide -->
                <div class="col-md-6 col-lg-4 article-item" data-category="rbi-fema guides" data-title="FEMA 23R Service Export Declaration Guide HDFC EDF Inward Remittance SOFTEX exemption">
                    <div class="article-card">
                        <div class="p-4 flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge badge-tag badge-guide">Statutory Pillar</span>
                                <span class="text-muted small">Comprehensive</span>
                            </div>
                            <h3 class="h5 fw-bold mb-3">
                                <a href="{{ route('guides.fema-23r') }}" class="text-decoration-none text-dark hover-primary">
                                    FEMA 23(R) Service Export Declaration & HDFC EDF Guide
                                </a>
                            </h3>
                            <p class="text-slate-600 small mb-0">
                                Complete compliance manual for filing service export declarations under FEMA 23(R). Understand statutory SoftEX exemptions, invoice self-declarations, and clearing held inward remittances.
                            </p>
                        </div>
                        <div class="px-4 py-3 bg-slate-50 border-top d-flex justify-content-between align-items-center">
                            <a href="{{ route('guides.fema-23r') }}" class="text-primary fw-semibold small text-decoration-none">Read Pillar Guide →</a>
                            <span class="text-muted small">12 min read</span>
                        </div>
                    </div>
                </div>

                <!-- Article 5: GST LUT Rule 96A Masterclass -->
                <div class="col-md-6 col-lg-4 article-item" data-category="gst-lut guides" data-title="GST LUT Rule 96A Exporter Guide 0% IGST Letter of Undertaking refund capital blockage">
                    <div class="article-card">
                        <div class="p-4 flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge badge-tag badge-gst">Statutory Pillar</span>
                                <span class="text-muted small">Comprehensive</span>
                            </div>
                            <h3 class="h5 fw-bold mb-3">
                                <a href="{{ route('guides.gst-lut') }}" class="text-decoration-none text-dark hover-primary">
                                    GST LUT Rule 96A Exporter Guide (0% IGST)
                                </a>
                            </h3>
                            <p class="text-slate-600 small mb-0">
                                Legal framework of Section 16 IGST Act and Rule 96A CGST Rules. Complete analysis of zero-rated supplies, export invoice declarations, GSTR-1 Table 6A reporting, and input tax credit (ITC) claims.
                            </p>
                        </div>
                        <div class="px-4 py-3 bg-slate-50 border-top d-flex justify-content-between align-items-center">
                            <a href="{{ route('guides.gst-lut') }}" class="text-primary fw-semibold small text-decoration-none">Read Pillar Guide →</a>
                            <span class="text-muted small">11 min read</span>
                        </div>
                    </div>
                </div>

                <!-- Article 6: FIRC & e-BRC Reconciliation Guide -->
                <div class="col-md-6 col-lg-4 article-item" data-category="rbi-fema guides" data-title="FIRC e-BRC Reconciliation Guide DGFT Inward Remittance IRMS Bank Realisation Certificate">
                    <div class="article-card">
                        <div class="p-4 flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge badge-tag badge-fema">Statutory Pillar</span>
                                <span class="text-muted small">Comprehensive</span>
                            </div>
                            <h3 class="h5 fw-bold mb-3">
                                <a href="{{ route('guides.firc-e-brc') }}" class="text-decoration-none text-dark hover-primary">
                                    FIRC & e-BRC Inward Remittance Reconciliation Guide
                                </a>
                            </h3>
                            <p class="text-slate-600 small mb-0">
                                How to reconcile foreign inward remittances with electronic Bank Realisation Certificates (e-BRC) on DGFT. Covers foreign exchange rate variance tracking and audit trail maintenance.
                            </p>
                        </div>
                        <div class="px-4 py-3 bg-slate-50 border-top d-flex justify-content-between align-items-center">
                            <a href="{{ route('guides.firc-e-brc') }}" class="text-primary fw-semibold small text-decoration-none">Read Pillar Guide →</a>
                            <span class="text-muted small">10 min read</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Deep Educational Content: Regulatory Framework Governing Indian Service Exports -->
            <section class="statutory-card">
                <div class="row g-4">
                    <div class="col-lg-12">
                        <h2 class="h3 fw-bold mb-3">The Regulatory Architecture Governing Indian Service Exports</h2>
                        <p class="text-slate-600 leading-relaxed mb-4">
                            Cross-border invoicing from India is governed by an interlocking trifecta of statutory bodies: the <strong>Central Board of Indirect Taxes and Customs (CBIC)</strong> under the Goods and Services Tax framework, the <strong>Reserve Bank of India (RBI)</strong> under the Foreign Exchange Management Act (FEMA 1999), and the <strong>Directorate General of Foreign Trade (DGFT)</strong> under the Foreign Trade Policy. Failing to reconcile any single component exposes the exporter to severe statutory liabilities, including retroactive GST demand notices at 18%, 18% per annum mandatory interest under Section 50(1), and compounded penalties under Section 13 of FEMA.
                        </p>
                    </div>

                    <div class="col-md-4">
                        <div class="p-4 bg-slate-50 rounded-3 border h-100">
                            <div class="text-primary fs-3 mb-2">📜</div>
                            <h3 class="h5 fw-bold mb-2">1. The IGST Framework</h3>
                            <p class="small text-slate-600 mb-0">
                                Under Section 2(6) of the IGST Act 2017, five cumulative statutory tests must be fulfilled for an IT service to qualify as a legal export: the supplier is in India, recipient is outside India, place of supply is outside India, payment is received in convertible foreign exchange within permitted timelines, and the supplier and recipient are distinct legal entities.
                            </p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-4 bg-slate-50 rounded-3 border h-100">
                            <div class="text-primary fs-3 mb-2">🏦</div>
                            <h3 class="h5 fw-bold mb-2">2. The FEMA & RBI Mandate</h3>
                            <p class="small text-slate-600 mb-0">
                                Regulation 9 of Foreign Exchange Management (Export of Goods and Services) Regulations 2015 requires exporters to fully realize and repatriate foreign exchange proceeds into India within <strong>9 months</strong> from the invoice date. Bank remittances must be reported under specific RBI Purpose Codes through Authorised Dealer (AD Category-I) banks.
                            </p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-4 bg-slate-50 rounded-3 border h-100">
                            <div class="text-primary fs-3 mb-2">🌐</div>
                            <h3 class="h5 fw-bold mb-2">3. The DGFT & e-BRC System</h3>
                            <p class="small text-slate-600 mb-0">
                                Remittances processed through banking channels trigger electronic Inward Remittance Messages (IRMs) uploaded to the DGFT portal. Exporters must self-certify these entries into electronic Bank Realisation Certificates (e-BRC) to maintain formal statutory closure and retain entitlement to export incentives and GST refunds.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- 16-Point Export Invoice Checklist -->
                <div class="mt-5 pt-4 border-top">
                    <h3 class="h4 fw-bold mb-4">Mandatory 16-Point Statutory Checklist for Indian Export Invoices</h3>
                    <p class="text-slate-600 mb-4">
                        Under Rule 46 of the CGST Rules 2017 read with Circular No. 161/17/2021-GST, every commercial or tax invoice issued to a foreign client without payment of integrated tax under a Letter of Undertaking must incorporate specific legal disclosures:
                    </p>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="checklist-item">
                                <div class="checklist-icon">✓</div>
                                <div><strong>Supplier Legal Identification:</strong> Registered business name, trade name, registered office address, PAN, and 15-digit GSTIN.</div>
                            </div>
                            <div class="checklist-item">
                                <div class="checklist-icon">✓</div>
                                <div><strong>Consecutive Serial Number:</strong> Unique numeric or alphanumeric invoice identifier not exceeding 16 characters, unique for the financial year.</div>
                            </div>
                            <div class="checklist-item">
                                <div class="checklist-icon">✓</div>
                                <div><strong>Invoice Date:</strong> Date of issue conforming to time of supply rules under Section 13 of the CGST Act.</div>
                            </div>
                            <div class="checklist-item">
                                <div class="checklist-icon">✓</div>
                                <div><strong>Foreign Client Coordinates:</strong> Complete legal corporate name, registered overseas street address, state/province, and country code.</div>
                            </div>
                            <div class="checklist-item">
                                <div class="checklist-icon">✓</div>
                                <div><strong>Mandatory Statutory Endorsement:</strong> "SUPPLY MEANT FOR EXPORT OF SERVICES UNDER LETTER OF UNDERTAKING WITHOUT PAYMENT OF INTEGRATED TAX".</div>
                            </div>
                            <div class="checklist-item">
                                <div class="checklist-icon">✓</div>
                                <div><strong>LUT Reference & Validity:</strong> Form GST RFD-11 ARN number and corresponding financial year validity (e.g., FY 2026-27).</div>
                            </div>
                            <div class="checklist-item">
                                <div class="checklist-icon">✓</div>
                                <div><strong>Place of Supply Designation:</strong> Explicitly marked as "Outside India" or the respective foreign country (e.g., "United States / Other Territory").</div>
                            </div>
                            <div class="checklist-item">
                                <div class="checklist-icon">✓</div>
                                <div><strong>Foreign Currency Specification:</strong> Distinct currency denomination (USD, EUR, GBP, AUD, CAD) with international ISO currency code.</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="checklist-item">
                                <div class="checklist-icon">✓</div>
                                <div><strong>Services Accounting Code (SAC):</strong> 6-digit SAC code (e.g., 998311 for IT Consulting or 998312 for Software Development).</div>
                            </div>
                            <div class="checklist-item">
                                <div class="checklist-icon">✓</div>
                                <div><strong>Contract Scope & Milestones:</strong> Granular description of professional deliverables, hours worked, or sprint milestones.</div>
                            </div>
                            <div class="checklist-item">
                                <div class="checklist-icon">✓</div>
                                <div><strong>Forex Conversion Benchmark:</strong> Exchange rate applied on invoice generation date (RBI reference rate or authorized dealer benchmark).</div>
                            </div>
                            <div class="checklist-item">
                                <div class="checklist-icon">✓</div>
                                <div><strong>INR Equivalent Disclosure:</strong> Invoice total expressed in both contracted foreign currency and Indian Rupees (INR).</div>
                            </div>
                            <div class="checklist-item">
                                <div class="checklist-icon">✓</div>
                                <div><strong>Applicable Tax Rate:</strong> Explicitly itemized as 0% Integrated Goods and Services Tax (IGST) with zero tax amount.</div>
                            </div>
                            <div class="checklist-item">
                                <div class="checklist-icon">✓</div>
                                <div><strong>Overseas Wire Banking Details:</strong> Beneficiary Account Name, IBAN/Account Number, SWIFT/BIC Code, and AD Bank Branch Name.</div>
                            </div>
                            <div class="checklist-item">
                                <div class="checklist-icon">✓</div>
                                <div><strong>FEMA Realization Undertaking:</strong> Declaration acknowledging payment realization in convertible foreign exchange within 9 months.</div>
                            </div>
                            <div class="checklist-item">
                                <div class="checklist-icon">✓</div>
                                <div><strong>Authorized Digital Signature:</strong> Sign-off by the proprietor, partner, director, or authorized representative.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Comparison of Payment Settlement Rails -->
                <div class="mt-5 pt-4 border-top">
                    <h3 class="h4 fw-bold mb-3">Comparing Cross-Border Settlement Channels for Indian Exporters</h3>
                    <p class="text-slate-600 mb-4">
                        How your international client pays directly determines whether your inward remittance receives an automatic FIRC/FIRS advice or requires manual banking declarations.
                    </p>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle bg-white">
                            <thead class="table-light">
                                <tr>
                                    <th>Settlement Rail</th>
                                    <th>Typical Fees & Margins</th>
                                    <th>Processing Speed</th>
                                    <th>FIRC / Advice Handling</th>
                                    <th>EDPMS & Compliance Overhead</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Direct Bank SWIFT Wire</strong></td>
                                    <td>$15–$30 intermediary fee + 0.5%–1.5% bank forex margin</td>
                                    <td>1 to 3 business days</td>
                                    <td>Direct Foreign Inward Remittance Advice (FIRA) issued by your AD Bank</td>
                                    <td>Lowest statutory friction; bank directly logs IRM on EDPMS/DGFT.</td>
                                </tr>
                                <tr>
                                    <td><strong>Cross-Border Fintech (e.g. Wise, Payoneer)</strong></td>
                                    <td>0.8%–2.0% transaction fee + competitive live mid-market rate</td>
                                    <td>Instant to 24 hours</td>
                                    <td>Fintech provides digital FIRC/FIRS downloaded directly from dashboard</td>
                                    <td>Requires regular tracking of monthly statements and IRM numbers.</td>
                                </tr>
                                <tr>
                                    <td><strong>Payment Gateways (e.g. Stripe, PayPal)</strong></td>
                                    <td>3.5%–5.0% gateway fee + 2.5%–3.5% currency conversion spread</td>
                                    <td>3 to 7 business days</td>
                                    <td>Monthly aggregated FIRC certificates issued via nodal partner banks</td>
                                    <td>Higher fees; bulk deposits require reconciliation to individual invoices.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Comprehensive Exporter FAQ Accordion -->
                <div class="mt-5 pt-4 border-top">
                    <h3 class="h4 fw-bold mb-4">Frequently Asked Questions on Indian Export Billing & Taxation</h3>
                    <div class="accordion" id="blogFaqAccordion">
                        
                        <div class="accordion-item border-0 mb-3 rounded-3 overflow-hidden shadow-sm">
                            <h4 class="accordion-header" id="headingOne">
                                <button class="accordion-button fw-bold text-dark bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Can I export services without GST registration if my annual turnover is under ₹20 Lakhs?
                                </button>
                            </h4>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#blogFaqAccordion">
                                <div class="accordion-body text-slate-600 bg-slate-50">
                                    Yes. Under Notification No. 10/2017-Integrated Tax dated 13th October 2017, service providers making inter-state supplies (including export of services) whose aggregate turnover does not exceed the threshold limit of ₹20 Lakhs (or ₹10 Lakhs in special category states) are exempt from compulsory registration under Section 24(i) of the CGST Act. However, if you register for GST voluntarily or exceed ₹20 Lakhs, you must obtain an LUT to export at 0% tax.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border-0 mb-3 rounded-3 overflow-hidden shadow-sm">
                            <h4 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed fw-bold text-dark bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    What is the validity period of Form GST RFD-11 (Letter of Undertaking)?
                                </button>
                            </h4>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#blogFaqAccordion">
                                <div class="accordion-body text-slate-600 bg-slate-50">
                                    An LUT furnished in Form GST RFD-11 is valid for exactly one financial year (from 1st April through 31st March). For example, an LUT filed on 5th April 2026 remains valid until 31st March 2027. Exporters should file their renewal for the upcoming financial year in March or early April before issuing their first export invoice of the new fiscal period.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border-0 mb-3 rounded-3 overflow-hidden shadow-sm">
                            <h4 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed fw-bold text-dark bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    What happens if inward remittance is not received within 9 months?
                                </button>
                            </h4>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#blogFaqAccordion">
                                <div class="accordion-body text-slate-600 bg-slate-50">
                                    Under Rule 96A(1)(b) of the CGST Rules, if the foreign convertible exchange is not realized within 9 months (or 15 days following the expiration of the permitted period), the exporter is legally bound to deposit the integrated tax (IGST at 18%) along with interest at 18% per annum under Section 50(1). Once payment is realized later, the exporter can claim a refund of the tax paid.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border-0 mb-3 rounded-3 overflow-hidden shadow-sm">
                            <h4 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed fw-bold text-dark bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Can I receive export payments into a personal savings account?
                                </button>
                            </h4>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#blogFaqAccordion">
                                <div class="accordion-body text-slate-600 bg-slate-50">
                                    While small independent freelancers occasionally receive transfers into savings accounts, RBI guidelines and bank KYC protocols mandate that business and commercial export proceeds must flow through a designated Current Account or an EEFC (Exchange Earners' Foreign Currency) account. Receiving business proceeds in savings accounts frequently leads to account freezes, compliance queries from bank forex desks, and rejection of FIRC requests.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border-0 mb-3 rounded-3 overflow-hidden shadow-sm">
                            <h4 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed fw-bold text-dark bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    Do IT and software service exports require SOFTEX form filing?
                                </button>
                            </h4>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#blogFaqAccordion">
                                <div class="accordion-body text-slate-600 bg-slate-50">
                                    Under RBI Foreign Exchange Management Regulations, entities registered as STPI (Software Technology Parks of India) or SEZ units must file statutory SOFTEX forms for export of computer software transmission. However, small non-STPI IT service providers, freelance developers, and independent tech consultants are exempt from mandatory STPI registration and submit a self-declaration under FEMA Notification No. 23(R) alongside invoice copies to their AD Bank.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </section>

            <!-- Bottom CTA Banner -->
            <div class="p-5 rounded-4 text-center text-white my-5 shadow-lg position-relative overflow-hidden" style="background: linear-gradient(135deg, #0284c7 0%, #2563eb 100%);">
                <h2 class="h3 fw-bold text-white mb-3">Eliminate Export Invoicing Errors with COD XPERT</h2>
                <p class="text-white-50 mx-auto mb-4" style="max-width: 650px;">
                    Generate compliant 0% IGST export invoices with automatic LUT declarations, multi-currency conversion, FEMA 23(R) disclaimers, and GSTR-1 Table 6A JSON exports in seconds.
                </p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="{{ route('tools.invoice-generator') }}" class="btn btn-light text-primary fw-bold px-4 py-2 rounded-pill shadow-sm">
                        Try Free Invoice Generator
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-light fw-bold px-4 py-2 rounded-pill">
                        Create Free Exporter Account →
                    </a>
                </div>
            </div>

        </div>
    </main>

    @include('partials.public_footer')

    <!-- Interactive Filtering & Search Script -->
    <script>
        function setCategory(category, button) {
            document.querySelectorAll('.category-pill').forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            const articles = document.querySelectorAll('.article-item');
            articles.forEach(article => {
                const articleCategories = article.getAttribute('data-category').split(' ');
                if (category === 'all' || articleCategories.includes(category)) {
                    article.style.display = 'block';
                } else {
                    article.style.display = 'none';
                }
            });
        }

        function filterArticles() {
            const query = document.getElementById('blogSearchInput').value.toLowerCase().trim();
            const articles = document.querySelectorAll('.article-item');

            articles.forEach(article => {
                const title = article.getAttribute('data-title').toLowerCase();
                const text = article.innerText.toLowerCase();
                if (title.includes(query) || text.includes(query)) {
                    article.style.display = 'block';
                } else {
                    article.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>
