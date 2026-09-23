<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>404 - Page Not Found | Cod Xpert Invoices</title>
    <meta name="description" content="The page or invoice you are looking for could not be found.">
    <meta name="robots" content="noindex, follow">

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
            --color-primary: #0284c7;
            --color-primary-hover: #0369a1;
            --color-text-main: #0f172a;
            --color-text-muted: #475569;
            --glass-bg: rgba(255, 255, 255, 0.65);
            --glass-border: rgba(255, 255, 255, 0.7);
            
            --shadow-premium: 0 25px 50px -12px rgba(15, 23, 42, 0.08), inset 0 1px 0 rgba(255, 255, 255, 0.9);
        }

        body {
            font-family: var(--font-main);
            background-color: var(--bg-body);
            color: var(--color-text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow-x: hidden;
            padding: 24px 16px;
        }

        /* Animated Background Blobs for Glassmorphism */
        .bg-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.22;
            z-index: -1;
            pointer-events: none;
            animation: float-blob 20s infinite alternate ease-in-out;
        }

        .bg-blob-1 {
            top: 10%;
            right: 15%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, #38bdf8, #818cf8);
        }

        .bg-blob-2 {
            bottom: 10%;
            left: 10%;
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, #818cf8, #c084fc);
            animation-delay: -6s;
        }

        @keyframes float-blob {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(30px, -40px) scale(1.1); }
            100% { transform: translate(-20px, 30px) scale(0.9); }
        }

        .error-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 28px;
            padding: 50px 40px;
            max-width: 580px;
            width: 100%;
            text-align: center;
            box-shadow: var(--shadow-premium);
            position: relative;
        }

        .brand-icon {
            height: 44px;
            width: 44px;
            border-radius: 12px;
            background: linear-gradient(135deg, #0ea5e9, #6366f1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-family: var(--font-heading);
            font-weight: 800;
            color: white;
            font-size: 20px;
            box-shadow: 0 4px 15px rgba(14, 165, 233, 0.35);
            margin-bottom: 20px;
        }

        .error-code {
            font-family: var(--font-heading);
            font-size: 88px;
            font-weight: 800;
            line-height: 1;
            letter-spacing: -3px;
            background: linear-gradient(135deg, #0284c7 0%, #6366f1 50%, #a855f7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 12px;
        }

        .error-title {
            font-family: var(--font-heading);
            font-size: 26px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 12px;
        }

        .error-desc {
            font-size: 15px;
            color: #475569;
            line-height: 1.6;
            margin-bottom: 32px;
        }

        .btn-primary-gradient {
            background: linear-gradient(135deg, #0284c7, #2563eb);
            color: white;
            font-weight: 600;
            border: none;
            padding: 12px 28px;
            border-radius: 30px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
            box-shadow: 0 4px 15px rgba(2, 132, 199, 0.3);
        }

        .btn-primary-gradient:hover {
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(2, 132, 199, 0.4);
        }

        .btn-secondary-glass {
            background: rgba(255, 255, 255, 0.7);
            color: #334155;
            font-weight: 600;
            border: 1px solid #cbd5e1;
            padding: 12px 24px;
            border-radius: 30px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
        }

        .btn-secondary-glass:hover {
            background: #ffffff;
            color: #0f172a;
            border-color: #94a3b8;
            transform: translateY(-1px);
        }

        .quick-links {
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid rgba(226, 232, 240, 0.8);
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .quick-links a {
            color: #64748b;
            font-size: 13px;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .quick-links a:hover {
            color: var(--color-primary);
        }
    </style>
</head>
<body>
    <!-- Animated Background Blobs -->
    <div class="bg-blob bg-blob-1"></div>
    <div class="bg-blob bg-blob-2"></div>

    <div class="error-card">
        <a href="{{ url('/') }}" class="text-decoration-none">
            <div class="brand-icon">EX</div>
        </a>
        
        <div class="error-code">404</div>
        <h1 class="error-title">Page Not Found</h1>
        <p class="error-desc">
            The page, invoice record, or resource you are looking for might have been moved, deleted, or does not exist.
        </p>

        <div class="d-flex flex-wrap justify-content-center gap-3">
            @auth
                <a href="{{ route('dashboard') }}" class="btn-primary-gradient">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Return to Dashboard
                </a>
                <a href="{{ route('invoices.index') }}" class="btn-secondary-glass">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    View Invoices
                </a>
            @else
                <a href="{{ url('/') }}" class="btn-primary-gradient">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Back to Homepage
                </a>
                <a href="{{ route('login') }}" class="btn-secondary-glass">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                    Sign In
                </a>
            @endauth
        </div>

        <div class="quick-links">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ route('privacy') }}">Privacy Policy</a>
            <a href="{{ route('terms') }}">Terms of Use</a>
            <a href="mailto:info@codxpert.com">Contact Support</a>
        </div>
    </div>
</body>
</html>
