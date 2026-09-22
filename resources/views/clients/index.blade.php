@extends('layouts.app')

@section('title', 'Client Directory')
@section('header_title', 'Client Directory Management')

@section('content')
<div class="container-fluid p-0 d-flex flex-column gap-4">
    
    <!-- Header Bar with Add Client -->
    <div class="premium-card">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
            <div>
                <h4 class="m-0 fs-5 mb-1">Business Clients</h4>
                <p class="text-muted fs-7 m-0">Create and search client entities used for invoice auto-filling.</p>
            </div>
            
            <button class="btn btn-primary rounded-pill px-4 fw-semibold border-0" style="background: linear-gradient(135deg, #0284c7, #2563eb);" data-bs-toggle="modal" data-bs-target="#addClientModal">
                + Add Client
            </button>
        </div>

        <hr class="my-4 text-muted opacity-25">

        <!-- Search Bar -->
        <form method="GET" action="{{ route('clients.index') }}" class="m-0">
            <div class="input-group">
                <input type="text" name="search" class="form-control rounded-start-pill border-end-0 px-4" placeholder="Search by name, email, phone..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary rounded-end-pill px-4" style="background-color: var(--color-primary); border-color: var(--color-primary);">
                    Search
                </button>
            </div>
        </form>
    </div>

    <!-- Clients Table -->
    <div class="premium-card">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr class="fs-7 text-uppercase text-muted fw-bold">
                        <th>Client Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>GST/VAT Number</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clients as $client)
                        <tr>
                            <td class="fw-semibold">{{ $client->name }}</td>
                            <td>{{ $client->email ?: '—' }}</td>
                            <td>{{ $client->phone ?: '—' }}</td>
                            <td class="text-muted fs-7" style="max-width: 240px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                {{ $client->address ?: '—' }}
                            </td>
                            <td>
                                @if($client->gst_number)
                                    <span class="badge bg-light text-secondary border border-secondary-subtle px-2 py-1">{{ $client->gst_number }}</span>
                                @else
                                    —
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-light btn-sm rounded-pill px-3">Edit</a>
                                    
                                    <form method="POST" action="{{ route('clients.destroy', $client->id) }}" class="m-0" onsubmit="return confirm('Are you sure you want to delete this client?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">
                                <svg class="mb-3 text-muted" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                <p class="m-0 fw-semibold">No clients registered</p>
                                <p class="fs-7 text-muted">Register a client to speed up invoice generation.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($clients->hasPages())
            <div class="mt-4 d-flex justify-content-center">
                {{ $clients->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Add Client Modal -->
<div class="modal fade" id="addClientModal" tabindex="-1" aria-labelledby="addClientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header border-bottom-0 pb-0 px-4 pt-4">
                <h5 class="modal-title fs-5" id="addClientModalLabel">Add Client Entity</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form method="POST" action="{{ route('clients.store') }}">
                @csrf
                <div class="modal-body px-4 py-3">
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted fs-7">Client/Business Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control rounded-3" required placeholder="e.g. Acme Corp">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted fs-7">Contact Email Address</label>
                        <input type="email" name="email" class="form-control rounded-3" placeholder="e.g. accounts@acme.com">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted fs-7">Contact Phone Number</label>
                        <input type="text" name="phone" class="form-control rounded-3" placeholder="e.g. +91 98765 43210">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted fs-7">GSTIN / VAT Number</label>
                        <input type="text" name="gst_number" class="form-control rounded-3" placeholder="e.g. 27AAAAA1111A1Z1">
                    </div>

                    <div class="mb-2">
                        <label class="form-label fw-semibold text-muted fs-7">Billing Address</label>
                        <textarea name="address" rows="3" class="form-control rounded-3" placeholder="Street, City, Zip..."></textarea>
                    </div>
                </div>

                <div class="modal-footer border-top-0 px-4 pb-4 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-toggle="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 border-0" style="background: linear-gradient(135deg, #0284c7, #2563eb);">Save Client</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
