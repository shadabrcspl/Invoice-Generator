<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta Tags -->
    <title>Cod Xpert Invoices - GST LUT Foreign Currency Invoicing & Forex Software</title>
    <meta name="description" content="Statutory GST LUT 0% IGST export invoicing and real-time Forex variance software. Automated FIRC reconciliation, e-BRC tracking, and GSTR-1 CSV exports.">
    <meta name="keywords" content="invoice generator, multi-currency invoicing, GST LUT, export billing, GSTR-1 exporter, Forex gain loss tracker, business expense tracker, custom SMTP invoicing, DPDP Act compliant">
    <link rel="canonical" href="{{ url('/') }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="Cod Xpert Invoices - GST LUT Foreign Currency Invoicing & Forex Software">
    <meta property="og:description" content="An ultra-modern, statutory-compliant invoicing platform for global exporters. Features GST LUT 0% IGST export billing, real-time exchange rates, automated Forex variance tracking, and GSTR-1 CSV exports.">
    <meta property="og:image" content="https://invoice.codxpert.com/images/forex_dashboard.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/') }}">
    <meta property="twitter:title" content="Cod Xpert Invoices - GST LUT Foreign Currency Invoicing & Forex Software">
    <meta property="twitter:description" content="An ultra-modern, statutory-compliant invoicing platform for global exporters. Features GST LUT 0% IGST export billing, real-time exchange rates, automated Forex variance tracking, and GSTR-1 CSV exports.">
    <meta property="twitter:image" content="https://invoice.codxpert.com/images/forex_dashboard.png">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon-192x192.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- JSON-LD Schema Markup -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "SoftwareApplication",
        "name": "Cod Xpert Invoices",
        "applicationCategory": "BusinessApplication",
        "operatingSystem": "All",
        "author": {
            "@type": "Organization",
            "name": "CodXpert",
            "url": "https://codxpert.com/"
        },
        "publisher": {
            "@type": "Organization",
            "name": "CodXpert",
            "url": "https://codxpert.com/"
        },
        "offers": {
            "@type": "Offer",
            "price": "0.00",
            "priceCurrency": "USD"
        },
        "featureList": [
            "GST LUT Compliance Exemption",
            "Multi-Currency Invoicing",
            "Manual & Daily Exchange Rate Override",
            "Real-time Forex Reconciliation & Simulator",
            "Custom User SMTP Mailer Configuration",
            "GSTR-1 Compliant CSV Exporting",
            "Business Expense & Input Tax Credit (ITC) Tracker",
            "Digital Personal Data Protection Act (DPDP Act) 2023 Compliant"
        ]
    }
    </script>

    <!-- FAQPage JSON-LD Schema Markup for Google Rich Snippets -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            {
                "@type": "Question",
                "name": "How does the GST Letter of Undertaking (LUT) zero-rate export work?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Under Section 16 of the IGST Act, Indian registered entities exporting services or goods can supply without payment of Integrated GST by executing an active Letter of Undertaking (LUT). Once you register your LUT number inside settings, Cod Xpert automatically injects the mandatory statutory declaration string onto both customer views and downloaded PDF invoice layouts."
                }
            },
            {
                "@type": "Question",
                "name": "How are foreign currency exchange rates validated and locked?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "The application connects to a secure live ExchangeRate-API. Whenever you select a foreign currency (USD, AED, EUR, AUD, etc.), the system checks its validity and fetches the daily conversion rate. For maximum commercial flexibility, you can manually override the exchange rate, which updates the locked, read-only INR equivalent."
                }
            },
            {
                "@type": "Question",
                "name": "How does Forex reconciliation and FIRC/e-BRC logging function?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "When recording a payment or editing an invoice, you enter the actual INR credited by your bank and the Foreign Inward Remittance Certificate (FIRC/e-BRC) reference number. The system compares the received INR with the locked invoice date INR, automatically calculating and posting the exact realized Forex Gain Credit or Loss Debit to your compliance ledger."
                }
            },
            {
                "@type": "Question",
                "name": "Can I track business expenses and claim Input Tax Credit (ITC)?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Yes! The integrated Business Expense Tracker allows you to log operational costs (hosting, internet, software licenses), upload PDF or image receipts, and compile tax splits (CGST, SGST, IGST) into a clean Excel ledger to claim Input Tax Credit on your GST returns."
                }
            },
            {
                "@type": "Question",
                "name": "Is my business and client data compliant with India's DPDP Act, 2023?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Yes, 100%. Cod Xpert operates in complete compliance with India's Digital Personal Data Protection Act, 2023 (Act No. 22 of 2023). We enforce itemized notice and consent, strict purpose limitation, AES-256-CBC encryption for SMTP credentials, multi-tenant database isolation, a published Data Protection Officer desk, and a guaranteed 7-business-day resolution SLA."
                }
            }
        ]
    }
    </script>

    <!-- Google Fonts: Space Grotesk (Headings/Monospace) + Plus Jakarta Sans (Body) + JetBrains Mono (Financials) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Modern White Architectural Design System Styles -->
    <style>
        :root {
            --font-heading: 'Space Grotesk', -apple-system, sans-serif;
            --font-body: 'Plus Jakarta Sans', -apple-system, sans-serif;
            --font-mono: 'JetBrains Mono', monospace;

            /* Pristine White Theme Palette */
            --bg-canvas: #ffffff;
            --bg-subtle: #f8fafc;
            --bg-card: #ffffff;
            --bg-card-hover: #ffffff;
            
            /* Accent & Brand Colors */
            --brand-primary: #0284c7;
            --brand-primary-hover: #0369a1;
            --brand-indigo: #4f46e5;
            --brand-cyan: #06b6d4;
            --brand-emerald: #10b981;
            --brand-amber: #f59e0b;
            
            /* High Contrast Text */
            --text-heading: #0f172a;
            --text-body: #334155;
            --text-muted: #64748b;
            --text-light: #94a3b8;

            /* Borders & Shadows */
            --border-subtle: rgba(15, 23, 42, 0.08);
            --border-highlight: rgba(2, 132, 199, 0.25);
            --shadow-sm: 0 2px 8px -2px rgba(15, 23, 42, 0.05);
            --shadow-md: 0 12px 30px -10px rgba(15, 23, 42, 0.06);
            --shadow-lg: 0 25px 50px -12px rgba(2, 132, 199, 0.09);
            --shadow-glow: 0 0 35px rgba(2, 132, 199, 0.15);
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-body);
            background-color: var(--bg-canvas);
            color: var(--text-body);
            overflow-x: hidden;
            position: relative;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        h1, h2, h3, h4, h5, h6, .font-heading {
            font-family: var(--font-heading);
            color: var(--text-heading);
            font-weight: 700;
            letter-spacing: -0.025em;
        }

        .font-mono {
            font-family: var(--font-mono);
        }

        /* Subtle Geometric Blueprint Grid Background */
        .blueprint-grid {
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(to right, rgba(15, 23, 42, 0.032) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(15, 23, 42, 0.032) 1px, transparent 1px);
            background-size: 48px 48px;
            pointer-events: none;
            z-index: 0;
            mask-image: radial-gradient(ellipse 90% 70% at 50% 20%, black 40%, transparent 80%);
            -webkit-mask-image: radial-gradient(ellipse 90% 70% at 50% 20%, black 40%, transparent 80%);
        }

        /* Ambient Radiant Glow Accents */
        .ambient-glow {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.18;
            pointer-events: none;
            z-index: 0;
            animation: pulseGlow 14s infinite alternate ease-in-out;
        }
        .ambient-glow-1 {
            top: 50px;
            right: 5%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, #38bdf8, #818cf8);
        }
        .ambient-glow-2 {
            top: 700px;
            left: -100px;
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, #06b6d4, #3b82f6);
            animation-delay: -6s;
        }
        .ambient-glow-3 {
            bottom: 600px;
            right: -80px;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, #a855f7, #6366f1);
            animation-delay: -10s;
        }

        @keyframes pulseGlow {
            0% { transform: scale(1) translate(0, 0); opacity: 0.14; }
            50% { transform: scale(1.12) translate(30px, -20px); opacity: 0.22; }
            100% { transform: scale(0.95) translate(-20px, 30px); opacity: 0.16; }
        }

        /* Typography Gradients */
        .heading-gradient {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 55%, #0284c7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .brand-gradient-text {
            background: linear-gradient(135deg, #0284c7 0%, #4f46e5 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Glassmorphic Floating Navbar */
        .navbar-modern {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(15, 23, 42, 0.07);
            padding: 16px 0;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.03);
            z-index: 1050;
        }

        .brand-badge {
            height: 38px;
            width: 38px;
            border-radius: 10px;
            background: linear-gradient(135deg, #0284c7, #4f46e5);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: #ffffff;
            font-family: var(--font-heading);
            font-size: 16px;
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.35);
        }

        .nav-link-modern {
            color: var(--text-muted) !important;
            font-size: 14.5px;
            font-weight: 600;
            padding: 8px 16px !important;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        .nav-link-modern:hover {
            color: var(--brand-primary) !important;
            background: rgba(2, 132, 199, 0.05);
        }

        /* Modern Action Buttons */
        .btn-brand-primary {
            background: linear-gradient(135deg, #0284c7 0%, #2563eb 100%);
            color: #ffffff !important;
            border: none;
            padding: 12px 28px;
            font-weight: 600;
            font-size: 14.5px;
            border-radius: 12px;
            box-shadow: 0 8px 20px -4px rgba(2, 132, 199, 0.35);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }
        .btn-brand-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 28px -6px rgba(2, 132, 199, 0.45);
        }
        .btn-brand-primary::after {
            content: '';
            position: absolute;
            top: 0; left: -100%; width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.25), transparent);
            transition: 0.5s;
        }
        .btn-brand-primary:hover::after {
            left: 100%;
        }

        .btn-brand-secondary {
            background: #ffffff;
            color: var(--text-heading) !important;
            border: 1px solid rgba(15, 23, 42, 0.12);
            padding: 12px 28px;
            font-weight: 600;
            font-size: 14.5px;
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(15, 23, 42, 0.04);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }
        .btn-brand-secondary:hover {
            background: var(--bg-subtle);
            border-color: rgba(2, 132, 199, 0.3);
            color: var(--brand-primary) !important;
            transform: translateY(-2px);
        }

        /* Pill Badges with Pulse */
        .chip-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 16px;
            background: rgba(2, 132, 199, 0.06);
            border: 1px solid rgba(2, 132, 199, 0.18);
            border-radius: 100px;
            font-size: 12.5px;
            font-weight: 600;
            color: var(--brand-primary);
            letter-spacing: 0.02em;
        }

        .pulse-beacon {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #10b981;
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            animation: pulseBeacon 2s infinite;
        }

        @keyframes pulseBeacon {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 8px rgba(16, 185, 129, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }

        /* Symmetrical Glowing Currency Rates Strip */
        .currency-strip-wrapper {
            position: relative;
            z-index: 2;
        }

        .currency-strip-bar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(2, 132, 199, 0.25);
            border-radius: 22px;
            padding: 20px 24px;
            box-shadow: 0 10px 30px -5px rgba(2, 132, 199, 0.1), 0 0 25px rgba(2, 132, 199, 0.08);
            position: relative;
        }

        .currency-chip-card {
            background: #ffffff;
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 16px;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            box-shadow: 0 2px 10px rgba(15, 23, 42, 0.04);
            overflow: hidden;
        }

        /* Ambient subtle glowing edge on the top */
        .currency-chip-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 20%;
            right: 20%;
            height: 2px;
            background: linear-gradient(90deg, transparent, rgba(2, 132, 199, 0.8), rgba(6, 182, 212, 0.8), transparent);
            border-radius: 2px;
            opacity: 0.75;
            transition: all 0.3s ease;
        }

        .currency-chip-card:hover {
            border-color: rgba(2, 132, 199, 0.45);
            box-shadow: 0 10px 25px -4px rgba(2, 132, 199, 0.2), 0 0 20px rgba(6, 182, 212, 0.25);
            transform: translateY(-3px);
        }

        .currency-chip-card:hover::before {
            left: 5%;
            right: 5%;
            opacity: 1;
        }

        .currency-flag-box {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
            border: 1px solid rgba(15, 23, 42, 0.06);
            box-shadow: inset 0 1px 2px rgba(255, 255, 255, 0.8);
        }

        .currency-chip-pair {
            font-family: var(--font-heading);
            font-weight: 700;
            font-size: 15px;
            color: var(--text-heading);
            letter-spacing: -0.01em;
            line-height: 1.2;
        }

        .currency-chip-rate {
            font-family: var(--font-mono);
            font-weight: 700;
            font-size: 18px;
            color: #0f172a;
            letter-spacing: -0.02em;
            line-height: 1.2;
        }

        .currency-chip-badge {
            font-family: var(--font-mono);
            font-size: 11px;
            font-weight: 600;
            padding: 3px 8px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            margin-top: 4px;
        }
        .currency-chip-badge.up {
            background-color: rgba(16, 185, 129, 0.12);
            color: #059669;
            border: 1px solid rgba(16, 185, 129, 0.25);
        }
        .currency-chip-badge.down {
            background-color: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            border: 1px solid rgba(239, 68, 68, 0.25);
        }

        /* Hero Section Styling */
        .hero-section {
            padding: 170px 0 100px;
            position: relative;
            z-index: 1;
        }

        .hero-headline {
            font-size: 58px;
            line-height: 1.12;
            font-weight: 800;
            letter-spacing: -0.035em;
            margin-bottom: 22px;
        }
        @media (max-width: 992px) {
            .hero-headline { font-size: 40px; }
        }

        .hero-subtitle {
            font-size: 18.5px;
            line-height: 1.65;
            color: var(--text-muted);
            margin-bottom: 38px;
            max-width: 580px;
        }

        /* Live Terminal Mockup (Hero Right) */
        .terminal-container {
            position: relative;
            padding: 16px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(248, 250, 252, 0.95));
            border: 1px solid rgba(15, 23, 42, 0.09);
            border-radius: 24px;
            box-shadow: 0 30px 60px -15px rgba(2, 132, 199, 0.12), 0 0 0 1px rgba(255, 255, 255, 0.8) inset;
        }

        .terminal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 14px;
            border-bottom: 1px solid rgba(15, 23, 42, 0.06);
            margin-bottom: 16px;
        }

        .mac-dots {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .mac-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
        }
        .mac-dot-red { background-color: #ef4444; }
        .mac-dot-yellow { background-color: #f59e0b; }
        .mac-dot-green { background-color: #10b981; }

        /* Modern Bento Grid Features */
        .bento-section {
            padding: 100px 0;
            position: relative;
            z-index: 1;
        }

        .section-tag {
            font-family: var(--font-mono);
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--brand-primary);
            margin-bottom: 12px;
            display: inline-block;
        }

        .section-headline {
            font-size: 42px;
            font-weight: 800;
            letter-spacing: -0.03em;
            margin-bottom: 18px;
        }
        @media (max-width: 768px) {
            .section-headline { font-size: 32px; }
        }

        .bento-card {
            background: #ffffff;
            border: 1px solid var(--border-subtle);
            border-radius: 22px;
            padding: 34px;
            height: 100%;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: var(--shadow-sm);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }
        .bento-card:hover {
            transform: translateY(-5px);
            border-color: rgba(2, 132, 199, 0.25);
            box-shadow: var(--shadow-md);
        }

        .bento-icon-wrapper {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: rgba(2, 132, 199, 0.07);
            color: var(--brand-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 22px;
            transition: all 0.3s ease;
        }
        .bento-card:hover .bento-icon-wrapper {
            background: linear-gradient(135deg, #0284c7, #2563eb);
            color: #ffffff;
            transform: scale(1.06);
        }

        /* Interactive Simulator Island */
        .simulator-section {
            padding: 100px 0;
            position: relative;
            z-index: 1;
        }

        .simulator-panel {
            background: #ffffff;
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 28px;
            box-shadow: 0 20px 45px -15px rgba(2, 132, 199, 0.08);
            padding: 42px;
            overflow: hidden;
            position: relative;
        }

        .currency-toggle-btn {
            background: #f8fafc;
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 10px;
            padding: 8px 16px;
            font-size: 13.5px;
            font-weight: 700;
            font-family: var(--font-mono);
            color: var(--text-muted);
            transition: all 0.2s ease;
            cursor: pointer;
        }
        .currency-toggle-btn.active {
            background: #0284c7;
            border-color: #0284c7;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.3);
        }

        /* Workflow Comparison Section */
        .comparison-card {
            border-radius: 22px;
            padding: 38px;
            height: 100%;
        }
        .comparison-legacy {
            background: #fef2f2;
            border: 1px solid rgba(239, 68, 68, 0.15);
        }
        .comparison-codxpert {
            background: #f0fdf4;
            border: 1px solid rgba(16, 185, 129, 0.2);
            box-shadow: 0 15px 35px -10px rgba(16, 185, 129, 0.1);
        }

        /* Stat Counter Grid */
        .stat-card {
            background: #ffffff;
            border: 1px solid var(--border-subtle);
            border-radius: 18px;
            padding: 28px 24px;
            text-align: center;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
            border-color: rgba(2, 132, 199, 0.25);
        }
        .stat-number {
            font-family: var(--font-mono);
            font-size: 40px;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 8px;
        }

        /* Modern FAQ Accordion */
        .accordion-modern .accordion-item {
            background: #ffffff;
            border: 1px solid var(--border-subtle);
            border-radius: 14px;
            margin-bottom: 14px;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(15, 23, 42, 0.02);
            transition: all 0.2s ease;
        }
        .accordion-modern .accordion-item:hover {
            border-color: rgba(2, 132, 199, 0.2);
        }
        .accordion-modern .accordion-button {
            font-family: var(--font-heading);
            font-size: 16px;
            font-weight: 700;
            color: var(--text-heading);
            background: #ffffff;
            padding: 20px 24px;
            box-shadow: none;
        }
        .accordion-modern .accordion-button:not(.collapsed) {
            color: var(--brand-primary);
            background: #f8fafc;
            border-bottom: 1px solid rgba(15, 23, 42, 0.05);
        }
        .accordion-modern .accordion-body {
            padding: 22px 24px;
            font-size: 15px;
            color: var(--text-muted);
            line-height: 1.7;
            background: #ffffff;
        }

        /* Contact Form Modern Card */
        .contact-card-modern {
            background: #ffffff;
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 24px;
            padding: 44px;
            box-shadow: var(--shadow-lg);
        }

        .form-control-modern, .form-select-modern {
            background-color: #f8fafc;
            border: 1.5px solid rgba(15, 23, 42, 0.08);
            border-radius: 12px;
            padding: 14px 18px;
            font-size: 14.5px;
            color: var(--text-heading);
            transition: all 0.25s ease;
        }
        .form-control-modern:focus, .form-select-modern:focus {
            background-color: #ffffff;
            border-color: var(--brand-primary);
            box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.12);
            outline: none;
        }

        /* Alert Feedback Boxes */
        .alert-modern {
            padding: 14px 18px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 22px;
        }
        .alert-modern.success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #15803d;
        }
        .alert-modern.error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
        }

        /* Minimal Footer */
        .footer-modern {
            background-color: #f8fafc;
            border-top: 1px solid rgba(15, 23, 42, 0.06);
            padding: 70px 0 35px;
        }

        /* Cryptographic Text Decode Effect */
        .decode-text {
            display: inline-block;
            cursor: default;
        }
    </style>
</head>
<body>

    <!-- Blueprint Grid Backdrop -->
    <div class="blueprint-grid"></div>

    <!-- Radiant Ambient Glow Spheres -->
    <div class="ambient-glow ambient-glow-1"></div>
    <div class="ambient-glow ambient-glow-2"></div>
    <div class="ambient-glow ambient-glow-3"></div>

    <!-- Top Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-modern fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 text-decoration-none" href="{{ url('/') }}">
                <img src="{{ asset('images/codxpert-logo.png') }}" alt="CodXpert" style="height: 38px; width: auto; object-fit: contain;">
                <span class="font-heading fw-bold text-dark fs-5 tracking-tight">Invoices</span>
            </a>
            
            <button class="navbar-toggler border-0 shadow-none p-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link nav-link-modern" href="#features">Architecture</a></li>
                    <li class="nav-item"><a class="nav-link nav-link-modern" href="{{ route('pricing') }}">Pricing</a></li>
                    <li class="nav-item"><a class="nav-link nav-link-modern text-primary fw-semibold" href="{{ route('free-invoice-generator') }}"><span class="badge bg-primary-subtle text-primary me-1">Free</span> Generator</a></li>
                    <li class="nav-item"><a class="nav-link nav-link-modern" href="#simulator">Simulator</a></li>
                    <li class="nav-item"><a class="nav-link nav-link-modern" href="#faqs">Statutory FAQs</a></li>
                    <li class="nav-item"><a class="nav-link nav-link-modern" href="{{ route('contact.view') }}">Contact Desk</a></li>
                </ul>
                <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
                    <a href="{{ route('login') }}" class="btn-brand-secondary py-2 px-3">Sign In</a>
                    <a href="{{ route('register') }}" class="btn-brand-primary py-2 px-3">Get Started</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- 1. Hero Section -->
    <header class="hero-section">
        <div class="container">
            <div class="row align-items-center g-5">
                
                <!-- Left: Headline & Actions -->
                <div class="col-lg-6 text-center text-lg-start">
                    <div class="chip-pill mb-4">
                        <span class="pulse-beacon"></span>
                        <span class="decode-text" data-text="STATUTORY GST & FOREX ENGINE">STATUTORY GST & FOREX ENGINE</span>
                    </div>
                    
                    <h1 class="hero-headline heading-gradient">
                        Modern Invoicing for <span class="brand-gradient-text">Global Exporters</span> & Agile Teams
                    </h1>
                    
                    <p class="hero-subtitle">
                        Say goodbye to Excel-based audit vulnerabilities. Generate multi-currency export invoices, automate 0% IGST Letter of Undertaking (LUT) filings, and reconcile bank Forex realization gains/losses with mathematical precision.
                    </p>
                    
                    <div class="d-flex flex-column flex-sm-row justify-content-center justify-content-lg-start gap-3 mb-4">
                        <a href="{{ route('register') }}" class="btn-brand-primary">
                            <span>Create Free Account</span>
                            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                        <a href="#simulator" class="btn-brand-secondary">
                            <span>Open Live Simulator</span>
                            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </a>
                    </div>

                    <!-- Trust Chips -->
                    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start gap-3 pt-2 text-muted fs-8 font-mono">
                        <span class="d-inline-flex align-items-center gap-1">
                            <span class="text-success fw-bold">✓</span> 100% DPDP Act Compliant
                        </span>
                        <span class="d-inline-flex align-items-center gap-1">
                            <span class="text-primary fw-bold">✓</span> 0% IGST under LUT
                        </span>
                        <span class="d-inline-flex align-items-center gap-1">
                            <span class="text-info fw-bold">✓</span> Instant GSTR-1 CSV
                        </span>
                    </div>
                </div>

                <!-- Right: Live Invoice Terminal Mockup (Clean Architectural View) -->
                <div class="col-lg-6">
                    <div class="position-relative">
                        
                        <!-- Terminal Card -->
                        <div class="terminal-container" id="heroTerminal">
                            
                            <div class="terminal-header">
                                <div class="mac-dots">
                                    <span class="mac-dot mac-dot-red"></span>
                                    <span class="mac-dot mac-dot-yellow"></span>
                                    <span class="mac-dot mac-dot-green"></span>
                                    <span class="font-mono text-muted fs-8 ms-2">codxpert-engine // invoice_terminal.sys</span>
                                </div>
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill font-mono fs-9 px-2 py-1">
                                    ● LIVE AUDIT VERIFIED
                                </span>
                            </div>

                            <!-- Invoice Content Replica -->
                            <div class="bg-white rounded-3 p-3 border border-light shadow-sm">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        <h6 class="m-0 font-heading fw-bold text-dark fs-6">INV-202609-0001</h6>
                                        <small class="text-muted fs-8 font-mono">Billed to: Acme Global Technologies (Dubai, UAE)</small>
                                    </div>
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1 font-mono fs-9">
                                        LUT EXPORT (0% IGST)
                                    </span>
                                </div>

                                <!-- Line Items Table -->
                                <div class="table-responsive mb-3">
                                    <table class="table table-sm table-borderless m-0 fs-8 font-mono align-middle">
                                        <thead>
                                            <tr class="text-muted border-bottom">
                                                <th>Service Item</th>
                                                <th class="text-center">SAC</th>
                                                <th class="text-center">Qty</th>
                                                <th class="text-end">Rate (AED)</th>
                                                <th class="text-end">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="border-bottom">
                                                <td class="fw-semibold text-dark">Cloud Solution Architecture</td>
                                                <td class="text-center text-muted">998314</td>
                                                <td class="text-center">1.0</td>
                                                <td class="text-end">3,500.00</td>
                                                <td class="text-end fw-bold text-dark">3,500.00</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-semibold text-dark">API & Database Infrastructure</td>
                                                <td class="text-center text-muted">998315</td>
                                                <td class="text-center">1.0</td>
                                                <td class="text-end">1,000.00</td>
                                                <td class="text-end fw-bold text-dark">1,000.00</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Total & Statutory Box -->
                                <div class="p-3 rounded-2 border border-dashed border-primary-subtle bg-light">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="fs-8 text-muted">Invoice Subtotal:</span>
                                        <span class="font-mono fw-bold text-dark">AED 4,500.00</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="fs-8 text-muted">Statutory IGST (Export under LUT):</span>
                                        <span class="font-mono fw-bold text-success">AED 0.00 (0%)</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                                        <span class="fs-7 fw-bold text-dark">Grand Total:</span>
                                        <span class="font-mono fs-6 fw-extrabold text-primary">AED 4,500.00</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center pt-1 font-mono fs-8 text-muted">
                                        <span>Invoice-Date Locked Value:</span>
                                        <span class="text-dark fw-semibold">₹{{ number_format(4500 * ($rates['AED'] ?? 25.90), 2) }} INR (@ {{ number_format($rates['AED'] ?? 25.90, 2) }})</span>
                                    </div>
                                </div>

                                <!-- FIRC Banner -->
                                <div class="mt-2 p-2 rounded-2 bg-warning-subtle border border-warning-subtle d-flex justify-content-between align-items-center fs-8 font-mono">
                                    <span class="text-warning-emphasis fw-bold">⚡ Bank FIRC Reference:</span>
                                    <span class="text-dark fw-semibold">010926I049909936</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- Symmetrical Glowing Currency Rates Strip -->
            <div class="currency-strip-wrapper mt-5 pt-4">
                <div class="currency-strip-bar">
                    <div class="d-flex flex-wrap align-items-center justify-content-between mb-3 pb-2 border-bottom border-light gap-2">
                        <div class="d-flex align-items-center gap-2">
                            <span class="pulse-beacon"></span>
                            <span class="font-mono fs-8 fw-bold text-uppercase text-muted letter-spacing-1">
                                Real-Time Foreign Currency Exchange Rates
                            </span>
                        </div>
                        <div class="d-flex align-items-center gap-3 font-mono fs-8 text-muted">
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2 py-1">
                                ● LIVE BENCHMARK
                            </span>
                            <span class="d-none d-md-inline">RBI Reference & Central Bank Fixed Pegs</span>
                        </div>
                    </div>

                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-5 g-3">
                        <!-- 1. USD / INR -->
                        <div class="col">
                            <div class="currency-chip-card">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="currency-flag-box">🇺🇸</div>
                                    <div>
                                        <div class="currency-chip-pair">USD / INR</div>
                                        <small class="font-mono text-muted fs-9">US Dollar</small>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <div class="currency-chip-rate">₹{{ number_format($rates['USD'] ?? 95.12, 2) }}</div>
                                    <span class="currency-chip-badge up">▲ +0.12%</span>
                                </div>
                            </div>
                        </div>

                        <!-- 2. AED / INR -->
                        <div class="col">
                            <div class="currency-chip-card">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="currency-flag-box">🇦🇪</div>
                                    <div>
                                        <div class="currency-chip-pair">AED / INR</div>
                                        <small class="font-mono text-muted fs-9">UAE Dirham</small>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <div class="currency-chip-rate">₹{{ number_format($rates['AED'] ?? 25.90, 2) }}</div>
                                    <span class="currency-chip-badge up">▲ +0.08%</span>
                                </div>
                            </div>
                        </div>

                        <!-- 3. EUR / INR -->
                        <div class="col">
                            <div class="currency-chip-card">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="currency-flag-box">🇪🇺</div>
                                    <div>
                                        <div class="currency-chip-pair">EUR / INR</div>
                                        <small class="font-mono text-muted fs-9">Euro</small>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <div class="currency-chip-rate">₹{{ number_format($rates['EUR'] ?? 110.61, 2) }}</div>
                                    <span class="currency-chip-badge down">▼ -0.04%</span>
                                </div>
                            </div>
                        </div>

                        <!-- 4. GBP / INR -->
                        <div class="col">
                            <div class="currency-chip-card">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="currency-flag-box">🇬🇧</div>
                                    <div>
                                        <div class="currency-chip-pair">GBP / INR</div>
                                        <small class="font-mono text-muted fs-9">British Pound</small>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <div class="currency-chip-rate">₹{{ number_format($rates['GBP'] ?? 128.82, 2) }}</div>
                                    <span class="currency-chip-badge up">▲ +0.15%</span>
                                </div>
                            </div>
                        </div>

                        <!-- 5. AUD / INR -->
                        <div class="col">
                            <div class="currency-chip-card">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="currency-flag-box">🇦🇺</div>
                                    <div>
                                        <div class="currency-chip-pair">AUD / INR</div>
                                        <small class="font-mono text-muted fs-9">Australian Dollar</small>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <div class="currency-chip-rate">₹{{ number_format($rates['AUD'] ?? 68.68, 2) }}</div>
                                    <span class="currency-chip-badge up">▲ +0.06%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- 2. Live Interactive Forex & GST LUT Simulator Island -->
    <section id="simulator" class="simulator-section">
        <div class="container">
            <div class="text-center max-w-700 mx-auto mb-5">
                <span class="section-tag decode-text" data-text="INTERACTIVE COMPLIANCE SANDBOX">INTERACTIVE COMPLIANCE SANDBOX</span>
                <h2 class="section-headline heading-gradient">Calculate Your Forex Variance & Tax Savings</h2>
                <p class="text-muted fs-6">Experience how Cod Xpert automatically computes bank liquidation realization rates, logs Forex gain credits, and legally eliminates IGST under LUT.</p>
            </div>

            <div class="simulator-panel">
                <div class="row g-5 align-items-center">
                    
                    <!-- Left: Inputs & Sliders -->
                    <div class="col-lg-6">
                        <div class="d-flex flex-column gap-4">
                            
                            <!-- Currency Selector -->
                            <div>
                                <label class="font-mono fs-8 text-uppercase fw-bold text-muted mb-2 d-block">1. Select Billing Currency</label>
                                <div class="d-flex flex-wrap gap-2" id="simCurrencyGroup">
                                    <button type="button" class="currency-toggle-btn active" data-curr="USD" data-symbol="$" data-base-rate="{{ $rates['USD'] ?? 95.12 }}">USD ($)</button>
                                    <button type="button" class="currency-toggle-btn" data-curr="AED" data-symbol="AED " data-base-rate="{{ $rates['AED'] ?? 25.90 }}">AED (د.إ)</button>
                                    <button type="button" class="currency-toggle-btn" data-curr="EUR" data-symbol="€" data-base-rate="{{ $rates['EUR'] ?? 110.61 }}">EUR (€)</button>
                                    <button type="button" class="currency-toggle-btn" data-curr="GBP" data-symbol="£" data-base-rate="{{ $rates['GBP'] ?? 128.82 }}">GBP (£)</button>
                                    <button type="button" class="currency-toggle-btn" data-curr="AUD" data-symbol="A$" data-base-rate="{{ $rates['AUD'] ?? 68.68 }}">AUD (A$)</button>
                                </div>
                            </div>

                            <!-- Invoice Amount Input -->
                            <div>
                                <label class="font-mono fs-8 text-uppercase fw-bold text-muted mb-2 d-block">2. Foreign Invoice Amount</label>
                                <div class="input-group input-group-lg shadow-sm">
                                    <span class="input-group-text bg-light font-mono fw-bold" id="simCurrencySymbol">$</span>
                                    <input type="number" id="simAmount" class="form-control font-mono fw-bold fs-5" value="5000" step="100" min="100">
                                </div>
                            </div>

                            <!-- Bank Liquidation Slider -->
                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="font-mono fs-8 text-uppercase fw-bold text-muted m-0">3. Bank Realization Rate (Slide Variance)</label>
                                    <span class="font-mono fw-bold text-primary fs-7" id="simCurrentRateDisplay">₹{{ number_format(($rates['USD'] ?? 95.12) * 1.01, 2) }} INR</span>
                                </div>
                                <input type="range" id="simRateSlider" class="form-range" min="{{ round(($rates['USD'] ?? 95.12) * 0.95, 2) }}" max="{{ round(($rates['USD'] ?? 95.12) * 1.05, 2) }}" step="0.05" value="{{ round(($rates['USD'] ?? 95.12) * 1.01, 2) }}">
                                <div class="d-flex justify-content-between font-mono fs-9 text-muted mt-1">
                                    <span id="simMinRate">₹{{ number_format(($rates['USD'] ?? 95.12) * 0.95, 2) }}</span>
                                    <span>Locked on Invoice: <strong id="simBaseRateDisplay">₹{{ number_format($rates['USD'] ?? 95.12, 2) }}</strong></span>
                                    <span id="simMaxRate">₹{{ number_format(($rates['USD'] ?? 95.12) * 1.05, 2) }}</span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Right: Dynamic Real-time Calculations -->
                    <div class="col-lg-6">
                        <div class="bg-light rounded-4 p-4 border border-subtle d-flex flex-column gap-3">
                            <h5 class="font-heading fw-bold text-dark fs-6 pb-2 border-bottom m-0">Automated Financial Output</h5>

                            <!-- Locked INR Value -->
                            <div class="d-flex justify-content-between align-items-center fs-7">
                                <span class="text-muted">Invoiced INR Equivalent (Invoice Date):</span>
                                <span class="font-mono fw-bold text-dark" id="simInvoicedInr">₹4,17,250.00</span>
                            </div>

                            <!-- Realized Bank Payout -->
                            <div class="d-flex justify-content-between align-items-center fs-7">
                                <span class="text-muted">Actual Bank Liquidation (Bank Date):</span>
                                <span class="font-mono fw-bold text-dark" id="simRealizedInr">₹4,21,000.00</span>
                            </div>

                            <!-- Realized Forex Gain/Loss -->
                            <div class="p-3 rounded-3 bg-white border d-flex justify-content-between align-items-center" id="simForexBox">
                                <div>
                                    <span class="d-block font-mono fs-8 fw-bold text-muted text-uppercase">Forex Variance Ledger</span>
                                    <span class="fs-6 fw-bold text-success" id="simForexStatus">📈 Realized Forex Gain Credit</span>
                                </div>
                                <span class="font-mono fs-5 fw-extrabold text-success" id="simForexDiff">+₹3,750.00</span>
                            </div>

                            <!-- Statutory LUT 0% Savings -->
                            <div class="p-3 rounded-3 bg-white border d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="d-block font-mono fs-8 fw-bold text-muted text-uppercase">Statutory GST Exemption (LUT)</span>
                                    <span class="fs-7 fw-semibold text-dark">IGST Payable: <strong class="text-success">₹0.00 (0%)</strong></span>
                                </div>
                                <div class="text-end">
                                    <span class="font-mono fs-7 fw-bold text-primary" id="simLutSaved">Saved: ₹75,105.00</span>
                                    <small class="d-block text-muted fs-9 font-mono">@ 18% standard IGST</small>
                                </div>
                            </div>

                            <a href="{{ route('register') }}" class="btn-brand-primary justify-content-center py-3 mt-2">
                                <span>Automate This Workflow Free</span>
                                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- 3. Bento Grid Features Architecture -->
    <section id="features" class="bento-section">
        <div class="container">
            <div class="text-center max-w-700 mx-auto mb-5">
                <span class="section-tag decode-text" data-text="SYSTEM ARCHITECTURE & CAPABILITIES">SYSTEM ARCHITECTURE & CAPABILITIES</span>
                <h2 class="section-headline heading-gradient">Engineered for Flawless Exporter Compliance</h2>
                <p class="text-muted fs-6">Every module is purpose-built to eliminate accounting guesswork, comply with Indian GST laws, and protect your commercial records.</p>
            </div>

            <div class="row g-4">
                
                <!-- Bento 1: GST LUT Compliance -->
                <div class="col-md-6 col-lg-4">
                    <div class="bento-card">
                        <div>
                            <div class="bento-icon-wrapper">⚖️</div>
                            <h4 class="font-heading fw-bold text-dark fs-5 mb-2">GST LUT Compliance</h4>
                            <p class="text-muted fs-7 mb-0">Automatic injection of mandatory statutory Letter of Undertaking (LUT) declarations on export invoices, legally validating 0% IGST export billing without audit risk.</p>
                        </div>
                        <div class="pt-3 mt-3 border-top d-flex align-items-center gap-2 font-mono fs-8 text-primary">
                            <span>●</span> Section 16 IGST Act Ready
                        </div>
                    </div>
                </div>

                <!-- Bento 2: Multi-Currency Engine -->
                <div class="col-md-6 col-lg-4">
                    <div class="bento-card">
                        <div>
                            <div class="bento-icon-wrapper">💱</div>
                            <h4 class="font-heading fw-bold text-dark fs-5 mb-2">Multi-Currency Engine</h4>
                            <p class="text-muted fs-7 mb-0">Full support for USD, AED, EUR, GBP, AUD, CAD, and 160+ currencies with real-time exchange rates. Includes instant manual override options to lock precise invoice-date rates.</p>
                        </div>
                        <div class="pt-3 mt-3 border-top d-flex align-items-center gap-2 font-mono fs-8 text-primary">
                            <span>●</span> Live API Sync + Manual Locks
                        </div>
                    </div>
                </div>

                <!-- Bento 3: Forex Variance & FIRC Tracker -->
                <div class="col-md-6 col-lg-4">
                    <div class="bento-card">
                        <div>
                            <div class="bento-icon-wrapper">📈</div>
                            <h4 class="font-heading fw-bold text-dark fs-5 mb-2">Forex Variance Ledger</h4>
                            <p class="text-muted fs-7 mb-0">Track exact bank liquidation dates and realized INR amounts. Automatically reconciles realized Forex gains or losses and synchronizes bank FIRC / e-BRC reference numbers.</p>
                        </div>
                        <div class="pt-3 mt-3 border-top d-flex align-items-center gap-2 font-mono fs-8 text-primary">
                            <span>●</span> Automatic e-BRC Reconciliation
                        </div>
                    </div>
                </div>

                <!-- Bento 4: GSTR-1 One-Click Exporter -->
                <div class="col-md-6 col-lg-4">
                    <div class="bento-card">
                        <div>
                            <div class="bento-icon-wrapper">🗄️</div>
                            <h4 class="font-heading fw-bold text-dark fs-5 mb-2">GSTR-1 Tax Portal Export</h4>
                            <p class="text-muted fs-7 mb-0">Generate monthly GSTR-1 compliant CSV reports for your Chartered Accountant. Strict lock on invoice-date values, export invoice categories, and complete tax breakdown.</p>
                        </div>
                        <div class="pt-3 mt-3 border-top d-flex align-items-center gap-2 font-mono fs-8 text-primary">
                            <span>●</span> Direct CA & Portal Upload
                        </div>
                    </div>
                </div>

                <!-- Bento 5: Business Expenses & ITC Tracker -->
                <div class="col-md-6 col-lg-4">
                    <div class="bento-card">
                        <div>
                            <div class="bento-icon-wrapper">🧾</div>
                            <h4 class="font-heading fw-bold text-dark fs-5 mb-2">Expense & ITC Ledger</h4>
                            <p class="text-muted fs-7 mb-0">Log company purchases (hosting, domains, software), upload digital receipts, and track tax credit claims in a secure GST Input Tax Credit (ITC) ledger with Excel export.</p>
                        </div>
                        <div class="pt-3 mt-3 border-top d-flex align-items-center gap-2 font-mono fs-8 text-primary">
                            <span>●</span> Digital Receipt Vault + Excel Export
                        </div>
                    </div>
                </div>

                <!-- Bento 6: Custom Corporate SMTP Mailer -->
                <div class="col-md-6 col-lg-4">
                    <div class="bento-card">
                        <div>
                            <div class="bento-icon-wrapper">✉️</div>
                            <h4 class="font-heading fw-bold text-dark fs-5 mb-2">Custom SMTP Dispatch</h4>
                            <p class="text-muted fs-7 mb-0">Deliver invoices and payment reminders from your own domain SMTP credentials. All passwords are encrypted with AES-256-CBC with complete dispatch audit logs.</p>
                        </div>
                        <div class="pt-3 mt-3 border-top d-flex align-items-center gap-2 font-mono fs-8 text-primary">
                            <span>●</span> Zero Shared Mailer Overhead
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 4. Workflow Comparison (Before vs After) -->
    <section id="workflow" class="bento-section bg-subtle border-top border-bottom">
        <div class="container">
            <div class="text-center max-w-700 mx-auto mb-5">
                <span class="section-tag decode-text" data-text="WORKFLOW OPTIMIZATION">WORKFLOW OPTIMIZATION</span>
                <h2 class="section-headline heading-gradient">Spreadsheet Chaos vs. Cod Xpert Pipeline</h2>
                <p class="text-muted fs-6">Eliminate manual conversion mistakes, missing LUT audit trails, and payment reconciliation delays.</p>
            </div>

            <div class="row g-4 align-items-stretch">
                
                <!-- Legacy Spreadsheets -->
                <div class="col-lg-6">
                    <div class="comparison-card comparison-legacy">
                        <div class="d-flex align-items-center gap-2 text-danger fw-bold fs-5 mb-4">
                            <span class="badge bg-danger text-white rounded-circle p-1">✕</span>
                            <span>Legacy Manual Workflow</span>
                        </div>
                        <ul class="d-flex flex-column gap-3 p-0 m-0 list-unstyled fs-7 text-muted">
                            <li class="d-flex align-items-start gap-2">
                                <span class="text-danger fw-bold">✕</span>
                                <span><strong>Manual Rate Copy-Pasting:</strong> Relying on random search engine exchange rates without date-locked audit records.</span>
                            </li>
                            <li class="d-flex align-items-start gap-2">
                                <span class="text-danger fw-bold">✕</span>
                                <span><strong>Tax Audit Penalties:</strong> Invoices generated without mandatory statutory LUT declarations risk severe IGST demand notices.</span>
                            </li>
                            <li class="d-flex align-items-start gap-2">
                                <span class="text-danger fw-bold">✕</span>
                                <span><strong>Forex Variance Blindspots:</strong> Inability to trace whether a completed transaction ended in a net currency gain or loss.</span>
                            </li>
                            <li class="d-flex align-items-start gap-2">
                                <span class="text-danger fw-bold">✕</span>
                                <span><strong>Scattered Receipt Proofs:</strong> Missing software purchase invoices and failure to claim eligible Input Tax Credits (ITC).</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Cod Xpert Automated Precision -->
                <div class="col-lg-6">
                    <div class="comparison-card comparison-codxpert">
                        <div class="d-flex align-items-center gap-2 text-success fw-bold fs-5 mb-4">
                            <span class="badge bg-success text-white rounded-circle p-1">✓</span>
                            <span>Cod Xpert Automated Precision</span>
                        </div>
                        <ul class="d-flex flex-column gap-3 p-0 m-0 list-unstyled fs-7 text-muted">
                            <li class="d-flex align-items-start gap-2">
                                <span class="text-success fw-bold">✓</span>
                                <span><strong>Automated Live Conversion:</strong> Exact rates fetched and locked at the second of invoice creation with tamper-proof records.</span>
                            </li>
                            <li class="d-flex align-items-start gap-2">
                                <span class="text-success fw-bold">✓</span>
                                <span><strong>Statutory LUT Protection:</strong> Automated LUT injection on customer views and downloadable PDF documents.</span>
                            </li>
                            <li class="d-flex align-items-start gap-2">
                                <span class="text-success fw-bold">✓</span>
                                <span><strong>Real-time Forex Ledger:</strong> Liquidation rates and FIRC numbers synchronized across PDF, web views, and exports.</span>
                            </li>
                            <li class="d-flex align-items-start gap-2">
                                <span class="text-success fw-bold">✓</span>
                                <span><strong>ITC Tax Credit Ledger:</strong> Centralized digital receipt vault with instant Excel export ready for your accountant.</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 5. Key Metrics Grid -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row g-4">
                <div class="col-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-number text-primary" data-target="160">160+</div>
                        <div class="fs-7 text-muted font-heading fw-semibold">Global Currencies Supported</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-number text-success" data-target="0">0%</div>
                        <div class="fs-7 text-muted font-heading fw-semibold">IGST Paid Under LUT Export</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-number text-dark" data-target="100">100%</div>
                        <div class="fs-7 text-muted font-heading fw-semibold">DPDP Act 2023 Compliant</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-number text-info" data-target="7">7 Days</div>
                        <div class="fs-7 text-muted font-heading fw-semibold">Grievance Redressal SLA</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. Statutory FAQs Accordion -->
    <section id="faqs" class="bento-section">
        <div class="container">
            <div class="text-center max-w-700 mx-auto mb-5">
                <span class="section-tag decode-text" data-text="REGULATORY COMPLIANCE CLARIFICATIONS">REGULATORY COMPLIANCE CLARIFICATIONS</span>
                <h2 class="section-headline heading-gradient">Frequently Asked Questions</h2>
                <p class="text-muted fs-6">Clear statutory and technical answers regarding GST LUT exports, Forex reconciliations, and data privacy.</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion accordion-modern" id="faqAccordion">
                        
                        <!-- FAQ 1 -->
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="true">
                                    How does the GST Letter of Undertaking (LUT) zero-rate export work?
                                </button>
                            </h3>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Under Section 16 of the IGST Act, Indian registered entities exporting services or goods can supply without payment of Integrated GST by executing an active Letter of Undertaking (LUT). Once you register your LUT number inside settings, Cod Xpert automatically injects the mandatory statutory declaration string onto both customer views and downloaded PDF invoice layouts.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 2 -->
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false">
                                    How are foreign currency exchange rates validated and locked?
                                </button>
                            </h3>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    The application connects to a secure live ExchangeRate-API. Whenever you select a foreign currency (USD, AED, EUR, AUD, etc.), the system checks its validity and fetches the daily conversion rate. For maximum commercial flexibility, you can manually override the exchange rate, which updates the locked, read-only INR equivalent.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 3 -->
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false">
                                    How does Forex reconciliation and FIRC/e-BRC logging function?
                                </button>
                            </h3>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    When recording a payment or editing an invoice, you enter the actual INR credited by your bank and the Foreign Inward Remittance Certificate (FIRC/e-BRC) reference number. The system compares the received INR with the locked invoice date INR, automatically calculating and posting the exact realized Forex Gain Credit or Loss Debit to your compliance ledger.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 4 -->
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false">
                                    Can I track business expenses and claim Input Tax Credit (ITC)?
                                </button>
                            </h3>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes! The integrated Business Expense Tracker allows you to log operational costs (hosting, internet, software licenses), upload PDF or image receipts, and compile tax splits (CGST, SGST, IGST) into a clean Excel ledger to claim Input Tax Credit on your GST returns.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 5 -->
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5" aria-expanded="false">
                                    Is my business and client data compliant with India's DPDP Act, 2023?
                                </button>
                            </h3>
                            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes, 100%. Cod Xpert operates in complete compliance with India's Digital Personal Data Protection Act, 2023 (Act No. 22 of 2023). We enforce itemized notice and consent, strict purpose limitation, AES-256-CBC encryption for SMTP credentials, multi-tenant database isolation, a published Data Protection Officer desk, and a guaranteed 7-business-day resolution SLA.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. Glassmorphic AJAX Contact Desk -->
    <section id="contact" class="bento-section bg-subtle border-top">
        <div class="container">
            <div class="row align-items-center g-5">
                
                <div class="col-lg-5">
                    <span class="section-tag decode-text" data-text="DIRECT INQUIRY DESK">DIRECT INQUIRY DESK</span>
                    <h2 class="section-headline heading-gradient text-start mb-4">Have Questions or Need Architecture Support?</h2>
                    <p class="text-muted fs-6 mb-4" style="line-height: 1.7;">
                        Whether you need assistance setting up GST LUT rules, custom SMTP verification, or managing multi-currency invoices, our engineering desk is ready. Reach out and receive a reply within 24 business hours.
                    </p>
                    
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex align-items-center gap-3 p-3 bg-white rounded-3 border border-subtle">
                            <div class="brand-badge" style="background: rgba(2, 132, 199, 0.1); color: var(--brand-primary); font-size: 16px;">✉️</div>
                            <div>
                                <small class="text-muted font-mono d-block fs-8">Direct Email Support</small>
                                <a href="mailto:info@codxpert.com" class="fw-bold text-dark fs-7 text-decoration-none">info@codxpert.com</a>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3 p-3 bg-white rounded-3 border border-subtle">
                            <div class="brand-badge" style="background: rgba(34, 197, 94, 0.1); color: #16a34a; font-size: 16px;">📞</div>
                            <div>
                                <small class="text-muted font-mono d-block fs-8">Phone & WhatsApp Support</small>
                                <a href="tel:+917979976451" class="fw-bold text-dark fs-7 text-decoration-none">+91 7979976451</a>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-3 p-3 bg-white rounded-3 border border-subtle">
                            <div class="brand-badge mt-1" style="background: rgba(234, 179, 8, 0.1); color: #ca8a04; font-size: 16px;">📍</div>
                            <div>
                                <small class="text-muted font-mono d-block fs-8">Registered Headquarters</small>
                                <span class="fw-semibold text-dark fs-8 d-block">House No. 119, I.T.C. Colony, Shankarpur, Munger, Bihar 811201, India</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="contact-card-modern">
                        
                        <!-- AJAX Alert Box -->
                        <div id="contactAlert" style="display: none;"></div>

                        <form id="contactForm">
                            <div class="row g-3">
                                <!-- Full Name -->
                                <div class="col-md-6">
                                    <label for="contactName" class="font-heading fw-bold fs-7 text-dark mb-1 d-flex align-items-center justify-content-between">
                                        <span>Full Name <span class="text-danger">*</span></span>
                                    </label>
                                    <input type="text" id="contactName" name="name" class="form-control form-control-modern" placeholder="John Doe" required>
                                </div>

                                <!-- Email Address -->
                                <div class="col-md-6">
                                    <label for="contactEmail" class="font-heading fw-bold fs-7 text-dark mb-1 d-flex align-items-center justify-content-between">
                                        <span>Work Email <span class="text-danger">*</span></span>
                                    </label>
                                    <input type="email" id="contactEmail" name="email" class="form-control form-control-modern" placeholder="john@company.com" required>
                                </div>

                                <!-- Company / Business Name -->
                                <div class="col-md-6">
                                    <label for="contactCompany" class="font-heading fw-bold fs-7 text-dark mb-1 d-flex align-items-center justify-content-between">
                                        <span>Company / Business Name</span>
                                        <small class="text-muted fw-normal font-mono fs-9">Optional</small>
                                    </label>
                                    <input type="text" id="contactCompany" name="company" class="form-control form-control-modern" placeholder="e.g. Acme Global Technologies">
                                </div>

                                <!-- Phone / WhatsApp Number -->
                                <div class="col-md-6">
                                    <label for="contactPhone" class="font-heading fw-bold fs-7 text-dark mb-1 d-flex align-items-center justify-content-between">
                                        <span>Phone / WhatsApp</span>
                                        <span class="badge bg-success-subtle text-success font-mono fs-9 px-2">Fast WhatsApp Support</span>
                                    </label>
                                    <input type="tel" id="contactPhone" name="phone" class="form-control form-control-modern" placeholder="e.g. +91 98765 43210">
                                </div>

                                <!-- Inquiry Topic Category -->
                                <div class="col-md-6">
                                    <label for="contactInquiryType" class="font-heading fw-bold fs-7 text-dark mb-1">Inquiry Category</label>
                                    <select id="contactInquiryType" name="inquiry_type" class="form-select form-select-modern">
                                        <option value="GST LUT Compliance & 0% IGST Billing">GST LUT Exemption & 0% IGST Billing</option>
                                        <option value="Forex Variance & Bank FIRC Reconciliation">Forex Variance & FIRC / e-BRC Reconciliation</option>
                                        <option value="Custom Corporate SMTP Mailer Setup">Custom Corporate SMTP Mailer Setup</option>
                                        <option value="Monthly GSTR-1 Tax Portal Export">Monthly GSTR-1 Tax Portal Export</option>
                                        <option value="Multi-Currency Engine (USD, AED, EUR, etc.)">Multi-Currency Engine (USD, AED, EUR, etc.)</option>
                                        <option value="Business Expense & ITC Tracker">Business Expense & ITC Tracker</option>
                                        <option value="Product Demo & General Onboarding">Product Demo & General Onboarding</option>
                                    </select>
                                </div>

                                <!-- Subject -->
                                <div class="col-md-6">
                                    <label for="contactSubject" class="font-heading fw-bold fs-7 text-dark mb-1">Subject</label>
                                    <input type="text" id="contactSubject" name="subject" class="form-control form-control-modern" placeholder="e.g. Setup assistance for GST LUT export billing">
                                </div>

                                <!-- Message Details -->
                                <div class="col-12">
                                    <label for="contactMessage" class="font-heading fw-bold fs-7 text-dark mb-1 d-flex align-items-center justify-content-between">
                                        <span>Message Details <span class="text-danger">*</span></span>
                                        <small class="text-muted fw-normal font-mono fs-9">Min. 5 characters</small>
                                    </label>
                                    <textarea id="contactMessage" name="message" class="form-control form-control-modern" rows="4" placeholder="Describe your business needs, questions about foreign currency invoicing, or custom deployment requirements..." required></textarea>
                                </div>

                                <div class="col-12 pt-2">
                                    <button type="submit" id="contactSubmitBtn" class="btn-brand-primary w-100 justify-content-center py-3">
                                        <span id="btnText">Submit Secure Inquiry →</span>
                                        <span id="btnSpinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 8. Minimal Modern Footer -->
    <footer class="footer-modern">
        <div class="container">
            <div class="row align-items-center g-4 pb-4 border-bottom border-subtle">
                <div class="col-md-6 text-center text-md-start">
                    <a class="d-inline-flex align-items-center gap-2 text-decoration-none mb-2" href="{{ url('/') }}">
                        <img src="{{ asset('images/codxpert-logo.png') }}" alt="CodXpert" style="height: 36px; width: auto; object-fit: contain;">
                        <span class="font-heading fw-bold text-dark fs-5">Invoices</span>
                    </a>
                    <p class="text-muted fs-8 mb-0" style="max-width: 440px;">
                        Enterprise statutory invoicing for exporters, engineered by <a href="https://codxpert.com/" target="_blank" rel="noopener" class="text-primary text-decoration-none fw-semibold">CodXpert</a>. Aligned with Indian GST laws, DPDP Act 2023, and automated Forex reconciliation.
                    </p>
                </div>
                <div class="col-md-6 d-flex flex-column align-items-center align-items-md-end gap-2">
                    <ul class="list-unstyled d-flex flex-wrap justify-content-center justify-content-md-end gap-3 m-0 fs-8 font-mono">
                        <li><a href="#features" class="text-muted text-decoration-none">Architecture</a></li>
                        <li><a href="{{ route('pricing') }}" class="text-muted text-decoration-none">Pricing</a></li>
                        <li><a href="{{ route('free-invoice-generator') }}" class="text-muted text-decoration-none">Free Generator</a></li>
                        <li><a href="{{ route('for.freelancers') }}" class="text-muted text-decoration-none">For Freelancers</a></li>
                        <li><a href="{{ route('for.contractors') }}" class="text-muted text-decoration-none">For Contractors</a></li>
                        <li><a href="{{ route('features.e-invoicing') }}" class="text-muted text-decoration-none">E-Invoicing</a></li>
                        <li><a href="{{ route('terms') }}" class="text-muted text-decoration-none">Terms</a></li>
                        <li><a href="{{ route('privacy') }}" class="text-muted text-decoration-none">Privacy</a></li>
                        <li><a href="{{ route('contact.view') }}" class="text-muted text-decoration-none">Contact Desk</a></li>
                        <li><a href="https://codxpert.com/" target="_blank" rel="noopener" class="text-muted text-decoration-none">CodXpert Main</a></li>
                        <li><a href="{{ route('login') }}" class="text-primary text-decoration-none fw-bold">Sign In</a></li>
                    </ul>
                </div>
            </div>
            <div class="pt-4 text-center text-md-start d-flex flex-column flex-md-row justify-content-between align-items-center gap-2 fs-8 font-mono text-muted">
                <span>© {{ date('Y') }} <a href="https://codxpert.com/" target="_blank" rel="noopener" class="text-primary text-decoration-none fw-semibold">CodXpert</a> (<a href="https://codxpert.com/" target="_blank" rel="noopener" class="text-muted text-decoration-none">codxpert.com</a>). All rights reserved.</span>
                <span>Statutory Compliance: GST LUT & DPDP Act, 2023 Certified</span>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JavaScript Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Micro-Interactions & Engines: 3D Tilt, Text Scramble, Forex Simulator, AJAX -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            

            // ─── 2. Cryptographic Matrix Text Scramble Effect ────────────────
            const chars = '01#$*&%~ABCDEF0123456789';
            document.querySelectorAll('.decode-text').forEach(el => {
                const originalText = el.getAttribute('data-text') || el.innerText;
                
                function scramble() {
                    let iteration = 0;
                    const interval = setInterval(() => {
                        el.innerText = originalText
                            .split('')
                            .map((char, index) => {
                                if (index < iteration) return originalText[index];
                                if (char === ' ') return ' ';
                                return chars[Math.floor(Math.random() * chars.length)];
                            })
                            .join('');

                        if (iteration >= originalText.length) {
                            clearInterval(interval);
                        }
                        iteration += 1 / 2;
                    }, 25);
                }

                el.addEventListener('mouseenter', scramble);
            });

            // ─── 3. Interactive Forex & GST LUT Simulation Sandbox ──────────
            const activeBtn = document.querySelector('#simCurrencyGroup .currency-toggle-btn.active') 
                           || document.querySelector('#simCurrencyGroup .currency-toggle-btn');
            let currentCurrency = activeBtn ? activeBtn.getAttribute('data-curr') : 'USD';
            let currentSymbol = activeBtn ? activeBtn.getAttribute('data-symbol') : '$';
            let baseRate = activeBtn ? parseFloat(activeBtn.getAttribute('data-base-rate')) : 95.12;
            let currentRealizedRate = parseFloat((baseRate * 1.01).toFixed(2));

            const simAmountInput = document.getElementById('simAmount');
            const simSlider = document.getElementById('simRateSlider');
            const simCurrencyBtns = document.querySelectorAll('#simCurrencyGroup .currency-toggle-btn');
            const simCurrencySymbol = document.getElementById('simCurrencySymbol');
            const simCurrentRateDisplay = document.getElementById('simCurrentRateDisplay');
            const simBaseRateDisplay = document.getElementById('simBaseRateDisplay');
            const simMinRate = document.getElementById('simMinRate');
            const simMaxRate = document.getElementById('simMaxRate');
            const simInvoicedInr = document.getElementById('simInvoicedInr');
            const simRealizedInr = document.getElementById('simRealizedInr');
            const simForexStatus = document.getElementById('simForexStatus');
            const simForexDiff = document.getElementById('simForexDiff');
            const simForexBox = document.getElementById('simForexBox');
            const simLutSaved = document.getElementById('simLutSaved');

            function updateSimulator() {
                const amount = parseFloat(simAmountInput.value) || 0;
                currentRealizedRate = parseFloat(simSlider.value);

                simCurrentRateDisplay.textContent = `₹${currentRealizedRate.toFixed(2)} INR`;

                const invoicedValueInr = amount * baseRate;
                const realizedValueInr = amount * currentRealizedRate;
                const forexDiff = realizedValueInr - invoicedValueInr;
                const lutSavings = invoicedValueInr * 0.18; // 18% standard IGST

                simInvoicedInr.textContent = `₹${invoicedValueInr.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                simRealizedInr.textContent = `₹${realizedValueInr.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                simLutSaved.textContent = `Saved: ₹${lutSavings.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;

                if (forexDiff >= 0) {
                    simForexStatus.textContent = '📈 Realized Forex Gain Credit';
                    simForexStatus.className = 'fs-6 fw-bold text-success';
                    simForexDiff.textContent = `+₹${forexDiff.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                    simForexDiff.className = 'font-mono fs-5 fw-extrabold text-success';
                    simForexBox.style.borderColor = 'rgba(16, 185, 129, 0.3)';
                } else {
                    simForexStatus.textContent = '📉 Realized Forex Loss Debit';
                    simForexStatus.className = 'fs-6 fw-bold text-danger';
                    simForexDiff.textContent = `-₹${Math.abs(forexDiff).toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                    simForexDiff.className = 'font-mono fs-5 fw-extrabold text-danger';
                    simForexBox.style.borderColor = 'rgba(239, 68, 68, 0.3)';
                }
            }

            simCurrencyBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    simCurrencyBtns.forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');

                    currentCurrency = btn.getAttribute('data-curr');
                    currentSymbol = btn.getAttribute('data-symbol');
                    baseRate = parseFloat(btn.getAttribute('data-base-rate'));

                    simCurrencySymbol.textContent = currentSymbol;
                    simBaseRateDisplay.textContent = `₹${baseRate.toFixed(2)}`;

                    const min = (baseRate * 0.95).toFixed(2);
                    const max = (baseRate * 1.05).toFixed(2);
                    simSlider.min = min;
                    simSlider.max = max;
                    simSlider.value = (baseRate * 1.01).toFixed(2);
                    simMinRate.textContent = `₹${min}`;
                    simMaxRate.textContent = `₹${max}`;

                    updateSimulator();
                });
            });

            simAmountInput.addEventListener('input', updateSimulator);
            simSlider.addEventListener('input', updateSimulator);
            updateSimulator();

            // ─── 4. Stat Numbers Counter Animation on Scroll ────────────────
            const statNumbers = document.querySelectorAll('.stat-number');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const target = entry.target;
                        const targetVal = parseFloat(target.getAttribute('data-target'));
                        let current = 0;
                        const duration = 1500;
                        const stepTime = 30;
                        const steps = duration / stepTime;
                        const increment = targetVal / steps;

                        const timer = setInterval(() => {
                            current += increment;
                            if (current >= targetVal) {
                                current = targetVal;
                                clearInterval(timer);
                            }
                            if (targetVal === 160) target.textContent = `${Math.floor(current)}+`;
                            else if (targetVal === 0) target.textContent = `0%`;
                            else if (targetVal === 100) target.textContent = `${Math.floor(current)}%`;
                            else if (targetVal === 7) target.textContent = `${Math.floor(current)} Days`;
                        }, stepTime);

                        observer.unobserve(target);
                    }
                });
            }, { threshold: 0.5 });

            statNumbers.forEach(stat => observer.observe(stat));

            // ─── 5. AJAX Contact Desk Form Submission ───────────────────────
            const contactForm = document.getElementById('contactForm');
            if (contactForm) {
                contactForm.addEventListener('submit', function(event) {
                    event.preventDefault();

                    const form = event.target;
                    const alertBox = document.getElementById('contactAlert');
                    const submitBtn = document.getElementById('contactSubmitBtn');
                    const btnText = document.getElementById('btnText');
                    const btnSpinner = document.getElementById('btnSpinner');

                    const name = document.getElementById('contactName').value.trim();
                    const email = document.getElementById('contactEmail').value.trim();
                    const company = document.getElementById('contactCompany')?.value.trim() || '';
                    const phone = document.getElementById('contactPhone')?.value.trim() || '';
                    const inquiry_type = document.getElementById('contactInquiryType')?.value || '';
                    const subject = document.getElementById('contactSubject')?.value.trim() || inquiry_type || 'General Inquiry';
                    const message = document.getElementById('contactMessage').value.trim();

                    if (message.length < 5) {
                        alertBox.className = 'alert-modern error';
                        alertBox.innerHTML = '✕ Message details must be at least 5 characters long.';
                        alertBox.style.display = 'flex';
                        return;
                    }

                    submitBtn.disabled = true;
                    btnText.textContent = 'Submitting Secure Inquiry...';
                    btnSpinner.style.display = 'inline-block';
                    alertBox.style.display = 'none';

                    fetch('{{ route("contact") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ name, email, company, phone, inquiry_type, subject, message })
                    })
                    .then(async response => {
                        const data = await response.json();
                        if (!response.ok) {
                            throw new Error(data.message || 'Failed to submit inquiry.');
                        }
                        return data;
                    })
                    .then(data => {
                        alertBox.className = 'alert-modern success';
                        alertBox.innerHTML = '✓ ' + (data.message || 'Thank you! Your inquiry has been transmitted securely.');
                        alertBox.style.display = 'flex';
                        form.reset();
                    })
                    .catch(error => {
                        alertBox.className = 'alert-modern error';
                        alertBox.innerHTML = '✕ ' + error.message;
                        alertBox.style.display = 'flex';
                    })
                    .finally(() => {
                        submitBtn.disabled = false;
                        btnText.textContent = 'Submit Secure Inquiry →';
                        btnSpinner.style.display = 'none';
                    });
                });
            }

        });
    </script>
</body>
</html>
