@extends('layouts.app')

@section('title', 'Company Profile Settings')
@section('header_title', 'Company Profile Settings')

@section('styles')
<style>
    .image-preview-container {
        position: relative;
        border: 2px dashed #cbd5e1;
        border-radius: 16px;
        padding: 24px;
        text-align: center;
        background-color: #f8fafc;
        transition: all 0.2s ease;
    }
    .image-preview-container:hover {
        border-color: var(--color-primary);
        background-color: #f0f9ff;
    }
    .preview-box {
        max-height: 120px;
        margin-bottom: 12px;
        display: none;
    }
    .preview-box img {
        max-height: 100px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }
</style>
@endsection

@section('content')
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12 col-lg-10 col-xl-8">
            <div class="premium-card">
                <div class="mb-4">
                    <h4 class="m-0 fs-5 mb-1">Company Profile</h4>
                    <p class="text-muted fs-7 m-0">This profile holds YOUR business details, which are automatically populated on generated invoices.</p>
                </div>

                <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-4 mb-4">
                        <!-- Company Name -->
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-semibold text-muted fs-7">Company / Business Name <span class="text-danger">*</span></label>
                            <input type="text" name="company_name" class="form-control rounded-3" value="{{ old('company_name', $setting->company_name) }}" required placeholder="e.g. Cod Xpert Solutions">
                        </div>

                        <!-- Website -->
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-semibold text-muted fs-7">Business Website URL</label>
                            <input type="url" name="website" class="form-control rounded-3" value="{{ old('website', $setting->website) }}" placeholder="e.g. https://codxpert.com">
                        </div>

                        <!-- Email -->
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-semibold text-muted fs-7">Billing Support Email</label>
                            <input type="email" name="email" class="form-control rounded-3" value="{{ old('email', $setting->email) }}" placeholder="e.g. finance@codxpert.com">
                        </div>

                        <!-- Phone -->
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-semibold text-muted fs-7">Business Phone Number</label>
                            <input type="text" name="phone" class="form-control rounded-3" value="{{ old('phone', $setting->phone) }}" placeholder="e.g. +91 98765 43210">
                        </div>

                        <!-- GST Number -->
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-semibold text-muted fs-7">GSTIN / VAT ID Number</label>
                            <input type="text" name="gst_number" class="form-control rounded-3" value="{{ old('gst_number', $setting->gst_number) }}" placeholder="e.g. 27AAAAA1111A1Z1">
                        </div>

                        <!-- LUT Number -->
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-semibold text-muted fs-7">Letter of Undertaking (LUT) Number</label>
                            <input type="text" name="lut_number" class="form-control rounded-3" value="{{ old('lut_number', $setting->lut_number) }}" placeholder="e.g. AD270324000123A">
                        </div>

                        <!-- Address -->
                        <div class="col-12">
                            <label class="form-label fw-semibold text-muted fs-7">Corporate Physical Address</label>
                            <textarea name="address" rows="3" class="form-control rounded-3" placeholder="Office details, Street address...">{{ old('address', $setting->address) }}</textarea>
                        </div>
                    </div>

                    <!-- Uploads Row -->
                    <div class="row g-4 mb-4">
                        <!-- Company Logo -->
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-semibold text-muted fs-7 d-block">Company Logo File</label>
                            <div class="image-preview-container">
                                <div class="preview-box" id="logo-preview-box" style="{{ $setting->logo ? 'display:block;' : '' }}">
                                    <img id="logo-img" src="{{ $setting->logo ? Storage::url($setting->logo) : '#' }}" alt="Company Logo">
                                </div>
                                <div id="logo-prompt" style="{{ $setting->logo ? 'display:none;' : '' }}">
                                    <svg class="mb-2 text-muted" width="36" height="36" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <p class="fs-8 text-muted mb-2">Upload PNG/JPG logo (Max 2MB)</p>
                                </div>
                                <input type="file" id="logo-input" name="logo" class="form-control form-control-sm rounded-pill mt-2">
                            </div>
                        </div>

                        <!-- Corporate Signature -->
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-semibold text-muted fs-7 d-block">Authorized Representative Signature</label>
                            <div class="image-preview-container">
                                <div class="preview-box" id="sig-preview-box" style="{{ $setting->signature ? 'display:block;' : '' }}">
                                    <img id="sig-img" src="{{ $setting->signature ? Storage::url($setting->signature) : '#' }}" alt="Corporate Signature">
                                </div>
                                <div id="sig-prompt" style="{{ $setting->signature ? 'display:none;' : '' }}">
                                    <svg class="mb-2 text-muted" width="36" height="36" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                    <p class="fs-8 text-muted mb-2">Upload signature png (Max 2MB)</p>
                                </div>
                                <input type="file" id="sig-input" name="signature" class="form-control form-control-sm rounded-pill mt-2">
                            </div>
                        </div>
                    </div>

                    <!-- Default Bank Notes / Payment Details -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted fs-7">Default Payment & Bank Instructions (Footer Notes)</label>
                        <textarea name="bank_notes" rows="4" class="form-control rounded-3" placeholder="Bank: HDFC Bank&#10;A/C No: 50100293847293&#10;IFSC: HDFC0000123&#10;SWIFT: HDFCINBBXXX&#10;UPI: accounts@upi">{{ old('bank_notes', $setting->bank_notes) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary rounded-pill px-5 py-2.5 fw-semibold border-0" style="background: linear-gradient(135deg, #0284c7, #2563eb);">
                        Save Settings
                    </button>
                </form>
            </div>

            {{-- 💱 Active Currencies Management --}}
            <div class="premium-card mt-4">
                <div class="mb-4">
                    <h4 class="m-0 fs-5 mb-1">💱 Active Currencies Management</h4>
                    <p class="text-muted fs-7 m-0">Manage foreign currencies available for your invoices. When adding a currency, today's conversion rate will be automatically fetched and cached.</p>
                </div>

                <div class="row g-4">
                    <!-- Active Currencies List -->
                    <div class="col-12 col-md-7">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="fs-8 text-muted text-uppercase">Currency</th>
                                        <th class="fs-8 text-muted text-uppercase">Symbol</th>
                                        <th class="fs-8 text-muted text-uppercase">Status</th>
                                        <th class="fs-8 text-muted text-uppercase text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($currencies as $currency)
                                        <tr>
                                            <td class="fw-semibold text-dark fs-7">{{ $currency->code }}</td>
                                            <td class="text-secondary fs-7">{{ $currency->symbol }}</td>
                                            <td>
                                                <span class="badge rounded-pill bg-success-subtle text-success fs-8">Active</span>
                                            </td>
                                            <td class="text-end">
                                                <form action="{{ route('currencies.destroy', $currency) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger border-0 rounded-circle" onclick="return confirm('Are you sure you want to remove {{ $currency->code }}? Existing invoices in this currency will not be deleted, but you won\'t be able to select it for new invoices.')" title="Remove Currency">
                                                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4 fs-7">No custom currencies added yet. Default billing will use base currency (INR).</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Add Currency Form -->
                    <div class="col-12 col-md-5">
                        <div class="p-3 border rounded-4 bg-light-subtle">
                            <h5 class="fs-7 fw-bold mb-3">Add Custom Currency</h5>
                            <form action="{{ route('currencies.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-muted fs-8">Currency Code (ISO) <span class="text-danger">*</span></label>
                                    <input type="text" name="code" class="form-control form-control-sm rounded-3 text-uppercase" placeholder="e.g. EUR" maxlength="3" required>
                                    <div class="form-text fs-8 text-muted">e.g. EUR, GBP, JPY, SGD. Must be supported by ExchangeRate-API.</div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-muted fs-8">Currency Symbol <span class="text-danger">*</span></label>
                                    <input type="text" name="symbol" class="form-control form-control-sm rounded-3" placeholder="e.g. €" maxlength="10" required>
                                    <div class="form-text fs-8 text-muted">e.g. €, £, ¥, S$</div>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary w-100 rounded-pill fw-semibold border-0" style="background: linear-gradient(135deg, #0284c7, #2563eb);">
                                    Add Currency
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 👤 Account Profile Section --}}
            <div class="premium-card mt-4">
                <div class="mb-4">
                    <h4 class="m-0 fs-5 mb-1">👤 Account Profile</h4>
                    <p class="text-muted fs-7 m-0">Update your user account profile name. Your email address cannot be changed.</p>
                </div>

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-semibold text-muted fs-7">Account Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control rounded-3" value="{{ old('name', Auth::user()->name) }}" required placeholder="e.g. Shadab Alam">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-semibold text-muted fs-7">Email Address (Cannot be changed)</label>
                            <input type="email" class="form-control rounded-3 bg-light-subtle" value="{{ Auth::user()->email }}" readonly disabled>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 fw-semibold border-0" style="background: linear-gradient(135deg, #0284c7, #2563eb);">
                                Update Name
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- 🔒 Change Password Section --}}
            <div class="premium-card mt-4">
                <div class="mb-4">
                    <h4 class="m-0 fs-5 mb-1">🔒 Change Password</h4>
                    <p class="text-muted fs-7 m-0">Update your account password. You will need to enter your current password to confirm the change.</p>
                </div>

                @if(session('password_updated'))
                    <div class="alert alert-success border-0 rounded-3 py-2 mb-3 d-flex align-items-center gap-2" style="font-size:13px; background:#f0fdf4; color:#166534;">
                        ✅ {{ session('password_updated') }}
                    </div>
                @endif

                @if($errors->updatePassword->any())
                    <div class="alert alert-danger border-0 rounded-3 py-2 mb-3" style="font-size:13px;">
                        {{ $errors->updatePassword->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-semibold text-muted fs-7">Current Password <span class="text-danger">*</span></label>
                            <input type="password" name="current_password" class="form-control rounded-3" placeholder="Enter current password" required>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-semibold text-muted fs-7">New Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control rounded-3" placeholder="Enter new password" required>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-semibold text-muted fs-7">Confirm New Password <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" class="form-control rounded-3" placeholder="Confirm new password" required>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-danger rounded-pill px-5 py-2 fw-semibold border-0" style="background:linear-gradient(135deg,#dc2626,#991b1b);">
                                Update Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Logo Preview trigger
    document.getElementById('logo-input').addEventListener('change', function(e) {
        readUrl(this, 'logo-img', 'logo-preview-box', 'logo-prompt');
    });

    // Signature Preview trigger
    document.getElementById('sig-input').addEventListener('change', function(e) {
        readUrl(this, 'sig-img', 'sig-preview-box', 'sig-prompt');
    });

    function readUrl(input, imgId, boxId, promptId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(imgId).src = e.target.result;
                document.getElementById(boxId).style.display = 'block';
                document.getElementById(promptId).style.display = 'none';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
