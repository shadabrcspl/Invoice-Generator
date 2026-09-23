<!-- Global Public Footer Component -->
<style>
    .footer-comprehensive {
        background: #0f172a;
        color: #94a3b8;
        padding: 70px 0 30px;
        border-top: 1px solid #1e293b;
        font-size: 13.5px;
    }
    .footer-comprehensive h6 {
        color: #f8fafc;
        font-family: var(--font-heading, 'Outfit', sans-serif);
        font-weight: 700;
        font-size: 14px;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        margin-bottom: 20px;
    }
    .footer-comprehensive ul {
        list-style: none;
        padding-left: 0;
        margin-bottom: 0;
    }
    .footer-comprehensive ul li {
        margin-bottom: 11px;
    }
    .footer-comprehensive ul li a {
        color: #94a3b8;
        text-decoration: none;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .footer-comprehensive ul li a:hover {
        color: #38bdf8;
        transform: translateX(2px);
    }
    .footer-contact-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 12px;
        color: #cbd5e1;
        font-size: 13px;
        line-height: 1.5;
    }
    .footer-contact-item a {
        color: #38bdf8;
        text-decoration: none;
    }
    .footer-contact-item a:hover {
        text-decoration: underline;
    }
    .footer-bottom-bar {
        border-top: 1px solid #1e293b;
        padding-top: 28px;
        margin-top: 50px;
        font-size: 12.5px;
        color: #64748b;
    }
    .footer-bottom-bar a {
        color: #94a3b8;
        text-decoration: none;
        transition: color 0.15s ease;
    }
    .footer-bottom-bar a:hover {
        color: #38bdf8;
    }
    .compliance-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(2, 132, 199, 0.12);
        color: #38bdf8;
        border: 1px solid rgba(2, 132, 199, 0.3);
        padding: 4px 10px;
        border-radius: 50px;
        font-size: 11.5px;
        font-weight: 600;
    }
    @media print {
        .no-print {
            display: none !important;
        }
    }
</style>

<footer class="footer-comprehensive no-print">
    <div class="container">
        <div class="row g-4 g-lg-5">
            
            <!-- Column 1: Brand & Contact Info -->
            <div class="col-lg-4 col-md-6">
                <a class="d-inline-flex align-items-center gap-2 text-decoration-none mb-3" href="{{ url('/') }}">
                    <img src="{{ asset('images/codxpert-logo.png') }}" alt="CodXpert" style="height: 38px; width: auto; object-fit: contain; filter: brightness(1.2);">
                    <span class="fw-bold text-white fs-4">Invoices</span>
                </a>
                <p class="text-slate-400 fs-7 mb-4 leading-relaxed">
                    Enterprise statutory multi-currency foreign invoicing, GST LUT zero-rated compliance, and real-time Forex reconciliation platform. Built by <a href="https://codxpert.com/" target="_blank" rel="noopener" class="text-info text-decoration-none fw-semibold">CodXpert</a>.
                </p>

                <!-- Official Business Details -->
                <div class="d-flex flex-column gap-2 mb-3">
                    <div class="footer-contact-item">
                        <span class="text-info">📍</span>
                        <span>House No. 119, I.T.C. Colony, Shankarpur, Munger, Bihar 811201, India</span>
                    </div>
                    <div class="footer-contact-item">
                        <span class="text-info">📞</span>
                        <div>
                            <a href="tel:+917979976451" class="fw-bold text-white">+91 7979976451</a>
                            <span class="text-slate-400 fs-8 d-block">Mon – Sat, 9:30 AM to 6:30 PM IST</span>
                        </div>
                    </div>
                    <div class="footer-contact-item">
                        <span class="text-info">✉️</span>
                        <div>
                            <a href="mailto:info@codxpert.com" class="fw-semibold">info@codxpert.com</a>
                            <span class="text-slate-400 fs-8 d-block">Guaranteed 24-hr Response SLA</span>
                        </div>
                    </div>
                    <div class="footer-contact-item">
                        <span class="text-success">💬</span>
                        <a href="https://wa.me/917979976451" target="_blank" rel="noopener" class="text-success fw-semibold">Chat on WhatsApp →</a>
                    </div>
                </div>

                <div class="compliance-pill mt-2">
                    <span>🛡️</span> DPDP Act 2023 & GST LUT Certified
                </div>
            </div>

            <!-- Column 2: Core Feature Pillars -->
            <div class="col-lg-2 col-md-6 col-6">
                <h6>Features</h6>
                <ul>
                    <li><a href="{{ route('features.e-invoicing') }}">E-Invoicing & GST</a></li>
                    <li><a href="{{ route('features.recurring-invoices') }}">Recurring Invoices</a></li>
                    <li><a href="{{ route('features.invoice-tracking') }}">Invoice Tracking</a></li>
                    <li><a href="{{ route('features.multi-currency') }}">Multi-Currency & Forex</a></li>
                    <li><a href="{{ route('features.quotations') }}">Quotes to Invoices</a></li>
                    <li><a href="{{ url('/') }}#features">Custom SMTP Mailer</a></li>
                    <li><a href="{{ url('/') }}#architecture">Audit & Archival Engine</a></li>
                </ul>
            </div>

            <!-- Column 3: Solutions by Industry -->
            <div class="col-lg-2 col-md-6 col-6">
                <h6>Solutions</h6>
                <ul>
                    <li><a href="{{ route('for.small-business') }}">For Small Business</a></li>
                    <li><a href="{{ route('for.agencies') }}">For Digital Agencies</a></li>
                    <li><a href="{{ route('for.consultants') }}">For Consultants</a></li>
                    <li><a href="{{ route('for.freelancers') }}">For Freelancers</a></li>
                    <li><a href="{{ route('for.contractors') }}">For Contractors</a></li>
                    <li><a href="{{ url('/') }}">For Global Exporters</a></li>
                </ul>
            </div>

            <!-- Column 4: Free Tools & Templates -->
            <div class="col-lg-2 col-md-6 col-6">
                <h6>Free Tools</h6>
                <ul>
                    <li>
                        <a href="{{ route('free-invoice-generator') }}">
                            <span>Invoice Generator</span>
                            <span class="badge bg-primary text-white" style="font-size: 9px;">Free</span>
                        </a>
                    </li>
                    <li><a href="{{ route('tools.forex-calculator') }}">Forex Calculator</a></li>
                    <li><a href="{{ route('templates.word') }}">Word Templates (.docx)</a></li>
                    <li><a href="{{ route('templates.excel') }}">Excel Templates (.xlsx)</a></li>
                    <li><a href="{{ url('/') }}#simulator">Live Forex Sandbox</a></li>
                </ul>
            </div>

            <!-- Column 5: Statutory Guides & Comparison -->
            <div class="col-lg-2 col-md-6 col-6">
                <h6>Resources</h6>
                <ul>
                    <li><a href="{{ route('guide.gst-lut') }}">GST LUT Rule 96A Guide</a></li>
                    <li><a href="{{ route('guide.firc-e-brc') }}">FIRC & e-BRC Guide</a></li>
                    <li><a href="{{ route('vs.zoho-invoice') }}">vs Zoho Invoice</a></li>
                    <li><a href="{{ route('vs.tally-prime') }}">vs Tally Prime</a></li>
                    <li><a href="{{ route('pricing') }}">Pricing & Plans</a></li>
                    <li><a href="{{ route('contact.view') }}">Enterprise Contact Desk</a></li>
                    <li><a href="https://codxpert.com/" target="_blank" rel="noopener">CodXpert Corporate ↗</a></li>
                </ul>
            </div>

        </div>

        <!-- Footer Bottom Bar -->
        <div class="footer-bottom-bar d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <div class="text-center text-md-start">
                © {{ date('Y') }} <a href="https://codxpert.com/" target="_blank" rel="noopener" class="text-white fw-semibold">CodXpert</a> (<a href="https://codxpert.com/" target="_blank" rel="noopener" class="text-slate-400">codxpert.com</a>). All rights reserved.
            </div>
            <div class="d-flex flex-wrap justify-content-center gap-3 font-mono">
                <a href="{{ route('privacy') }}">Privacy Policy</a>
                <span>·</span>
                <a href="{{ route('terms') }}">Terms of Use</a>
                <span>·</span>
                <a href="{{ route('contact.view') }}">Contact Desk</a>
                <span>·</span>
                <a href="{{ url('/sitemap.xml') }}">Sitemap</a>
                <span>·</span>
                <a href="{{ url('/llms.txt') }}">LLMs.txt</a>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap 5 JavaScript Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

