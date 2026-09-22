<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Invoice {{ $invoice->invoice_number }}</title>
</head>
<body style="margin:0;padding:0;font-family:'Segoe UI',Arial,sans-serif;background:#f0f4f8;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f0f4f8;padding:40px 0;">
  <tr><td align="center">
    <table width="640" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,0.08);">
      <!-- Header -->
      <tr>
        <td style="background:linear-gradient(135deg,#1e3a5f,#2d6cdf);padding:32px 40px;">
          <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
              <td>
                <h1 style="margin:0;color:#ffffff;font-size:24px;font-weight:800;">{{ $invoice->user->companySetting->company_name ?? config('app.name') }}</h1>
                @if($invoice->user->companySetting)
                <p style="margin:6px 0 0;color:rgba(255,255,255,0.75);font-size:13px;">{{ $invoice->user->companySetting->address ?? '' }}</p>
                @endif
              </td>
              <td align="right">
                <p style="margin:0;color:rgba(255,255,255,0.6);font-size:12px;text-transform:uppercase;letter-spacing:1px;">Invoice</p>
                <p style="margin:4px 0 0;color:#ffffff;font-size:20px;font-weight:700;">{{ $invoice->invoice_number }}</p>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <!-- Date Row -->
      <tr>
        <td style="padding:20px 40px;background:#f8fafc;border-bottom:1px solid #e2e8f0;">
          <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
              <td style="color:#6b7280;font-size:12px;text-transform:uppercase;">Issue Date<br><strong style="color:#111827;font-size:14px;text-transform:none;">{{ $invoice->invoice_date->format('d M Y') }}</strong></td>
              <td align="center" style="color:#6b7280;font-size:12px;text-transform:uppercase;">Due Date<br><strong style="color:#e53e3e;font-size:14px;text-transform:none;">{{ $invoice->due_date->format('d M Y') }}</strong></td>
              <td align="right" style="color:#6b7280;font-size:12px;text-transform:uppercase;">Status<br><strong style="color:#059669;font-size:14px;text-transform:capitalize;">{{ $invoice->status }}</strong></td>
            </tr>
          </table>
        </td>
      </tr>
      <!-- Billed To -->
      <tr>
        <td style="padding:24px 40px;">
          <p style="margin:0 0 6px;color:#9ca3af;font-size:11px;text-transform:uppercase;letter-spacing:1px;">Billed To</p>
          <p style="margin:0;color:#111827;font-size:15px;font-weight:700;">{{ $invoice->client->name }}</p>
          @if($invoice->client->company)<p style="margin:2px 0 0;color:#6b7280;font-size:13px;">{{ $invoice->client->company }}</p>@endif
          @if($invoice->client->address)<p style="margin:2px 0 0;color:#6b7280;font-size:13px;">{{ $invoice->client->address }}</p>@endif
          @if($invoice->client->tax_id)<p style="margin:2px 0 0;color:#6b7280;font-size:13px;">Tax ID: {{ $invoice->client->tax_id }}</p>@endif
        </td>
      </tr>
      <!-- Items Table -->
      <tr>
        <td style="padding:0 40px 24px;">
          <table width="100%" cellpadding="0" cellspacing="0" style="border-radius:8px;overflow:hidden;border:1px solid #e2e8f0;">
            <tr style="background:#1e3a5f;">
              <td style="padding:12px 16px;color:#ffffff;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Description</td>
              <td align="center" style="padding:12px 16px;color:#ffffff;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Qty</td>
              <td align="center" style="padding:12px 16px;color:#ffffff;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Rate</td>
              <td align="center" style="padding:12px 16px;color:#ffffff;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Tax</td>
              <td align="right" style="padding:12px 16px;color:#ffffff;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Total</td>
            </tr>
            @foreach($invoice->items as $i => $item)
            <tr style="background:{{ $i % 2 === 0 ? '#ffffff' : '#f9fafb' }};">
              <td style="padding:12px 16px;color:#111827;font-size:13px;border-bottom:1px solid #e2e8f0;">{{ $item->item_name }}</td>
              <td align="center" style="padding:12px 16px;color:#374151;font-size:13px;border-bottom:1px solid #e2e8f0;">{{ $item->qty }}</td>
              <td align="center" style="padding:12px 16px;color:#374151;font-size:13px;border-bottom:1px solid #e2e8f0;">{{ number_format($item->rate, 2) }}</td>
              <td align="center" style="padding:12px 16px;color:#374151;font-size:13px;border-bottom:1px solid #e2e8f0;">{{ $item->tax_percent }}%</td>
              <td align="right" style="padding:12px 16px;color:#111827;font-size:13px;font-weight:600;border-bottom:1px solid #e2e8f0;">{{ $invoice->currency_symbol }} {{ number_format($item->total, 2) }}</td>
            </tr>
            @endforeach
            <!-- Totals -->
            <tr><td colspan="4" align="right" style="padding:10px 16px;color:#6b7280;font-size:13px;border-top:2px solid #e2e8f0;">Subtotal</td><td align="right" style="padding:10px 16px;color:#111827;font-size:13px;border-top:2px solid #e2e8f0;">{{ $invoice->currency_symbol }} {{ number_format($invoice->subtotal, 2) }}</td></tr>
            <tr><td colspan="4" align="right" style="padding:10px 16px;color:#6b7280;font-size:13px;">Tax</td><td align="right" style="padding:10px 16px;color:#111827;font-size:13px;">{{ $invoice->currency_symbol }} {{ number_format($invoice->tax_amount, 2) }}</td></tr>
            <tr style="background:#fff7ed;"><td colspan="4" align="right" style="padding:14px 16px;color:#d97706;font-size:14px;font-weight:700;">Grand Total</td><td align="right" style="padding:14px 16px;color:#d97706;font-size:18px;font-weight:800;">{{ $invoice->currency_symbol }} {{ number_format($invoice->grand_total, 2) }}</td></tr>
            @if($invoice->currency_code !== 'INR')
            <tr style="background:#fef3c7;">
                <td colspan="4" align="right" style="padding:10px 16px;color:#b45309;font-size:13px;font-weight:700;">INR Equivalent (Locked)</td>
                <td align="right" style="padding:10px 16px;color:#b45309;font-size:15px;font-weight:800;">₹ {{ number_format($invoice->inr_equivalent, 2) }}</td>
            </tr>
            @endif
          </table>
        </td>
      </tr>
      @if($invoice->bank_notes)
      <tr>
        <td style="padding:0 40px 24px;">
          <table width="100%" cellpadding="0" cellspacing="0" style="background:#f0fdf4;border-left:4px solid #10b981;border-radius:4px;padding:16px;">
            <tr><td style="padding:16px;">
              <p style="margin:0 0 6px;color:#065f46;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;">Payment Instructions</p>
              <p style="margin:0;color:#374151;font-size:13px;white-space:pre-line;">{{ $invoice->bank_notes }}</p>
            </td></tr>
          </table>
        </td>
      </tr>
      @endif
      <!-- Footer -->
      <tr>
        <td style="background:#f8fafc;padding:24px 40px;text-align:center;border-top:1px solid #e2e8f0;">
          @if($invoice->currency_code !== 'INR')
          <p style="margin:0 0 12px;color:#475569;font-size:12px;font-weight:600;background-color:#f1f5f9;padding:8px;border-radius:4px;border:1px dashed #cbd5e1;">
            Export of Services – Supplied under Letter of Undertaking (LUT) without payment of IGST.
          </p>
          @endif
          @if($invoice->notes)<p style="margin:0 0 12px;color:#6b7280;font-size:13px;font-style:italic;">{{ $invoice->notes }}</p>@endif
          <p style="margin:0;color:#9ca3af;font-size:11px;">Generated by <strong>{{ config('app.name') }}</strong> · {{ config('app.url') }}</p>
        </td>
      </tr>
    </table>
  </td></tr>
</table>
</body>
</html>
