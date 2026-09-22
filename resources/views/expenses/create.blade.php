@extends('layouts.app')

@section('title', 'Record Expense')
@section('header_title', 'Record New Expense')

@section('content')
<div class="container-fluid p-0 d-flex flex-column gap-4" style="max-width: 800px;">
    
    <div class="premium-card">
        <div class="mb-4">
            <h4 class="m-0 fs-5 mb-1">Expense Information</h4>
            <p class="text-muted fs-7 m-0">Enter the invoice particulars and log tax credentials below.</p>
        </div>

        <form method="POST" action="{{ route('expenses.store') }}" enctype="multipart/form-data" id="expense-form">
            @csrf

            <div class="row g-3">
                <!-- Date -->
                <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold text-muted fs-7">Expense Date <span class="text-danger">*</span></label>
                    <input type="date" name="expense_date" class="form-control rounded-3 @error('expense_date') is-invalid @enderror" value="{{ old('expense_date', date('Y-m-d')) }}" required>
                    @error('expense_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Vendor Name -->
                <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold text-muted fs-7">Vendor Name <span class="text-danger">*</span></label>
                    <input type="text" name="vendor_name" class="form-control rounded-3 @error('vendor_name') is-invalid @enderror" value="{{ old('vendor_name') }}" placeholder="e.g. Hostinger, Airtel, Local Vendor" required>
                    @error('vendor_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Vendor GSTIN -->
                <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold text-muted fs-7">Vendor GSTIN (Optional)</label>
                    <input type="text" name="vendor_gstin" class="form-control rounded-3 @error('vendor_gstin') is-invalid @enderror" value="{{ old('vendor_gstin') }}" placeholder="e.g. 27AAAAA1111A1Z1" style="text-transform: uppercase;">
                    @error('vendor_gstin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Category -->
                <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold text-muted fs-7">Category <span class="text-danger">*</span></label>
                    <select name="category_select" id="category_select" class="form-select rounded-3" required>
                        <option value="Software & Subscriptions" {{ old('category') === 'Software & Subscriptions' ? 'selected' : '' }}>Software & Subscriptions</option>
                        <option value="Domain & Hosting" {{ old('category') === 'Domain & Hosting' ? 'selected' : '' }}>Domain & Hosting</option>
                        <option value="Utilities & Internet" {{ old('category') === 'Utilities & Internet' ? 'selected' : '' }}>Utilities & Internet</option>
                        <option value="Office Supplies" {{ old('category') === 'Office Supplies' ? 'selected' : '' }}>Office Supplies</option>
                        <option value="Rent & Workspace" {{ old('category') === 'Rent & Workspace' ? 'selected' : '' }}>Rent & Workspace</option>
                        <option value="Marketing & Advertising" {{ old('category') === 'Marketing & Advertising' ? 'selected' : '' }}>Marketing & Advertising</option>
                        <option value="custom" {{ old('category_select') === 'custom' ? 'selected' : '' }}>Other / Custom (Specify...)</option>
                    </select>
                    <input type="hidden" name="category" id="category_hidden" value="{{ old('category', 'Software & Subscriptions') }}">
                </div>

                <!-- Custom Category Input -->
                <div class="col-12 d-none" id="custom-category-group">
                    <label class="form-label fw-semibold text-muted fs-7">Specify Custom Category <span class="text-danger">*</span></label>
                    <input type="text" id="custom_category_input" class="form-control rounded-3" placeholder="Enter custom category name">
                </div>

                <hr class="my-4 text-muted opacity-25">

                <!-- Base Amount -->
                <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold text-muted fs-7">Base Amount (INR) <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-3">₹</span>
                        <input type="number" step="0.01" min="0" name="base_amount" id="base_amount" class="form-control rounded-end-3 @error('base_amount') is-invalid @enderror" value="{{ old('base_amount', '0.00') }}" required>
                    </div>
                    @error('base_amount')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- GST Type Selector -->
                <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold text-muted fs-7">GST Tax Configuration</label>
                    <select id="gst_type" class="form-select rounded-3">
                        <option value="none">None (Exempt / Out of Scope)</option>
                        <option value="local_18" selected>Local GST 18% (9% CGST + 9% SGST)</option>
                        <option value="local_12">Local GST 12% (6% CGST + 6% SGST)</option>
                        <option value="local_5">Local GST 5% (2.5% CGST + 2.5% SGST)</option>
                        <option value="local_28">Local GST 28% (14% CGST + 14% SGST)</option>
                        <option value="igst_18">Out-of-State IGST 18%</option>
                        <option value="igst_12">Out-of-State IGST 12%</option>
                        <option value="igst_5">Out-of-State IGST 5%</option>
                        <option value="igst_28">Out-of-State IGST 28%</option>
                        <option value="custom">Custom Tax Calculations (Manual Input)</option>
                    </select>
                </div>

                <!-- CGST -->
                <div class="col-12 col-md-4">
                    <label class="form-label fw-semibold text-muted fs-7">CGST (INR)</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-3">₹</span>
                        <input type="number" step="0.01" min="0" name="cgst" id="cgst" class="form-control rounded-end-3" value="{{ old('cgst', '0.00') }}" readonly>
                    </div>
                </div>

                <!-- SGST -->
                <div class="col-12 col-md-4">
                    <label class="form-label fw-semibold text-muted fs-7">SGST (INR)</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-3">₹</span>
                        <input type="number" step="0.01" min="0" name="sgst" id="sgst" class="form-control rounded-end-3" value="{{ old('sgst', '0.00') }}" readonly>
                    </div>
                </div>

                <!-- IGST -->
                <div class="col-12 col-md-4">
                    <label class="form-label fw-semibold text-muted fs-7">IGST (INR)</label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-3">₹</span>
                        <input type="number" step="0.01" min="0" name="igst" id="igst" class="form-control rounded-end-3" value="{{ old('igst', '0.00') }}" readonly>
                    </div>
                </div>

                <!-- Total Amount -->
                <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold text-muted fs-7">Grand Total (INR) <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text rounded-start-3">₹</span>
                        <input type="number" step="0.01" min="0" name="total_amount" id="total_amount" class="form-control rounded-end-3 bg-light @error('total_amount') is-invalid @enderror" value="{{ old('total_amount', '0.00') }}" readonly required>
                    </div>
                    @error('total_amount')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Payment Mode -->
                <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold text-muted fs-7">Payment Mode</label>
                    <select name="payment_mode" class="form-select rounded-3">
                        <option value="Current Account Debit Card" {{ old('payment_mode') === 'Current Account Debit Card' ? 'selected' : '' }}>Current Account Debit Card</option>
                        <option value="Net Banking" {{ old('payment_mode') === 'Net Banking' ? 'selected' : '' }}>Net Banking</option>
                        <option value="Credit Card" {{ old('payment_mode') === 'Credit Card' ? 'selected' : '' }}>Credit Card</option>
                        <option value="UPI / GPay / PhonePe" {{ old('payment_mode') === 'UPI / GPay / PhonePe' ? 'selected' : '' }}>UPI / GPay / PhonePe</option>
                        <option value="Cash" {{ old('payment_mode') === 'Cash' ? 'selected' : '' }}>Cash</option>
                    </select>
                </div>

                <!-- Receipt Upload -->
                <div class="col-12">
                    <label class="form-label fw-semibold text-muted fs-7">Attach Invoice Receipt (PDF or Image, max 5MB)</label>
                    <input type="file" name="receipt" class="form-control rounded-3 @error('receipt') is-invalid @enderror" accept=".pdf,image/png,image/jpeg,image/jpg">
                    @error('receipt')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- ITC Flag Checkbox -->
                <div class="col-12 mt-4">
                    <div class="form-check form-switch p-3 bg-light rounded-3 border border-slate-100 d-flex justify-content-between align-items-center">
                        <div class="pe-3">
                            <label class="form-check-label fw-bold text-dark fs-6 d-block mb-1" for="is_itc_eligible">Eligible for GST Input Tax Credit (ITC)?</label>
                            <span class="text-muted fs-7">Turn this ON if the vendor invoice contains your official GSTIN and is claimable under GSTR-2B filing.</span>
                        </div>
                        <input class="form-check-input ms-0" type="checkbox" role="switch" name="is_itc_eligible" id="is_itc_eligible" value="1" {{ old('is_itc_eligible') ? 'checked' : '' }} style="width: 48px; height: 24px; cursor: pointer;">
                    </div>
                </div>

                <!-- Submission Actions -->
                <div class="col-12 mt-4 d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-primary rounded-pill px-4 py-2.5 fw-semibold border-0" style="background: linear-gradient(135deg, #0284c7, #2563eb);">
                        Record Expense
                    </button>
                    <a href="{{ route('expenses.index') }}" class="btn btn-light rounded-pill px-4 py-2.5 fw-semibold text-dark">
                        Cancel
                    </a>
                </div>

            </div>
        </form>
    </div>
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('category_select');
        const customCategoryGroup = document.getElementById('custom-category-group');
        const customCategoryInput = document.getElementById('custom_category_input');
        const categoryHidden = document.getElementById('category_hidden');
        
        const baseAmountInput = document.getElementById('base_amount');
        const gstTypeSelect = document.getElementById('gst_type');
        const cgstInput = document.getElementById('cgst');
        const sgstInput = document.getElementById('sgst');
        const igstInput = document.getElementById('igst');
        const totalAmountInput = document.getElementById('total_amount');
        
        // --- Category Selection Toggles ---
        function updateCategoryHidden() {
            if (categorySelect.value === 'custom') {
                categoryHidden.value = customCategoryInput.value.trim() || 'Miscellaneous';
            } else {
                categoryHidden.value = categorySelect.value;
            }
        }

        categorySelect.addEventListener('change', function() {
            if (this.value === 'custom') {
                customCategoryGroup.classList.remove('d-none');
                customCategoryInput.setAttribute('required', 'required');
            } else {
                customCategoryGroup.classList.add('d-none');
                customCategoryInput.removeAttribute('required');
            }
            updateCategoryHidden();
        });

        customCategoryInput.addEventListener('input', updateCategoryHidden);

        // --- GST Calculations ---
        function calculateTaxes() {
            const baseAmount = parseFloat(baseAmountInput.value) || 0;
            const gstType = gstTypeSelect.value;
            
            let cgst = 0;
            let sgst = 0;
            let igst = 0;

            if (gstType !== 'custom') {
                cgstInput.setAttribute('readonly', 'readonly');
                sgstInput.setAttribute('readonly', 'readonly');
                igstInput.setAttribute('readonly', 'readonly');
                
                if (gstType.startsWith('local_')) {
                    const rate = parseInt(gstType.split('_')[1]) || 0;
                    const taxFactor = rate / 100;
                    const halfTax = (baseAmount * taxFactor) / 2;
                    cgst = halfTax;
                    sgst = halfTax;
                } else if (gstType.startsWith('igst_')) {
                    const rate = parseInt(gstType.split('_')[1]) || 0;
                    const taxFactor = rate / 100;
                    igst = baseAmount * taxFactor;
                }

                cgstInput.value = cgst.toFixed(2);
                sgstInput.value = sgst.toFixed(2);
                igstInput.value = igst.toFixed(2);
            } else {
                // If custom, allow editing
                cgstInput.removeAttribute('readonly');
                sgstInput.removeAttribute('readonly');
                igstInput.removeAttribute('readonly');
                
                cgst = parseFloat(cgstInput.value) || 0;
                sgst = parseFloat(sgstInput.value) || 0;
                igst = parseFloat(igstInput.value) || 0;
            }

            const total = baseAmount + cgst + sgst + igst;
            totalAmountInput.value = total.toFixed(2);
        }

        baseAmountInput.addEventListener('input', calculateTaxes);
        gstTypeSelect.addEventListener('change', function() {
            if (this.value === 'custom') {
                cgstInput.value = '0.00';
                sgstInput.value = '0.00';
                igstInput.value = '0.00';
            }
            calculateTaxes();
        });

        cgstInput.addEventListener('input', calculateTaxes);
        sgstInput.addEventListener('input', calculateTaxes);
        igstInput.addEventListener('input', calculateTaxes);

        // Initial trigger
        calculateTaxes();
    });
</script>
@endsection
@endsection
