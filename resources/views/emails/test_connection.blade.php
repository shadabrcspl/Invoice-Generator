<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>SMTP Test Email</title></head>
<body style="margin:0;padding:0;font-family:'Segoe UI',Arial,sans-serif;background:#f0f4f8;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f0f4f8;padding:40px 0;">
  <tr><td align="center">
    <table width="560" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,0.08);">
      <tr>
        <td style="background:linear-gradient(135deg,#059669,#047857);padding:36px 40px;text-align:center;">
          <div style="font-size:42px;margin-bottom:12px;">✅</div>
          <h1 style="margin:0;color:#ffffff;font-size:22px;font-weight:800;">SMTP Connection Verified!</h1>
          <p style="margin:8px 0 0;color:rgba(255,255,255,0.85);font-size:14px;">Your email configuration is working correctly.</p>
        </td>
      </tr>
      <tr>
        <td style="padding:32px 40px;">
          <p style="margin:0 0 20px;color:#374151;font-size:15px;">Hello <strong>{{ $user->name }}</strong>,</p>
          <p style="margin:0 0 24px;color:#6b7280;font-size:14px;line-height:1.7;">
            This is a test email from <strong>{{ config('app.name') }}</strong>. If you received this message, your custom SMTP email configuration is set up correctly and all invoice-related emails will be sent from your domain.
          </p>
          <table width="100%" cellpadding="0" cellspacing="0" style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;margin-bottom:24px;">
            <tr><td style="padding:20px 24px;">
              <p style="margin:0 0 10px;color:#9ca3af;font-size:11px;text-transform:uppercase;letter-spacing:1px;">Connection Details</p>
              <p style="margin:0 0 6px;color:#374151;font-size:13px;"><span style="color:#9ca3af;">Sent at:</span> <strong>{{ now()->format('d M Y, h:i A') }}</strong></p>
              <p style="margin:0;color:#374151;font-size:13px;"><span style="color:#9ca3af;">Account:</span> <strong>{{ $user->email }}</strong></p>
            </td></tr>
          </table>
          <p style="margin:0;color:#9ca3af;font-size:12px;text-align:center;">
            You can now safely send invoices from your own domain email address.
          </p>
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
