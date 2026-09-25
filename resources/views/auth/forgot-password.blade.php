<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | Cod Xpert Invoices</title>
    <meta name="description" content="Reset your CodXpert Invoices account password. Enter your registered email address to receive a secure password recovery link.">
    <meta name="robots" content="noindex, follow">
    <link rel="canonical" href="{{ url('/forgot-password') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon-192x192.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #1e3a5f 0%, #2d6cdf 50%, #1a2f4e 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .card { background: #ffffff; border-radius: 20px; padding: 48px 44px; width: 100%; max-width: 420px; box-shadow: 0 25px 60px rgba(0,0,0,0.3); }
        .icon { width: 60px; height: 60px; background: linear-gradient(135deg, #2d6cdf, #1e3a5f); border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 26px; margin: 0 auto 24px; }
        h1 { font-size: 22px; font-weight: 800; color: #111827; text-align: center; margin-bottom: 8px; }
        p.sub { color: #6b7280; font-size: 13px; text-align: center; line-height: 1.6; margin-bottom: 28px; }
        .alert-success { background: #f0fdf4; border: 1px solid #86efac; border-radius: 10px; padding: 14px 16px; color: #166534; font-size: 13px; margin-bottom: 20px; }
        .alert-error { background: #fef2f2; border: 1px solid #fca5a5; border-radius: 10px; padding: 14px 16px; color: #991b1b; font-size: 13px; margin-bottom: 20px; }
        label { display: block; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.8px; color: #374151; margin-bottom: 6px; }
        input { width: 100%; padding: 13px 16px; border: 1.5px solid #e5e7eb; border-radius: 10px; font-size: 14px; color: #111827; outline: none; transition: border-color 0.2s; font-family: 'Inter', sans-serif; }
        input:focus { border-color: #2d6cdf; box-shadow: 0 0 0 3px rgba(45,108,223,0.12); }
        .form-group { margin-bottom: 20px; }
        .error-msg { color: #dc2626; font-size: 12px; margin-top: 4px; }
        .btn { width: 100%; padding: 14px; background: linear-gradient(135deg, #2d6cdf, #1e3a5f); color: #fff; border: none; border-radius: 10px; font-size: 14px; font-weight: 700; cursor: pointer; letter-spacing: 0.3px; transition: opacity 0.2s; margin-top: 4px; }
        .btn:hover { opacity: 0.9; }
        .back-link { text-align: center; margin-top: 22px; font-size: 13px; color: #6b7280; }
        .back-link a { color: #2d6cdf; font-weight: 600; text-decoration: none; }
    </style>
</head>
<body>
    <div class="card">
        <div class="icon">🔑</div>
        <h1>Forgot Password?</h1>
        <p class="sub">Enter your registered email address and we'll send you a secure link to reset your password.</p>

        @if(session('status'))
            <div class="alert-success">✅ {{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="your@email.com" required autofocus>
                @error('email')<p class="error-msg">{{ $message }}</p>@enderror
            </div>
            <button type="submit" class="btn">Send Reset Link →</button>
        </form>

        <div class="back-link">
            Remember your password? <a href="{{ route('login') }}">Login here</a>
        </div>
    </div>
</body>
</html>
