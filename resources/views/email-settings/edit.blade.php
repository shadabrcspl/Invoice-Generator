@extends('layouts.app')

@section('title', 'Email Settings')
@section('header_title', 'Email Configuration')

@section('styles')
<style>
    .section-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: linear-gradient(135deg, #eff6ff, #dbeafe);
        border: 1px solid #bfdbfe;
        color: #1d4ed8;
        border-radius: 30px;
        padding: 4px 14px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        margin-bottom: 16px;
    }
    .status-badge-verified {
        display: inline-flex; align-items: center; gap: 6px;
        background: #f0fdf4; border: 1px solid #86efac;
        color: #166534; border-radius: 30px; padding: 5px 14px;
        font-size: 12px; font-weight: 700;
    }
    .status-badge-unverified {
        display: inline-flex; align-items: center; gap: 6px;
        background: #fff7ed; border: 1px solid #fed7aa;
        color: #c2410c; border-radius: 30px; padding: 5px 14px;
        font-size: 12px; font-weight: 700;
    }
    .status-badge-none {
        display: inline-flex; align-items: center; gap: 6px;
        background: #f8fafc; border: 1px solid #cbd5e1;
        color: #64748b; border-radius: 30px; padding: 5px 14px;
        font-size: 12px; font-weight: 700;
    }
    .port-pill {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 30px;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
        border: 2px solid transparent;
        transition: all 0.15s;
        user-select: none;
    }
    .port-pill:hover { border-color: #2563eb; background: #eff6ff; color: #1d4ed8; }
    .port-pill.selected { background: #2563eb; color: #fff; border-color: #2563eb; }
    .field-help { font-size: 11px; color: #94a3b8; margin-top: 4px; }
    .toggle-password { cursor: pointer; border-left: 0; }
    .alert-error-custom {
        background: #fef2f2; border: 1px solid #fca5a5; border-radius: 12px;
        padding: 14px 18px; color: #991b1b; font-size: 13px; margin-bottom: 20px;
    }
    .info-box {
        background: linear-gradient(135deg, #eff6ff, #f0f9ff);
        border: 1px solid #bfdbfe;
        border-radius: 14px;
        padding: 20px 24px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12 col-lg-10 col-xl-8">

            {{-- Status Header Card --}}
            <div class="premium-card mb-4" style="background: linear-gradient(135deg, #0f172a, #1e3a5f); color: white; border: none;">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <div style="font-size:11px; text-transform:uppercase; letter-spacing:1px; color:#94a3b8; margin-bottom:6px;">Email Configuration Status</div>
                        <h4 style="margin:0; color:#ffffff; font-size:18px;">📨 Custom SMTP Email</h4>
                        <p style="margin:6px 0 0; color:#94a3b8; font-size:13px;">Send all emails (invoices, alerts, resets) from your own domain.</p>
                    </div>
                    <div class="text-end">
                        @if($setting && $setting->is_verified)
                            <span class="status-badge-verified">✅ SMTP Verified & Active</span>
                            @if($setting->last_tested_at)
                                <div style="font-size:11px; color:#94a3b8; margin-top:6px;">Last tested: {{ $setting->last_tested_at->diffForHumans() }}</div>
                            @endif
                        @elseif($setting)
                            <span class="status-badge-unverified">⚠️ Saved — Not Yet Tested</span>
                        @else
                            <span class="status-badge-none">⚙️ Using System Default</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Success / Error Alerts --}}
            @if(session('success'))
                <div class="alert border-0 rounded-4 mb-4 d-flex align-items-center gap-2" style="background:#f0fdf4; color:#166534; font-size:13px; border: 1px solid #86efac !important;">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert-error-custom">{{ session('error') }}</div>
            @endif

            {{-- SMTP Configuration Form --}}
            <div class="premium-card mb-4">
                <div class="section-badge">📡 SMTP Configuration</div>
                <h4 class="m-0 fs-5 mb-1">Mail Server Settings</h4>
                <p class="text-muted fs-7 m-0 mb-4">Configure your hosting provider's SMTP details. All emails will be sent from your domain.</p>

                <form method="POST" action="{{ route('email-settings.update') }}" id="smtpForm">
                    @csrf
                    @method('PUT')

                    {{-- Host + Port --}}
                    <div class="row g-3 mb-4">
                        <div class="col-12 col-md-7">
                            <label class="form-label fw-semibold text-muted fs-7">SMTP Host / Mail Server <span class="text-danger">*</span></label>
                            <input type="text" name="mail_host" class="form-control rounded-3"
                                value="{{ old('mail_host', $setting->mail_host ?? '') }}"
                                placeholder="mail.yourdomain.com" required>
                            <p class="field-help">Usually <code>mail.yourdomain.com</code> for Hostinger/cPanel</p>
                        </div>
                        <div class="col-12 col-md-5">
                            <label class="form-label fw-semibold text-muted fs-7">Port <span class="text-danger">*</span></label>
                            <input type="number" name="mail_port" id="portInput" class="form-control rounded-3"
                                value="{{ old('mail_port', $setting->mail_port ?? 465) }}"
                                min="1" max="65535" required>
                            <div class="d-flex gap-2 mt-2 flex-wrap">
                                <span class="port-pill {{ old('mail_port', $setting->mail_port ?? 465) == 465 ? 'selected' : '' }}" onclick="setPort(465, 'ssl')">465 (SSL)</span>
                                <span class="port-pill {{ old('mail_port', $setting->mail_port ?? 465) == 587 ? 'selected' : '' }}" onclick="setPort(587, 'tls')">587 (TLS/STARTTLS)</span>
                                <span class="port-pill {{ old('mail_port', $setting->mail_port ?? 465) == 25 ? 'selected' : '' }}" onclick="setPort(25, 'none')">25 (No Enc.)</span>
                            </div>
                        </div>
                    </div>

                    {{-- Encryption --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted fs-7">Encryption <span class="text-danger">*</span></label>
                        <div class="d-flex gap-3 flex-wrap">
                            @foreach(['ssl' => 'SSL (Recommended for port 465)', 'tls' => 'TLS / STARTTLS (port 587)', 'none' => 'None (Not Recommended)'] as $val => $label)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="mail_encryption" id="enc_{{ $val }}"
                                    value="{{ $val }}" {{ old('mail_encryption', ($setting->mail_encryption ?? 'ssl') ?: 'none') === $val ? 'checked' : '' }}>
                                <label class="form-check-label fs-7" for="enc_{{ $val }}">{{ $label }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Username + Password --}}
                    <div class="row g-3 mb-4">
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-semibold text-muted fs-7">SMTP Username (Email Address) <span class="text-danger">*</span></label>
                            <input type="email" name="mail_username" class="form-control rounded-3"
                                value="{{ old('mail_username', $setting->mail_username ?? '') }}"
                                placeholder="invoices@yourdomain.com" required>
                            <p class="field-help">The full email address used to authenticate with the mail server</p>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-semibold text-muted fs-7">
                                SMTP Password
                                @if($setting) <span class="text-muted fw-normal">(leave blank to keep current)</span> @else <span class="text-danger">*</span> @endif
                            </label>
                            <div class="input-group">
                                <input type="password" name="mail_password" id="smtpPassword" class="form-control rounded-start-3"
                                    placeholder="{{ $setting ? '••••••••' : 'Enter SMTP password' }}"
                                    {{ !$setting ? 'required' : '' }}>
                                <button type="button" class="btn btn-outline-secondary toggle-password" onclick="togglePwd()">👁</button>
                            </div>
                            <p class="field-help">Your email account password (stored securely, encrypted)</p>
                        </div>
                    </div>

                    {{-- From Address + From Name --}}
                    <div class="row g-3 mb-4">
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-semibold text-muted fs-7">From Email Address <span class="text-danger">*</span></label>
                            <input type="email" name="mail_from_address" class="form-control rounded-3"
                                value="{{ old('mail_from_address', $setting->mail_from_address ?? '') }}"
                                placeholder="invoices@yourdomain.com" required>
                            <p class="field-help">The "From" address recipients will see in their inbox</p>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-semibold text-muted fs-7">From Name <span class="text-danger">*</span></label>
                            <input type="text" name="mail_from_name" class="form-control rounded-3"
                                value="{{ old('mail_from_name', $setting->mail_from_name ?? config('app.name')) }}"
                                placeholder="My Business Name" required>
                            <p class="field-help">The sender name displayed in the recipient's inbox</p>
                        </div>
                    </div>

                    <div class="d-flex gap-3 align-items-center flex-wrap">
                        <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 fw-semibold border-0" style="background: linear-gradient(135deg, #2563eb, #1d4ed8);">
                            💾 Save Email Settings
                        </button>
                        @if($setting)
                            <form method="POST" action="{{ route('email-settings.destroy') }}" class="m-0"
                                onsubmit="return confirm('This will clear your custom SMTP settings and revert to the system default. Continue?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger rounded-pill px-4 py-2">Reset to Default</button>
                            </form>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Test Email Card --}}
            @if($setting)
            <div class="premium-card mb-4">
                <div class="section-badge" style="background: linear-gradient(135deg,#f0fdf4,#dcfce7); border-color: #86efac; color:#166534;">🔬 Connection Test</div>
                <h4 class="m-0 fs-5 mb-1">Send Test Email</h4>
                <p class="text-muted fs-7 m-0 mb-4">Verify your SMTP configuration by sending a test email. This will confirm your settings are correct before real emails are sent.</p>

                <form method="POST" action="{{ route('email-settings.test') }}">
                    @csrf
                    <div class="row g-3 align-items-end">
                        <div class="col-12 col-md-7">
                            <label class="form-label fw-semibold text-muted fs-7">Send Test To (Email Address)</label>
                            <input type="email" name="test_email" class="form-control rounded-3"
                                value="{{ old('test_email', auth()->user()->email) }}"
                                placeholder="your@email.com" required>
                        </div>
                        <div class="col-12 col-md-5">
                            <button type="submit" class="btn w-100 rounded-pill py-2 fw-semibold border-0" style="background: linear-gradient(135deg,#059669,#047857); color:white;">
                                🚀 Send Test Email
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            @endif

            {{-- Info / Help Box --}}
            <div class="info-box">
                <h6 class="fw-bold text-primary mb-3">📖 How to Find Your SMTP Settings</h6>
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <p class="fw-semibold mb-1" style="font-size:13px; color:#1e40af;">Hostinger / cPanel Mail</p>
                        <ul class="m-0 ps-3 text-muted" style="font-size:12px; line-height:2;">
                            <li>Log in to cPanel → Email Accounts</li>
                            <li>Host: <code>mail.yourdomain.com</code></li>
                            <li>Port: <code>465</code> (SSL) or <code>587</code> (TLS)</li>
                            <li>Username: your full email address</li>
                            <li>Password: your email account password</li>
                        </ul>
                    </div>
                    <div class="col-12 col-md-6">
                        <p class="fw-semibold mb-1" style="font-size:13px; color:#1e40af;">Gmail</p>
                        <ul class="m-0 ps-3 text-muted" style="font-size:12px; line-height:2;">
                            <li>Host: <code>smtp.gmail.com</code></li>
                            <li>Port: <code>465</code> (SSL) or <code>587</code> (TLS)</li>
                            <li>Username: your Gmail address</li>
                            <li>Password: <strong>App Password</strong> (not regular password)</li>
                            <li>Enable 2FA first, then create App Password</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function setPort(port, enc) {
        document.getElementById('portInput').value = port;
        document.querySelectorAll('.port-pill').forEach(p => p.classList.remove('selected'));
        event.target.classList.add('selected');

        // Also auto-select the encryption radio
        const encRadio = document.getElementById('enc_' + enc);
        if (encRadio) encRadio.checked = true;
    }

    function togglePwd() {
        const input = document.getElementById('smtpPassword');
        input.type = input.type === 'password' ? 'text' : 'password';
    }

    // Sync port-pill selection on page load
    document.addEventListener('DOMContentLoaded', function() {
        const currentPort = parseInt(document.getElementById('portInput').value);
        document.querySelectorAll('.port-pill').forEach(pill => {
            const pillPort = parseInt(pill.textContent);
            if (pillPort === currentPort) pill.classList.add('selected');
            else pill.classList.remove('selected');
        });
    });
</script>
@endsection
