<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration Received</title>
</head>
<body style="margin:0;padding:0;background:#f7f3ec;font-family:Georgia,'Times New Roman',serif;color:#1c1a17;">
<table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#f7f3ec;padding:32px 16px;">
<tr><td align="center">
<table role="presentation" width="600" cellspacing="0" cellpadding="0" style="max-width:600px;background:#ffffff;border:1px solid #c8b89a;">
  <tr>
    <td style="height:4px;background:linear-gradient(90deg,#8a3a1f,#b08a3e);"></td>
  </tr>
  <tr>
    <td style="padding:36px 32px 24px;text-align:center;border-bottom:1px solid #c8b89a;">
      <p style="margin:0 0 8px;font-family:Arial,sans-serif;font-size:11px;letter-spacing:0.22em;text-transform:uppercase;color:#4a4540;">
        Africa Special Needs Education Network · Acorn Special Tutorials
      </p>
      <h1 style="margin:0 0 8px;font-size:28px;font-weight:normal;color:#1c1a17;">Registration received</h1>
      <p style="margin:0;font-size:17px;font-style:italic;color:#4a4540;">Inclusive by Design Masterclass</p>
    </td>
  </tr>
  <tr>
    <td style="padding:28px 32px;">
      <p style="margin:0 0 16px;font-family:Arial,sans-serif;font-size:15px;line-height:1.6;color:#1c1a17;">
        Dear {{ $participant->name }},
      </p>
      <p style="margin:0 0 20px;font-family:Arial,sans-serif;font-size:15px;line-height:1.6;color:#4a4540;">
        Your registration for the Inclusive by Design Masterclass with <strong>{{ $registration->school_name }}</strong> has been received and is <strong>being processed</strong>. The school lead contact will receive payment instructions separately once the application is reviewed.
      </p>

      <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#1c1a17;margin-bottom:24px;">
        <tr>
          <td style="padding:20px 24px;text-align:center;">
            <p style="margin:0 0 6px;font-family:Arial,sans-serif;font-size:10px;letter-spacing:0.28em;text-transform:uppercase;color:rgba(247,243,236,0.7);">Reference</p>
            <p style="margin:0;font-size:26px;letter-spacing:0.1em;color:#b08a3e;">{{ $registration->reference }}</p>
          </td>
        </tr>
      </table>

      <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border:1px solid #c8b89a;margin-bottom:24px;">
        <tr>
          <td style="padding:12px 16px;font-family:Arial,sans-serif;font-size:13px;border-bottom:1px solid #c8b89a;">
            <strong style="color:#4a4540;">Your role</strong><br>{{ $participant->role }}
          </td>
          <td style="padding:12px 16px;font-family:Arial,sans-serif;font-size:13px;border-bottom:1px solid #c8b89a;">
            <strong style="color:#4a4540;">School</strong><br>{{ $registration->school_name }}
          </td>
        </tr>
      </table>

      <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#efe7d8;border-left:3px solid #8a3a1f;margin-bottom:24px;">
        <tr>
          <td style="padding:18px 20px;">
            <p style="margin:0 0 8px;font-family:Arial,sans-serif;font-size:11px;letter-spacing:0.18em;text-transform:uppercase;color:#4a4540;">Provisional dates</p>
            <p style="margin:0 0 6px;font-size:18px;color:#1c1a17;"><strong>14 – 16 July 2026</strong></p>
            <p style="margin:0;font-family:Arial,sans-serif;font-size:14px;line-height:1.5;color:#4a4540;">
              Daily 8:30 a.m. – 3:30 p.m.<br>
              {{ \App\Services\MasterclassCalendar::VENUE }}
            </p>
            <p style="margin:12px 0 0;font-family:Arial,sans-serif;font-size:13px;line-height:1.5;color:#4a4540;">
              A calendar file is attached so you can save the dates while your registration is processed.
            </p>
          </td>
        </tr>
      </table>

      <p style="margin:0;font-family:Arial,sans-serif;font-size:14px;line-height:1.6;color:#4a4540;">
        You will receive a separate confirmation email once payment has been verified and your place is secured.
        Questions? Contact
        <a href="mailto:info@asnenafrica.org" style="color:#8a3a1f;">info@asnenafrica.org</a>.
      </p>
    </td>
  </tr>
  <tr>
    <td style="padding:20px 32px;text-align:center;border-top:1px solid #c8b89a;background:#f7f3ec;">
      <p style="margin:0 0 6px;font-size:16px;font-style:italic;color:#8a3a1f;">“I am because we are.”</p>
      <p style="margin:0;font-family:Arial,sans-serif;font-size:12px;color:#4a4540;">
        Masterclass Secretariat · +254 703 906 990 · +254 712 652 621
      </p>
    </td>
  </tr>
</table>
</td></tr>
</table>
</body>
</html>
