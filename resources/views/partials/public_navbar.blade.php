<!-- Global Public Navigation Bar -->
<style>
    .navbar-public {
        background: rgba(255, 255, 255, 0.94);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        border-bottom: 1px solid rgba(226, 232, 240, 0.85);
        transition: all 0.25s ease;
        padding: 12px 0;
        z-index: 1050;
    }
    .navbar-public .nav-link {
        color: #334155;
        font-weight: 500;
        font-size: 14px;
        padding: 8px 14px !important;
        border-radius: 8px;
        transition: all 0.2s ease;
    }
    .navbar-public .nav-link:hover,
    .navbar-public .nav-link:focus,
    .navbar-public .nav-link.active {
        color: #0284c7;
        background-color: rgba(2, 132, 199, 0.05);
    }
    .dropdown-menu-modern {
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        box-shadow: 0 20px 40px -15px rgba(15, 23, 42, 0.12);
        padding: 10px;
        min-width: 270px;
        background: #ffffff;
        animation: navDropdownFade 0.2s cubic-bezier(0.16, 1, 0.3, 1);
    }
    @keyframes navDropdownFade {
        from { opacity: 0; transform: translateY(6px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .dropdown-item-modern {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 10px 12px;
        border-radius: 10px;
        color: #0f172a;
        text-decoration: none;
        transition: all 0.15s ease;
    }
    .dropdown-item-modern:hover {
        background: #f8fafc;
        color: #0284c7;
    }
    .dropdown-item-modern .item-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
        transition: all 0.15s ease;
    }
    .dropdown-item-modern:hover .item-icon {
        background: #e0f2fe;
        color: #0284c7;
    }
    .dropdown-item-modern .item-title {
        font-weight: 600;
        font-size: 13.5px;
        line-height: 1.25;
        margin-bottom: 2px;
    }
    .dropdown-item-modern .item-desc {
        font-size: 11.5px;
        color: #64748b;
        line-height: 1.35;
        margin-bottom: 0;
    }
    @media (min-width: 992px) {
        .navbar-public .dropdown:hover > .dropdown-menu {
            display: block;
        }
    }
    @media print {
        .no-print {
            display: none !important;
        }
    }
</style>

<nav class="navbar navbar-expand-lg navbar-public fixed-top no-print">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center gap-2 text-decoration-none me-3" href="{{ url('/') }}">
            <img src="{{ asset('images/codxpert-logo.png') }}" alt="CodXpert" style="height: 36px; width: auto; object-fit: contain;">
            <span class="fw-bold text-dark fs-5 tracking-tight">Invoices</span>
        </a>

        <!-- Mobile Toggler -->
        <button class="navbar-toggler border-0 shadow-none p-1" type="button" data-bs-toggle="collapse" data-bs-target="#publicNavDropdown" aria-controls="publicNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Menu Links -->
        <div class="collapse navbar-collapse" id="publicNavDropdown">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-lg-1">
                
                <!-- 1. Features Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-1" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span>Features</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-modern" style="min-width: 320px;">
                        <a href="{{ route('features.e-invoicing') }}" class="dropdown-item-modern">
                            <div class="item-icon">⚡</div>
                            <div>
                                <div class="item-title">E-Invoicing & GST Compliance</div>
                                <div class="item-desc">IRN generation, QR codes & 0% IGST export compliance.</div>
                            </div>
                        </a>
                        <a href="{{ route('features.recurring-invoices') }}" class="dropdown-item-modern">
                            <div class="item-icon">🔄</div>
                            <div>
                                <div class="item-title">Recurring Invoices & Retainers</div>
                                <div class="item-desc">Autopilot billing cadence with scheduled PDF dispatch.</div>
                            </div>
                        </a>
                        <a href="{{ route('features.invoice-tracking') }}" class="dropdown-item-modern">
                            <div class="item-icon">📊</div>
                            <div>
                                <div class="item-title">Invoice Tracking & Telemetry</div>
                                <div class="item-desc">Real-time view receipts, aging analysis & auto-reminders.</div>
                            </div>
                        </a>
                        <a href="{{ route('features.multi-currency') }}" class="dropdown-item-modern">
                            <div class="item-icon">🌍</div>
                            <div>
                                <div class="item-title">Multi-Currency & Live Forex</div>
                                <div class="item-desc">USD, EUR, AED conversion with bank spread tracking.</div>
                            </div>
                        </a>
                        <a href="{{ route('features.quotations') }}" class="dropdown-item-modern">
                            <div class="item-icon">📄</div>
                            <div>
                                <div class="item-title">Quotations to Invoices</div>
                                <div class="item-desc">Instant 1-click conversion from approved client estimates.</div>
                            </div>
                        </a>
                    </div>
                </li>

                <!-- 2. Solutions Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-1" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span>Solutions</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-modern" style="min-width: 300px;">
                        <a href="{{ route('for.small-business') }}" class="dropdown-item-modern">
                            <div class="item-icon">🏢</div>
                            <div>
                                <div class="item-title">Small Businesses</div>
                                <div class="item-desc">Fast, cloud-based GST billing without ERP bloat.</div>
                            </div>
                        </a>
                        <a href="{{ route('for.agencies') }}" class="dropdown-item-modern">
                            <div class="item-icon">🎨</div>
                            <div>
                                <div class="item-title">Digital & Creative Agencies</div>
                                <div class="item-desc">Manage client retainers and cross-border billing.</div>
                            </div>
                        </a>
                        <a href="{{ route('for.consultants') }}" class="dropdown-item-modern">
                            <div class="item-icon">💼</div>
                            <div>
                                <div class="item-title">Independent Consultants</div>
                                <div class="item-desc">Hourly rates, fractional CXO & advisory retainers.</div>
                            </div>
                        </a>
                        <a href="{{ route('for.freelancers') }}" class="dropdown-item-modern">
                            <div class="item-icon">💻</div>
                            <div>
                                <div class="item-title">Freelancers</div>
                                <div class="item-desc">Sleek international invoices with foreign wire details.</div>
                            </div>
                        </a>
                        <a href="{{ route('for.contractors') }}" class="dropdown-item-modern">
                            <div class="item-icon">🔨</div>
                            <div>
                                <div class="item-title">Contractors</div>
                                <div class="item-desc">Milestone billing, expense logs & statutory compliance.</div>
                            </div>
                        </a>
                    </div>
                </li>

                <!-- 3. Free Tools & Templates Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-1" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span>Tools & Templates</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-modern" style="min-width: 310px;">
                        <a href="{{ route('free-invoice-generator') }}" class="dropdown-item-modern">
                            <div class="item-icon" style="background:#e0f2fe; color:#0284c7;">🚀</div>
                            <div>
                                <div class="item-title d-flex align-items-center gap-2">
                                    <span>Free Invoice Generator</span>
                                    <span class="badge bg-primary text-white" style="font-size: 10px;">Instant</span>
                                </div>
                                <div class="item-desc">Create and download PDF invoices with zero login.</div>
                            </div>
                        </a>
                        <a href="{{ route('tools.forex-calculator') }}" class="dropdown-item-modern">
                            <div class="item-icon">🧮</div>
                            <div>
                                <div class="item-title">Forex & Remittance Calculator</div>
                                <div class="item-desc">Interactive calculator with live RBI exchange benchmarks.</div>
                            </div>
                        </a>
                        <a href="{{ route('templates.word') }}" class="dropdown-item-modern">
                            <div class="item-icon">📝</div>
                            <div>
                                <div class="item-title">Word Invoice Templates (.docx)</div>
                                <div class="item-desc">Curated corporate and minimalist blank templates.</div>
                            </div>
                        </a>
                        <a href="{{ route('templates.excel') }}" class="dropdown-item-modern">
                            <div class="item-icon">📊</div>
                            <div>
                                <div class="item-title">Excel Invoice Templates (.xlsx)</div>
                                <div class="item-desc">Automated spreadsheets with built-in tax formulas.</div>
                            </div>
                        </a>
                    </div>
                </li>

                <!-- 4. Guides & Compare Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-1" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span>Guides & Compare</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-modern" style="min-width: 320px;">
                        <a href="{{ route('guide.gst-lut') }}" class="dropdown-item-modern">
                            <div class="item-icon">📜</div>
                            <div>
                                <div class="item-title">GST LUT Rule 96A Masterclass</div>
                                <div class="item-desc">How to file RFD-11 & export at 0% tax without IGST.</div>
                            </div>
                        </a>
                        <a href="{{ route('guide.firc-e-brc') }}" class="dropdown-item-modern">
                            <div class="item-icon">🏦</div>
                            <div>
                                <div class="item-title">FIRC & e-BRC Reconciliation Guide</div>
                                <div class="item-desc">Reconcile inward wires and self-certify on DGFT.</div>
                            </div>
                        </a>
                        <div class="dropdown-divider my-1"></div>
                        <a href="{{ route('vs.zoho-invoice') }}" class="dropdown-item-modern">
                            <div class="item-icon">⚖️</div>
                            <div>
                                <div class="item-title">CodXpert vs Zoho Invoice</div>
                                <div class="item-desc">Dedicated exporter invoicing vs multi-app suite.</div>
                            </div>
                        </a>
                        <a href="{{ route('vs.tally-prime') }}" class="dropdown-item-modern">
                            <div class="item-icon">🖥️</div>
                            <div>
                                <div class="item-title">CodXpert vs Tally Prime</div>
                                <div class="item-desc">Cloud-native mobile billing vs desktop accounting.</div>
                            </div>
                        </a>
                    </div>
                </li>

                <!-- Direct Links -->
                <li class="nav-item"><a class="nav-link" href="{{ route('pricing') }}">Pricing</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('contact.view') }}">Contact Desk</a></li>
            </ul>

            <!-- Auth Buttons -->
            <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm px-3 rounded-pill fw-semibold">Dashboard →</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-sm px-3 rounded-pill fw-medium">Sign In</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm px-3 rounded-pill fw-semibold" style="background: linear-gradient(135deg, #0284c7, #2563eb); border:none;">Get Started Free</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
