<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Privacy Policy | Cod Xpert Invoices</title>
    <meta name="description" content="Privacy Policy for Cod Xpert Invoices. Learn how we collect, use, and protect your business billing, client data, GST details, and invoice records.">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url('/privacy') }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/privacy') }}">
    <meta property="og:title" content="Privacy Policy | Cod Xpert Invoices">
    <meta property="og:description" content="Learn how Cod Xpert Invoices protects your business billing data, GST compliance details, and customer records.">

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
            right: 10%;
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, #38bdf8, #818cf8);
        }

        .bg-blob-2 {
            top: 45%;
            left: -5%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, #818cf8, #c084fc);
            animation-delay: -5s;
        }

        .bg-blob-3 {
            bottom: 10%;
            right: -5%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, #22d3ee, #6366f1);
            animation-delay: -10s;
        }

        @keyframes float-blob {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(40px, -60px) scale(1.1); }
            100% { transform: translate(-20px, 30px) scale(0.9); }
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
            background: rgba(2, 132, 199, 0.1);
            color: #0284c7;
            border: 1px solid rgba(2, 132, 199, 0.2);
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
            background: linear-gradient(135deg, #0ea5e9, #2563eb);
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

        .highlight-box {
            background: rgba(2, 132, 199, 0.04);
            border-left: 4px solid var(--color-primary);
            border-radius: 0 12px 12px 0;
            padding: 16px 20px;
            margin: 20px 0;
            font-size: 14px;
            color: #334155;
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
            color: var(--color-primary);
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
                <div class="brand-icon">EX</div>
                <span class="brand-text">Cod Xpert Invoices</span>
            </a>
            <div class="ms-auto d-flex align-items-center gap-2">
                <a href="{{ url('/') }}" class="nav-link-custom d-none d-sm-inline-block">Home</a>
                <a href="{{ route('terms') }}" class="nav-link-custom d-none d-sm-inline-block">Terms of Use</a>
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
                            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            DPDP Act, 2023 & GST Compliant
                        </span>
                        <span class="text-muted fs-8">Last Updated: August 25, 2026</span>
                    </div>
                    <h1 class="display-6 fw-bold mb-3">Privacy Policy</h1>
                    <p class="text-muted mb-0 lead fs-6">
                        At <strong>Cod Xpert Invoices</strong> (operated via <code>invoice.codxpert.com</code> and <code>codxpert.com</code>), we are strictly committed to complying with the <strong>Digital Personal Data Protection Act, 2023 (DPDP Act)</strong> of India and protecting the personal and financial data you entrust to our platform.
                    </p>
                </div>

                <!-- Legal Body Card -->
                <div class="legal-card">

                    <!-- Quick Navigation -->
                    <div class="table-of-contents mb-4">
                        <div class="fw-bold fs-7 text-uppercase text-muted mb-2">Table of Contents (DPDP Act, 2023 Aligned)</div>
                        <div class="row g-1">
                            <div class="col-12 col-md-6">
                                <a href="#section-1">1. Scope, Status & DPDP Act Framework</a>
                                <a href="#section-2">2. Categories of Digital Personal Data Collected</a>
                                <a href="#section-3">3. Specified Purposes & Lawful Processing</a>
                                <a href="#section-4">4. Itemized Notice & Consent Framework</a>
                                <a href="#section-5">5. Restriction on Children's Personal Data</a>
                                <a href="#section-6">6. Multi-Tenant Data Isolation & Security</a>
                            </div>
                            <div class="col-12 col-md-6">
                                <a href="#section-7">7. Custom SMTP & Third-Party Processors</a>
                                <a href="#section-8">8. Data Retention, Minimization & Erasure</a>
                                <a href="#section-9">9. Statutory Rights of the Data Principal</a>
                                <a href="#section-10">10. Grievance Redressal & DPBI Escalation</a>
                            </div>
                        </div>
                    </div>

                    <!-- Section 1 -->
                    <div class="legal-section" id="section-1">
                        <h2><span class="section-num">1</span> Scope, Status & DPDP Act Framework</h2>
                        <p>
                            This Privacy Policy explains how <strong>Cod Xpert</strong> (operating as the <em>"Data Fiduciary"</em> under the Digital Personal Data Protection Act, 2023) processes digital personal data provided by business users, authorized representatives, clients, and partners (the <em>"Data Principals"</em>).
                        </p>
                        <p>
                            Our processing activities are strictly governed by the provisions of the <strong>Digital Personal Data Protection Act, 2023 (Act No. 22 of 2023)</strong> and applicable rules framed thereunder.
                        </p>
                    </div>

                    <!-- Section 2 -->
                    <div class="legal-section" id="section-2">
                        <h2><span class="section-num">2</span> Categories of Digital Personal Data Collected</h2>
                        <p>In accordance with the principle of <em>Data Minimisation</em>, we collect only the personal data that is strictly required for delivering our software services:</p>
                        <ul>
                            <li><strong>Account & Identity Data:</strong> Full name, authorized signatory name, business email address, hashed passwords, contact phone numbers, and digital signatures.</li>
                            <li><strong>Business & Tax Identifiers:</strong> Company name, postal address, GSTIN, PAN, Letter of Undertaking (LUT) reference numbers, and bank account/UPI identifiers.</li>
                            <li><strong>Customer & Client Contact Details:</strong> Customer business names, billing addresses, contact emails, phone numbers, state codes, and GSTINs entered by the user.</li>
                            <li><strong>Transactional & Financial Records:</strong> Invoice line items, SAC/HSN codes, item descriptions, invoice dates, foreign currency symbols, locked exchange rates, inward remittances, and FIRC tracking numbers.</li>
                            <li><strong>Business Expense Logs:</strong> Expense categories, vendor details, receipts/documents, taxable values, and Input Tax Credit (ITC) data.</li>
                            <li><strong>Custom SMTP Credentials:</strong> Custom mail server host, port, username, and encrypted password used solely for dispatching authenticated invoice emails from the user's custom domain.</li>
                        </ul>
                    </div>

                    <!-- Section 3 -->
                    <div class="legal-section" id="section-3">
                        <h2><span class="section-num">3</span> Specified Purposes & Lawful Processing</h2>
                        <p>Under Section 4 and Section 7 of the DPDP Act, 2023, personal data is processed strictly for the following specified, lawful business purposes:</p>
                        <ul>
                            <li>Generating printable and downloadable PDF invoices, quotations, and payment receipts.</li>
                            <li>Calculating state-wise GST allocations (CGST + SGST for intra-state, IGST for inter-state) based on statutory rules.</li>
                            <li>Locking foreign currency exchange rates on invoice creation dates and computing INR equivalents for GST export compliances.</li>
                            <li>Compiling GSTR-1 CSV exports (B2B, Export under LUT, Nil/Exempted, HSN summaries).</li>
                            <li>Exporting business expense ledgers to Excel/CSV with Input Tax Credit (ITC) categorization.</li>
                            <li>Dispatching transactional emails and payment reminders to clients upon user request.</li>
                        </ul>
                        <div class="highlight-box">
                            <strong>Zero Commercial Monetization Guarantee:</strong> We do <u>not</u> sell, lease, trade, or monetize any personal data, customer rosters, or financial transactions to advertisers, analytics firms, or data brokers.
                        </div>
                    </div>

                    <!-- Section 4 -->
                    <div class="legal-section" id="section-4">
                        <h2><span class="section-num">4</span> Itemized Notice & Consent Framework (Sections 5 & 6)</h2>
                        <p>
                            In compliance with Section 5 of the DPDP Act, 2023, users are provided with a clear notice at the time of registration and data entry detailing the specific personal data collected and the purpose for which it will be processed.
                        </p>
                        <p>
                            <strong>Right to Withdraw Consent:</strong> Data Principals have the unconditional right to withdraw consent at any time by accessing their account settings or contacting the Grievance Officer. Withdrawal of consent will lead to the immediate cessation of data processing and subsequent erasure of personal data, subject to mandatory statutory tax retention obligations.
                        </p>
                    </div>

                    <!-- Section 5 -->
                    <div class="legal-section" id="section-5">
                        <h2><span class="section-num">5</span> Restriction on Processing Children's Personal Data (Section 9)</h2>
                        <p>
                            Cod Xpert Invoices is exclusively a B2B business invoicing and tax management tool intended for commercial entities and individuals aged <strong>18 years and older</strong>.
                        </p>
                        <p>
                            In strict compliance with Section 9 of the DPDP Act, 2023, we do not knowingly collect, track, or process personal data of children (individuals under 18 years of age) or persons with disabilities without verifiable parental or guardian authorization.
                        </p>
                    </div>

                    <!-- Section 6 -->
                    <div class="legal-section" id="section-6">
                        <h2><span class="section-num">6</span> Multi-Tenant Data Isolation & Security Safeguards (Section 8)</h2>
                        <p>
                            In compliance with Section 8(4) and 8(5) of the DPDP Act, 2023, we maintain robust organizational, technical, and architectural security safeguards:
                        </p>
                        <ul>
                            <li><strong>Multi-Tenant Row-Level Isolation:</strong> Strict authorization policies ensuring that no tenant can query, access, or alter data belonging to another user.</li>
                            <li><strong>Encryption in Transit & at Rest:</strong> Enforced TLS 1.3 encryption across all public and internal connections; symmetric AES-256-CBC encryption for SMTP credentials.</li>
                            <li><strong>Password Hashing:</strong> Strong, irreversible Bcrypt hashing for authentication credentials.</li>
                            <li><strong>Session & Cookie Protection:</strong> Encrypted, HTTPOnly, and SameSite=Strict cookies guarding against CSRF and cross-site scripting attacks.</li>
                            <li><strong>Data Breach Notification Protocol:</strong> In the event of a personal data breach, Cod Xpert will notify the Data Protection Board of India (DPBI) and affected Data Principals in accordance with statutory guidelines.</li>
                        </ul>
                    </div>

                    <!-- Section 7 -->
                    <div class="legal-section" id="section-7">
                        <h2><span class="section-num">7</span> Custom SMTP & Third-Party Processors</h2>
                        <p>
                            We engage only trusted third-party service providers acting as <em>Data Processors</em> under strict contractual privacy obligations:
                        </p>
                        <ul>
                            <li><strong>Exchange Rate Providers (ExchangeRate-API):</strong> Used strictly for retrieving reference foreign currency conversion rates without transmitting any personal data.</li>
                            <li><strong>Custom SMTP Relays:</strong> When configured by the user, custom SMTP servers are connected securely to transmit emails directly through the user's authorized mail infrastructure.</li>
                            <li><strong>Cloud Infrastructure:</strong> Secured enterprise server hosting with automated daily backups, firewall isolation, and DDoS protection.</li>
                        </ul>
                    </div>

                    <!-- Section 8 -->
                    <div class="legal-section" id="section-8">
                        <h2><span class="section-num">8</span> Data Retention, Minimization & Erasure (Section 8(7))</h2>
                        <p>
                            Personal data is retained only for as long as necessary to satisfy the purpose for which it was collected, or to comply with statutory audit trail requirements under the Goods and Services Tax (GST) Act and the Companies Act, 2013 (typically up to 6-8 financial years for accounting invoices).
                        </p>
                        <p>
                            Upon receipt of an account closure or data erasure request, personal data that is no longer required for statutory compliance will be irrevocably deleted or anonymized.
                        </p>
                    </div>

                    <!-- Section 9 -->
                    <div class="legal-section" id="section-9">
                        <h2><span class="section-num">9</span> Statutory Rights of the Data Principal (Sections 11–14)</h2>
                        <p>Under Chapter III of the DPDP Act, 2023, you have the following enforceable statutory rights:</p>
                        <ul>
                            <li><strong>Right to Access Information (Section 11):</strong> Right to obtain a summary of personal data being processed, identities of all data processors, and any other relevant processing details.</li>
                            <li><strong>Right to Correction & Erasure (Section 12):</strong> Right to correct misleading or inaccurate personal data, update incomplete records, and request erasure of data no longer required.</li>
                            <li><strong>Right of Grievance Redressal (Section 13):</strong> Right to an accessible and timely grievance redressal mechanism provided by our designated Grievance Officer.</li>
                            <li><strong>Right to Nominate (Section 14):</strong> Right to nominate another individual who shall, in the event of death or incapacity of the Data Principal, exercise these statutory rights.</li>
                        </ul>
                    </div>

                    <!-- Section 10 -->
                    <div class="legal-section" id="section-10">
                        <h2><span class="section-num">10</span> Grievance Redressal Officer & DPBI Escalation (Section 8(9) & 13)</h2>
                        <p>
                            In compliance with Section 8(9) and Section 13(1) of the Digital Personal Data Protection Act, 2023, Cod Xpert has appointed a designated <strong>Grievance Officer / Data Protection Officer (DPO)</strong>:
                        </p>
                        
                        <div class="p-4 bg-light rounded-4 border mb-4">
                            <h5 class="fw-bold text-dark mb-2">Designated Data Protection & Grievance Redressal Officer</h5>
                            <p class="mb-1"><strong>Officer Name / Desk:</strong> Data Protection Office, Cod Xpert Invoices</p>
                            <p class="mb-1"><strong>Company:</strong> COD XPERT</p>
                            <p class="mb-1"><strong>Office Address:</strong> Neelam Cinema Road, Gandhi Chowk, India</p>
                            <p class="mb-1"><strong>Official Grievance Email:</strong> <a href="mailto:support@codxpert.com" class="text-primary fw-semibold text-decoration-none">support@codxpert.com</a></p>
                            <p class="mb-0"><strong>Response & Resolution SLA:</strong> Initial acknowledgment within 24 hours; complete resolution within <strong>7 business days</strong>.</p>
                        </div>

                        <p class="fs-7 text-muted">
                            <strong>Escalation to Data Protection Board of India (DPBI):</strong> If you do not receive a satisfactory response to your grievance from our Grievance Officer within the stipulated timeline, you have the statutory right under Section 13(3) of the DPDP Act, 2023 to file a formal complaint with the <strong>Data Protection Board of India (DPBI)</strong>.
                        </p>
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
                        <div class="brand-icon" style="height:28px; width:28px; font-size:14px;">EX</div>
                        <span class="brand-text text-dark" style="font-size:17px;">Cod Xpert Invoices</span>
                    </a>
                    <p class="text-muted fs-8 mb-0">GST-compliant, multi-currency export billing & expense tracking software.</p>
                </div>
                <div class="col-md-6 d-flex flex-column align-items-center align-items-md-end gap-2">
                    <ul class="footer-links">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ route('terms') }}">Terms of Use</a></li>
                        <li><a href="{{ route('privacy') }}" class="text-primary fw-semibold">Privacy Policy</a></li>
                        <li><a href="{{ route('login') }}">Sign In</a></li>
                    </ul>
                    <p class="text-muted fs-8 mb-0" style="font-size:12px;">© {{ date('Y') }} <a href="https://codxpert.com" target="_blank" style="color:var(--color-primary); text-decoration:none; font-weight:600;">codxpert.com</a>. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JavaScript Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
