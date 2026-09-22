@extends('layouts.app')

@section('title', 'User Approval Panel')
@section('header_title', 'User Approval Control Panel')

@section('content')
<div class="container-fluid p-0 d-flex flex-column gap-4">
    
    <!-- Status summary banner / Filter cards -->
    <div class="row g-3">
        <div class="col-12 col-md-3">
            <div class="card border-0 rounded-4 p-3 shadow-sm text-center" style="background-color: white; border: 1px solid var(--glass-border) !important;">
                <div class="small text-muted fw-bold text-uppercase mb-1" style="font-size: 11px;">Total Users</div>
                <h3 class="fw-bold m-0 text-dark">{{ \App\Models\User::where('email', '!=', 'shadabcse2020@gmail.com')->count() }}</h3>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card border-0 rounded-4 p-3 shadow-sm text-center" style="background-color: white; border: 1px solid var(--glass-border) !important;">
                <div class="small text-warning fw-bold text-uppercase mb-1" style="font-size: 11px;">⏳ Pending Approval</div>
                <h3 class="fw-bold m-0 text-warning">{{ \App\Models\User::where('status', 'pending')->where('email', '!=', 'shadabcse2020@gmail.com')->count() }}</h3>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card border-0 rounded-4 p-3 shadow-sm text-center" style="background-color: white; border: 1px solid var(--glass-border) !important;">
                <div class="small text-success fw-bold text-uppercase mb-1" style="font-size: 11px;">✅ Approved Users</div>
                <h3 class="fw-bold m-0 text-success">{{ \App\Models\User::where('status', 'approved')->where('email', '!=', 'shadabcse2020@gmail.com')->count() }}</h3>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card border-0 rounded-4 p-3 shadow-sm text-center" style="background-color: white; border: 1px solid var(--glass-border) !important;">
                <div class="small text-danger fw-bold text-uppercase mb-1" style="font-size: 11px;">❌ Rejected Users</div>
                <h3 class="fw-bold m-0 text-danger">{{ \App\Models\User::where('status', 'rejected')->where('email', '!=', 'shadabcse2020@gmail.com')->count() }}</h3>
            </div>
        </div>
    </div>

    <!-- Filter Tab Bar & Search Card -->
    <div class="premium-card">
        <div class="d-flex flex-column gap-3">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                <!-- Status Filter Tabs -->
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.users.index', ['status' => 'all', 'search' => request('search')]) }}" class="btn rounded-pill px-3 py-1.5 fw-semibold fs-7 {{ $status === 'all' ? 'btn-primary border-0' : 'btn-light border text-muted' }}" style="{{ $status === 'all' ? 'background: linear-gradient(135deg, #0284c7, #2563eb);' : '' }}">
                        All Users
                    </a>
                    <a href="{{ route('admin.users.index', ['status' => 'pending', 'search' => request('search')]) }}" class="btn rounded-pill px-3 py-1.5 fw-semibold fs-7 {{ $status === 'pending' ? 'btn-warning border-0 text-white' : 'btn-light border text-muted' }}">
                        Pending
                    </a>
                    <a href="{{ route('admin.users.index', ['status' => 'approved', 'search' => request('search')]) }}" class="btn rounded-pill px-3 py-1.5 fw-semibold fs-7 {{ $status === 'approved' ? 'btn-success border-0 text-white' : 'btn-light border text-muted' }}">
                        Approved
                    </a>
                    <a href="{{ route('admin.users.index', ['status' => 'rejected', 'search' => request('search')]) }}" class="btn rounded-pill px-3 py-1.5 fw-semibold fs-7 {{ $status === 'rejected' ? 'btn-danger border-0 text-white' : 'btn-light border text-muted' }}">
                        Rejected
                    </a>
                </div>
            </div>

            <!-- Search Bar -->
            <form method="GET" action="{{ route('admin.users.index') }}" class="m-0">
                <input type="hidden" name="status" value="{{ $status }}">
                <div class="input-group">
                    <input type="text" name="search" class="form-control rounded-start-pill border-end-0 px-4" placeholder="Search registered user by name or email..." value="{{ $search }}">
                    <button type="submit" class="btn btn-primary rounded-end-pill px-4" style="background-color: var(--color-primary); border-color: var(--color-primary);">
                        Search
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Alerts -->
    @if(session('success'))
        <div class="alert alert-success border-0 rounded-4 shadow-sm p-3 mb-0">
            {{ session('success') }}
        </div>
    @endif
    @if(session('warning'))
        <div class="alert alert-warning border-0 rounded-4 shadow-sm p-3 mb-0">
            {{ session('warning') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger border-0 rounded-4 shadow-sm p-3 mb-0">
            {{ session('error') }}
        </div>
    @endif

    <!-- Users Table Card -->
    <div class="premium-card">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr class="fs-7 text-uppercase text-muted fw-bold">
                        <th>User Name</th>
                        <th>Email Address</th>
                        <th>Registered Date</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-circle rounded-circle bg-light d-flex align-items-center justify-content-center fw-bold text-primary" style="width:36px; height:36px; border:1px solid var(--glass-border);">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>
                                    <span class="fw-semibold text-dark">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('M d, Y h:i A') }}</td>
                            <td>
                                @if($user->status === 'approved')
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1.5 rounded-pill fs-8">✅ Active / Approved</span>
                                @elseif($user->status === 'rejected')
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-1.5 rounded-pill fs-8">❌ Rejected</span>
                                @else
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-1.5 rounded-pill fs-8">⏳ Pending Approval</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <button class="btn btn-light btn-sm rounded-pill px-3 border" data-bs-toggle="modal" data-bs-target="#userModal_{{ $user->id }}">
                                        View Details
                                    </button>

                                    @if($user->status !== 'approved')
                                        <form method="POST" action="{{ route('admin.users.approve', $user->id) }}" class="m-0">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-success btn-sm rounded-pill px-3 fw-semibold">Approve</button>
                                        </form>
                                    @endif

                                    @if($user->status !== 'rejected')
                                        <form method="POST" action="{{ route('admin.users.reject', $user->id) }}" class="m-0" onsubmit="return confirm('Are you sure you want to REJECT this registration request?');">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3 fw-semibold">Reject</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>

                        <!-- Details Modal for this User -->
                        <div class="modal fade" id="userModal_{{ $user->id }}" tabindex="-1" aria-labelledby="userModalLabel_{{ $user->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content rounded-4 border-0 shadow-lg">
                                    <div class="modal-header border-bottom-0 pb-0 px-4 pt-4">
                                        <h5 class="modal-title fw-bold" id="userModalLabel_{{ $user->id }}" style="font-family:'Outfit';">User Registration Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body px-4 py-3">
                                        <div class="d-flex align-items-center gap-3 mb-4 p-3 rounded-4" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
                                            <div class="avatar bg-primary text-white rounded-3 d-flex align-items-center justify-content-center fw-bold fs-4" style="width:54px; height:54px;">
                                                {{ strtoupper(substr($user->name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <h5 class="m-0 fw-bold text-dark">{{ $user->name }}</h5>
                                                <p class="m-0 text-muted small">{{ $user->email }}</p>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="small text-muted fw-semibold d-block mb-1">Registration Date</label>
                                            <div class="bg-light p-2 rounded-3 border-0 fs-7 fw-semibold text-dark">
                                                🗓 {{ $user->created_at->format('l, F d, Y @ h:i A') }}
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="small text-muted fw-semibold d-block mb-1">Status</label>
                                            <div class="bg-light p-2 rounded-3 border-0 fs-7 fw-semibold text-dark">
                                                @if($user->status === 'approved')
                                                    🟢 Approved (User can log in and manage invoices)
                                                @elseif($user->status === 'rejected')
                                                    🔴 Rejected (User login is blocked)
                                                @else
                                                    🟡 Pending Approval (User cannot access platform)
                                                @endif
                                            </div>
                                        </div>

                                        <div class="mb-2">
                                            <label class="small text-muted fw-semibold d-block mb-1">Assigned Resources</label>
                                            <div class="bg-light p-2 rounded-3 border-0 fs-7 text-muted">
                                                <span class="d-block mb-1">📄 Invoices: <strong>{{ $user->invoices()->count() }}</strong></span>
                                                <span class="d-block">👤 Clients: <strong>{{ $user->clients()->count() }}</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-top-0 px-4 pb-4 pt-0 justify-content-end gap-2">
                                        <button type="button" class="btn btn-light rounded-pill px-4 border" data-bs-dismiss="modal">Close</button>
                                        
                                        @if($user->status !== 'approved')
                                            <form method="POST" action="{{ route('admin.users.approve', $user->id) }}" class="m-0">
                                                @csrf
                                                <button type="submit" class="btn btn-success rounded-pill px-4 border-0" style="background-color: #059669;">Approve Account</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">
                                <svg class="mb-3 text-muted" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                <p class="m-0 fw-semibold">No registration requests found</p>
                                <p class="fs-7 text-muted">There are no accounts matching the selected criteria.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="mt-4 d-flex justify-content-center">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
