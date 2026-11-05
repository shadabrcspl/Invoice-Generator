@extends('layouts.app')

@section('title', 'Profit & Loss Statement')
@section('header_title', 'Monthly Profit & Loss Statement')

@section('styles')
<style>
    .pl-metric-card {
        background: var(--glass-bg);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        padding: 22px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .pl-metric-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 28px -10px rgba(0,0,0,0.08);
    }
    .hero-profit-card {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        color: #ffffff;
        border: 1px solid #334155;
    }
    .hero-profit-card.profit-positive {
        border-left: 6px solid #10b981 !important;
    }
    .hero-profit-card.profit-negative {
        border-left: 6px solid #ef4444 !important;
    }
    .category-progress {
        height: 8px;
        border-radius: 6px;
        background-color: #e2e8f0;
        overflow: hidden;
    }
    .category-progress-bar {
        height: 100%;
        border-radius: 6px;
        transition: width 0.6s ease;
    }
    .nav-tabs-pl .nav-link {
        font-weight: 600;
        color: #64748b;
        border: none;
        padding: 12px 20px;
        border-radius: 12px;
        transition: all 0.2s ease;
    }
    .nav-tabs-pl .nav-link.active {
        color: #0284c7;
        background-color: #f0f9ff;
    }
    @media print {
        .sidebar, .nav-header, .no-print {
            display: none !important;
        }
        .main-content {
            margin-left: 0 !important;
            padding: 0 !important;
        }
        .premium-card, .pl-metric-card {
            box-shadow: none !important;
            border: 1px solid #cbd5e1 !important;
            break-inside: avoid;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid p-0 d-flex flex-column gap-4">

    <!-- Top Filter & Period Control Bar -->
    <div class="premium-card p-3 p-md-4">
        <div class="row align-items-center g-3">
            <div class="col-12 col-md-5">
                <div class="d-flex align-items-center gap-2">
                    <div class="p-2.5 rounded-3 bg-primary-subtle text-primary">
                        <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0 text-dark">{{ $periodLabel }}</h4>
                        <span class="fs-7 text-muted">Comprehensive Net Profit & Cash Realization Audit</span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-7">
                <form method="GET" action="{{ route('profit-loss.index') }}" class="d-flex flex-wrap align-items-center justify-content-md-end gap-2 no-print">
                    
                    @if($prevMonth)
                        <a href="{{ route('profit-loss.index', ['period' => $prevMonth]) }}" class="btn btn-light btn-sm rounded-pill px-3 border shadow-xs" title="Previous Month">
                            ← Prev
                        </a>
                    @endif

                    <!-- Month Select Dropdown -->
                    <div style="min-width: 170px;">
                        <select name="period" class="form-select form-select-sm rounded-pill px-3 fw-semibold" onchange="this.form.submit()" style="border-color: #cbd5e1;">
                            <optgroup label="Monthly Statements">
                                @foreach($allMonths as $m)
                                    <option value="{{ $m }}" {{ $selectedPeriod === $m ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::createFromFormat('Y-m', $m)->format('F Y') }}
                                    </option>
                                @endforeach
                            </optgroup>
                            <optgroup label="Annual Financial Year">
                                <option value="FY-2026-2027" {{ $selectedPeriod === 'FY-2026-2027' ? 'selected' : '' }}>Full FY 2026-27 (Apr-Mar)</option>
                            </optgroup>
                        </select>
                    </div>

                    @if($nextMonth)
                        <a href="{{ route('profit-loss.index', ['period' => $nextMonth]) }}" class="btn btn-light btn-sm rounded-pill px-3 border shadow-xs" title="Next Month">
                            Next →
                        </a>
                    @endif

                    <button type="button" onclick="window.print()" class="btn btn-outline-secondary btn-sm rounded-pill px-3 d-inline-flex align-items-center gap-1 shadow-xs">
                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                        <span>Print</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Hero Profit & Loss Cards Grid -->
    <div class="row g-3">
        <!-- Hero: True Realized Cash Profit -->
        <div class="col-12 col-xl-4 col-md-6">
            <div class="pl-metric-card hero-profit-card {{ $realizedNetProfit >= 0 ? 'profit-positive' : 'profit-negative' }} h-100 shadow-sm">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <span class="fs-8 text-uppercase tracking-wider fw-bold text-slate-300">True In-Hand Net Cash Profit</span>
                    @if($realizedNetProfit >= 0)
                        <span class="badge rounded-pill bg-success-subtle text-success px-2.5 py-1 fs-8 fw-bold">✓ Net Surplus</span>
                    @else
                        <span class="badge rounded-pill bg-danger-subtle text-danger px-2.5 py-1 fs-8 fw-bold">⚠️ Cash Deficit</span>
                    @endif
                </div>
                <h2 class="display-6 fw-bold mb-1 {{ $realizedNetProfit >= 0 ? 'text-emerald-400' : 'text-rose-400' }}" style="color: {{ $realizedNetProfit >= 0 ? '#34d399' : '#f87171' }};">
                    ₹{{ number_format($realizedNetProfit, 2) }}
                </h2>
                <div class="d-flex align-items-center gap-2 mt-2 pt-2 border-top border-slate-700 fs-8 text-slate-300">
                    <span>Cash Margin: <strong>{{ $realizedMarginPct }}%</strong></span>
                    <span>•</span>
                    <span>Bank Inflow − Outflow</span>
                </div>
            </div>
        </div>

        <!-- Metric 2: Realized Inflow (Bank Deposited) -->
        <div class="col-12 col-xl-2 col-md-6">
            <div class="pl-metric-card h-100 shadow-xs">
                <span class="fs-8 text-uppercase tracking-wider fw-bold text-muted d-block mb-1">Realized Inflow (Bank)</span>
                <h3 class="fw-bold text-dark mb-1">₹{{ number_format($totalRealizedInflow, 2) }}</h3>
                <span class="badge bg-primary-subtle text-primary rounded-pill px-2 py-0.5 fs-8">
                    {{ $payments->count() }} Client Payment(s)
                </span>
            </div>
        </div>

        <!-- Metric 3: Invoiced Revenue (Accrual / Paper) -->
        <div class="col-12 col-xl-2 col-md-6">
            <div class="pl-metric-card h-100 shadow-xs">
                <span class="fs-8 text-uppercase tracking-wider fw-bold text-muted d-block mb-1">Invoiced Revenue (Paper)</span>
                <h3 class="fw-bold text-dark mb-1">₹{{ number_format($totalInvoicedRevenue, 2) }}</h3>
                <span class="badge bg-slate-200 text-dark rounded-pill px-2 py-0.5 fs-8">
                    {{ $invoices->count() }} Invoice(s) Billed
                </span>
            </div>
        </div>

        <!-- Metric 4: Operating Expenses -->
        <div class="col-12 col-xl-2 col-md-6">
            <div class="pl-metric-card h-100 shadow-xs">
                <span class="fs-8 text-uppercase tracking-wider fw-bold text-muted d-block mb-1">Total Expenses</span>
                <h3 class="fw-bold text-danger mb-1">₹{{ number_format($totalExpenses, 2) }}</h3>
                <span class="badge bg-danger-subtle text-danger rounded-pill px-2 py-0.5 fs-8">
                    {{ $expenses->count() }} Expense Item(s)
                </span>
            </div>
        </div>

        <!-- Metric 5: Forex & Banking Variance -->
        <div class="col-12 col-xl-2 col-md-6">
            <div class="pl-metric-card h-100 shadow-xs">
                <span class="fs-8 text-uppercase tracking-wider fw-bold text-muted d-block mb-1">Forex & Bank Spread</span>
                <h3 class="fw-bold mb-1 {{ $totalForexVariance >= 0 ? 'text-success' : 'text-danger' }}">
                    {{ $totalForexVariance >= 0 ? '+' : '' }}₹{{ number_format($totalForexVariance, 2) }}
                </h3>
                <span class="badge {{ $totalForexVariance >= 0 ? 'bg-success-subtle text-success' : 'bg-warning-subtle text-warning-emphasis' }} rounded-pill px-2 py-0.5 fs-8">
                    {{ $totalForexVariance < 0 ? 'Conversion Loss' : 'Gain' }}
                </span>
            </div>
        </div>
    </div>

    <!-- Dual Comparison Strip: Accrual vs Cash Accounting -->
    <div class="premium-card">
        <h5 class="fw-bold text-dark mb-3">⚖️ Invoiced (Accrual) vs. Realized (Cash in Hand) Analysis</h5>
        <div class="row g-4 align-items-center">
            <div class="col-md-6 border-end-md">
                <div class="p-3 rounded-3 bg-light">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="fw-semibold text-muted fs-7">Booked Accrual Profit (Based on Invoices Issued)</span>
                        <span class="badge bg-secondary-subtle text-dark">Accrual Basis</span>
                    </div>
                    <div class="d-flex align-items-baseline gap-2">
                        <h4 class="fw-bold mb-0 {{ $accrualNetProfit >= 0 ? 'text-success' : 'text-danger' }}">
                            ₹{{ number_format($accrualNetProfit, 2) }}
                        </h4>
                        <span class="fs-8 text-muted">({{ $accrualMarginPct }}% Booked Margin)</span>
                    </div>
                    <div class="fs-8 text-muted mt-2">
                        <strong>Formula:</strong> Total Invoiced (₹{{ number_format($totalInvoicedRevenue, 2) }}) − Expenses (₹{{ number_format($totalExpenses, 2) }})
                    </div>
                    @if($invoicesPendingCount > 0)
                        <div class="mt-2 text-warning fs-8 fw-semibold">
                            ⏳ ₹{{ number_format($invoicesPendingAmount, 2) }} pending collection across {{ $invoicesPendingCount }} invoice(s).
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-3 rounded-3" style="background: #f0fdf4; border: 1px solid #bbf7d0;">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="fw-semibold text-success fs-7">True Realized Net Profit (Actual Cash Deposited)</span>
                        <span class="badge bg-success text-white">Cash Basis (In Hand)</span>
                    </div>
                    <div class="d-flex align-items-baseline gap-2">
                        <h4 class="fw-bold mb-0 text-success">
                            ₹{{ number_format($realizedNetProfit, 2) }}
                        </h4>
                        <span class="fs-8 text-success-emphasis">({{ $realizedMarginPct }}% Realized Margin)</span>
                    </div>
                    <div class="fs-8 text-muted mt-2">
                        <strong>Formula:</strong> Actual Bank Receipts (₹{{ number_format($totalRealizedInflow, 2) }}) − Expenses (₹{{ number_format($totalExpenses, 2) }})
                    </div>
                    @if($totalForexVariance != 0)
                        <div class="mt-2 text-muted fs-8">
                            📉 Bank spread & forex difference accounted for <strong>₹{{ number_format(abs($totalForexVariance), 2) }}</strong> of margin variance.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Operating Expense Category Breakdown -->
    <div class="premium-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h5 class="fw-bold text-dark mb-0">🏷️ Expense Outflow Breakdown by Category</h5>
                <span class="fs-8 text-muted">Where your money went during this cycle</span>
            </div>
            <span class="badge bg-danger-subtle text-danger px-3 py-1.5 rounded-pill fw-bold fs-7">
                Total: ₹{{ number_format($totalExpenses, 2) }}
            </span>
        </div>

        @if($categoryBreakdown->isEmpty())
            <div class="text-center py-4 text-muted fs-7">
                No expense entries recorded for this period.
            </div>
        @else
            <div class="row g-3">
                @foreach($categoryBreakdown as $cat)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="p-3 border rounded-3 bg-white shadow-2xs h-100">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold text-dark fs-7">{{ $cat['category'] }}</span>
                                <span class="fw-bold text-dark fs-7">₹{{ number_format($cat['total'], 2) }}</span>
                            </div>
                            <div class="category-progress mb-2">
                                <div class="category-progress-bar bg-primary" style="width: {{ $cat['percentage'] }}%;"></div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center fs-8 text-muted">
                                <span>{{ $cat['count'] }} item(s)</span>
                                <span class="fw-semibold text-primary">{{ $cat['percentage'] }}% of expenses</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Detailed Ledger Section with Tabs -->
    <div class="premium-card">
        <ul class="nav nav-tabs nav-tabs-pl mb-4 border-bottom-0 no-print" id="plTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="payments-tab" data-bs-toggle="tab" data-bs-target="#tab-payments" type="button" role="tab">
                    🏦 Realized Bank Receipts ({{ $payments->count() }})
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="invoices-tab" data-bs-toggle="tab" data-bs-target="#tab-invoices" type="button" role="tab">
                    🧾 Invoices Issued ({{ $invoices->count() }})
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="expenses-tab" data-bs-toggle="tab" data-bs-target="#tab-expenses" type="button" role="tab">
                    📉 Operating Expenses ({{ $expenses->count() }})
                </button>
            </li>
        </ul>

        <div class="tab-content" id="plTabsContent">
            
            <!-- Tab 1: Realized Bank Receipts -->
            <div class="tab-pane fade show active" id="tab-payments" role="tabpanel">
                @if($payments->isEmpty())
                    <div class="text-center py-5 text-muted">
                        <p class="mb-0 fw-semibold">No inward client payments were cleared in this period.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="table-light fs-8 text-uppercase fw-bold text-muted">
                                <tr>
                                    <th>Payment Date</th>
                                    <th>Invoice #</th>
                                    <th>Client</th>
                                    <th>Original Billed</th>
                                    <th>Invoiced INR Value</th>
                                    <th>Actual Net Received</th>
                                    <th>Forex Variance</th>
                                    <th>FIRC / Ref</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payments as $p)
                                    <tr>
                                        <td class="fw-semibold fs-7">{{ $p->payment_date ? $p->payment_date->format('d M, Y') : '—' }}</td>
                                        <td>
                                            @if($p->invoice)
                                                <a href="{{ route('invoices.show', $p->invoice->id) }}" class="text-dark fw-bold text-decoration-none hover-primary">
                                                    {{ $p->invoice->invoice_number }}
                                                </a>
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                        <td class="fs-7 text-dark fw-medium">
                                            {{ $p->invoice->client->name ?? 'Direct Client' }}
                                        </td>
                                        <td class="fs-7">
                                            @if($p->invoice)
                                                {{ $p->invoice->currency_code }} {{ number_format($p->invoice->grand_total, 2) }}
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td class="fs-7 text-muted">
                                            @if($p->invoice)
                                                ₹{{ number_format($p->invoice->currency_code === 'INR' ? $p->invoice->grand_total : ($p->invoice->inr_equivalent ?? $p->inr_amount_received), 2) }}
                                            @else
                                                ₹{{ number_format($p->inr_amount_received, 2) }}
                                            @endif
                                        </td>
                                        <td class="fs-7 fw-bold text-success">
                                            ₹{{ number_format($p->inr_amount_received, 2) }}
                                        </td>
                                        <td class="fs-7 fw-semibold {{ $p->forex_gain_loss < 0 ? 'text-danger' : ($p->forex_gain_loss > 0 ? 'text-success' : 'text-muted') }}">
                                            {{ $p->forex_gain_loss > 0 ? '+' : '' }}₹{{ number_format($p->forex_gain_loss, 2) }}
                                        </td>
                                        <td>
                                            @if($p->firc_number)
                                                <span class="badge bg-dark-subtle text-dark fs-8">{{ $p->firc_number }}</span>
                                            @else
                                                <span class="text-muted opacity-50">—</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <!-- Tab 2: Invoices Issued -->
            <div class="tab-pane fade" id="tab-invoices" role="tabpanel">
                @if($invoices->isEmpty())
                    <div class="text-center py-5 text-muted">
                        <p class="mb-0 fw-semibold">No invoices were issued in this period.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="table-light fs-8 text-uppercase fw-bold text-muted">
                                <tr>
                                    <th>Invoice Date</th>
                                    <th>Invoice #</th>
                                    <th>Client</th>
                                    <th>Currency Billed</th>
                                    <th>INR Equivalent</th>
                                    <th>Status</th>
                                    <th>Settlement</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($invoices as $inv)
                                    <tr>
                                        <td class="fw-semibold fs-7">{{ $inv->invoice_date ? $inv->invoice_date->format('d M, Y') : '—' }}</td>
                                        <td>
                                            <a href="{{ route('invoices.show', $inv->id) }}" class="text-dark fw-bold text-decoration-none hover-primary">
                                                {{ $inv->invoice_number }}
                                            </a>
                                        </td>
                                        <td class="fs-7 text-dark">{{ $inv->client->name ?? '—' }}</td>
                                        <td class="fs-7 fw-medium">{{ $inv->currency_code }} {{ number_format($inv->grand_total, 2) }}</td>
                                        <td class="fs-7 fw-bold">₹{{ number_format($inv->currency_code === 'INR' ? $inv->grand_total : ($inv->inr_equivalent ?? $inv->grand_total), 2) }}</td>
                                        <td>
                                            <span class="badge-status badge-{{ $inv->status }}">{{ $inv->status }}</span>
                                        </td>
                                        <td class="fs-7">
                                            @if($inv->status === 'paid' && $inv->actual_inr_received)
                                                <span class="text-success fw-bold">Cleared: ₹{{ number_format($inv->actual_inr_received, 2) }}</span>
                                            @else
                                                <span class="text-muted">Unsettled</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <!-- Tab 3: Operating Expenses -->
            <div class="tab-pane fade" id="tab-expenses" role="tabpanel">
                @if($expenses->isEmpty())
                    <div class="text-center py-5 text-muted">
                        <p class="mb-0 fw-semibold">No expenses were logged for this period.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="table-light fs-8 text-uppercase fw-bold text-muted">
                                <tr>
                                    <th>Expense Date</th>
                                    <th>Vendor / Payee</th>
                                    <th>Category</th>
                                    <th>Payment Mode</th>
                                    <th>Amount (INR)</th>
                                    <th>Recurring</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($expenses as $exp)
                                    <tr>
                                        <td class="fw-semibold fs-7">{{ $exp->expense_date ? $exp->expense_date->format('d M, Y') : '—' }}</td>
                                        <td class="fs-7 fw-bold text-dark">{{ $exp->vendor_name }}</td>
                                        <td>
                                            <span class="badge bg-secondary-subtle text-dark rounded-pill px-2.5 py-1 fs-8">
                                                {{ $exp->category }}
                                            </span>
                                        </td>
                                        <td class="fs-7 text-muted">{{ $exp->payment_mode ?? 'Bank Transfer' }}</td>
                                        <td class="fs-7 fw-bold text-danger">₹{{ number_format($exp->total_amount, 2) }}</td>
                                        <td>
                                            @if($exp->is_recurring)
                                                <span class="badge bg-primary-subtle text-primary rounded-pill px-2 py-0.5 fs-8">
                                                    🔁 {{ ucfirst($exp->recurring_frequency ?? 'Monthly') }}
                                                </span>
                                            @else
                                                <span class="text-muted opacity-50">—</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Historical 6-Month Comparison Mini-Table -->
    <div class="premium-card">
        <h5 class="fw-bold text-dark mb-3">📈 6-Month Realized Cash & Profit Trends</h5>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light fs-8 text-uppercase fw-bold text-muted">
                    <tr>
                        <th>Month</th>
                        <th>Realized Cash Inflow</th>
                        <th>Operating Expenses</th>
                        <th>Net Realized Cash Profit</th>
                        <th>Net Margin %</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($trends as $tr)
                        <tr class="{{ $tr['key'] === $selectedPeriod ? 'table-primary table-active' : '' }}">
                            <td class="fw-bold fs-7">{{ $tr['label'] }}</td>
                            <td class="fs-7 text-dark">₹{{ number_format($tr['realized'], 2) }}</td>
                            <td class="fs-7 text-danger">₹{{ number_format($tr['expenses'], 2) }}</td>
                            <td class="fs-7 fw-bold {{ $tr['profit'] >= 0 ? 'text-success' : 'text-danger' }}">
                                ₹{{ number_format($tr['profit'], 2) }}
                            </td>
                            <td class="fs-7">
                                @php
                                    $mMargin = $tr['realized'] > 0 ? round(($tr['profit'] / $tr['realized']) * 100, 1) : 0;
                                @endphp
                                <span class="badge {{ $mMargin >= 50 ? 'bg-success' : ($mMargin >= 0 ? 'bg-primary' : 'bg-danger') }} rounded-pill px-2.5 py-1 fs-8">
                                    {{ $mMargin }}%
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('profit-loss.index', ['period' => $tr['key']]) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3 py-1 fs-8">
                                    View Statement →
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
