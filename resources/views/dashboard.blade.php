@extends('layouts.app')

@section('title', 'Dashboard')
@section('header_title', 'Invoice Analytics Dashboard')

@section('styles')
<style>
    .card-metric {
        position: relative;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .card-metric:hover {
        transform: translateY(-5px);
    }
    .metric-value {
        font-size: 26px;
        font-weight: 800;
        letter-spacing: -0.02em;
        margin: 8px 0;
    }
    .metric-icon {
        height: 48px;
        width: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }
    .badge-status {
        padding: 5px 12px;
        font-size: 11px;
        font-weight: 700;
        border-radius: 30px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        display: inline-block;
    }
    .badge-paid {
        background-color: #ecfdf5;
        color: #059669;
        border: 1px solid #a7f3d0;
    }
    .badge-sent {
        background-color: #eff6ff;
        color: #1d4ed8;
        border: 1px solid #bfdbfe;
    }
    .badge-draft {
        background-color: #f1f5f9;
        color: #475569;
        border: 1px solid #cbd5e1;
    }
    .badge-overdue {
        background-color: #fff1f2;
        color: #e11d48;
        border: 1px solid #fecdd3;
    }
    .chart-container {
        position: relative;
        height: 300px;
        width: 100%;
    }
    .alert-overdue-card {
        background: linear-gradient(135deg, #fff5f5, #ffebeb);
        border: 1px dashed #feb2b2;
        border-radius: 16px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid p-0 d-flex flex-column gap-4">
    
    <!-- Metrics Grid -->
    <div class="row g-4">
        <!-- P&L Row -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="premium-card card-metric d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase text-muted fw-bold mb-1" style="font-size: 11px; letter-spacing: 0.08em;">Total Revenue</p>
                    <h3 class="metric-value text-success">₹{{ number_format($totalRevenue, 2) }}</h3>
                    <span class="text-muted fs-7">Collected from paid invoices</span>
                </div>
                <div class="metric-icon" style="background-color: #ecfdf5; color: #10b981;">
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="premium-card card-metric d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase text-muted fw-bold mb-1" style="font-size: 11px; letter-spacing: 0.08em;">Total Expenses</p>
                    <h3 class="metric-value text-danger">₹{{ number_format($totalExpenses, 2) }}</h3>
                    <span class="text-muted fs-7">Logged business expenses</span>
                </div>
                <div class="metric-icon" style="background-color: #fff1f2; color: #e11d48;">
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="premium-card card-metric d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase text-muted fw-bold mb-1" style="font-size: 11px; letter-spacing: 0.08em;">Net Business Profit</p>
                    <h3 class="metric-value {{ $netProfit >= 0 ? 'text-primary' : 'text-danger' }}">₹{{ number_format($netProfit, 2) }}</h3>
                    <span class="text-muted fs-7">Revenue - Expenses</span>
                </div>
                <div class="metric-icon" style="background-color: #f0f9ff; color: #0284c7;">
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2m0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
            </div>
        </div>

        <!-- Invoicing Details Row -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="premium-card card-metric d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase text-muted fw-bold mb-1" style="font-size: 11px; letter-spacing: 0.08em;">Outstanding Due</p>
                    <h3 class="metric-value text-primary">₹{{ number_format($pendingRevenue, 2) }}</h3>
                    <span class="text-muted fs-7">Draft & sent amount</span>
                </div>
                <div class="metric-icon" style="background-color: #eff6ff; color: #3b82f6;">
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="premium-card card-metric d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase text-muted fw-bold mb-1" style="font-size: 11px; letter-spacing: 0.08em;">Overdue Invoices</p>
                    <h3 class="metric-value text-danger">{{ $overdueCount }}</h3>
                    <span class="text-muted fs-7">Critical collection action needed</span>
                </div>
                <div class="metric-icon" style="background-color: #fff1f2; color: #f43f5e;">
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="premium-card card-metric d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase text-muted fw-bold mb-1" style="font-size: 11px; letter-spacing: 0.08em;">Paid Invoices</p>
                    <h3 class="metric-value" style="color: #0f172a;">{{ $paidInvoicesCount }}</h3>
                    <span class="text-muted fs-7">Completed transactions</span>
                </div>
                <div class="metric-icon" style="background-color: #f0fdf4; color: #16a34a;">
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-6">
            <div class="premium-card card-metric d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase text-muted fw-bold mb-1" style="font-size: 11px; letter-spacing: 0.08em;">Pending Action</p>
                    <h3 class="metric-value text-info">{{ $pendingInvoicesCount }}</h3>
                    <span class="text-muted fs-7">Sent invoices awaiting payment</span>
                </div>
                <div class="metric-icon" style="background-color: #f0f9ff; color: #0284c7;">
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-6">
            <div class="premium-card card-metric d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase text-muted fw-bold mb-1" style="font-size: 11px; letter-spacing: 0.08em;">Active Quotations</p>
                    <h3 class="metric-value text-purple" style="color: #8b5cf6;">{{ $quotationCount }}</h3>
                    <span class="text-muted fs-7">Quotes & Proformas generated</span>
                </div>
                <div class="metric-icon" style="background-color: #f5f3ff; color: #8b5cf6;">
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row g-4">
        <!-- 12-Month Revenue Comparison Bar Chart -->
        <div class="col-12 col-lg-8">
            <div class="premium-card">
                <h4 class="mb-4 fs-5">Revenue Performance (Last 12 Months)</h4>
                <div class="chart-container">
                    <canvas id="revenueBarChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Invoice Status Share Donut Chart -->
        <div class="col-12 col-lg-4">
            <div class="premium-card h-100">
                <h4 class="mb-4 fs-5">Status Distribution</h4>
                <div class="chart-container d-flex align-items-center justify-content-center">
                    <canvas id="statusDonutChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Overdue Invoice Alerts (If exists) -->
    @if($overdueInvoices->count() > 0)
    <div class="premium-card alert-overdue-card p-4">
        <div class="d-flex align-items-center gap-2 mb-3">
            <span style="font-size: 20px;">⚠️</span>
            <h4 class="m-0 fs-5 text-danger fw-bold">Critical Overdue Invoices Alert</h4>
        </div>
        <p class="text-muted fs-7 mb-4">The following invoices are past their due date. Immediate followup action is recommended.</p>
        
        <div class="table-responsive">
            <table class="table align-middle table-borderless m-0">
                <thead>
                    <tr class="fs-8 text-uppercase text-muted fw-bold">
                        <th>Invoice</th>
                        <th>Client</th>
                        <th>Due Date</th>
                        <th>Amount</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($overdueInvoices as $overdue)
                    <tr style="border-bottom: 1px solid rgba(225, 29, 72, 0.1);">
                        <td class="fw-bold text-danger">{{ $overdue->invoice_number }}</td>
                        <td class="fw-semibold text-dark">{{ $overdue->client->name ?? 'N/A' }}</td>
                        <td class="text-danger fw-medium">{{ $overdue->due_date->format('M d, Y') }} ({{ $overdue->due_date->diffForHumans() }})</td>
                        <td class="fw-extrabold text-danger">{{ $overdue->currency_symbol }}{{ number_format($overdue->grand_total, 2) }}</td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('invoices.show', $overdue->id) }}" class="btn btn-danger btn-xs rounded-pill px-3 fs-8 text-white border-0" style="background-color:#e11d48; padding: 4px 12px;">View & Send Reminder</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- Recent Invoices & Quick Actions -->
    <div class="row g-4">
        <!-- Recent Invoices Table -->
        <div class="col-12 col-lg-8">
            <div class="premium-card h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="m-0 fs-5">Recent Invoices</h4>
                    <a href="{{ route('invoices.index') }}" class="btn btn-light btn-sm rounded-pill px-3">View All</a>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr class="fs-7 text-uppercase text-muted fw-bold">
                                <th>Invoice</th>
                                <th>Client</th>
                                <th>Due Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentInvoices as $invoice)
                                <tr>
                                    <td class="fw-semibold">{{ $invoice->invoice_number }}</td>
                                    <td>{{ $invoice->client->name ?? 'N/A' }}</td>
                                    <td class="text-muted">{{ $invoice->due_date ? $invoice->due_date->format('M d, Y') : 'N/A' }}</td>
                                    <td class="fw-bold">{{ $invoice->currency_symbol }}{{ number_format($invoice->grand_total, 2) }}</td>
                                    <td>
                                        <span class="badge-status badge-{{ $invoice->status }}">{{ $invoice->status }}</span>
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown">
                                            <button class="btn btn-light btn-sm rounded-pill" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                •••
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm rounded-3">
                                                <li><a class="dropdown-item py-2" href="{{ route('invoices.show', $invoice->id) }}">View Details</a></li>
                                                <li><a class="dropdown-item py-2" href="{{ route('invoices.edit', $invoice->id) }}">Edit Record</a></li>
                                                <li><a class="dropdown-item py-2 text-primary" href="{{ route('invoices.pdf', $invoice->id) }}">Download PDF</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-5">
                                        <svg class="mb-3 text-muted" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        <p class="m-0 fw-semibold">No invoices generated yet</p>
                                        <p class="fs-7 text-muted">Create your first invoice to see stats populate!</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Quick Actions Sidebar -->
        <div class="col-12 col-lg-4">
            <div class="premium-card h-100 d-flex flex-column justify-content-between">
                <div>
                    <h4 class="mb-3 fs-5">Quick Actions</h4>
                    <p class="text-muted fs-7 mb-4">Easily construct invoices, generate quotations, update settings, or register clients instantly.</p>
                    
                    <div class="d-flex flex-column gap-3">
                        <a href="{{ route('invoices.create') }}" class="btn btn-primary d-flex align-items-center justify-content-center gap-2 py-3 rounded-4 fw-semibold border-0" style="background: linear-gradient(135deg, #0284c7, #2563eb);">
                            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                            Create New Invoice
                        </a>

                        <a href="{{ route('invoices.create', ['type' => 'quotation']) }}" class="btn btn-purple d-flex align-items-center justify-content-center gap-2 py-3 rounded-4 fw-semibold text-white border-0" style="background: linear-gradient(135deg, #8b5cf6, #6d28d9);">
                            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            Create New Quotation
                        </a>

                        <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary d-flex align-items-center justify-content-center gap-2 py-3 rounded-4 fw-semibold">
                            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                            Add New Client
                        </a>

                        <a href="{{ route('settings.edit') }}" class="btn btn-light d-flex align-items-center justify-content-center gap-2 py-3 rounded-4 fw-semibold text-dark">
                            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Configure Business Details
                        </a>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-top text-center text-muted fs-8">
                    Made by <a href="https://codxpert.com" target="_blank" class="fw-semibold text-primary text-decoration-none">codxpert.com</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Load Chart.js from premium high-speed CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // --- 12-Month Revenue Comparison Bar Chart ---
        const ctxBar = document.getElementById('revenueBarChart').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: {!! json_encode($monthlyLabels) !!},
                datasets: [
                    {
                        label: 'Paid Revenue',
                        data: {!! json_encode($monthlyPaid) !!},
                        backgroundColor: 'rgba(16, 185, 129, 0.85)',
                        borderColor: '#10b981',
                        borderWidth: 1,
                        borderRadius: 6
                    },
                    {
                        label: 'Pending Revenue',
                        data: {!! json_encode($monthlyPending) !!},
                        backgroundColor: 'rgba(59, 130, 246, 0.85)',
                        borderColor: '#3b82f6',
                        borderWidth: 1,
                        borderRadius: 6
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: { family: 'Plus Jakarta Sans', weight: 600, size: 11 }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { drawBorder: false, color: 'rgba(0,0,0,0.05)' },
                        ticks: {
                            font: { family: 'Plus Jakarta Sans' },
                            callback: function(value) { return '₹' + value.toLocaleString(); }
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: {
                            font: { family: 'Plus Jakarta Sans' }
                        }
                    }
                }
            }
        });

        // --- Status Distribution Donut Chart ---
        const ctxDonut = document.getElementById('statusDonutChart').getContext('2d');
        new Chart(ctxDonut, {
            type: 'doughnut',
            data: {
                labels: ['Paid', 'Sent', 'Draft', 'Overdue'],
                datasets: [{
                    data: [
                        {{ $statusDistribution['paid'] }},
                        {{ $statusDistribution['sent'] }},
                        {{ $statusDistribution['draft'] }},
                        {{ $statusDistribution['overdue'] }}
                    ],
                    backgroundColor: ['#10b981', '#3b82f6', '#64748b', '#ef4444'],
                    borderWidth: 2,
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: { family: 'Plus Jakarta Sans', weight: 600, size: 11 }
                        }
                    }
                },
                cutout: '70%'
            }
        });
    });
</script>
@endsection
