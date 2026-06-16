<!DOCTYPE html>
<html>
<head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'></head>
<body style='margin:0;padding:0;background-color:#f6f7fb;font-family:Montserrat,Segoe UI,system-ui,sans-serif;'>
<table width='100%' cellpadding='0' cellspacing='0'><tr><td align='center' style='padding:40px 20px;'>
<table width='600' cellpadding='0' cellspacing='0' style='background:#ffffff;border-radius:24px;overflow:hidden;box-shadow:0 20px 80px rgba(0,0,0,0.08);'>
<tr><td style='background:linear-gradient(135deg,#0329CE 0%,#1D3DF1 100%);padding:40px 40px 30px;text-align:center;'>
<div style='color:#ffffff;font-size:28px;font-weight:700;'>Master of Data</div>
<div style='color:rgba(255,255,255,0.8);font-size:13px;margin-top:6px;letter-spacing:0.2em;text-transform:uppercase;'>Inscription confirmée</div>
</td></tr>
<tr><td style='padding:40px;'>
<h1 style='margin:0 0 16px;font-size:22px;color:#1e293b;'>Bonjour {{ $prospect->prenom }},</h1>
<p style='margin:0 0 24px;color:#475569;line-height:1.7;font-size:15px;'>Merci pour votre inscription au <strong>Master of Data</strong>. Votre place est bien réservée.</p>

<div style='background:#f8f9fc;border-radius:16px;padding:24px;margin-bottom:24px;'>
<div style='font-size:11px;color:#94a3b8;text-transform:uppercase;letter-spacing:0.15em;margin-bottom:12px;'>Vos informations</div>
<table cellpadding='0' cellspacing='0' width='100%' style='font-size:14px;color:#334155;'>
<tr><td style='padding:8px 0;color:#64748b;'>Nom</td><td style='padding:8px 0;font-weight:600;text-align:right;'>{{ $prospect->prenom }} {{ $prospect->nom }}</td></tr>
<tr><td style='padding:8px 0;color:#64748b;'>Email</td><td style='padding:8px 0;font-weight:600;text-align:right;'>{{ $prospect->email }}</td></tr>
<tr><td style='padding:8px 0;color:#64748b;'>WhatsApp</td><td style='padding:8px 0;font-weight:600;text-align:right;'>{{ $prospect->whatsapp }}</td></tr>
<tr><td style='padding:8px 0;color:#64748b;'>Pays</td><td style='padding:8px 0;font-weight:600;text-align:right;'>{{ $prospect->pays }}</td></tr>
<tr><td style='padding:8px 0;color:#64748b;'>Secteur</td><td style='padding:8px 0;font-weight:600;text-align:right;'>{{ $prospect->secteur }}</td></tr>
<tr><td style='padding:8px 0;color:#64748b;'>Profil</td><td style='padding:8px 0;font-weight:600;text-align:right;'>{{ $prospect->profil }}</td></tr>
<tr><td style='padding:8px 0;color:#64748b;'>Niveau</td><td style='padding:8px 0;font-weight:600;text-align:right;'>{{ $prospect->niveau }}</td></tr>
</table>
</div>

<p style='margin:0 0 8px;color:#475569;line-height:1.7;font-size:15px;'>Nous vous enverrons les informations de connexion ainsi qu'un rappel avant le début du webinaire.</p>
<p style='margin:0;color:#475569;line-height:1.7;font-size:15px;'>À très bientôt,<br><strong>L'équipe Webinaire</strong></p>
</td></tr>
<tr><td style='background:#f8f9fc;padding:24px 40px;text-align:center;font-size:12px;color:#94a3b8;'>
Cet email a été envoyé automatiquement. Merci de ne pas y répondre.
</td></tr>
</table>
</td></tr></table>
</body>
</html>
