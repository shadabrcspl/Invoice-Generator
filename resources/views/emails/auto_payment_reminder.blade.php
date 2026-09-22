<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Auto-Payment Reminder: Invoice {{ $invoice->invoice_number }}</title>
</head>
<body style="margin:0;padding:0;font-family:'Segoe UI',Arial,sans-serif;background:#f0f4f8;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f0f4f8;padding:40px 0;">
  <tr><td align="center">
    <table width="640" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,0.08);">
      <!-- Header -->
      <tr>
        <td style="background:linear-gradient(135deg,#b91c1c,#ea580c);padding:32px 40px;">
          <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
              <td>
                <h1 style="margin:0;color:#ffffff;font-size:24px;font-weight:800;">{{ $invoice->user->companySetting->company_name ?? config('app.name') }}</h1>
                <p style="margin:6px 0 0;color:rgba(255,255,255,0.8);font-size:13px;">⏰ Automated Payment Reminder</p>
              </td>
              <td align="right">
                <p style="margin:0;color:rgba(255,255,255,0.7);font-size:12px;text-transform:uppercase;letter-spacing:1px;">Invoice</p>
                <p style="margin:4px 0 0;color:#ffffff;font-size:20px;font-weight:700;">{{ $invoice->invoice_number }}</p>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <!-- Date Row -->
      <tr>
        <td style="padding:20px 40px;background:#fef2f2;border-bottom:1px solid #fee2e2;">
          <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
              <td style="color:#991b1b;font-size:12px;text-transform:uppercase;">Due Date<br><strong style="color:#b91c1c;font-size:15px;text-transform:none;">{{ $invoice->due_date->format('d M Y') }}</strong></td>
              <td align="center" style="color:#991b1b;font-size:12px;text-transform:uppercase;">Amount Pending<br><strong style="color:#b91c1c;font-size:15px;text-transform:none;">{{ $invoice->currency_symbol }} {{ number_format($invoice->grand_total, 2) }}</strong></td>
              <td align="right" style="color:#991b1b;font-size:12px;text-transform:uppercase;">Status<br><strong style="color:#ef4444;font-size:15px;text-transform:uppercase;">OVERDUE / UNPAID</strong></td>
            </tr>
          </table>
        </td>
      </tr>
      <!-- Billed To -->
      <tr>
        <td style="padding:32px 40px 16px;">
          <p style="margin:0 0 10px;color:#374151;font-size:15px;">Dear <strong>{{ $invoice->client->name }}</strong>,</p>
          <p style="margin:0 0 16px;color:#4b5563;font-size:14px;line-height:1.7;">This is an automated payment reminder from the billing system at <strong>{{ $invoice->user->companySetting->company_name ?? 'our company' }}</strong>. According to our records, the outstanding payment for **Invoice {{ $invoice->invoice_number }}** (issued on **{{ $invoice->invoice_date->format('d M Y') }}**) remains unpaid.</p>
          <p style="margin:0 0 24px;color:#4b5563;font-size:14px;line-height:1.7;">We have **attached a copy of the invoice as a PDF** to this email for your reference. Below is a summary of the outstanding items:</p>
          
          <p style="margin:0 0 6px;color:#9ca3af;font-size:11px;text-transform:uppercase;letter-spacing:1px;">Billed To</p>
          <p style="margin:0;color:#111827;font-size:14px;font-weight:700;">{{ $invoice->client->name }}</p>
          @if($invoice->client->company)<p style="margin:2px 0 0;color:#6b7280;font-size:13px;">{{ $invoice->client->company }}</p>@endif
          @if($invoice->client->address)<p style="margin:2px 0 0;color:#6b7280;font-size:13px;">{{ $invoice->client->address }}</p>@endif
        </td>
      </tr>
      <!-- Items Summary -->
      <tr>
        <td style="padding:0 40px 24px;">
          <table width="100%" cellpadding="0" cellspacing="0" style="border-radius:8px;overflow:hidden;border:1px solid #e2e8f0;">
            <tr style="background:#ea580c;">
              <td style="padding:10px 16px;color:#ffffff;font-size:11px;font-weight:600;text-transform:uppercase;">Description</td>
              <td align="center" style="padding:10px 16px;color:#ffffff;font-size:11px;font-weight:600;text-transform:uppercase;">Qty</td>
              <td align="right" style="padding:10px 16px;color:#ffffff;font-size:11px;font-weight:600;text-transform:uppercase;">Total</td>
            </tr>
            @foreach($invoice->items as $i => $item)
            <tr style="background:{{ $i % 2 === 0 ? '#ffffff' : '#f9fafb' }}; border-bottom:1px solid #e2e8f0;">
              <td style="padding:10px 16px;color:#111827;font-size:12px;">{{ $item->item_name }}</td>
              <td align="center" style="padding:10px 16px;color:#374151;font-size:12px;">{{ $item->qty }}</td>
              <td align="right" style="padding:10px 16px;color:#111827;font-size:12px;font-weight:600;">{{ $invoice->currency_symbol }} {{ number_format($item->total, 2) }}</td>
            </tr>
            @endforeach
            <tr style="background:#fff5f5;"><td colspan="2" align="right" style="padding:12px 16px;color:#991b1b;font-size:13px;font-weight:700;">Outstanding Balance</td><td align="right" style="padding:12px 16px;color:#b91c1c;font-size:16px;font-weight:800;">{{ $invoice->currency_symbol }} {{ number_format($invoice->grand_total, 2) }}</td></tr>
          </table>
        </td>
      </tr>
      
      @if($invoice->bank_notes)
      <tr>
        <td style="padding:0 40px 24px;">
          <table width="100%" cellpadding="0" cellspacing="0" style="background:#f0fdf4;border-left:4px solid #10b981;border-radius:4px;padding:16px;">
            <tr><td style="padding:16px;">
              <p style="margin:0 0 6px;color:#065f46;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;">Remittance Instructions</p>
              <p style="margin:0;color:#374151;font-size:13px;white-space:pre-line;">{{ $invoice->bank_notes }}</p>
            </td></tr>
          </table>
        </td>
      </tr>
      @endif
      
      <tr>
        <td style="padding:0 40px 32px;">
          <p style="margin:0 0 16px;color:#4b5563;font-size:14px;line-height:1.7;">If payment has already been sent, please let us know so we can update our records immediately. Otherwise, please settle the outstanding balance as soon as possible.</p>
          <p style="margin:0;color:#4b5563;font-size:14px;">Thank you for your prompt attention to this matter.</p>
          <p style="margin:20px 0 0;color:#111827;font-size:14px;font-weight:700;">Sincerely,</p>
          <p style="margin:4px 0 0;color:#4b5563;font-size:14px;">{{ $invoice->user->name }}<br><span style="color:#9ca3af;font-size:12px;">{{ $invoice->user->companySetting->company_name ?? '' }}</span></p>
        </td>
      </tr>
      
      <!-- Footer -->
      <tr>
        <td style="background:#f8fafc;padding:24px 40px;text-align:center;border-top:1px solid #e2e8f0;">
          <p style="margin:0;color:#9ca3af;font-size:11px;">Automated reminder generated by <strong>Cod Xpert</strong> · https://invoice.codxpert.com</p>
        </td>
      </tr>
    </table>
  </td></tr>
</table>
</body>
</html>
