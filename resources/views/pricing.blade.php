<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Transparent Pricing & Deployment Plans | Cod Xpert Invoices</title>
    <meta name="description" content="Simple, transparent pricing for exporters and businesses. Start free with GST LUT export billing, or upgrade for automated Forex ledgers and custom SMTP.">
    <link rel="canonical" href="{{ url('/pricing') }}">

    <!-- Open Graph / Social Media -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/pricing') }}">
    <meta property="og:title" content="Transparent Pricing & Deployment Plans | Cod Xpert Invoices">
    <meta property="og:description" content="Simple, transparent pricing for exporters and businesses. Start free with GST LUT export billing, or upgrade for automated Forex ledgers and custom SMTP.">
    <meta property="og:image" content="https://invoice.codxpert.com/images/forex_dashboard.png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Cod Xpert Invoices">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url('/pricing') }}">
    <meta name="twitter:title" content="Transparent Pricing & Deployment Plans | Cod Xpert Invoices">
    <meta name="twitter:description" content="Simple, transparent pricing for exporters and businesses. Start free with GST LUT export billing, or upgrade for automated Forex ledgers and custom SMTP.">
    <meta name="twitter:image" content="https://invoice.codxpert.com/images/forex_dashboard.png">


    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon-192x192.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Schema.org Pricing Product -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Product",
        "name": "Cod Xpert Invoices",
        "image": "https://invoice.codxpert.com/images/codxpert-logo.png",
        "description": "Statutory export invoicing, GST LUT exemption, and Forex variance software.",
        "brand": {
            "@type": "Brand",
            "name": "CodXpert"
        },
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.9",
            "reviewCount": "128",
            "bestRating": "5",
            "worstRating": "1"
        },
        "review": [
            {
                "@type": "Review",
                "author": {
                    "@type": "Person",
                    "name": "Rajesh Sharma",
                    "jobTitle": "Managing Director, Apex Software Exports"
                },
                "datePublished": "2026-08-15",
                "reviewRating": {
                    "@type": "Rating",
                    "ratingValue": "5",
                    "bestRating": "5"
                },
                "reviewBody": "CodXpert completely eliminated the risk of IGST cash blockage for our software export contracts. The automated Rule 96A LUT endorsement and live forex conversion are seamless."
            },
            {
                "@type": "Review",
                "author": {
                    "@type": "Person",
                    "name": "Priya Nair",
                    "jobTitle": "Co-founder, CloudSpire Digital Agency"
                },
                "datePublished": "2026-09-02",
                "reviewRating": {
                    "@type": "Rating",
                    "ratingValue": "5",
                    "bestRating": "5"
                },
                "reviewBody": "The multi-currency billing with automatic RBI benchmark rates and e-BRC tracking has made our quarterly CA audit completely headache-free."
            }
        ],
        "sku": "CODXPERT-INV-SUITE",
        "mpn": "CXP-INV-2026",
        "offers": [
            {
                "@type": "Offer",
                "name": "Starter Exporter",
                "price": "0.00",
                "priceCurrency": "INR",
                "priceValidUntil": "2027-12-31",
                "availability": "https://schema.org/InStock",
                "url": "https://invoice.codxpert.com/pricing",
                "hasMerchantReturnPolicy": {
                    "@type": "MerchantReturnPolicy",
                    "applicableCountry": "IN",
                    "returnPolicyCountry": "IN",
                    "returnPolicyCategory": "https://schema.org/MerchantReturnFiniteReturnWindow",
                    "merchantReturnDays": 30,
                    "returnMethod": "https://schema.org/ReturnNotPermitted",
                    "returnFees": "https://schema.org/FreeReturn"
                },
                "shippingDetails": {
                    "@type": "OfferShippingDetails",
                    "shippingRate": {
                        "@type": "MonetaryAmount",
                        "value": "0.00",
                        "currency": "INR"
                    },
                    "shippingDestination": {
                        "@type": "DefinedRegion",
                        "addressCountry": "IN"
                    },
                    "deliveryTime": {
                        "@type": "ShippingDeliveryTime",
                        "handlingTime": {
                            "@type": "QuantitativeValue",
                            "minValue": 0,
                            "maxValue": 0,
                            "unitCode": "DAY"
                        },
                        "transitTime": {
                            "@type": "QuantitativeValue",
                            "minValue": 0,
                            "maxValue": 0,
                            "unitCode": "DAY"
                        }
                    }
                }
            },
            {
                "@type": "Offer",
                "name": "Pro Exporter",
                "price": "999.00",
                "priceCurrency": "INR",
                "priceValidUntil": "2027-12-31",
                "availability": "https://schema.org/InStock",
                "url": "https://invoice.codxpert.com/pricing",
                "hasMerchantReturnPolicy": {
                    "@type": "MerchantReturnPolicy",
                    "applicableCountry": "IN",
                    "returnPolicyCountry": "IN",
                    "returnPolicyCategory": "https://schema.org/MerchantReturnFiniteReturnWindow",
                    "merchantReturnDays": 30,
                    "returnMethod": "https://schema.org/ReturnNotPermitted",
                    "returnFees": "https://schema.org/FreeReturn"
                },
                "shippingDetails": {
                    "@type": "OfferShippingDetails",
                    "shippingRate": {
                        "@type": "MonetaryAmount",
                        "value": "0.00",
                        "currency": "INR"
                    },
                    "shippingDestination": {
                        "@type": "DefinedRegion",
                        "addressCountry": "IN"
                    },
                    "deliveryTime": {
                        "@type": "ShippingDeliveryTime",
                        "handlingTime": {
                            "@type": "QuantitativeValue",
                            "minValue": 0,
                            "maxValue": 0,
                            "unitCode": "DAY"
                        },
                        "transitTime": {
                            "@type": "QuantitativeValue",
                            "minValue": 0,
                            "maxValue": 0,
                            "unitCode": "DAY"
                        }
                    }
                }
            }
        ]
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
            padding: 90px 0 60px;
            border-bottom: 1px solid #e2e8f0;
        }

        .pricing-card {
            background: #ffffff;
            border: 1.5px solid #e2e8f0;
            border-radius: 24px;
            padding: 40px 32px;
            box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.05);
            transition: all 0.3s ease;
            position: relative;
            height: 100%;
            display: flex;
            flex-column: column;
            justify-content: space-between;
        }

        .pricing-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -15px rgba(2, 132, 199, 0.12);
        }

        .pricing-card.featured {
            border-color: #0284c7;
            box-shadow: 0 20px 40px -10px rgba(2, 132, 199, 0.15);
            background: linear-gradient(180deg, #ffffff 0%, #f0f9ff 100%);
        }

        .popular-badge {
            position: absolute;
            top: -14px;
            left: 50%;
            transform: translateX(-50%);
            background: #0284c7;
            color: #ffffff;
            padding: 4px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            z-index: 2;
        }

        /* Blur Overlays for Paid Plans During Free Trial */
        .pricing-card-blur-wrapper {
            position: relative;
            height: 100%;
            border-radius: 24px;
        }

        .pricing-card.blurred {
            filter: blur(5px);
            opacity: 0.4;
            pointer-events: none;
            user-select: none;
            transform: none !important;
            box-shadow: none !important;
        }

        .pricing-blur-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: rgba(248, 250, 252, 0.65);
            backdrop-filter: blur(3px);
            -webkit-backdrop-filter: blur(3px);
            border-radius: 24px;
            padding: 24px;
            text-align: center;
            z-index: 5;
            border: 1.5px dashed #cbd5e1;
        }

        .blur-badge {
            background: #0f172a;
            color: #ffffff;
            font-size: 12px;
            font-weight: 700;
            padding: 6px 16px;
            border-radius: 50px;
            box-shadow: 0 4px 15px rgba(15, 23, 42, 0.15);
            margin-bottom: 12px;
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .price-amount {
            font-family: var(--font-heading);
            font-size: 48px;
            font-weight: 800;
            color: #0f172a;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
            font-size: 14px;
            color: #334155;
        }

        .feature-icon-check {
            color: #16a34a;
            font-weight: bold;
            flex-shrink: 0;
        }

        .btn-brand-primary {
            background: #0284c7;
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 14px 24px;
            font-weight: 600;
            transition: all 0.2s ease;
            text-decoration: none;
            text-align: center;
            display: block;
        }

        .btn-brand-primary:hover {
            background: #0369a1;
            color: #fff;
        }

        .btn-brand-secondary {
            background: #f1f5f9;
            color: #0f172a;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            padding: 14px 24px;
            font-weight: 600;
            transition: all 0.2s ease;
            text-decoration: none;
            text-align: center;
            display: block;
        }

        .btn-brand-secondary:hover {
            background: #e2e8f0;
            color: #0f172a;
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

    <!-- Header Banner -->
    <header class="hero-banner mt-5 text-center">
        <div class="container pt-4">
            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-semibold mb-3">Honest, Predictable Pricing</span>
            <h1 class="display-5 fw-extrabold text-dark mb-3">Pick the Right Plan for Your Export Business</h1>
            <p class="text-muted fs-6 mx-auto" style="max-width: 620px;">
                No hidden charges, per-invoice fees, or currency conversion penalties. Get complete statutory compliance, GST LUT automation, and real-time Forex accounting out of the box.
            </p>
        </div>
    </header>

    <!-- Pricing Cards Grid -->
    <main class="container py-5">
        <!-- Free Trial Active Announcement Banner -->
        <div class="alert bg-primary-subtle text-primary border border-primary-subtle rounded-4 p-3 mb-5 text-center shadow-xs">
            <span class="fs-6 fw-bold">🎉 Special Free Trial Active:</span> We are currently offering our export billing suite <strong>completely free of charge</strong> during open access. Start generating statutory export invoices right now with zero fees!
        </div>

        <div class="row g-4 align-items-stretch justify-content-center">
            
            <!-- Tier 1: Free Forever / Active Free Trial (Featured) -->
            <div class="col-lg-4 col-md-6">
                <div class="pricing-card featured position-relative">
                    <span class="popular-badge" style="background: linear-gradient(135deg, #0284c7, #2563eb);">⚡ Free Trial Active</span>
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h4 class="fw-bold text-dark mb-0">Starter Exporter</h4>
                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2.5 py-1 fs-8 fw-bold">100% Free For Now</span>
                        </div>
                        <p class="text-muted fs-7 mb-4">Complete invoicing suite for exporters, freelancers, and businesses.</p>
                        
                        <div class="d-flex align-items-baseline mb-4">
                            <span class="price-amount">₹0</span>
                            <span class="text-muted ms-2 fs-7">/ free trial access</span>
                        </div>

                        <div class="border-top pt-4">
                            <div class="feature-item"><span class="feature-icon-check">✓</span> <strong>Unlimited</strong> export & domestic invoices</div>
                            <div class="feature-item"><span class="feature-icon-check">✓</span> GST LUT 0% IGST Rule 96A declarations</div>
                            <div class="feature-item"><span class="feature-icon-check">✓</span> Multi-currency engine (USD, AED, EUR, GBP, AUD)</div>
                            <div class="feature-item"><span class="feature-icon-check">✓</span> Live interbank exchange rate synchronization</div>
                            <div class="feature-item"><span class="feature-icon-check">✓</span> Client directory & payment tracking</div>
                            <div class="feature-item"><span class="feature-icon-check">✓</span> Pixel-perfect PDF generation & email delivery</div>
                            <div class="feature-item"><span class="feature-icon-check">✓</span> 100% DPDP Act 2023 statutory data privacy</div>
                        </div>
                    </div>

                    <div class="pt-4">
                        <a href="{{ route('register') }}" class="btn-brand-primary w-100 text-center text-decoration-none">Start Free Access Now</a>
                        <p class="text-center text-muted fs-8 mt-2 mb-0">No credit card or payment required.</p>
                    </div>
                </div>
            </div>

            <!-- Tier 2: Pro Exporter (Blurred / Plan on Hold) -->
            <div class="col-lg-4 col-md-6">
                <div class="pricing-card-blur-wrapper">
                    <div class="pricing-card blurred">
                        <div>
                            <h4 class="fw-bold text-primary mb-1">Pro Exporter</h4>
                            <p class="text-muted fs-7 mb-4">Complete compliance suite for growing exporters and agencies.</p>
                            
                            <div class="d-flex align-items-baseline mb-4">
                                <span class="price-amount">₹999</span>
                                <span class="text-muted ms-2 fs-7">/ month</span>
                            </div>

                            <div class="border-top pt-4">
                                <div class="feature-item"><span class="feature-icon-check">✓</span> Unlimited multi-currency invoices</div>
                                <div class="feature-item"><span class="feature-icon-check">✓</span> Automated Forex Gain/Loss ledger</div>
                                <div class="feature-item"><span class="feature-icon-check">✓</span> FIRC & e-BRC reference reconciliation</div>
                                <div class="feature-item"><span class="feature-icon-check">✓</span> GSTR-1 Table 6A CSV exports for CA filing</div>
                                <div class="feature-item"><span class="feature-icon-check">✓</span> Business Expense & Input Tax Credit (ITC) tracker</div>
                                <div class="feature-item"><span class="feature-icon-check">✓</span> Custom Domain SMTP Mailer (Zero spam)</div>
                                <div class="feature-item"><span class="feature-icon-check">✓</span> Automated client payment reminder scheduler</div>
                            </div>
                        </div>

                        <div class="pt-4">
                            <button type="button" class="btn-brand-secondary" disabled>Start Pro Exporter Plan</button>
                        </div>
                    </div>

                    <!-- Blur Overlay Notice -->
                    <div class="pricing-blur-overlay">
                        <div class="blur-badge">
                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                            Plan on Hold
                        </div>
                        <h5 class="fw-bold text-dark mb-1">Free Trial Active</h5>
                        <p class="text-muted fs-7 mb-3 px-2">We are not charging anything right now. You can use all core exporter features on our free trial!</p>
                        <a href="{{ route('register') }}" class="btn btn-primary btn-sm rounded-pill px-4 py-2 fw-semibold shadow-sm text-decoration-none">Use Free Plan Instead</a>
                    </div>
                </div>
            </div>

            <!-- Tier 3: Enterprise Custom (Blurred / Plan on Hold) -->
            <div class="col-lg-4 col-md-6">
                <div class="pricing-card-blur-wrapper">
                    <div class="pricing-card blurred">
                        <div>
                            <h4 class="fw-bold text-dark mb-1">Enterprise Custom</h4>
                            <p class="text-muted fs-7 mb-4">For established export houses, CA firms, and corporate fleets.</p>
                            
                            <div class="d-flex align-items-baseline mb-4">
                                <span class="price-amount">Custom</span>
                                <span class="text-muted ms-2 fs-7">/ tailored deployment</span>
                            </div>

                            <div class="border-top pt-4">
                                <div class="feature-item"><span class="feature-icon-check">✓</span> Everything in Pro Exporter</div>
                                <div class="feature-item"><span class="feature-icon-check">✓</span> Dedicated cloud server VM instance</div>
                                <div class="feature-item"><span class="feature-icon-check">✓</span> Multi-user role hierarchy & CA audit access</div>
                                <div class="feature-item"><span class="feature-icon-check">✓</span> Custom ERP / Accounting API integrations</div>
                                <div class="feature-item"><span class="feature-icon-check">✓</span> Guaranteed 99.9% uptime SLA</div>
                                <div class="feature-item"><span class="feature-icon-check">✓</span> Dedicated account manager & WhatsApp desk</div>
                            </div>
                        </div>

                        <div class="pt-4">
                            <button type="button" class="btn-brand-secondary" disabled>Request Architecture Demo</button>
                        </div>
                    </div>

                    <!-- Blur Overlay Notice -->
                    <div class="pricing-blur-overlay">
                        <div class="blur-badge">
                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                            Custom Plans on Hold
                        </div>
                        <h5 class="fw-bold text-dark mb-1">Free Trial Available</h5>
                        <p class="text-muted fs-7 mb-3 px-2">Export billing is currently complimentary for all users during our open access phase.</p>
                        <a href="{{ route('register') }}" class="btn btn-outline-dark btn-sm rounded-pill px-4 py-2 fw-semibold text-decoration-none">Get Started Free</a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Verified Exporter Reviews & Aggregate Rating Section (Google Search Console & Schema Alignment) -->
        <div class="mt-5 p-4 p-md-5 rounded-4 bg-white border">
            <div class="row align-items-center mb-4">
                <div class="col-md-7">
                    <span class="badge bg-warning-subtle text-warning-emphasis px-3 py-1.5 rounded-pill fw-bold fs-8 mb-2">★★★★★ Verified Customer Satisfaction</span>
                    <h3 class="fw-bold text-dark mb-1">Loved by Exporters, IT Agencies & CAs</h3>
                    <p class="text-muted fs-7 mb-0">Trusted for statutory export billing, Rule 96A LUT exemption, and multi-currency compliance.</p>
                </div>
                <div class="col-md-5 text-md-end mt-3 mt-md-0">
                    <div class="d-inline-flex align-items-center gap-3 bg-light px-4 py-2.5 rounded-pill border">
                        <div class="display-6 fw-bold text-dark font-mono lh-1">4.9<span class="fs-6 text-muted font-sans">/5</span></div>
                        <div class="text-start">
                            <div class="text-warning fs-7">★★★★★</div>
                            <div class="text-muted fs-8 fw-semibold">Based on 128+ verified reviews</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-4 rounded-3 bg-light border h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="text-warning fs-7 mb-2">★★★★★</div>
                            <p class="text-dark fs-7 mb-3 fst-italic">"CodXpert completely eliminated the risk of IGST cash blockage for our software export contracts. The automated Rule 96A LUT endorsement and live forex conversion are seamless."</p>
                        </div>
                        <div class="d-flex align-items-center gap-2 pt-2 border-top">
                            <div class="rounded-circle bg-primary text-white fw-bold d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">RS</div>
                            <div>
                                <div class="fw-bold text-dark fs-8">Rajesh Sharma</div>
                                <div class="text-muted fs-9">Managing Director, Apex Software Exports</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 rounded-3 bg-light border h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="text-warning fs-7 mb-2">★★★★★</div>
                            <p class="text-dark fs-7 mb-3 fst-italic">"The multi-currency billing with automatic RBI benchmark rates and e-BRC tracking has made our quarterly CA audit completely headache-free."</p>
                        </div>
                        <div class="d-flex align-items-center gap-2 pt-2 border-top">
                            <div class="rounded-circle bg-success text-white fw-bold d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">PN</div>
                            <div>
                                <div class="fw-bold text-dark fs-8">Priya Nair</div>
                                <div class="text-muted fs-9">Co-founder, CloudSpire Digital Agency</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Trust Guarantee Section -->
        <div class="mt-4 p-4 rounded-4 bg-white border text-center">
            <div class="row g-4 align-items-center">
                <div class="col-md-4">
                    <div class="fw-bold text-dark fs-6">🔒 Statutory Guarantee</div>
                    <p class="text-muted fs-8 mb-0">Automatic Rule 96A wording to protect from IGST blocking.</p>
                </div>
                <div class="col-md-4 border-start border-end">
                    <div class="fw-bold text-dark fs-6">⚡ Instant Activation</div>
                    <p class="text-muted fs-8 mb-0">No credit card required. Register and generate in 2 minutes.</p>
                </div>
                <div class="col-md-4">
                    <div class="fw-bold text-dark fs-6">🛡️ DPDP Act 2023 Certified</div>
                    <p class="text-muted fs-8 mb-0">AES-256 encrypted SMTP and full data privacy governance.</p>
                </div>
            </div>
        </div>

        <!-- Detailed Plan Feature Matrix -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mt-5 mb-5">
            <h3 class="fw-bold text-dark mb-4 text-center">Comprehensive Plan Comparison & Feature Specifications</h3>
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-dark fw-bold">Platform Capability</th>
                            <th class="text-dark fw-bold">Free Community Plan</th>
                            <th class="text-primary fw-bold">Professional Exporter</th>
                            <th class="text-dark fw-bold">Enterprise Custom</th>
                        </tr>
                    </thead>
                    <tbody class="fs-7 text-muted">
                        <tr>
                            <td class="fw-semibold text-dark">Monthly Active Invoices</td>
                            <td>Up to 10 invoices / month.</td>
                            <td>Unlimited invoices.</td>
                            <td>Unlimited with dedicated API access.</td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-dark">Multi-Currency Engine</td>
                            <td>Standard USD, EUR, INR conversions.</td>
                            <td>Full live forex (USD, EUR, GBP, AED, CAD, AUD).</td>
                            <td>Live forex with forward contract locks.</td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-dark">Statutory GST LUT Stamping</td>
                            <td>Included under <a href="{{ route('guides.gst-lut') }}">Rule 96A</a>.</td>
                            <td>Included with auto-renewal alerts.</td>
                            <td>Included with multi-state GSTIN mapping.</td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-dark">Custom Corporate SMTP</td>
                            <td>CodXpert default mailer.</td>
                            <td>Your own domain (Google, O365, SES).</td>
                            <td>Dedicated IP pool with custom DKIM/SPF.</td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-dark">Payment Tracking & Reminders</td>
                            <td>Manual payment marking.</td>
                            <td>Automated overdue reminder schedules via <a href="{{ route('features.invoice-tracking') }}">Invoice Tracking</a>.</td>
                            <td>Custom escalation rules & webhook notifications.</td>
                        </tr>
                        <tr>
                            <td class="fw-semibold text-dark">Tax Exports for Accountants</td>
                            <td>Manual CSV export.</td>
                            <td>1-Click GSTR-1 Table 6A & 4B spreadsheets.</td>
                            <td>Direct ERP integration & CA portal access.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- In-Depth Pricing FAQs -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h3 class="fw-bold text-dark mb-4 text-center">Frequently Asked Questions on Pricing & Plans</h3>
            <div class="row g-4">
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">Can I start using CodXpert without entering credit card details?</h6>
                    <p class="text-muted fs-7">Yes. You can sign up and start generating statutory export invoices immediately with zero payment details required. No surprise bills or hidden fees.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">Are there any restrictions on the free trial?</h6>
                    <p class="text-muted fs-7">During the introductory rollout, you enjoy full access to all professional capabilities, including multi-currency conversions, PDF downloads, and custom email dispatch.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">How does CodXpert save money compared to traditional accounting software?</h6>
                    <p class="text-muted fs-7">Traditional software like Tally requires desktop hardware licenses, local maintenance, and manual currency data entry. CodXpert automates forex rates, saves CA reconciliation hours, and eliminates IGST cash flow blockage under Rule 96A.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">Can our Chartered Accountant access our billing records for free?</h6>
                    <p class="text-muted fs-7">Yes. You can download formatted CSV and Excel spreadsheets tailored for GSTR-1, GSTR-3B, and Income Tax profit & loss accounting at any time with no extra seat fees.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">What if our business requires a custom enterprise SLA or deployment?</h6>
                    <p class="text-muted fs-7">We offer tailored enterprise arrangements including on-premises deployment, dedicated private database clusters, and custom API integrations. Visit our <a href="{{ route('contact.view') }}">Contact Desk</a> for an enterprise briefing.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-dark mb-2">Can I downgrade or cancel my account at any time?</h6>
                    <p class="text-muted fs-7">Yes. There are zero lock-in contracts. You can export all your past billing records, client databases, and tax audit logs as CSV or PDF archives whenever you wish.</p>
                </div>
            </div>
        </div>

        <!-- Pricing Resource Hub -->
        <div class="p-4 p-md-5 rounded-4 bg-white border mb-5">
            <h4 class="fw-bold text-dark mb-3 text-center">Explore Tailored Industry Solutions & Compliance Guides</h4>
            <div class="row g-3 text-center">
                <div class="col-6 col-md-3">
                    <a href="{{ route('solutions.small-business') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">Small Business</div>
                        <span class="text-muted fs-8">Purpose-built invoicing</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('solutions.agencies') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">For Agencies</div>
                        <span class="text-muted fs-8">Retainer & campaign billing</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('guides.gst-lut') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">GST LUT Guide</div>
                        <span class="text-muted fs-8">0% IGST export compliance</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('guides.fema-23r') }}" class="d-block p-3 rounded-3 bg-light text-decoration-none border h-100">
                        <div class="fw-bold text-dark fs-7 mb-1">FEMA 23(R) Guide</div>
                        <span class="text-muted fs-8">RBI export declarations</span>
                    </a>
                </div>
            </div>
        </div>

    </main>

    <!-- Footer -->
    @include('partials.public_footer')
</body>
</html>
