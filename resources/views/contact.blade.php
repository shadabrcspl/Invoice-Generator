<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Contact & Enterprise Support Desk | Cod Xpert Invoices</title>
    <meta name="description" content="Get in touch with Cod Xpert Invoices for enterprise deployment, custom SMTP setup, GST LUT compliance consulting, or technical support. Guaranteed 24-hr SLA.">
    <link rel="canonical" href="{{ url('/contact') }}">

    <!-- Open Graph / Social Media -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/contact') }}">
    <meta property="og:title" content="Contact & Enterprise Support Desk | Cod Xpert Invoices">
    <meta property="og:description" content="Get in touch with Cod Xpert Invoices for enterprise deployment, custom SMTP setup, GST LUT compliance consulting, or technical support. Guaranteed 24-hr SLA.">
    <meta property="og:image" content="https://invoice.codxpert.com/images/forex_dashboard.png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Cod Xpert Invoices">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url('/contact') }}">
    <meta name="twitter:title" content="Contact & Enterprise Support Desk | Cod Xpert Invoices">
    <meta name="twitter:description" content="Get in touch with Cod Xpert Invoices for enterprise deployment, custom SMTP setup, GST LUT compliance consulting, or technical support. Guaranteed 24-hr SLA.">
    <meta name="twitter:image" content="https://invoice.codxpert.com/images/forex_dashboard.png">


    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon-192x192.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Schema.org ContactPage -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ContactPage",
        "name": "Cod Xpert Invoices Contact Desk",
        "url": "https://invoice.codxpert.com/contact",
        "description": "Enterprise support, GST LUT compliance consultation, and deployment inquiries.",
        "mainEntity": {
            "@type": "Organization",
            "name": "CodXpert",
            "url": "https://codxpert.com/",
            "email": "info@codxpert.com",
            "telephone": "+91 7979976451",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "House No. 119, I.T.C. Colony, Shankarpur",
                "addressLocality": "Munger",
                "addressRegion": "Bihar",
                "postalCode": "811201",
                "addressCountry": "IN"
            },
            "contactPoint": {
                "@type": "ContactPoint",
                "contactType": "Customer Support",
                "telephone": "+91 7979976451",
                "email": "info@codxpert.com",
                "availableLanguage": ["English", "Hindi"]
            }
        }
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
            --color-text-muted: #64748b;
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
            padding: 80px 0 50px;
            border-bottom: 1px solid #e2e8f0;
        }

        .card-custom {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.06);
            transition: all 0.2s ease;
        }

        .card-custom:hover {
            box-shadow: 0 20px 40px -15px rgba(2, 132, 199, 0.1);
        }

        .contact-icon-box {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: #e0f2fe;
            color: #0284c7;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .form-control-modern {
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .form-control-modern:focus {
            border-color: #0284c7;
            box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.1);
        }

        .btn-brand-primary {
            background: #0284c7;
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-brand-primary:hover {
            background: #0369a1;
            color: #fff;
            transform: translateY(-1px);
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

    <!-- Hero Banner -->
    <header class="hero-banner mt-5">
        <div class="container text-center pt-4">
            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-semibold mb-3">Enterprise Support & Demo Desk</span>
            <h1 class="display-5 fw-extrabold text-dark mb-3">How Can Our Engineering Team Help You?</h1>
            <p class="text-muted fs-6 mx-auto" style="max-width: 650px;">
                Whether you have questions regarding GST Rule 96A Letter of Undertaking (LUT) billing, automated Forex variance ledgering, or custom multi-tenant deployment, we are here to support your workflow.
            </p>
        </div>
    </header>

    <!-- Main Content Grid -->
    <main class="container py-5">
        <div class="row g-5">
            
            <!-- Left Column: Support Channels & Headquarters -->
            <div class="col-lg-5">
                <div class="d-flex flex-column gap-4">
                    
                    <div class="card-custom p-4">
                        <div class="d-flex align-items-start gap-3">
                            <div class="contact-icon-box flex-shrink-0">
                                <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <h5 class="fw-bold text-dark mb-1">Official Support & Legal Desk</h5>
                                <p class="text-muted fs-7 mb-2">Direct assistance for account verification, API issues, and statutory questions.</p>
                                <a href="mailto:info@codxpert.com" class="text-primary fw-semibold text-decoration-none">info@codxpert.com</a>
                                <div class="mt-2 text-muted fs-8 font-monospace">SLA: Under 24 Business Hours</div>
                            </div>
                        </div>
                    </div>

                    <div class="card-custom p-4">
                        <div class="d-flex align-items-start gap-3">
                            <div class="contact-icon-box flex-shrink-0" style="background:#dcfce7; color:#16a34a;">
                                <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.174.086.275.073.376-.044.101-.116.433-.506.549-.68.116-.173.231-.145.39-.086s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824z"/></svg>
                            </div>
                            <div>
                                <h5 class="fw-bold text-dark mb-1">Direct Phone & WhatsApp</h5>
                                <p class="text-muted fs-7 mb-2">Instant messaging and telephonic support for onboarding & technical queries.</p>
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <a href="tel:+917979976451" class="text-dark fw-bold text-decoration-none fs-6">+91 7979976451</a>
                                    <a href="https://wa.me/917979976451" target="_blank" rel="noopener" class="badge bg-success text-white text-decoration-none px-2 py-1 rounded">WhatsApp Chat →</a>
                                </div>
                                <div class="mt-1 text-muted fs-8 font-monospace">Mon – Sat, 9:30 AM to 6:30 PM IST</div>
                            </div>
                        </div>
                    </div>

                    <div class="card-custom p-4">
                        <div class="d-flex align-items-start gap-3">
                            <div class="contact-icon-box flex-shrink-0" style="background:#fef3c7; color:#d97706;">
                                <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                            <div>
                                <h5 class="fw-bold text-dark mb-1">Registered Headquarters</h5>
                                <p class="text-muted fs-7 mb-1 fw-semibold">COD XPERT</p>
                                <p class="text-muted fs-8 mb-1">House No. 119, I.T.C. Colony, Shankarpur, Munger, Bihar 811201, India</p>
                                <p class="text-muted fs-8 mb-2">Phone: +91 7979976451 · Email: info@codxpert.com</p>
                                <a href="https://codxpert.com/" target="_blank" rel="noopener" class="text-primary text-decoration-none fw-semibold fs-8">Visit CodXpert Corporate Site →</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Right Column: Interactive Contact Form -->
            <div class="col-lg-7">
                <div class="card-custom p-4 p-md-5">
                    <h4 class="fw-bold text-dark mb-2">Send Secure Inquiry</h4>
                    <p class="text-muted fs-7 mb-4">Complete the fields below and our engineering desk will respond with statutory guidance or demo access.</p>

                    <div id="contactAlert" class="alert alert-dismissible fade show" role="alert" style="display:none;"></div>

                    <form id="contactFormDesk">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="contactName" class="form-label fs-7 fw-semibold text-dark">Full Name <span class="text-danger">*</span></label>
                                <input type="text" id="contactName" name="name" class="form-control form-control-modern" placeholder="e.g. Rahul Sharma" required>
                            </div>

                            <div class="col-md-6">
                                <label for="contactEmail" class="form-label fs-7 fw-semibold text-dark">Work Email <span class="text-danger">*</span></label>
                                <input type="email" id="contactEmail" name="email" class="form-control form-control-modern" placeholder="rahul@company.com" required>
                            </div>

                            <div class="col-md-6">
                                <label for="contactCompany" class="form-label fs-7 fw-semibold text-dark">Company / Organization</label>
                                <input type="text" id="contactCompany" name="company" class="form-control form-control-modern" placeholder="e.g. Apex Exports Pvt Ltd">
                            </div>

                            <div class="col-md-6">
                                <label for="contactPhone" class="form-label fs-7 fw-semibold text-dark">Phone / WhatsApp</label>
                                <input type="tel" id="contactPhone" name="phone" class="form-control form-control-modern" placeholder="+91 98765 43210">
                            </div>

                            <div class="col-12">
                                <label for="contactInquiryType" class="form-label fs-7 fw-semibold text-dark">Inquiry Category</label>
                                <select id="contactInquiryType" name="inquiry_type" class="form-select form-control-modern">
                                    <option value="GST LUT Exemption & 0% IGST Billing">GST LUT Exemption & 0% IGST Billing</option>
                                    <option value="Forex Variance & FIRC / e-BRC Reconciliation">Forex Variance & FIRC / e-BRC Reconciliation</option>
                                    <option value="Custom Corporate SMTP Mailer Setup">Custom Corporate SMTP Mailer Setup</option>
                                    <option value="Monthly GSTR-1 Tax Portal Export">Monthly GSTR-1 Tax Portal Export</option>
                                    <option value="Multi-Currency Engine (USD, AED, EUR, GBP)">Multi-Currency Engine (USD, AED, EUR, GBP)</option>
                                    <option value="Business Expense & ITC Tracker">Business Expense & ITC Tracker</option>
                                    <option value="Enterprise Custom Deployment & Demo">Enterprise Custom Deployment & Demo</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="contactMessage" class="form-label fs-7 fw-semibold text-dark">Message Details <span class="text-danger">*</span></label>
                                <textarea id="contactMessage" name="message" class="form-control form-control-modern" rows="5" placeholder="Please outline your cross-border billing workflow, team size, or integration requirements..." required></textarea>
                            </div>

                            <div class="col-12 pt-2">
                                <button type="submit" id="submitBtnDesk" class="btn-brand-primary w-100 py-3">
                                    <span id="btnTextDesk">Submit Inquiry →</span>
                                    <span id="btnSpinnerDesk" class="spinner-border spinner-border-sm ms-2" role="status" style="display:none;"></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <!-- Enterprise Advisory & Integration Desk -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mt-5 mb-5">
            <h3 class="fw-bold text-dark mb-4 text-center">Enterprise Onboarding & Statutory Migration Advisory Services</h3>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="p-4 rounded-3 bg-light h-100 border">
                        <div class="badge bg-primary text-white rounded-pill mb-2 px-3 py-1">Service 1</div>
                        <h5 class="fw-bold text-dark mb-2">Custom Corporate SMTP Setup</h5>
                        <p class="text-muted fs-7 mb-0">Our engineering team assists with DNS record authentication (DKIM, SPF, DMARC) so your corporate emails dispatch directly through Google Workspace, Microsoft 365, or Amazon SES with zero spam penalties.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 rounded-3 bg-light h-100 border">
                        <div class="badge bg-primary text-white rounded-pill mb-2 px-3 py-1">Service 2</div>
                        <h5 class="fw-bold text-dark mb-2">Chartered Accountant Consultation</h5>
                        <p class="text-muted fs-7 mb-0">Need guidance on Letter of Undertaking (LUT) renewals or GSTR-1 Table 6A reconciliation? We coordinate directly with your accounting department to ensure seamless tax audits.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 rounded-3 bg-light h-100 border">
                        <div class="badge bg-primary text-white rounded-pill mb-2 px-3 py-1">Service 3</div>
                        <h5 class="fw-bold text-dark mb-2">Multi-Entity & Branch Hierarchy</h5>
                        <p class="text-muted fs-7 mb-0">For companies with operations across multiple states or international subsidiaries, we configure segregated company profiles, custom invoice prefixes, and isolated audit logs.</p>
                    </div>
                </div>
            </div>
        </div>


        <!-- Regulatory Advisory Consultation Framework -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h3 class="fw-bold text-dark mb-3 text-center">Statutory Invoicing Advisory for Exporters & Chartered Accountants</h3>
            <p class="text-muted text-center fs-7 mx-auto mb-4" style="max-width: 720px;">
                Navigating cross-border tax compliance, bank foreign remittances, and GST zero-rating requires specialist knowledge. Our compliance engineering team works directly with finance heads and CAs.
            </p>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-4 border rounded-3 h-100 bg-light">
                        <h5 class="fw-bold text-dark mb-2">FEMA 23(R) & AD Bank Remittance Alignment</h5>
                        <p class="text-muted fs-7 mb-3">If your bank Authorized Dealer (AD Category-I) desk requires specific export realization schedules, purpose codes (e.g., P0802 for software services or P1007 for management consultancy), or consolidated export invoices, our compliance desk provides immediate technical assistance.</p>
                        <a href="{{ route('guides.fema-23r') }}" class="text-primary fw-bold fs-7 text-decoration-none">Review the Complete FEMA 23(R) Guide →</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 border rounded-3 h-100 bg-light">
                        <h5 class="fw-bold text-dark mb-2">Rule 96A Letter of Undertaking (LUT) Assistance</h5>
                        <p class="text-muted fs-7 mb-3">Filing your annual Form GST RFD-11 renewal or correcting past export invoice declarations? We provide pre-built templates, statutory wording checks, and GSTR-1 Table 6A reconciliation spreadsheets to resolve queries promptly.</p>
                        <a href="{{ route('guides.gst-lut') }}" class="text-primary fw-bold fs-7 text-decoration-none">Read the Complete GST LUT Rule 96A Guide →</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact & Enterprise Consultation FAQs -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h3 class="fw-bold text-dark mb-4 text-center">Frequently Asked Questions: Contact & Technical Support</h3>
            <div class="row g-4">
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">What is the guaranteed response time for technical inquiries?</h6>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">Can our company request an in-person or virtual product walkthrough?</h6>
                    <p class="text-muted fs-7">Yes. Our solutions engineering team hosts live interactive Zoom/Google Meet walkthroughs tailored to your finance department, demonstrating multi-currency ledgers, automated email setups, and GSTR-1 export workflows.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">Where is COD XPERT headquartered in India?</h6>
                    <p class="text-muted fs-7">COD XPERT operates from House No. 119, I.T.C. Colony, Shankarpur, Munger, Bihar 811201, India, providing software engineering and statutory billing solutions to clients across India and globally.</p>
                </div>

                    <p class="text-muted fs-7">Our support engineers review all incoming inquiries within 24 hours on business days. Enterprise tier clients receive priority 4-hour response SLAs with dedicated account managers.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">Can CodXpert help us migrate from Zoho, Tally, or Excel spreadsheets?</h6>
                    <p class="text-muted fs-7">Yes. We provide automated CSV data ingestion tools and dedicated onboarding support to import your client contacts, item catalogs, and historical balances without operational downtime.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">Is phone or WhatsApp support available?</h6>
                    <p class="text-muted fs-7">Yes. You can contact our direct advisory line at +91 7979976451 during standard business hours (10:00 AM – 6:30 PM IST, Monday through Saturday) or request an executive callback.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">How can our Chartered Accountant connect with CodXpert?</h6>
                    <p class="text-muted fs-7">Select 'Monthly GSTR-1 Tax Portal Export' in the inquiry category above and include your firm's contact details. Our statutory compliance team will schedule an orientation call.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">Can we request custom feature developments or private API integrations?</h6>
                    <p class="text-muted fs-7">Yes. Enterprise customers can request customized ERP sync connectors, automated banking webhooks, and private API access tailored to internal treasury workflows.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">What security standards apply to contact submissions?</h6>
                    <p class="text-muted fs-7">All contact desk submissions are encrypted in transit via TLS 1.3 and processed in full compliance with the Digital Personal Data Protection (DPDP) Act 2023.</p>
                </div>
            </div>
        </div>

        <!-- Contact Resource Hub -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h4 class="fw-bold text-dark mb-3 text-center">Explore Self-Service Invoicing Resources & Guides</h4>
            <div class="row g-3 text-center">
                <div class="col-6 col-md-3">
                    <a href="{{ route('tools.invoice-generator') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">Instant Generator</div>
                        <span class="text-muted fs-8">Free browser PDF tool</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('pricing') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">Pricing & Plans</div>
                        <span class="text-muted fs-8">Compare platform tiers</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('guides.gst-lut') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">GST LUT Guide</div>
                        <span class="text-muted fs-8">Rule 96A export zero-rating</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('guides.fema-23r') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">FEMA 23(R) Guide</div>
                        <span class="text-muted fs-8">Bank remittance filing</span>
                    </a>
                </div>
            </div>
        </div>

    </main>

    <!-- Footer -->
    @include('partials.public_footer')
    <script>
        document.getElementById('contactFormDesk').addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = document.getElementById('submitBtnDesk');
            const btnText = document.getElementById('btnTextDesk');
            const spinner = document.getElementById('btnSpinnerDesk');
            const alertBox = document.getElementById('contactAlert');

            btn.disabled = true;
            btnText.textContent = 'Transmitting Secure Inquiry...';
            spinner.style.display = 'inline-block';
            alertBox.style.display = 'none';

            const payload = {
                name: document.getElementById('contactName').value.trim(),
                email: document.getElementById('contactEmail').value.trim(),
                company: document.getElementById('contactCompany').value.trim(),
                phone: document.getElementById('contactPhone').value.trim(),
                inquiry_type: document.getElementById('contactInquiryType').value,
                subject: document.getElementById('contactInquiryType').value,
                message: document.getElementById('contactMessage').value.trim()
            };

            fetch('{{ route("contact") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(data => {
                alertBox.className = 'alert alert-success';
                alertBox.textContent = '✓ ' + (data.message || 'Thank you! Your inquiry has been received.');
                alertBox.style.display = 'block';
                document.getElementById('contactFormDesk').reset();
            })
            .catch(err => {
                alertBox.className = 'alert alert-danger';
                alertBox.textContent = '✕ Error submitting inquiry. Please try again or email info@codxpert.com directly.';
                alertBox.style.display = 'block';
            })
            .finally(() => {
                btn.disabled = false;
                btnText.textContent = 'Submit Inquiry →';
                spinner.style.display = 'none';
            });
        });
    </script>
</body>
</html>
