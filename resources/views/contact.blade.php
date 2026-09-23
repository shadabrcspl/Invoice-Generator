<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Contact & Enterprise Demo Desk | Cod Xpert Invoices</title>
    <meta name="description" content="Get in touch with Cod Xpert Invoices for enterprise deployment, custom SMTP setup, GST LUT compliance consulting, or technical support. Guaranteed 24-hour SLA.">
    <meta name="keywords" content="contact codxpert, invoice software support, GST LUT inquiry, exporter software consultation, enterprise invoicing demo">
    <link rel="canonical" href="{{ url('/contact') }}">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/contact') }}">
    <meta property="og:title" content="Contact & Enterprise Demo Desk | Cod Xpert Invoices">
    <meta property="og:description" content="Reach our statutory compliance engineering team for enterprise deployment and technical support.">

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
            "email": "support@codxpert.com",
            "contactPoint": {
                "@type": "ContactPoint",
                "contactType": "Customer Support",
                "email": "support@codxpert.com",
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
                    <li class="nav-item"><a class="nav-link text-muted" href="{{ route('for.contractors') }}">For Contractors</a></li>
                    <li class="nav-item"><a class="nav-link text-primary fw-bold" href="{{ route('contact.view') }}">Contact</a></li>
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
                                <a href="mailto:support@codxpert.com" class="text-primary fw-semibold text-decoration-none">support@codxpert.com</a>
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
                                <h5 class="fw-bold text-dark mb-1">WhatsApp Fast Connect</h5>
                                <p class="text-muted fs-7 mb-2">Instant messaging for quick onboarding and technical consultations.</p>
                                <span class="badge bg-success-subtle text-success px-2 py-1 rounded">Fast WhatsApp Support</span>
                                <div class="mt-2 text-muted fs-8 font-monospace">Mon – Sat, 9:30 AM to 6:30 PM IST</div>
                            </div>
                        </div>
                    </div>

                    <div class="card-custom p-4">
                        <div class="d-flex align-items-start gap-3">
                            <div class="contact-icon-box flex-shrink-0" style="background:#fef3c7; color:#d97706;">
                                <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                            <div>
                                <h5 class="fw-bold text-dark mb-1">Engineering Headquarters</h5>
                                <p class="text-muted fs-7 mb-1">COD XPERT Digital Technologies</p>
                                <p class="text-muted fs-8 mb-1">Neelam Cinema Road, Gandhi Chowk, India</p>
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
                    <a href="{{ route('free-invoice-generator') }}" class="text-muted text-decoration-none">Free Generator</a>
                    <a href="{{ route('terms') }}" class="text-muted text-decoration-none">Terms</a>
                    <a href="{{ route('privacy') }}" class="text-muted text-decoration-none">Privacy</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
                alertBox.textContent = '✕ Error submitting inquiry. Please try again or email support@codxpert.com directly.';
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
