<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard') | {{ config('app.name', 'Cod Xpert Invoices') }}</title>

    <!-- Premium Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Premium custom CSS variables and UI structures -->
    <style>
        :root {
            --font-main: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            --font-heading: 'Outfit', sans-serif;
            
            --bg-body: #f1f5f9;
            --bg-sidebar: #0f172a;
            --color-primary: #0284c7;
            --color-primary-hover: #0369a1;
            --color-text-main: #1e293b;
            --color-text-light: #475569;
            
            --glass-bg: rgba(255, 255, 255, 0.45);
            --glass-border: rgba(255, 255, 255, 0.5);
            --shadow-premium: 0 10px 30px -10px rgba(0, 0, 0, 0.03), inset 0 1px 0 rgba(255, 255, 255, 0.6);
            --shadow-hover: 0 20px 40px -15px rgba(2, 132, 199, 0.08), inset 0 1px 0 rgba(255, 255, 255, 0.7);
        }

        body {
            font-family: var(--font-main);
            background-color: var(--bg-body);
            color: var(--color-text-main);
            overflow-x: hidden;
            position: relative;
        }

        /* Animated Background Blobs for Glassmorphism */
        .bg-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.16;
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
            top: 35%;
            left: 20%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, #818cf8, #c084fc);
            animation-delay: -5s;
        }

        .bg-blob-3 {
            bottom: 20%;
            right: 5%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, #22d3ee, #6366f1);
            animation-delay: -10s;
        }

        @keyframes float-blob {
            0% {
                transform: translate(0, 0) scale(1);
            }
            50% {
                transform: translate(40px, -60px) scale(1.1);
            }
            100% {
                transform: translate(-20px, 30px) scale(0.9);
            }
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: var(--font-heading);
            font-weight: 700;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 260px;
            height: 100vh;
            background-color: var(--bg-sidebar);
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            z-index: 1000;
            box-shadow: 10px 0 30px rgba(0,0,0,0.05);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-brand {
            padding: 24px;
            border-bottom: 1px solid #1e293b;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon {
            height: 36px;
            width: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, #0ea5e9, #2563eb);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: white;
            font-size: 18px;
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
        }

        .brand-text {
            font-size: 19px;
            font-weight: 800;
            font-family: var(--font-heading);
            background: linear-gradient(to right, #ffffff, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .sidebar-nav {
            flex-grow: 1;
            padding: 24px 16px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .nav-item-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 12px;
            color: #94a3b8;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .nav-item-link:hover {
            color: white;
            background-color: rgba(255,255,255,0.05);
        }

        .nav-item-link.active {
            color: white;
            background: linear-gradient(to right, #0284c7, #2563eb);
            box-shadow: 0 4px 15px rgba(2, 132, 199, 0.3);
        }

        .sidebar-user {
            padding: 16px;
            border-top: 1px solid #1e293b;
            display: flex;
            align-items: center;
            gap: 12px;
            background-color: rgba(0,0,0,0.15);
        }

        .user-avatar {
            height: 38px;
            width: 38px;
            border-radius: 10px;
            background-color: #1e293b;
            border: 1px solid #334155;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: #0ea5e9;
        }

        .user-details {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            flex-grow: 1;
        }

        .user-name {
            font-size: 13px;
            font-weight: 600;
            color: white;
            margin: 0;
        }

        .user-email {
            font-size: 11px;
            color: #64748b;
            margin: 0;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Main Workspace Styling */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .header-bar {
            background-color: var(--glass-bg);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--glass-border);
            padding: 18px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 900;
        }

        .content-body {
            padding: 40px 32px;
            flex-grow: 1;
        }

        /* Glass Card Component */
        .premium-card {
            background-color: var(--glass-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            box-shadow: var(--shadow-premium);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 24px;
            position: relative;
            overflow: hidden;
        }

        .premium-card:hover {
            background-color: rgba(255, 255, 255, 0.6);
            box-shadow: var(--shadow-hover);
        }

        /* Responsive */
        @media(max-width: 991px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
            .sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(15, 23, 42, 0.5);
                backdrop-filter: blur(4px);
                -webkit-backdrop-filter: blur(4px);
                z-index: 999;
                transition: opacity 0.3s ease;
            }
            .sidebar-overlay.show {
                display: block;
            }
        }

        @media(max-width: 576px) {
            .header-bar {
                padding: 14px 16px;
            }
            .content-body {
                padding: 20px 16px;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Animated Glassmorphism Background Blobs -->
    <div class="bg-blob bg-blob-1"></div>
    <div class="bg-blob bg-blob-2"></div>
    <div class="bg-blob bg-blob-3"></div>

    <!-- Sidebar Overlay Backdrop -->
    <div class="sidebar-overlay" id="appSidebarOverlay"></div>

    <!-- Sidebar Layout Navigation -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">EX</div>
            <span class="brand-text">Cod Xpert</span>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('dashboard') }}" class="nav-item-link {{ Request::routeIs('dashboard') ? 'active' : '' }}">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>
            
            <a href="{{ route('invoices.index') }}" class="nav-item-link {{ Request::routeIs('invoices.*') && request('type', 'invoice') !== 'quotation' ? 'active' : '' }}">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Invoices
            </a>

            <a href="{{ route('invoices.index', ['type' => 'quotation']) }}" class="nav-item-link {{ Request::routeIs('invoices.*') && request('type') === 'quotation' ? 'active' : '' }}">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Quotations
            </a>

            <a href="{{ route('expenses.index') }}" class="nav-item-link {{ Request::routeIs('expenses.*') ? 'active' : '' }}">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                Expenses
            </a>

            <a href="{{ route('clients.index') }}" class="nav-item-link {{ Request::routeIs('clients.*') ? 'active' : '' }}">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                Clients
            </a>

            <a href="{{ route('settings.edit') }}" class="nav-item-link {{ Request::routeIs('settings.*') ? 'active' : '' }}">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                Company Settings
            </a>

            <a href="{{ route('gstr1.index') }}" class="nav-item-link {{ Request::routeIs('gstr1.*') ? 'active' : '' }}">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                GST & Forex
            </a>

            <a href="{{ route('email-settings.edit') }}" class="nav-item-link {{ Request::routeIs('email-settings.*') ? 'active' : '' }}">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                Email Settings
                @php $emailSetting = \App\Models\EmailSetting::where('user_id', Auth::id())->first(); @endphp
                @if($emailSetting && $emailSetting->is_verified)
                    <span style="margin-left:auto; width:8px; height:8px; background:#10b981; border-radius:50%; display:inline-block;" title="SMTP Verified"></span>
                @elseif($emailSetting)
                    <span style="margin-left:auto; width:8px; height:8px; background:#f59e0b; border-radius:50%; display:inline-block;" title="Not Tested"></span>
                @endif
            </a>

            @if(Auth::user()->isAdmin())
            <a href="{{ route('admin.users.index') }}" class="nav-item-link {{ Request::routeIs('admin.users.*') ? 'active' : '' }}">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Admin Panel
            </a>
            @endif
        </nav>

        <div class="sidebar-user">
            <div class="user-avatar">
                {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}
            </div>
            <div class="user-details">
                <p class="user-name">{{ Auth::user()->name ?? 'User Account' }}</p>
                <p class="user-email">{{ Auth::user()->email ?? 'user@codxpert.com' }}</p>
            </div>
        </div>
    </aside>

    <!-- Main Workspace -->
    <main class="main-content">
        <!-- Header Bar -->
        <header class="header-bar">
            <div class="d-flex align-items-center">
                <button class="btn btn-link text-dark p-0 me-3 d-lg-none" id="sidebarToggle" aria-label="Toggle Navigation">
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <h2 class="m-0 fs-5" style="color: #0f172a;">@yield('header_title', 'Dashboard Overview')</h2>
            </div>
            
            <div class="d-flex align-items-center gap-3">
                <form method="POST" action="/logout" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                        Logout
                    </button>
                </form>
            </div>
        </header>

        <!-- Main Body Workspace -->
        <div class="content-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
                    <div class="d-flex align-items-center gap-2">
                        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
                    <div class="d-flex align-items-center gap-2">
                        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        <strong>Error!</strong> {{ session('error') }}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
                    <div class="d-flex align-items-start flex-column">
                        <div class="d-flex align-items-center gap-2 mb-1 fw-bold">
                            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            Error! Please resolve details below:
                        </div>
                        <ul class="m-0 ps-3 fs-6">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')

            <footer class="mt-5 pt-4 pb-3 border-top text-center text-muted fs-8" style="font-size: 13px;">
                <div class="d-flex justify-content-center gap-3 mb-1">
                    <a href="{{ route('privacy') }}" class="text-muted text-decoration-none">Privacy Policy</a>
                    <span>•</span>
                    <a href="{{ route('terms') }}" class="text-muted text-decoration-none">Terms of Use</a>
                    <span>•</span>
                    <a href="https://codxpert.com" target="_blank" class="text-muted text-decoration-none">codxpert.com</a>
                </div>
                <div>© {{ date('Y') }} Cod Xpert Invoices. All rights reserved.</div>
            </footer>
        </div>
    </main>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Sidebar responsive toggler script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.getElementById('appSidebarOverlay');
            
            if (sidebarToggle && sidebar && overlay) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                    overlay.classList.toggle('show');
                });
                
                overlay.addEventListener('click', function() {
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                });
            }
        });
    </script>
    @yield('scripts')
</body>
</html>
