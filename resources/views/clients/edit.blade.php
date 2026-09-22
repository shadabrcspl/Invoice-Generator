@extends('layouts.app')

@section('title', 'Edit Client')
@section('header_title', 'Modify Client Entity')

@section('content')
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="premium-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="m-0 fs-5">Edit Client Details</h4>
                    <a href="{{ route('clients.index') }}" class="btn btn-light btn-sm rounded-pill px-3">← Back</a>
                </div>

                <form method="POST" action="{{ route('clients.update', $client->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted fs-7">Client/Business Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control rounded-3" value="{{ old('name', $client->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted fs-7">Contact Email Address</label>
                        <input type="email" name="email" class="form-control rounded-3" value="{{ old('email', $client->email) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted fs-7">Contact Phone Number</label>
                        <input type="text" name="phone" class="form-control rounded-3" value="{{ old('phone', $client->phone) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted fs-7">GSTIN / VAT Number</label>
                        <input type="text" name="gst_number" class="form-control rounded-3" value="{{ old('gst_number', $client->gst_number) }}">
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted fs-7">Billing Address</label>
                        <textarea name="address" rows="3" class="form-control rounded-3">{{ old('address', $client->address) }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary rounded-pill px-4 border-0" style="background: linear-gradient(135deg, #0284c7, #2563eb);">Update Client</button>
                        <a href="{{ route('clients.index') }}" class="btn btn-light rounded-pill px-4">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
