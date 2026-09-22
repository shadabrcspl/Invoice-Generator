<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Account Approved — {{ config('app.name') }}</title></head>
<body style="margin:0;padding:0;font-family:'Segoe UI',Arial,sans-serif;background:#f0f4f8;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f0f4f8;padding:40px 0;">
  <tr><td align="center">
    <table width="580" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,0.08);">
      <tr>
        <td style="background:linear-gradient(135deg,#059669,#10b981);padding:40px;text-align:center;">
          <div style="width:64px;height:64px;background:rgba(255,255,255,0.2);border-radius:16px;margin:0 auto 16px;display:flex;align-items:center;justify-content:center;font-size:28px;">🎉</div>
          <h1 style="margin:0;color:#ffffff;font-size:24px;font-weight:800;">Account Approved!</h1>
          <p style="margin:8px 0 0;color:rgba(255,255,255,0.8);font-size:14px;">You can now log in to your dashboard</p>
        </td>
      </tr>
      <tr>
        <td style="padding:36px 40px;">
          <p style="margin:0 0 20px;color:#374151;font-size:15px;">Hello <strong>{{ $user->name }}</strong>,</p>
          <p style="margin:0 0 20px;color:#4b5563;font-size:14px;line-height:1.7;">
            Great news! Your account on <strong>{{ config('app.name') }}</strong> has been **approved** by the administrator. 
            You can now log in and access your billing system.
          </p>
          <table width="100%" cellpadding="0" cellspacing="0" style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;margin-bottom:28px;">
            <tr><td style="padding:20px 24px;">
              <p style="margin:0 0 10px;color:#9ca3af;font-size:11px;text-transform:uppercase;letter-spacing:1px;">Account Details</p>
              <p style="margin:0 0 6px;color:#374151;font-size:13px;"><span style="color:#9ca3af;">Name:</span> <strong>{{ $user->name }}</strong></p>
              <p style="margin:0 0 6px;color:#374151;font-size:13px;"><span style="color:#9ca3af;">Email:</span> <strong>{{ $user->email }}</strong></p>
              <p style="margin:0;color:#374151;font-size:13px;"><span style="color:#9ca3af;">Login URL:</span> <a href="{{ config('app.url') }}/login" style="color:#2d6cdf;font-weight:600;text-decoration:none;">{{ config('app.url') }}/login</a></p>
            </td></tr>
          </table>
          <table width="100%" cellpadding="0" cellspacing="0">
            <tr><td align="center">
              <a href="{{ config('app.url') }}/login" style="display:inline-block;background:linear-gradient(135deg,#059669,#10b981);color:#ffffff;text-decoration:none;padding:14px 36px;border-radius:8px;font-size:14px;font-weight:600;box-shadow:0 4px 12px rgba(16, 185, 129, 0.35);">Access Dashboard Now →</a>
            </td></tr>
          </table>
        </td>
      </tr>
      <tr>
        <td style="background:#f8fafc;padding:20px 40px;text-align:center;border-top:1px solid #e2e8f0;">
          <p style="margin:0;color:#9ca3af;font-size:11px;">© {{ date('Y') }} {{ config('app.name') }} · Account Active</p>
        </td>
      </tr>
    </table>
  </td></tr>
</table>
</body>
</html>
