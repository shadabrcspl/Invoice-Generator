<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $invoice->invoice_number }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #334155;
            font-size: 11px;
            line-height: 1.35;
            margin: 0;
            padding: 0;
        }
        
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 5px;
        }
        
        table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }
        
        table td {
            padding: 4px;
            vertical-align: top;
        }
        
        .header-table td {
            padding: 0;
        }

        .header-title {
            font-size: 20px;
            font-weight: bold;
            color: #0284c7;
            text-transform: uppercase;
        }
        
        .company-name {
            font-size: 14px;
            font-weight: bold;
            color: #0f172a;
        }
        
        .address-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 8px 10px;
            min-height: 70px;
        }
        
        .items-table {
            margin-top: 15px;
            border-bottom: 2px solid #e2e8f0;
        }
        
        .items-table th {
            background-color: #f1f5f9;
            border-bottom: 2px solid #cbd5e1;
            color: #475569;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10px;
            padding: 6px 6px;
        }
        
        .items-table td {
            padding: 6px 6px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 11px;
        }
        
        .total-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 8px 12px;
            margin-top: 10px;
        }
        
        .total-row td {
            padding: 3px 0;
        }

        .grand-total {
            font-size: 14px;
            font-weight: bold;
            color: #0284c7;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .badge-status {
            display: inline-block;
            padding: 2px 6px;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            border-radius: 10px;
            background-color: #e2e8f0;
            color: #475569;
            line-height: 1.2;
        }
        
        .status-paid {
            background-color: #d1fae5;
            color: #065f46;
        }
        .status-sent {
            background-color: #dbeafe;
            color: #1e40af;
        }
        .status-draft {
            background-color: #f1f5f9;
            color: #334155;
        }
        .status-overdue {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .signature-container {
            margin-top: 15px;
            text-align: right;
        }

        .signature-img {
            max-height: 40px;
            margin-top: 3px;
        }

        .footer {
            margin-top: 20px;
            border-top: 1px solid #e2e8f0;
            padding-top: 8px;
            text-align: center;
            font-size: 10px;
            color: #94a3b8;
        }
    </style>
</head>
<body>
    @php
        $currencyDisplay = $invoice->currency_symbol;
        if ($invoice->currency_code === 'INR') {
            $currencyDisplay = 'Rs. ';
        } elseif ($invoice->currency_code === 'USD') {
            $currencyDisplay = '$';
        } else {
            $currencyDisplay = $invoice->currency_code . ' ';
        }
    @endphp
    <div class="invoice-box">
        <!-- Header Info -->
        <table class="header-table">
            <tr>
                <td style="width: 50%;">
                    @if(!empty($logoBase64))
                        <img src="{{ $logoBase64 }}" alt="Logo" style="max-height: 60px; max-width: 180px;">
                    @else
                        <div style="font-size: 24px; font-weight: bold; color: #0284c7;">{{ strtoupper(substr($invoice->user->companySetting?->company_name ?? $invoice->user->name, 0, 2)) }}</div>
                    @endif
                    <div class="company-name" style="margin-top: 10px;">{{ $invoice->user->companySetting?->company_name ?? $invoice->user->name }}</div>
                    <div style="color: #64748b; font-size: 11px;">{{ $invoice->user->companySetting?->website ?? '' }}</div>
                </td>
                <td style="width: 50%; text-align: right;">
                    <div class="header-title">{{ $invoice->type === 'quotation' ? 'QUOTATION' : 'INVOICE' }}</div>
                    <div style="font-weight: bold; color: #64748b; font-size: 12px; margin-bottom: 10px;">{{ $invoice->invoice_number }}</div>
                    
                    <div style="font-size: 11px; color: #475569; line-height: 1.6; margin-top: 10px;">
                        <div style="margin-bottom: 5px;">
                            <strong>{{ $invoice->type === 'quotation' ? 'Quotation Date:' : 'Date:' }}</strong> {{ $invoice->invoice_date->format('M d, Y') }}
                        </div>
                        @if($invoice->due_date)
                            <div style="margin-bottom: 5px;">
                                <strong>Due Date:</strong> <span style="color: #e11d48;">{{ $invoice->due_date->format('M d, Y') }}</span>
                            </div>
                        @endif
                        <div style="margin-top: 6px;">
                            <strong>Status:</strong> <span class="badge-status status-{{ $invoice->status }}" style="margin-left: 4px; vertical-align: middle;">{{ $invoice->type === 'quotation' && $invoice->status === 'paid' ? 'accepted' : $invoice->status }}</span>
                        </div>
                    </div>
                </td>
            </tr>
        </table>

        <!-- Billing Addresses -->
        <table style="margin-top: 15px; width: 100%;" cellspacing="0" cellpadding="0">
            <tr>
                <td style="width: 48%; padding: 0;">
                    <div class="address-box">
                        <span style="font-size: 9px; font-weight: bold; text-transform: uppercase; color: #94a3b8; display: block; margin-bottom: 3px;">From (Vendor):</span>
                        <strong>{{ $invoice->user->companySetting?->company_name ?? $invoice->user->name }}</strong><br>
                        <span style="font-size: 10px; color: #64748b;">
                            {!! nl2br(e($invoice->user->companySetting?->address)) !!}
                        </span>
                        
                        <div style="font-size: 9px; color: #94a3b8; margin-top: 5px; border-top: 1px solid #e2e8f0; padding-top: 3px;">
                            @if($invoice->user->companySetting?->email) Email: {{ $invoice->user->companySetting?->email }}<br>@endif
                            @if($invoice->user->companySetting?->gst_number) <strong>GSTIN/VAT:</strong> {{ $invoice->user->companySetting?->gst_number }}@endif
                        </div>
                    </div>
                </td>
                <td style="width: 4%;"></td> <!-- Spacer -->
                <td style="width: 48%; padding: 0;">
                    <div class="address-box">
                        <span style="font-size: 9px; font-weight: bold; text-transform: uppercase; color: #94a3b8; display: block; margin-bottom: 3px;">To (Client):</span>
                        <strong>{{ $invoice->client->name ?? 'N/A' }}</strong><br>
                        <span style="font-size: 10px; color: #64748b;">
                            {!! nl2br(e($invoice->client->address)) !!}
                        </span>
                        
                        <div style="font-size: 9px; color: #94a3b8; margin-top: 5px; border-top: 1px solid #e2e8f0; padding-top: 3px;">
                            @if($invoice->client->email) Email: {{ $invoice->client->email }}<br>@endif
                            @if($invoice->client->gst_number) <strong>GSTIN/VAT:</strong> {{ $invoice->client->gst_number }}@endif
                        </div>
                    </div>
                </td>
            </tr>
        </table>

        <!-- Line Items Table -->
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 35%;">Item Name & Description</th>
                    <th style="width: 12%; text-align: center;">SAC Code</th>
                    <th style="width: 8%; text-align: center;">Qty</th>
                    <th style="width: 15%; text-align: right;">Rate</th>
                    <th style="width: 10%; text-align: center;">Tax %</th>
                    <th style="width: 20%; text-align: right;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoice->items as $item)
                    <tr>
                        <td>
                            <strong>{{ $item->item_name }}</strong>
                            @if($item->description)
                                <div style="font-size: 10px; color: #64748b; margin-top: 2px;">{{ $item->description }}</div>
                            @endif
                        </td>
                        <td class="text-center" style="font-size: 10px;">{{ $item->sac_code ?? '998315' }}</td>
                        <td class="text-center">{{ number_format($item->qty, 1) }}</td>
                        <td class="text-right">{{ number_format($item->rate, 2) }}</td>
                        <td class="text-center" style="color: #64748b;">{{ number_format($item->tax_percent, 1) }}%</td>
                        <td class="text-right" style="font-weight: bold;">{{ $currencyDisplay }}{{ number_format($item->total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Invoice Summary Block -->
        <div style="margin-top: 12px; text-align: right; width: 100%; display: block; clear: both;">
            <div style="display: inline-block; width: 260px; text-align: left; background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 8px 12px;">
                <table class="total-row" style="width: 100%;">
                    <tr>
                        <td style="color: #64748b; padding: 2px 0;">Subtotal:</td>
                        <td class="text-right" style="font-weight: bold; padding: 2px 0;">{{ $currencyDisplay }}{{ number_format($invoice->subtotal, 2) }}</td>
                    </tr>
                    @php
                        // GST type determination: compare first 2 digits of vendor vs client GSTIN
                        $vendorStateCode = substr($invoice->user->companySetting?->gst_number ?? '', 0, 2);
                        $clientStateCode = substr($invoice->client->gst_number ?? '', 0, 2);
                        $isIntraState = ($vendorStateCode !== '' && $clientStateCode !== '' && $vendorStateCode === $clientStateCode);

                        // Compute effective tax rate dynamically from stored values
                        $effectiveTaxRate = $invoice->subtotal > 0
                            ? round(($invoice->tax_amount / $invoice->subtotal) * 100, 2)
                            : 0;
                        $halfRate = $effectiveTaxRate / 2;
                    @endphp
                    @if($invoice->tax_amount > 0)
                        @if($isIntraState)
                            {{-- Intra-state: show CGST + SGST split --}}
                            <tr>
                                <td style="color: #64748b; padding: 2px 0;">CGST ({{ number_format($halfRate, 0) }}%):</td>
                                <td class="text-right" style="font-weight: bold; padding: 2px 0;">{{ $currencyDisplay }}{{ number_format($invoice->tax_amount / 2, 2) }}</td>
                            </tr>
                            <tr>
                                <td style="color: #64748b; padding: 2px 0;">SGST ({{ number_format($halfRate, 0) }}%):</td>
                                <td class="text-right" style="font-weight: bold; padding: 2px 0;">{{ $currencyDisplay }}{{ number_format($invoice->tax_amount / 2, 2) }}</td>
                            </tr>
                        @else
                            {{-- Inter-state: show IGST combined --}}
                            <tr>
                                <td style="color: #64748b; padding: 2px 0;">IGST ({{ number_format($effectiveTaxRate, 0) }}%):</td>
                                <td class="text-right" style="font-weight: bold; padding: 2px 0;">{{ $currencyDisplay }}{{ number_format($invoice->tax_amount, 2) }}</td>
                            </tr>
                        @endif
                    @else
                        <tr>
                            <td style="color: #64748b; padding: 2px 0;">Tax (GST/VAT):</td>
                            <td class="text-right" style="font-weight: bold; padding: 2px 0;">{{ $currencyDisplay }}0.00</td>
                        </tr>
                    @endif
                    <tr style="border-top: 2px solid #cbd5e1;">
                        <td style="font-weight: bold; padding-top: 6px; padding-bottom: 2px;">Grand Total:</td>
                        <td class="text-right grand-total" style="padding-top: 6px; padding-bottom: 2px;">{{ $currencyDisplay }}{{ number_format($invoice->grand_total, 2) }}</td>
                    </tr>
                    @if($invoice->currency_code !== 'INR')
                        <tr style="border-top: 1px dashed #cbd5e1;">
                            <td style="font-size: 9px; color: #b45309; padding-top: 5px; font-weight: bold;">INR Equivalent:</td>
                            <td class="text-right" style="font-size: 10px; color: #15803d; font-weight: bold; padding-top: 5px;">₹{{ number_format($invoice->inr_equivalent ?? 0.00, 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="font-size: 8px; color: #64748b; padding-top: 1px; text-align: right;">
                                (Rate: 1 {{ $invoice->currency_code }} = {{ number_format($invoice->exchange_rate_inr ?? 1.0, 4) }} INR locked on invoice date)
                            </td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>

        <!-- Authorized Signature Block -->
        @if(!empty($signatureBase64))
            <div class="signature-container" style="margin-top: 10px; text-align: right;">
                <span style="font-size: 9px; color: #94a3b8; text-transform: uppercase; font-weight: bold;">Authorized Representative:</span><br>
                <img src="{{ $signatureBase64 }}" class="signature-img" alt="Signature" style="margin-top: 4px;">
            </div>
        @endif

        <!-- Bank Payment Instructions Block -->
        @if($invoice->bank_notes)
            <div style="font-size: 10px; margin-top: 10px; margin-bottom: 8px;">
                <strong style="color: #475569; text-transform: uppercase; font-size: 9px;">Bank payment instructions:</strong>
                <div style="color: #64748b; margin-top: 3px; white-space: pre-line; background-color: #f8fafc; border: 1px solid #e2e8f0; padding: 6px 8px; border-radius: 4px;">{{ $invoice->bank_notes }}</div>
            </div>
        @endif

        <!-- Customer Notes Block -->
        @if($invoice->notes)
            <div style="font-size: 10px; margin-top: 8px; margin-bottom: 8px;">
                <strong style="color: #475569; text-transform: uppercase; font-size: 9px;">Customer Notes:</strong>
                <div style="color: #64748b; margin-top: 3px; white-space: pre-line; background-color: #f8fafc; border: 1px solid #e2e8f0; padding: 6px 8px; border-radius: 4px;">{{ $invoice->notes }}</div>
            </div>
        @endif

        <!-- Compliance Block -->
        @if($invoice->currency_code !== 'INR')
            @php
                $fircRef = !empty($invoice->payment?->firc_number) ? $invoice->payment->firc_number : (!empty($invoice->firc_number) ? $invoice->firc_number : null);
                $paymentDate = $invoice->payment?->payment_date ? $invoice->payment->payment_date->format('d M Y') : null;
                $liquidationRate = $invoice->payment?->exchange_rate_payment ?? $invoice->actual_exchange_rate;
                $actualReceivedInr = $invoice->payment?->inr_amount_received ?? $invoice->actual_inr_received;
                $forexDiff = $invoice->payment?->forex_gain_loss ?? ($actualReceivedInr && $invoice->inr_equivalent ? (floatval($actualReceivedInr) - floatval($invoice->inr_equivalent)) : null);
            @endphp

            @if($invoice->payment || $fircRef || $actualReceivedInr)
                <div style="font-size: 10px; margin-top: 8px; margin-bottom: 8px;">
                    <strong style="color: #b45309; text-transform: uppercase; font-size: 9px;">Compliance: FIRC/e-BRC Tracking Summary</strong>
                    <div style="color: #475569; margin-top: 3px; background-color: #fef3c7; border: 1px solid #fcd34d; padding: 6px 8px; border-radius: 4px; line-height: 1.3;">
                        <strong>FIRC Ref:</strong> {{ $fircRef ?: 'N/A' }}<br>
                        @if($paymentDate)
                            <strong>Payment Received Date:</strong> {{ $paymentDate }}<br>
                        @endif
                        @if($liquidationRate)
                            <strong>Bank Exchange Rate:</strong> 1 {{ $invoice->currency_code }} = {{ number_format($liquidationRate, 4) }} INR<br>
                        @endif
                        @if($actualReceivedInr)
                            <strong>Actual INR Received:</strong> ₹{{ number_format($actualReceivedInr, 2) }}<br>
                        @endif
                        @if($forexDiff !== null)
                            <strong>Forex Gain/Loss:</strong> 
                            @if($forexDiff >= 0)
                                +₹{{ number_format($forexDiff, 2) }} (Gain Credit)
                            @else
                                -₹{{ number_format(abs($forexDiff), 2) }} (Loss Debit)
                            @endif
                        @endif
                    </div>
                </div>
            @endif
        @endif

        @if($invoice->currency_code !== 'INR')
            <div style="margin-top: 10px; text-align: center; font-size: 9px; color: #64748b; padding: 4px 8px; border: 1px dashed #cbd5e1; border-radius: 4px;">
                Export of Services – Supplied under Letter of Undertaking (LUT)
                @if($invoice->user->companySetting && $invoice->user->companySetting->lut_number)
                    No. {{ $invoice->user->companySetting->lut_number }}
                @endif
                without payment of IGST.
            </div>
        @endif

        <!-- Footer -->
        <div class="footer">
            Made by <a href="https://codxpert.com/" style="color: #94a3b8; text-decoration: none; font-weight: bold;">CodXpert</a>
        </div>
    </div>
</body>
</html>
