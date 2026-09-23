<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Terms of Use | Cod Xpert Invoices</title>
    <meta name="description" content="Terms of Use and Conditions for Cod Xpert Invoices billing and tax compliance software platform.">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url('/terms') }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/terms') }}">
    <meta property="og:title" content="Terms of Use | Cod Xpert Invoices">
    <meta property="og:description" content="Read the terms, conditions, and compliance guidelines governing the use of Cod Xpert Invoices software.">

    <link rel="icon" type="image/png" href="{{ asset('images/codxpert-logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/codxpert-logo.png') }}">

    <!-- Premium Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Premium Custom Styles -->
    <style>
        :root {
            --font-main: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            --font-heading: 'Outfit', sans-serif;
            
            --bg-body: #f1f5f9;
            --bg-card: rgba(255, 255, 255, 0.65);
            --color-primary: #0284c7;
            --color-primary-hover: #0369a1;
            --color-indigo: #4f46e5;
            --color-text-main: #0f172a;
            --color-text-muted: #475569;
            --glass-bg: rgba(255, 255, 255, 0.55);
            --glass-border: rgba(255, 255, 255, 0.6);
            
            --shadow-premium: 0 20px 40px -15px rgba(15, 23, 42, 0.05), inset 0 1px 0 rgba(255, 255, 255, 0.8);
            --shadow-primary: 0 4px 20px rgba(2, 132, 199, 0.15);
        }

        body {
            font-family: var(--font-main);
            background-color: var(--bg-body);
            color: var(--color-text-main);
            overflow-x: hidden;
            position: relative;
            line-height: 1.7;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: var(--font-heading);
            font-weight: 700;
            color: #0f172a;
        }

        /* Animated Background Blobs for Glassmorphism */
        .bg-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.18;
            z-index: -1;
            pointer-events: none;
            animation: float-blob 20s infinite alternate ease-in-out;
        }

        .bg-blob-1 {
            top: 5%;
            left: 10%;
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, #818cf8, #38bdf8);
        }

        .bg-blob-2 {
            top: 50%;
            right: -5%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, #38bdf8, #c084fc);
            animation-delay: -7s;
        }

        .bg-blob-3 {
            bottom: 5%;
            left: -5%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, #22d3ee, #6366f1);
            animation-delay: -12s;
        }

        @keyframes float-blob {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(-30px, 50px) scale(1.1); }
            100% { transform: translate(30px, -20px) scale(0.95); }
        }

        /* Navbar Glassmorphism */
        .navbar-custom {
            background: var(--glass-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--glass-border);
            padding: 16px 0;
            transition: all 0.3s;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.03);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand-custom {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .brand-icon {
            height: 36px;
            width: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, #0ea5e9, #6366f1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: white;
            font-size: 18px;
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.4);
        }

        .brand-text {
            font-size: 20px;
            font-weight: 800;
            color: #0f172a;
            font-family: var(--font-heading);
            letter-spacing: -0.5px;
        }

        .nav-link-custom {
            color: var(--color-text-muted) !important;
            font-size: 15px;
            font-weight: 500;
            transition: color 0.2s;
            padding: 8px 16px !important;
            text-decoration: none;
        }

        .nav-link-custom:hover {
            color: var(--color-primary) !important;
        }

        /* Legal Content Container */
        .legal-header-card {
            background: var(--glass-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 40px;
            box-shadow: var(--shadow-premium);
            margin-bottom: 30px;
        }

        .legal-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 24px;
            padding: 45px;
            box-shadow: var(--shadow-premium);
            margin-bottom: 40px;
        }

        .badge-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            background: rgba(79, 70, 229, 0.1);
            color: var(--color-indigo);
            border: 1px solid rgba(79, 70, 229, 0.2);
        }

        .legal-section {
            margin-bottom: 36px;
            padding-bottom: 28px;
            border-bottom: 1px solid #e2e8f0;
        }

        .legal-section:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .legal-section h2 {
            font-size: 22px;
            margin-bottom: 16px;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .legal-section h2 .section-num {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #4f46e5, #0284c7);
            color: white;
            font-size: 14px;
            font-weight: 700;
            border-radius: 8px;
        }

        .legal-section p, .legal-section li {
            color: #334155;
            font-size: 15px;
        }

        .legal-section ul {
            padding-left: 20px;
            margin-top: 10px;
            margin-bottom: 16px;
        }

        .legal-section li {
            margin-bottom: 8px;
        }

        .warning-box {
            background: rgba(245, 158, 11, 0.06);
            border-left: 4px solid #f59e0b;
            border-radius: 0 12px 12px 0;
            padding: 16px 20px;
            margin: 20px 0;
            font-size: 14px;
            color: #92400e;
        }

        .table-of-contents {
            background: rgba(248, 250, 252, 0.8);
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 20px 24px;
            margin-bottom: 30px;
        }

        .table-of-contents a {
            color: #475569;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            display: block;
            padding: 6px 0;
            transition: all 0.2s ease;
        }

        .table-of-contents a:hover {
            color: var(--color-indigo);
            padding-left: 6px;
        }

        /* Footer */
        .footer-custom {
            background: var(--glass-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-top: 1px solid var(--glass-border);
            padding: 40px 0;
            margin-top: 40px;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 24px;
            flex-wrap: wrap;
        }

        .footer-links a {
            color: var(--color-text-muted);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: var(--color-primary);
        }
    </style>
</head>
<body>
    <!-- Animated Glassmorphism Background Blobs -->
    <div class="bg-blob bg-blob-1"></div>
    <div class="bg-blob bg-blob-2"></div>
    <div class="bg-blob bg-blob-3"></div>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand-custom" href="{{ url('/') }}">
                <img src="{{ asset('images/codxpert-logo.png') }}" alt="CodXpert" style="height: 38px; width: auto; object-fit: contain;">
                <span class="brand-text">Invoices</span>
            </a>
            <div class="ms-auto d-flex align-items-center gap-2">
                <a href="{{ url('/') }}" class="nav-link-custom d-none d-sm-inline-block">Home</a>
                <a href="{{ route('privacy') }}" class="nav-link-custom d-none d-sm-inline-block">Privacy Policy</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-semibold border-0" style="background: linear-gradient(135deg, #0284c7, #2563eb); font-size:14px;">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-semibold border-0" style="background: linear-gradient(135deg, #0284c7, #2563eb); font-size:14px;">
                        Sign In
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content Container -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-9">
                
                <!-- Header Card -->
                <div class="legal-header-card text-center text-md-start">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3">
                        <span class="badge-tag">
                            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Legal Agreement
                        </span>
                        <span class="text-muted fs-8">Last Modified: August 24, 2026</span>
                    </div>
                    <h1 class="display-6 fw-bold mb-3">Terms of Use</h1>
                    <p class="text-muted mb-0 lead fs-6">
                        These Terms of Use govern your access to and utilization of the <strong>Cod Xpert Invoices</strong> application and associated services hosted at <code>invoice.codxpert.com</code>.
                    </p>
                </div>

                <!-- Legal Body Card -->
                <div class="legal-card">

                    <!-- Quick Navigation -->
                    <div class="table-of-contents mb-4">
                        <div class="fw-bold fs-7 text-uppercase text-muted mb-2">Table of Contents</div>
                        <div class="row g-1">
                            <div class="col-12 col-md-6">
                                <a href="#section-1">1. Acceptance of Terms</a>
                                <a href="#section-2">2. Description of Software Services</a>
                                <a href="#section-3">3. Account Registration & Approval</a>
                                <a href="#section-4">4. User Tax & GST Compliance Obligations</a>
                                <a href="#section-5">5. Currency Rates & Forex Realization</a>
                            </div>
                            <div class="col-12 col-md-6">
                                <a href="#section-6">6. Custom SMTP & Outbound Email Rules</a>
                                <a href="#section-7">7. Prohibited & Unlawful Uses</a>
                                <a href="#section-8">8. Intellectual Property Rights</a>
                                <a href="#section-9">9. Limitation of Liability</a>
                                <a href="#section-10">10. Governing Law & Jurisdiction</a>
                            </div>
                        </div>
                    </div>

                    <!-- Section 1 -->
                    <div class="legal-section" id="section-1">
                        <h2><span class="section-num">1</span> Acceptance of Terms</h2>
                        <p>
                            By creating an account, registering your business details, or otherwise utilizing Cod Xpert Invoices ("the Service", "Platform", or "we"), you ("User", "Subscriber", or "Organization") agree to be bound by these Terms of Use and our <a href="{{ route('privacy') }}" class="text-primary fw-semibold text-decoration-none">Privacy Policy</a>.
                        </p>
                        <p>
                            If you are registering on behalf of a company, partnership, or legal entity, you represent and warrant that you possess the requisite legal authority to bind that entity to these Terms.
                        </p>
                    </div>

                    <!-- Section 2 -->
                    <div class="legal-section" id="section-2">
                        <h2><span class="section-num">2</span> Description of Software Services</h2>
                        <p>Cod Xpert Invoices provides a software platform designed to streamline corporate and freelance billing workflows, including:</p>
                        <ul>
                            <li>Creation, editing, conversion, and rendering of tax invoices and quotations.</li>
                            <li>Services Accounting Code (SAC) and Harmonized System of Nomenclature (HSN) categorization.</li>
                            <li>Export of Services under Letter of Undertaking (LUT) support with automatic tax exemption wording.</li>
                            <li>Multi-currency billing with locked exchange rate recording and rupee equivalent calculation.</li>
                            <li>Payment liquidation logging, FIRC/e-BRC reference tracking, and Forex gain/loss computation.</li>
                            <li>Expense tracking with Input Tax Credit (ITC) categorization and GSTR-1 compliant CSV exports.</li>
                            <li>Outbound transactional email delivery through custom user SMTP configurations.</li>
                        </ul>
                    </div>

                    <!-- Section 3 -->
                    <div class="legal-section" id="section-3">
                        <h2><span class="section-num">3</span> Account Registration, Age Eligibility & DPDP Duties</h2>
                        <p>
                            To safeguard platform integrity and comply with Section 9 and Section 15 of the <strong>Digital Personal Data Protection Act, 2023 (DPDP Act)</strong>:
                        </p>
                        <ul>
                            <li><strong>Age Requirement (18+):</strong> You represent and warrant that you are at least 18 years of age and legally competent to enter into binding agreements. The platform is not intended for minors.</li>
                            <li><strong>Authentic Information (Section 15):</strong> In accordance with the duties of Data Principals under the DPDP Act, you agree to provide true, accurate, current, and verifiable business and tax details, and not to suppress any material information or impersonate another entity.</li>
                            <li><strong>Credential Security:</strong> You must maintain the confidentiality of your login credentials and immediately notify us at <a href="mailto:support@codxpert.com" class="text-primary text-decoration-none">support@codxpert.com</a> upon detecting any security breach.</li>
                            <li><strong>Admin Review:</strong> All new business registrations remain subject to manual administrative review and approval before full platform activation.</li>
                        </ul>
                    </div>

                    <!-- Section 4 -->
                    <div class="legal-section" id="section-4">
                        <h2><span class="section-num">4</span> User Tax & Regulatory Compliance Obligations</h2>
                        <p>
                            Cod Xpert Invoices is an automated documentation tool and does not provide legal, accounting, tax, or financial advisory services.
                        </p>
                        <div class="warning-box">
                            <strong>Compliance Disclaimer:</strong> You are solely and exclusively responsible for the accuracy of your GSTIN, client GSTINs, applied SAC/HSN codes, CGST/SGST/IGST tax rates, LUT validity, and for filing your periodic returns (e.g., GSTR-1, GSTR-3B) with the Goods and Services Tax Network (GSTN) or relevant tax authorities.
                        </div>
                        <p>
                            While our platform compiles GSTR-1 CSV exports and calculates tax splits based on state code rules, you must independently review and verify all exported data prior to official submission to governmental portals.
                        </p>
                    </div>

                    <!-- Section 5 -->
                    <div class="legal-section" id="section-5">
                        <h2><span class="section-num">5</span> Currency Rates & Forex Realization Disclaimers</h2>
                        <p>
                            For foreign currency invoices (such as USD, EUR, GBP, AED, SGD), conversion rates fetched from external exchange rate APIs represent standard reference rates.
                        </p>
                        <ul>
                            <li><strong>Invoice Date Rate:</strong> The conversion rate locked on the invoice date is used for indicative GST reporting in INR.</li>
                            <li><strong>Actual Bank Realization:</strong> The actual Indian Rupee amount credited to your bank account upon foreign remittance realization depends on your authorized dealer (AD) bank's forex card rate, spread, and wire fees.</li>
                            <li><strong>Forex Variance:</strong> Calculations of Forex Gain/Loss recorded in the platform are for internal bookkeeping assistance and must be reconciled with your official FIRC/e-BRC certificates.</li>
                        </ul>
                    </div>

                    <!-- Section 6 -->
                    <div class="legal-section" id="section-6">
                        <h2><span class="section-num">6</span> Custom SMTP & Outbound Email Rules</h2>
                        <p>
                            Users utilizing the custom SMTP configuration feature to send invoice emails from their own domain must comply with strict anti-spam guidelines:
                        </p>
                        <ul>
                            <li>You must only send invoices, receipts, and payment reminders to bona fide clients with whom you have an existing commercial relationship.</li>
                            <li>You shall not use the service to dispatch bulk unsolicited promotional mail, phishing materials, or malicious software.</li>
                            <li>You are solely responsible for domain reputation, SPF, DKIM, and DMARC DNS settings on your mailing domain.</li>
                        </ul>
                    </div>

                    <!-- Section 7 -->
                    <div class="legal-section" id="section-7">
                        <h2><span class="section-num">7</span> Prohibited & Unlawful Uses</h2>
                        <p>You agree not to use Cod Xpert Invoices for any of the following activities:</p>
                        <ul>
                            <li>Generating fraudulent, fictitious, or sham invoices to claim illicit Input Tax Credit (ITC).</li>
                            <li>Attempting to bypass access controls, probe system vulnerabilities, or launch denial-of-service attacks.</li>
                            <li>Reverse engineering, decompiling, or disassembling any portion of the software platform.</li>
                            <li>Uploading corrupted files, viruses, trojans, or malicious code.</li>
                        </ul>
                    </div>

                    <!-- Section 8 -->
                    <div class="legal-section" id="section-8">
                        <h2><span class="section-num">8</span> Intellectual Property Rights</h2>
                        <p>
                            All software, UI designs, codebases, stylesheets, logos, trademarks, and documentation associated with Cod Xpert Invoices are the exclusive intellectual property of Cod Xpert and its licensors.
                        </p>
                        <p>
                            You retain full and exclusive ownership of all proprietary business data, client records, uploaded logos, and invoice particulars inputted into your account.
                        </p>
                    </div>

                    <!-- Section 9 -->
                    <div class="legal-section" id="section-9">
                        <h2><span class="section-num">9</span> Limitation of Liability & Warranty Disclaimer</h2>
                        <p>
                            The Service is provided on an "AS IS" and "AS AVAILABLE" basis without warranties of any kind, whether express, statutory, or implied.
                        </p>
                        <p>
                            To the maximum extent permitted by applicable law, in no event shall Cod Xpert, its developers, affiliates, or directors be liable for any indirect, incidental, special, consequential, or punitive damages, including loss of profits, loss of data, tax penalties, or business interruption arising out of or related to the use or inability to use the platform.
                        </p>
                    </div>

                    <!-- Section 10 -->
                    <div class="legal-section" id="section-10">
                        <h2><span class="section-num">10</span> Termination, Governing Law & Jurisdiction</h2>
                        <p>
                            We reserve the right to suspend or terminate access to any account that breaches these Terms or engages in fraudulent invoicing practices.
                        </p>
                        <p>
                            These Terms shall be governed by and construed in accordance with the laws of <strong>India</strong>. Any legal disputes arising under these Terms shall be subject to the exclusive jurisdiction of the competent courts in India.
                        </p>
                        <div class="p-3 bg-light rounded-3 border mt-4">
                            <p class="mb-1"><strong>Cod Xpert Invoices Legal Desk</strong></p>
                            <p class="mb-1 text-muted fs-7">Main Domain: <a href="https://codxpert.com/" target="_blank" rel="noopener" class="text-decoration-none text-primary fw-semibold">codxpert.com</a></p>
                            <p class="mb-1 text-muted fs-7">Platform URL: <a href="https://invoice.codxpert.com" class="text-decoration-none text-primary fw-semibold">invoice.codxpert.com</a></p>
                            <p class="mb-0 text-muted fs-7">Contact & Legal Inquiries: <a href="mailto:support@codxpert.com" class="text-decoration-none text-primary fw-semibold">support@codxpert.com</a></p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer-custom">
        <div class="container">
            <div class="row align-items-center g-3">
                <div class="col-md-6 text-center text-md-start">
                    <a class="navbar-brand-custom justify-content-center justify-content-md-start mb-2" href="{{ url('/') }}">
                        <img src="{{ asset('images/codxpert-logo.png') }}" alt="CodXpert" style="height: 32px; width: auto; object-fit: contain;">
                        <span class="brand-text text-dark" style="font-size:17px;">Invoices</span>
                    </a>
                    <p class="text-muted fs-8 mb-0">GST-compliant, multi-currency export billing & expense tracking software.</p>
                </div>
                <div class="col-md-6 d-flex flex-column align-items-center align-items-md-end gap-2">
                    <ul class="footer-links">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ route('terms') }}" class="text-primary fw-semibold">Terms of Use</a></li>
                        <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                        <li><a href="{{ route('login') }}">Sign In</a></li>
                    </ul>
                    <p class="text-muted fs-8 mb-0" style="font-size:12px;">© {{ date('Y') }} <a href="https://codxpert.com/" target="_blank" rel="noopener" style="color:var(--color-primary); text-decoration:none; font-weight:600;">CodXpert</a> (<a href="https://codxpert.com/" target="_blank" rel="noopener" class="text-muted text-decoration-none">codxpert.com</a>). All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JavaScript Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
