<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>New Invoice Generated</title>
</head>
<body style="margin:0;padding:0;font-family:'Segoe UI',Arial,sans-serif;background:#f0f4f8;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f0f4f8;padding:40px 0;">
  <tr><td align="center">
    <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,0.08);">
      <!-- Header -->
      <tr>
        <td style="background:linear-gradient(135deg,#1e3a5f,#2d6cdf);padding:32px 40px;text-align:center;">
          <h1 style="margin:0;color:#ffffff;font-size:22px;font-weight:700;letter-spacing:1px;">🧾 New Invoice Generated</h1>
          <p style="margin:8px 0 0;color:rgba(255,255,255,0.8);font-size:14px;">Cod Xpert Invoice Generator Alert</p>
        </td>
      </tr>
      <!-- Body -->
      <tr>
        <td style="padding:36px 40px;">
          <p style="margin:0 0 24px;color:#374151;font-size:15px;">Hello <strong>Admin</strong>, a new invoice has just been created in your system.</p>
          <!-- Invoice Summary Box -->
          <table width="100%" cellpadding="0" cellspacing="0" style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;overflow:hidden;margin-bottom:24px;">
            <tr style="background:#1e3a5f;">
              <td colspan="2" style="padding:12px 20px;color:#ffffff;font-size:13px;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Invoice Summary</td>
            </tr>
            <tr>
              <td style="padding:14px 20px;color:#6b7280;font-size:13px;border-bottom:1px solid #e2e8f0;">Invoice Number</td>
              <td style="padding:14px 20px;color:#111827;font-size:13px;font-weight:600;border-bottom:1px solid #e2e8f0;">{{ $invoice->invoice_number }}</td>
            </tr>
            <tr style="background:#f9fafb;">
              <td style="padding:14px 20px;color:#6b7280;font-size:13px;border-bottom:1px solid #e2e8f0;">Client</td>
              <td style="padding:14px 20px;color:#111827;font-size:13px;font-weight:600;border-bottom:1px solid #e2e8f0;">{{ $invoice->client->name }} ({{ $invoice->client->company ?? 'N/A' }})</td>
            </tr>
            <tr>
              <td style="padding:14px 20px;color:#6b7280;font-size:13px;border-bottom:1px solid #e2e8f0;">Invoice Date</td>
              <td style="padding:14px 20px;color:#111827;font-size:13px;border-bottom:1px solid #e2e8f0;">{{ $invoice->invoice_date->format('d M Y') }}</td>
            </tr>
            <tr style="background:#f9fafb;">
              <td style="padding:14px 20px;color:#6b7280;font-size:13px;border-bottom:1px solid #e2e8f0;">Due Date</td>
              <td style="padding:14px 20px;color:#111827;font-size:13px;border-bottom:1px solid #e2e8f0;">{{ $invoice->due_date->format('d M Y') }}</td>
            </tr>
            <tr>
              <td style="padding:14px 20px;color:#6b7280;font-size:13px;border-bottom:1px solid #e2e8f0;">Currency</td>
              <td style="padding:14px 20px;color:#111827;font-size:13px;border-bottom:1px solid #e2e8f0;">{{ $invoice->currency_code }}</td>
            </tr>
            <tr style="background:#fff7ed;">
              <td style="padding:16px 20px;color:#6b7280;font-size:14px;font-weight:700;">Grand Total</td>
              <td style="padding:16px 20px;color:#d97706;font-size:18px;font-weight:800;">{{ $invoice->currency_symbol }} {{ number_format($invoice->grand_total, 2) }}</td>
            </tr>
          </table>
          <!-- CTA Button -->
          <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
              <td align="center" style="padding:8px 0 24px;">
                <a href="{{ config('app.url') }}/invoices/{{ $invoice->id }}" style="display:inline-block;background:linear-gradient(135deg,#2d6cdf,#1e3a5f);color:#ffffff;text-decoration:none;padding:14px 32px;border-radius:8px;font-size:14px;font-weight:600;letter-spacing:0.5px;">View Invoice →</a>
              </td>
            </tr>
          </table>
          <p style="margin:0;color:#9ca3af;font-size:12px;text-align:center;">This is an automated alert from <strong>{{ config('app.name') }}</strong>. Please do not reply to this email.</p>
        </td>
      </tr>
      <!-- Footer -->
      <tr>
        <td style="background:#f8fafc;padding:20px 40px;text-align:center;border-top:1px solid #e2e8f0;">
          <p style="margin:0;color:#9ca3af;font-size:11px;">© {{ date('Y') }} Cod Xpert · All Rights Reserved</p>
        </td>
      </tr>
    </table>
  </td></tr>
</table>
</body>
</html>
