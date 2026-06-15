<?php

namespace App\Http\Controllers;

use App\Mail\RegistrationMail;
use App\Models\Prospect;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rule;

class WebinaireController extends Controller
{
    private array $secteurs = [
        'Agriculture', 'Industrie', 'BTP', 'Commerce',
        'Banque', 'Assurance', 'Finance & Comptabilité',
        'Audit et Conseil', 'Ressources Humaines', 'Informatique',
        'Data & IA', 'Télécommunications', 'Marketing & Communication',
        'Médias', 'Éducation & Formation', 'Santé',
        'Hôtellerie & Restauration', 'Transport & Logistique',
        'Administration publique', 'ONG & Associations'
    ];

    private array $profils = [
        'Directeur d\'entreprise (PDG, DG, Gérant, Fondateur)',
        'Directeur', 'Chef de département', 'Responsable d\'équipe',
        'Employé', 'Consultant', 'Prestataire ou Société partenaire',
        'Stagiaire', 'Intérimaire ou personnel temporaire',
        'Entrepreneur', 'Coach / Formateur', 'Créateur de contenu',
        'Autre'
    ];

    private array $niveaux = ['Débutant', 'Intermédiaire', 'Avancé'];


    private array $preferences = ['En ligne', 'En présentiel', 'Aucune préférence'];

    public function index()
    {
        return view('webinaire.index', [
            'secteurs' => $this->secteurs,
            'profils' => $this->profils,
            'niveaux' => $this->niveaux,
            'preferences' => $this->preferences,
        ]);
    }

    public function store(Request $request)
    {
        $ipKey = 'inscription:' . $request->ip();
        if (RateLimiter::tooManyAttempts($ipKey, 3)) {
            return back()->withErrors(['Trop de soumissions. Veuillez patienter 1 minute.'])->withInput();
        }
        RateLimiter::hit($ipKey, 60);

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:prospects,email',
            'whatsapp' => 'required|string|max:255',
            'secteur' => ['required', 'string'],
            'profil' => ['required', 'string'],
            'niveau' => ['required', 'string'],
            'preference' => ['required', 'string'],
            'consentement' => 'required',
        ]);

        $prospect = Prospect::create($validated);

        Mail::to($validated['email'])->queue(new RegistrationMail($prospect, 'prospect'));
        $admins = User::where('receive_notification', true)->get();
        foreach ($admins as $admin) {
            Mail::to($admin->email)->queue(new RegistrationMail($prospect, 'admin'));
        }

        return redirect()->route('merci');
    }

    public function merci()
    {
        return view('webinaire.merci');
    }

    private function hasMxRecord(string $email): bool
    {
        $domain = substr(strrchr($email, '@'), 1);
        if (!$domain) return false;
        return checkdnsrr($domain, 'MX') || checkdnsrr($domain, 'A');
    }
}
