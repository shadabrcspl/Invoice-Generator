<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register | Cod Xpert Invoices</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon-192x192.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f1f5f9;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
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
            top: -10%;
            right: -10%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, #38bdf8, #818cf8);
        }
        .bg-blob-2 {
            bottom: -10%;
            left: -10%;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, #818cf8, #c084fc);
            animation-delay: -5s;
        }
        @keyframes float-blob {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(30px, -40px) scale(1.15); }
            100% { transform: translate(-15px, 20px) scale(0.9); }
        }
        .register-card {
            background-color: rgba(255, 255, 255, 0.55);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 24px;
            box-shadow: 0 20px 40px -15px rgba(15, 23, 42, 0.05);
            padding: 40px;
            width: 100%;
            max-width: 440px;
        }
        .brand-icon {
            height: 48px;
            width: 48px;
            border-radius: 12px;
            background: linear-gradient(135deg, #0284c7, #2563eb);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            color: white;
            font-size: 22px;
            margin: 0 auto 20px auto;
            box-shadow: 0 4px 15px rgba(2, 132, 199, 0.3);
        }
    </style>
</head>
<body>
    <!-- Animated Glassmorphism Background Blobs -->
    <div class="bg-blob bg-blob-1"></div>
    <div class="bg-blob bg-blob-2"></div>

    <div class="register-card">
        <div class="text-center mb-3">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/codxpert-logo.png') }}" alt="CodXpert" style="height: 52px; width: auto; object-fit: contain;">
            </a>
        </div>
        <h3 class="text-center fw-bold mb-1" style="font-family: 'Outfit', sans-serif; color: #0f172a;">Register Account</h3>
        <p class="text-center text-muted fs-7 mb-4">Start managing your business billing professionally.</p>

        @if($errors->any())
            <div class="alert alert-danger border-0 rounded-3 mb-4 py-2.5 fs-7">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold text-muted small text-uppercase" style="letter-spacing: 0.05em;">Full Name</label>
                <input type="text" name="name" class="form-control rounded-3 py-2 px-3" required autofocus placeholder="e.g. John Doe">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold text-muted small text-uppercase" style="letter-spacing: 0.05em;">Email Address</label>
                <input type="email" name="email" class="form-control rounded-3 py-2 px-3" required placeholder="e.g. accounts@acme.com">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold text-muted small text-uppercase" style="letter-spacing: 0.05em;">Password</label>
                <input type="password" name="password" class="form-control rounded-3 py-2 px-3" required placeholder="••••••••">
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold text-muted small text-uppercase" style="letter-spacing: 0.05em;">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control rounded-3 py-2 px-3" required placeholder="••••••••">
            </div>

            <button type="submit" class="btn btn-primary w-100 rounded-pill py-2.5 fw-semibold border-0 mb-3" style="background: linear-gradient(135deg, #0284c7, #2563eb);">
                Register Account
            </button>

            <div class="text-center fs-8 text-muted mb-3" style="font-size: 11.5px; line-height: 1.5;">
                By registering, you confirm you are 18+ years old and agree to our <a href="{{ route('terms') }}" class="text-decoration-none text-primary fw-semibold">Terms of Use</a> and <a href="{{ route('privacy') }}" class="text-decoration-none text-primary fw-semibold">DPDP-Compliant Privacy Policy</a>.
            </div>

            <div class="text-center fs-7 text-muted">
                Already registered? <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">Login here</a>
            </div>
        </form>

        <div class="text-center mt-4 pt-3 border-top" style="font-size: 12px;">
            <a href="{{ url('/') }}" class="text-muted text-decoration-none me-3">Home</a>
            <a href="{{ route('terms') }}" class="text-muted text-decoration-none me-3">Terms of Use</a>
            <a href="{{ route('privacy') }}" class="text-muted text-decoration-none">Privacy Policy</a>
        </div>
    </div>
</body>
</html>
