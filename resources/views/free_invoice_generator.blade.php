<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Free Online Invoice Generator | Instant PDF Download | Cod Xpert</title>
    <meta name="description" content="Create and download professional invoices instantly in any currency (USD, EUR, INR, AED, GBP). Free online invoice maker with 0% IGST LUT export support. No sign-up required.">
    <meta name="keywords" content="free invoice generator, create invoice free, free invoice maker online, instant invoice pdf, international invoice generator">
    <link rel="canonical" href="{{ url('/free-invoice-generator') }}">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/free-invoice-generator') }}">
    <meta property="og:title" content="Free Online Invoice Generator | Instant PDF Download">
    <meta property="og:description" content="Generate beautiful, multi-currency export invoices in seconds. Download PDF instantly with zero registration required.">

    <!-- Schema.org WebApplication -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebApplication",
        "name": "Cod Xpert Free Invoice Generator",
        "url": "https://invoice.codxpert.com/free-invoice-generator",
        "applicationCategory": "BusinessApplication",
        "operatingSystem": "All",
        "offers": {
            "@type": "Offer",
            "price": "0.00",
            "priceCurrency": "USD"
        },
        "description": "Free web-based invoice maker supporting multi-currency billing, GST LUT declarations, and instant client-side PDF downloads."
    }
    </script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --font-main: 'Plus Jakarta Sans', sans-serif;
            --font-heading: 'Outfit', sans-serif;
            --font-mono: 'JetBrains Mono', monospace;
            --bg-body: #f8fafc;
            --color-primary: #0284c7;
            --color-primary-hover: #0369a1;
            --color-text-main: #0f172a;
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
            background: rgba(255, 255, 255, 0.95);
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

        .invoice-sheet {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            box-shadow: 0 15px 35px -10px rgba(15, 23, 42, 0.08);
            padding: 40px;
            margin-bottom: 30px;
        }

        .form-control-sheet {
            border: 1px solid transparent;
            background: #f8fafc;
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 14px;
            transition: all 0.2s;
        }

        .form-control-sheet:focus {
            background: #ffffff;
            border-color: #0284c7;
            box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1);
        }

        .table-items th {
            background: #f1f5f9;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #475569;
            border-bottom: 1px solid #cbd5e1;
            padding: 10px 12px;
        }

        .table-items td {
            padding: 8px 6px;
            vertical-align: middle;
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
            cursor: pointer;
        }

        .btn-brand-primary:hover {
            background: #0369a1;
            color: #fff;
            transform: translateY(-1px);
        }

        .summary-box {
            background: #f8fafc;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #e2e8f0;
        }

        /* Specialized Print Stylesheet for Instant Clean PDF Export */
        @media print {
            body {
                background: #ffffff !important;
                color: #000000 !important;
            }
            .no-print, .navbar-custom, .hero-banner, .footer-modern, .cta-banner {
                display: none !important;
            }
            .invoice-sheet {
                border: none !important;
                box-shadow: none !important;
                padding: 0 !important;
                margin: 0 !important;
                width: 100% !important;
            }
            .form-control-sheet {
                background: transparent !important;
                border: none !important;
                padding: 0 !important;
            }
            .btn-remove-row, .btn-add-row {
                display: none !important;
            }
        }
    </style>
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top no-print">
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
                    <li class="nav-item"><a class="nav-link text-primary fw-bold" href="{{ route('free-invoice-generator') }}"><span class="badge bg-primary-subtle text-primary me-1">Free</span> Generator</a></li>
                    <li class="nav-item"><a class="nav-link text-muted" href="{{ route('for.freelancers') }}">For Freelancers</a></li>
                    <li class="nav-item"><a class="nav-link text-muted" href="{{ route('for.contractors') }}">For Contractors</a></li>
                    <li class="nav-item"><a class="nav-link text-muted" href="{{ route('contact.view') }}">Contact</a></li>
                </ul>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-sm px-3 rounded-pill">Sign In</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm px-3 rounded-pill">Get Started</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header Banner -->
    <header class="py-5 mt-5 text-center no-print" style="background: linear-gradient(180deg, #f0f9ff 0%, #f8fafc 100%);">
        <div class="container pt-4">
            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-semibold mb-2">100% Free · No Registration Required</span>
            <h1 class="display-6 fw-extrabold text-dark mb-2">Free Online Invoice Generator</h1>
            <p class="text-muted fs-6 mx-auto mb-0" style="max-width: 600px;">
                Fill in your details below, choose your currency, and click Print / Download PDF. Works instantly in your browser.
            </p>
        </div>
    </header>

    <!-- Main Generator Workspace -->
    <main class="container py-4">
        
        <!-- Action Toolbar -->
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4 no-print">
            <div class="d-flex align-items-center gap-2">
                <label for="currencySelect" class="fw-semibold fs-7 text-dark">Currency:</label>
                <select id="currencySelect" class="form-select form-select-sm rounded-pill fw-bold" style="width: 140px;">
                    <option value="USD" data-symbol="$" data-rate="{{ $rates['USD'] }}">USD ($)</option>
                    <option value="EUR" data-symbol="€" data-rate="{{ $rates['EUR'] }}">EUR (€)</option>
                    <option value="GBP" data-symbol="£" data-rate="{{ $rates['GBP'] }}">GBP (£)</option>
                    <option value="AED" data-symbol="AED " data-rate="{{ $rates['AED'] }}">AED (د.إ)</option>
                    <option value="INR" data-symbol="₹" data-rate="1.0" selected>INR (₹)</option>
                    <option value="AUD" data-symbol="A$" data-rate="{{ $rates['AUD'] }}">AUD (A$)</option>
                    <option value="CAD" data-symbol="C$" data-rate="{{ $rates['CAD'] }}">CAD (C$)</option>
                </select>
            </div>

            <div class="d-flex align-items-center gap-2">
                <button type="button" onclick="window.print()" class="btn-brand-primary d-inline-flex align-items-center gap-2">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                    <span>Print / Save as PDF</span>
                </button>
            </div>
        </div>

        <!-- Editable Invoice Sheet -->
        <div class="invoice-sheet" id="invoiceArea">
            
            <!-- Top Header: Seller & Invoice Meta -->
            <div class="row g-4 justify-content-between mb-4 border-bottom pb-4">
                <div class="col-md-6">
                    <input type="text" id="sellerName" class="form-control-sheet fw-bold fs-4 text-dark mb-1 w-100" value="Your Business Name" placeholder="Your Business / Company Name">
                    <textarea id="sellerDetails" class="form-control-sheet text-muted fs-7 w-100" rows="3" placeholder="Address, City, Country&#10;GSTIN / Tax ID: 27AAAAA0000A1Z5&#10;Email: billing@yourdomain.com">Neelam Cinema Road, Gandhi Chowk, India&#10;GSTIN: 07AAAAA0000A1Z5&#10;Email: billing@codxpert.com</textarea>
                </div>
                <div class="col-md-5 text-md-end">
                    <h2 class="fw-extrabold text-primary mb-3">INVOICE</h2>
                    <div class="d-flex justify-content-md-end align-items-center gap-2 mb-2">
                        <span class="fs-7 text-muted fw-semibold">Invoice No:</span>
                        <input type="text" id="invNumber" class="form-control-sheet text-md-end fw-bold" style="width: 160px;" value="INV-2026-001">
                    </div>
                    <div class="d-flex justify-content-md-end align-items-center gap-2 mb-2">
                        <span class="fs-7 text-muted fw-semibold">Date:</span>
                        <input type="date" id="invDate" class="form-control-sheet text-md-end" style="width: 160px;" value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="d-flex justify-content-md-end align-items-center gap-2">
                        <span class="fs-7 text-muted fw-semibold">Due Date:</span>
                        <input type="date" id="invDueDate" class="form-control-sheet text-md-end" style="width: 160px;" value="{{ date('Y-m-d', strtotime('+15 days')) }}">
                    </div>
                </div>
            </div>

            <!-- Bill To & Statutory LUT -->
            <div class="row g-4 justify-content-between mb-4">
                <div class="col-md-6">
                    <div class="fs-8 text-uppercase tracking-wider fw-bold text-muted mb-1">Bill To (Client)</div>
                    <input type="text" id="clientName" class="form-control-sheet fw-bold fs-5 text-dark mb-1 w-100" value="Acme International LLC" placeholder="Client Name / Organization">
                    <textarea id="clientDetails" class="form-control-sheet text-muted fs-7 w-100" rows="3" placeholder="Client Address, Country, Tax ID...">123 Market Street, Suite 400&#10;San Francisco, CA 94105, USA&#10;contact@acme.com</textarea>
                </div>
                <div class="col-md-5">
                    <div class="p-3 rounded-3 bg-light border">
                        <div class="form-check form-switch mb-2 no-print">
                            <input class="form-check-input" type="checkbox" id="lutToggle" checked>
                            <label class="form-check-label fw-semibold fs-7 text-dark" for="lutToggle">Apply GST LUT 0% IGST Export</label>
                        </div>
                        <div id="lutDeclaration" class="fs-8 text-muted font-monospace">
                            "Supply Meant For Export Under Letter Of Undertaking (LUT) Without Payment Of Integrated Tax (IGST) Pursuant To Rule 96A Of CGST Rules, 2017."
                        </div>
                    </div>
                </div>
            </div>

            <!-- Line Items Table -->
            <div class="table-responsive mb-4">
                <table class="table table-items w-100">
                    <thead>
                        <tr>
                            <th style="width: 50%;">Description / Deliverable</th>
                            <th style="width: 15%; text-align: center;">Qty / Hrs</th>
                            <th style="width: 15%; text-align: right;">Rate (<span class="curr-symbol">₹</span>)</th>
                            <th style="width: 15%; text-align: right;">Amount (<span class="curr-symbol">₹</span>)</th>
                            <th class="no-print" style="width: 5%;"></th>
                        </tr>
                    </thead>
                    <tbody id="itemsBody">
                        <tr>
                            <td><input type="text" class="form-control-sheet w-100 item-desc" value="Full-Stack Web Application Development & API Architecture"></td>
                            <td><input type="number" class="form-control-sheet text-center item-qty" value="1" min="1" step="any"></td>
                            <td><input type="number" class="form-control-sheet text-end item-rate" value="1500" step="any"></td>
                            <td class="text-end fw-bold font-monospace item-total">1,500.00</td>
                            <td class="no-print text-center"><button type="button" class="btn btn-sm btn-link text-danger p-0 btn-remove-row" onclick="removeRow(this)">✕</button></td>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control-sheet w-100 item-desc" value="Monthly DevOps Cloud Infrastructure Management & SSL Maintenance"></td>
                            <td><input type="number" class="form-control-sheet text-center item-qty" value="1" min="1" step="any"></td>
                            <td><input type="number" class="form-control-sheet text-end item-rate" value="500" step="any"></td>
                            <td class="text-end fw-bold font-monospace item-total">500.00</td>
                            <td class="no-print text-center"><button type="button" class="btn btn-sm btn-link text-danger p-0 btn-remove-row" onclick="removeRow(this)">✕</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mb-4 no-print">
                <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 btn-add-row" onclick="addRow()">+ Add Line Item</button>
            </div>

            <!-- Notes & Summary Totals -->
            <div class="row g-4 justify-content-between align-items-start">
                <div class="col-md-6">
                    <label class="fs-8 text-uppercase tracking-wider fw-bold text-muted mb-1">Payment Instructions & Notes</label>
                    <textarea class="form-control-sheet text-muted fs-7 w-100" rows="4" placeholder="Bank Name: HDFC Bank&#10;Account No: 502000000000&#10;SWIFT/BIC: HDFCINBB&#10;Thank you for your business!">Wire Transfer Instructions:&#10;Bank: HDFC Bank Ltd.&#10;Account No: 50200012345678&#10;SWIFT / BIC: HDFCINBBXXX&#10;Payment Due within 15 days of invoice date.</textarea>
                </div>
                <div class="col-md-5">
                    <div class="summary-box">
                        <div class="d-flex justify-content-between mb-2 fs-7">
                            <span class="text-muted">Subtotal:</span>
                            <span class="fw-semibold font-monospace"><span class="curr-symbol">₹</span><span id="subTotalDisplay">2,000.00</span></span>
                        </div>
                        <div class="d-flex justify-content-between mb-2 fs-7 align-items-center">
                            <span class="text-muted">Tax / IGST:</span>
                            <span class="fw-semibold font-monospace" id="taxDisplay"><span class="curr-symbol">₹</span>0.00 (0% LUT)</span>
                        </div>
                        <div class="d-flex justify-content-between border-top pt-2 mt-2">
                            <span class="fw-bold fs-6 text-dark">Total Due:</span>
                            <span class="fw-extrabold fs-5 text-primary font-monospace"><span class="curr-symbol">₹</span><span id="grandTotalDisplay">2,000.00</span></span>
                        </div>
                        <div id="inrEstimateBox" class="mt-2 pt-2 border-top fs-8 text-muted font-monospace" style="display:none;">
                            Estimated INR: <strong class="text-dark" id="inrEstimateVal">₹0.00</strong> (@ <span id="currentRateLabel"></span>)
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Upgrade CTA Banner -->
        <div class="card p-4 rounded-4 border-0 shadow-sm text-center mb-5 cta-banner" style="background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);">
            <h4 class="fw-bold text-dark mb-2">Need Automatic Payment Reminders & Forex Accounting?</h4>
            <p class="text-muted fs-6 mx-auto mb-3" style="max-width: 600px;">
                Cod Xpert Invoices stores your clients, tracks real-time exchange rate variance, auto-generates GSTR-1 CSV exports, and dispatches reminders from your own domain.
            </p>
            <div>
                <a href="{{ route('register') }}" class="btn btn-primary py-2 px-4 rounded-pill fw-semibold">Create Free Lifetime Account →</a>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="footer-modern no-print">
        <div class="container text-center text-md-start">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                <div class="text-muted fs-8">
                    © {{ date('Y') }} <a href="https://codxpert.com/" target="_blank" rel="noopener" class="text-primary text-decoration-none fw-semibold">CodXpert</a>. All rights reserved. · Statutory Compliance: GST LUT & DPDP Act, 2023 Certified
                </div>
                <div class="d-flex gap-3 fs-8">
                    <a href="{{ url('/') }}" class="text-muted text-decoration-none">Home</a>
                    <a href="{{ route('pricing') }}" class="text-muted text-decoration-none">Pricing</a>
                    <a href="{{ route('for.freelancers') }}" class="text-muted text-decoration-none">For Freelancers</a>
                    <a href="{{ route('terms') }}" class="text-muted text-decoration-none">Terms</a>
                    <a href="{{ route('privacy') }}" class="text-muted text-decoration-none">Privacy</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function recalculate() {
            const currSelect = document.getElementById('currencySelect');
            const selectedOpt = currSelect.options[currSelect.selectedIndex];
            const symbol = selectedOpt.getAttribute('data-symbol') || '₹';
            const rate = parseFloat(selectedOpt.getAttribute('data-rate')) || 1.0;
            const currCode = selectedOpt.value;

            document.querySelectorAll('.curr-symbol').forEach(el => el.textContent = symbol);

            let subtotal = 0;
            document.querySelectorAll('#itemsBody tr').forEach(row => {
                const qty = parseFloat(row.querySelector('.item-qty')?.value) || 0;
                const rateVal = parseFloat(row.querySelector('.item-rate')?.value) || 0;
                const total = qty * rateVal;
                subtotal += total;
                const totalCell = row.querySelector('.item-total');
                if (totalCell) {
                    totalCell.textContent = total.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                }
            });

            document.getElementById('subTotalDisplay').textContent = subtotal.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

            const isLut = document.getElementById('lutToggle').checked;
            let tax = 0;
            const taxDisplay = document.getElementById('taxDisplay');
            if (isLut) {
                taxDisplay.textContent = `${symbol}0.00 (0% LUT)`;
                document.getElementById('lutDeclaration').style.display = 'block';
            } else {
                tax = subtotal * 0.18;
                taxDisplay.textContent = `${symbol}${tax.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })} (18% IGST)`;
                document.getElementById('lutDeclaration').style.display = 'none';
            }

            const grandTotal = subtotal + tax;
            document.getElementById('grandTotalDisplay').textContent = grandTotal.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

            const inrBox = document.getElementById('inrEstimateBox');
            if (currCode !== 'INR') {
                const inrVal = grandTotal * rate;
                document.getElementById('inrEstimateVal').textContent = `₹${inrVal.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                document.getElementById('currentRateLabel').textContent = `${rate.toFixed(2)}`;
                inrBox.style.display = 'block';
            } else {
                inrBox.style.display = 'none';
            }
        }

        function addRow() {
            const tbody = document.getElementById('itemsBody');
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td><input type="text" class="form-control-sheet w-100 item-desc" placeholder="Service description..."></td>
                <td><input type="number" class="form-control-sheet text-center item-qty" value="1" min="1" step="any"></td>
                <td><input type="number" class="form-control-sheet text-end item-rate" value="100" step="any"></td>
                <td class="text-end fw-bold font-monospace item-total">100.00</td>
                <td class="no-print text-center"><button type="button" class="btn btn-sm btn-link text-danger p-0 btn-remove-row" onclick="removeRow(this)">✕</button></td>
            `;
            tbody.appendChild(tr);
            attachListeners(tr);
            recalculate();
        }

        function removeRow(btn) {
            const rows = document.querySelectorAll('#itemsBody tr');
            if (rows.length > 1) {
                btn.closest('tr').remove();
                recalculate();
            }
        }

        function attachListeners(context) {
            context.querySelectorAll('.item-qty, .item-rate').forEach(input => {
                input.addEventListener('input', recalculate);
            });
        }

        document.getElementById('currencySelect').addEventListener('change', recalculate);
        document.getElementById('lutToggle').addEventListener('change', recalculate);
        attachListeners(document);
        recalculate();
    </script>
</body>
</html>
