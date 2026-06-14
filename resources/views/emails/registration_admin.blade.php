<!DOCTYPE html>
<html>
<head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'></head>
<body style='margin:0;padding:0;background-color:#f6f7fb;font-family:Montserrat,Segoe UI,system-ui,sans-serif;'>
<table width='100%' cellpadding='0' cellspacing='0'><tr><td align='center' style='padding:40px 20px;'>
<table width='600' cellpadding='0' cellspacing='0' style='background:#ffffff;border-radius:24px;overflow:hidden;box-shadow:0 20px 80px rgba(0,0,0,0.08);'>
<tr><td style='background:#1e293b;padding:30px 40px;text-align:center;'>
<div style='color:#ffffff;font-size:18px;font-weight:700;'>Nouvelle inscription</div>
<div style='color:rgba(255,255,255,0.6);font-size:12px;margin-top:4px;'>{{ now()->format('d/m/Y à H:i') }}</div>
</td></tr>
<tr><td style='padding:40px;'>
<div style='background:#ecfdf5;border:1px solid #a7f3d0;border-radius:12px;padding:16px;margin-bottom:24px;'>
<div style='display:flex;align-items:center;gap:12px;'>
<div style='width:40px;height:40px;background:#10b981;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-size:18px;'>&#10003;</div>
<div>
<div style='font-size:14px;font-weight:700;color:#065f46;'>Inscription validée</div>
<div style='font-size:12px;color:#059669;'>Un nouveau participant vient de s'inscrire.</div>
</div>
</div>
</div>

<div style='background:#f8f9fc;border-radius:16px;padding:24px;'>
<div style='font-size:11px;color:#94a3b8;text-transform:uppercase;letter-spacing:0.15em;margin-bottom:16px;'>Détails du participant</div>
<table cellpadding='0' cellspacing='0' width='100%' style='font-size:14px;color:#334155;'>
<tr><td style='padding:10px 0;color:#64748b;border-bottom:1px solid #e2e8f0;'>Nom complet</td><td style='padding:10px 0;font-weight:600;text-align:right;border-bottom:1px solid #e2e8f0;'>{{ $prospect->prenom }} {{ $prospect->nom }}</td></tr>
<tr><td style='padding:10px 0;color:#64748b;border-bottom:1px solid #e2e8f0;'>Email</td><td style='padding:10px 0;font-weight:600;text-align:right;border-bottom:1px solid #e2e8f0;'><a href='mailto:{{ $prospect->email }}' style='color:#0329CE;text-decoration:none;'>{{ $prospect->email }}</a></td></tr>
<tr><td style='padding:10px 0;color:#64748b;border-bottom:1px solid #e2e8f0;'>WhatsApp</td><td style='padding:10px 0;font-weight:600;text-align:right;border-bottom:1px solid #e2e8f0;'>{{ $prospect->whatsapp }}</td></tr>
<tr><td style='padding:10px 0;color:#64748b;border-bottom:1px solid #e2e8f0;'>Secteur</td><td style='padding:10px 0;font-weight:600;text-align:right;border-bottom:1px solid #e2e8f0;'><span style='background:#dbeafe;color:#0329CE;padding:4px 12px;border-radius:20px;font-size:12px;'>{{ $prospect->secteur }}</span></td></tr>
<tr><td style='padding:10px 0;color:#64748b;border-bottom:1px solid #e2e8f0;'>Profil</td><td style='padding:10px 0;font-weight:600;text-align:right;border-bottom:1px solid #e2e8f0;'>{{ $prospect->profil }}</td></tr>
<tr><td style='padding:10px 0;color:#64748b;'>Niveau</td><td style='padding:10px 0;font-weight:600;text-align:right;'><span style='background:#dbeafe;color:#1e40af;padding:4px 12px;border-radius:20px;font-size:12px;'>{{ $prospect->niveau }}</span></td></tr>
</table>
</div>

<div style='text-align:center;margin-top:32px;'>
<a href="{{ url('/admin') }}" style='display:inline-block;background:#1e293b;color:#ffffff;text-decoration:none;padding:14px 32px;border-radius:9999px;font-size:14px;font-weight:600;'>Voir dans l'admin</a>
</div>
</td></tr>
<tr><td style='background:#f8f9fc;padding:20px 40px;text-align:center;font-size:12px;color:#94a3b8;'>
Notification automatique du système de webinaire.
</td></tr>
</table>
</td></tr></table>
</body>
</html>
