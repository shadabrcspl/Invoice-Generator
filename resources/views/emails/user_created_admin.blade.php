<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>New User Registration Alert</title></head>
<body style="margin:0;padding:0;font-family:'Segoe UI',Arial,sans-serif;background:#f0f4f8;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f0f4f8;padding:40px 0;">
  <tr><td align="center">
    <table width="580" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,0.08);">
      <tr>
        <td style="background:linear-gradient(135deg,#0f172a,#1e293b);padding:40px;text-align:center;">
          <div style="width:64px;height:64px;background:rgba(255,255,255,0.1);border-radius:16px;margin:0 auto 16px;display:flex;align-items:center;justify-content:center;font-size:28px;">👤</div>
          <h1 style="margin:0;color:#ffffff;font-size:26px;font-weight:800;">New User Registered</h1>
          <p style="margin:8px 0 0;color:rgba(255,255,255,0.8);font-size:14px;">A new account has been created on your system</p>
        </td>
      </tr>
      <tr>
        <td style="padding:36px 40px;">
          <p style="margin:0 0 20px;color:#374151;font-size:15px;">Hello Admin,</p>
          <p style="margin:0 0 24px;color:#6b7280;font-size:14px;line-height:1.7;">A new user has just registered on the **{{ config('app.name') }}** platform. Below are the registration details:</p>
          
          <table width="100%" cellpadding="0" cellspacing="0" style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;margin-bottom:28px;">
            <tr><td style="padding:20px 24px;">
              <p style="margin:0 0 10px;color:#9ca3af;font-size:11px;text-transform:uppercase;letter-spacing:1px;">User Details</p>
              <p style="margin:0 0 6px;color:#374151;font-size:13px;"><span style="color:#9ca3af;">Name:</span> <strong>{{ $user->name }}</strong></p>
              <p style="margin:0 0 6px;color:#374151;font-size:13px;"><span style="color:#9ca3af;">Email:</span> <strong>{{ $user->email }}</strong></p>
              <p style="margin:0 0 6px;color:#374151;font-size:13px;"><span style="color:#9ca3af;">Registered At:</span> <strong>{{ $user->created_at->setTimezone('Asia/Kolkata')->format('M d, Y h:i A') }} (IST)</strong></p>
            </td></tr>
          </table>

          <p style="margin:0;color:#6b7280;font-size:13px;line-height:1.7;">No action is required from your side at this moment. You can view user registrations in your database backend.</p>
        </td>
      </tr>
      <tr>
        <td style="background:#f8fafc;padding:20px 40px;text-align:center;border-top:1px solid #e2e8f0;">
          <p style="margin:0;color:#9ca3af;font-size:11px;">© {{ date('Y') }} {{ config('app.name') }} · Automated Alert System</p>
        </td>
      </tr>
    </table>
  </td></tr>
</table>
</body>
</html>
