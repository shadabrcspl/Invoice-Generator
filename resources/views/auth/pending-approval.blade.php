<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration Pending Approval | {{ config('app.name') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/codxpert-logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/codxpert-logo.png') }}">
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
            padding: 20px;
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
        .pending-card {
            background-color: rgba(255, 255, 255, 0.55);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 24px;
            box-shadow: 0 20px 40px -15px rgba(15, 23, 42, 0.05);
            padding: 40px;
            width: 100%;
            max-width: 500px;
        }
        .brand-icon {
            height: 54px;
            width: 54px;
            border-radius: 14px;
            background: linear-gradient(135deg, #f59e0b, #d97706);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            color: white;
            font-size: 24px;
            margin: 0 auto 20px auto;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
        }
        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px dashed #e2e8f0;
            font-size: 14px;
        }
        .detail-item:last-child {
            border-bottom: none;
        }
        .detail-label {
            color: #64748b;
            font-weight: 500;
        }
        .detail-value {
            color: #0f172a;
            font-weight: 600;
            word-break: break-word;
            text-align: right;
            padding-left: 10px;
        }
        @media (max-width: 480px) {
            .pending-card {
                padding: 24px 16px;
            }
            .detail-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 2px;
            }
            .detail-value {
                text-align: left;
                padding-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Animated Glassmorphism Background Blobs -->
    <div class="bg-blob bg-blob-1"></div>
    <div class="bg-blob bg-blob-2"></div>

    <div class="pending-card">
        <div class="text-center mb-3">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/codxpert-logo.png') }}" alt="CodXpert" style="height: 52px; width: auto; object-fit: contain;">
            </a>
        </div>
        <div class="brand-icon">⏳</div>
        <h3 class="text-center fw-bold mb-1" style="font-family: 'Outfit', sans-serif; color: #0f172a;">Registration Received</h3>
        <p class="text-center text-muted small mb-4">Pending Administrator Approval</p>

        <div class="alert alert-warning border-0 rounded-3 mb-4 p-3 text-center" style="background-color: rgba(245, 158, 11, 0.1); color: #b45309; font-size: 13.5px; line-height: 1.6;">
            Your registration request has been submitted and is currently **pending review** by the administrator. You will receive an email once it is approved.
        </div>

        <div class="card border-0 rounded-4 p-3 mb-4" style="background-color: #f8fafc; border: 1px solid #e2e8f0 !important;">
            <p class="small text-uppercase text-muted fw-bold mb-2" style="letter-spacing: 0.05em; font-size: 11px;">Submitted Details</p>
            <div class="detail-item">
                <span class="detail-label">Name</span>
                <span class="detail-value">{{ $name }}</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Email Address</span>
                <span class="detail-value">{{ $email }}</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Submission Date</span>
                <span class="detail-value">{{ $date }}</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Account Status</span>
                <span class="detail-value text-warning">⏳ Pending Approval</span>
            </div>
        </div>

        <div class="mb-4 text-center text-muted" style="font-size: 13px; line-height: 1.6;">
            If you have any questions or queries regarding this process, please directly reach to the admin: 
            <a href="mailto:shadabcse2020@gmail.com" class="fw-semibold text-decoration-none" style="color: #0284c7;">shadabcse2020@gmail.com</a>
        </div>

        <a href="{{ route('login') }}" class="btn btn-secondary w-100 rounded-pill py-2.5 fw-semibold border-0" style="background-color: #64748b; color: white;">
            Back to Login
        </a>
    </div>
</body>
</html>
