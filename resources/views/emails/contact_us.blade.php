<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Contact Form Inquiry</title>
</head>
<body style="margin:0;padding:0;font-family:'Segoe UI',Arial,sans-serif;background:#f0f4f8;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f0f4f8;padding:40px 0;">
  <tr>
    <td align="center">
      <table width="580" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,0.08);">
        <tr>
          <td style="background:linear-gradient(135deg,#0f172a,#1e293b);padding:40px;text-align:center;">
            <div style="width:64px;height:64px;background:rgba(255,255,255,0.1);border-radius:16px;margin:0 auto 16px;display:flex;align-items:center;justify-content:center;font-size:28px;">✉️</div>
            <h1 style="margin:0;color:#ffffff;font-size:24px;font-weight:800;">New Contact Inquiry</h1>
            <p style="margin:8px 0 0;color:rgba(255,255,255,0.8);font-size:14px;">A message was submitted from the public landing page</p>
          </td>
        </tr>
        <tr>
          <td style="padding:36px 40px;">
            <p style="margin:0 0 20px;color:#374151;font-size:15px;">Hello Admin,</p>
            <p style="margin:0 0 24px;color:#6b7280;font-size:14px;line-height:1.7;">You have received a new message via the contact form on **{{ config('app.name', 'Cod Xpert Invoices') }}**:</p>
            
            <table width="100%" cellpadding="0" cellspacing="0" style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;margin-bottom:28px;">
              <tr>
                <td style="padding:20px 24px;">
                  <p style="margin:0 0 12px;color:#9ca3af;font-size:11px;text-transform:uppercase;letter-spacing:1px;font-weight:600;">Inquirer Details</p>
                  <p style="margin:0 0 8px;color:#374151;font-size:14px;"><span style="color:#64748b;font-weight:500;">Name:</span> <strong style="color:#0f172a;">{{ $name }}</strong></p>
                  <p style="margin:0 0 8px;color:#374151;font-size:14px;"><span style="color:#64748b;font-weight:500;">Email:</span> <a href="mailto:{{ $email }}" style="color:#0284c7;text-decoration:none;font-weight:600;">{{ $email }}</a></p>
                  @if(!empty($phone))
                  <p style="margin:0 0 8px;color:#374151;font-size:14px;"><span style="color:#64748b;font-weight:500;">Phone / WhatsApp:</span> <strong style="color:#0f172a;">{{ $phone }}</strong></p>
                  @endif
                  @if(!empty($company))
                  <p style="margin:0 0 8px;color:#374151;font-size:14px;"><span style="color:#64748b;font-weight:500;">Company / Business:</span> <strong style="color:#0f172a;">{{ $company }}</strong></p>
                  @endif
                  @if(!empty($inquiryType))
                  <p style="margin:0 0 8px;color:#374151;font-size:14px;"><span style="color:#64748b;font-weight:500;">Inquiry Category:</span> <span style="background:#e0f2fe;color:#0369a1;padding:3px 8px;border-radius:4px;font-size:12px;font-weight:600;">{{ $inquiryType }}</span></p>
                  @endif
                  <p style="margin:0 0 8px;color:#374151;font-size:14px;"><span style="color:#64748b;font-weight:500;">Subject:</span> <strong style="color:#0f172a;">{{ $mailSubject }}</strong></p>
                </td>
              </tr>
            </table>

            <p style="margin:0 0 8px;color:#9ca3af;font-size:11px;text-transform:uppercase;letter-spacing:1px;font-weight:600;">Message Content</p>
            <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;padding:20px 24px;color:#334155;font-size:14px;line-height:1.7;white-space:pre-wrap;margin-bottom:24px;">{{ $messageContent }}</div>

            <p style="margin:0;color:#6b7280;font-size:13px;line-height:1.7;">You can respond to this message directly by replying to this email.</p>
          </td>
        </tr>
        <tr>
          <td style="background:#f8fafc;padding:20px 40px;text-align:center;border-top:1px solid #e2e8f0;">
            <p style="margin:0;color:#9ca3af;font-size:11px;">© {{ date('Y') }} {{ config('app.name', 'Cod Xpert Invoices') }} · Powered by <a href="https://codxpert.com/" style="color:#64748b;text-decoration:none;font-weight:600;">CodXpert</a></p>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
