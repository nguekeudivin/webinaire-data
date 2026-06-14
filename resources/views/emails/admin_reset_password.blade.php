<!DOCTYPE html>
<html>
<head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'></head>
<body style='margin:0;padding:0;background-color:#f6f7fb;font-family:Montserrat,Segoe UI,system-ui,sans-serif;'>
<table width='100%' cellpadding='0' cellspacing='0'><tr><td align='center' style='padding:40px 20px;'>
<table width='600' cellpadding='0' cellspacing='0' style='background:#ffffff;border-radius:24px;overflow:hidden;box-shadow:0 20px 80px rgba(0,0,0,0.08);'>
<tr><td style='background:linear-gradient(135deg,#0329CE 0%,#1D3DF1 100%);padding:40px 40px 30px;text-align:center;'>
<div style='color:#ffffff;font-size:28px;font-weight:700;'>Master of Data</div>
<div style='color:rgba(255,255,255,0.8);font-size:13px;margin-top:6px;letter-spacing:0.2em;text-transform:uppercase;'>Réinitialisation</div>
</td></tr>
<tr><td style='padding:40px;'>
<h1 style='margin:0 0 16px;font-size:22px;color:#1e293b;'>Réinitialisation de mot de passe</h1>
<p style='margin:0 0 24px;color:#475569;line-height:1.7;font-size:15px;'>Vous avez demandé la réinitialisation de votre mot de passe. Cliquez sur le bouton ci-dessous pour en créer un nouveau.</p>

<div style='text-align:center;margin-top:32px;'>
<a href="{{ route('admin.password.reset', ['token' => $token, 'email' => $email]) }}" style='display:inline-block;background:#1e293b;color:#ffffff;text-decoration:none;padding:14px 32px;border-radius:9999px;font-size:14px;font-weight:600;'>Réinitialiser mon mot de passe</a>
</div>

<p style='margin-top:24px;color:#94a3b8;font-size:12px;'>Ce lien est valable 60 minutes.</p>
</td></tr>
<tr><td style='background:#f8f9fc;padding:24px 40px;text-align:center;font-size:12px;color:#94a3b8;'>
Cet email a été envoyé automatiquement. Merci de ne pas y répondre.
</td></tr>
</table>
</td></tr></table>
</body>
</html>
