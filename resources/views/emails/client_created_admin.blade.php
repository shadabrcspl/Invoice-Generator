<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>New Client Added</title></head>
<body style="margin:0;padding:0;font-family:'Segoe UI',Arial,sans-serif;background:#f0f4f8;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f0f4f8;padding:40px 0;">
  <tr><td align="center">
    <table width="580" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,0.08);">
      <tr>
        <td style="background:linear-gradient(135deg,#1e3a5f,#2d6cdf);padding:32px 40px;text-align:center;">
          <h1 style="margin:0;color:#ffffff;font-size:22px;font-weight:700;">👤 New Client Added</h1>
          <p style="margin:8px 0 0;color:rgba(255,255,255,0.8);font-size:14px;">Client Directory Update</p>
        </td>
      </tr>
      <tr>
        <td style="padding:36px 40px;">
          <p style="margin:0 0 24px;color:#374151;font-size:15px;">Hello <strong>{{ $admin->name }}</strong>, a new client has been added to your directory.</p>
          <table width="100%" cellpadding="0" cellspacing="0" style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;overflow:hidden;margin-bottom:24px;">
            <tr style="background:#1e3a5f;">
              <td colspan="2" style="padding:12px 20px;color:#ffffff;font-size:13px;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Client Details</td>
            </tr>
            <tr>
              <td style="padding:12px 20px;color:#6b7280;font-size:13px;border-bottom:1px solid #e2e8f0;width:40%;">Client Name</td>
              <td style="padding:12px 20px;color:#111827;font-size:13px;font-weight:600;border-bottom:1px solid #e2e8f0;">{{ $client->name }}</td>
            </tr>
            <tr style="background:#f9fafb;">
              <td style="padding:12px 20px;color:#6b7280;font-size:13px;border-bottom:1px solid #e2e8f0;">Company</td>
              <td style="padding:12px 20px;color:#111827;font-size:13px;border-bottom:1px solid #e2e8f0;">{{ $client->company ?? '—' }}</td>
            </tr>
            <tr>
              <td style="padding:12px 20px;color:#6b7280;font-size:13px;border-bottom:1px solid #e2e8f0;">Email</td>
              <td style="padding:12px 20px;color:#111827;font-size:13px;border-bottom:1px solid #e2e8f0;">{{ $client->email ?? '—' }}</td>
            </tr>
            <tr style="background:#f9fafb;">
              <td style="padding:12px 20px;color:#6b7280;font-size:13px;border-bottom:1px solid #e2e8f0;">Tax ID</td>
              <td style="padding:12px 20px;color:#111827;font-size:13px;border-bottom:1px solid #e2e8f0;">{{ $client->tax_id ?? '—' }}</td>
            </tr>
            <tr>
              <td style="padding:12px 20px;color:#6b7280;font-size:13px;">Address</td>
              <td style="padding:12px 20px;color:#111827;font-size:13px;">{{ $client->address ?? '—' }}</td>
            </tr>
          </table>
          <table width="100%" cellpadding="0" cellspacing="0">
            <tr><td align="center">
              <a href="{{ config('app.url') }}/clients" style="display:inline-block;background:linear-gradient(135deg,#2d6cdf,#1e3a5f);color:#ffffff;text-decoration:none;padding:14px 32px;border-radius:8px;font-size:14px;font-weight:600;">View Client Directory →</a>
            </td></tr>
          </table>
        </td>
      </tr>
      <tr>
        <td style="background:#f8fafc;padding:20px 40px;text-align:center;border-top:1px solid #e2e8f0;">
          <p style="margin:0;color:#9ca3af;font-size:11px;">© {{ date('Y') }} {{ config('app.name') }} · All Rights Reserved</p>
        </td>
      </tr>
    </table>
  </td></tr>
</table>
</body>
</html>
