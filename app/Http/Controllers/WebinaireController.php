<?php

namespace App\Http\Controllers;

use App\Mail\RegistrationMail;
use App\Models\Prospect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;

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
            'errors' => [],
            'old' => [],
        ]);
    }

    public function store(Request $request)
    {
        $errors = [];

        $ipKey = 'inscription:' . $request->ip();
        if (RateLimiter::tooManyAttempts($ipKey, 3)) {
            $errors[] = 'Trop de soumissions. Veuillez patienter 1 minute.';
        } else {
            RateLimiter::hit($ipKey, 60);

            $nom = trim($request->input('nom', ''));
            $prenom = trim($request->input('prenom', ''));
            $email = trim($request->input('email', ''));
            $whatsapp = trim($request->input('whatsapp', ''));
            $secteur = $request->input('secteur', '');
            $profil = $request->input('profil', '');
            $niveau = $request->input('niveau', '');
            $preference = $request->input('preference','');
            $consentement = $request->boolean('consentement');

            if (empty($nom)) $errors[] = 'Le nom est obligatoire.';
            if (empty($prenom)) $errors[] = 'Le prénom est obligatoire.';
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'L\'adresse email est invalide.';
            if (empty($whatsapp)) $errors[] = 'Le numéro WhatsApp est obligatoire.';
            if (empty($secteur)) $errors[] = 'Le secteur d\'activité est obligatoire.';
            if (empty($profil)) $errors[] = 'Le profil professionnel est obligatoire.';
            if (empty($niveau)) $errors[] = 'Le niveau en analyse de données est obligatoire.';
            if (empty($preference)) $errors[] = 'La préférence de formation est obligatoire.';
            if (!$consentement) $errors[] = 'Vous devez accepter de recevoir nos communications.';

            if (empty($errors)) {
                try {
                    $prospect = Prospect::create([
                        'nom' => $nom,
                        'prenom' => $prenom,
                        'email' => $email,
                        'whatsapp' => $whatsapp,
                        'secteur' => $secteur,
                        'profil' => $profil,
                        'niveau' => $niveau,
                        'preference' => $preference,
                        'consentement' => $consentement,
                    ]);

                    Mail::to($email)->queue(new RegistrationMail($prospect, 'prospect'));
                    Mail::to(env('ADMIN_EMAIL', 'admin@webinaire.local'))->queue(new RegistrationMail($prospect, 'admin'));

                    return redirect()->route('merci');
                } catch (\Exception $e) {
                    if (str_contains($e->getMessage(), 'UNIQUE constraint failed')) {
                        $errors[] = 'Cet email est déjà inscrit.';
                    } else {
                        $errors[] = 'Une erreur est survenue. Veuillez réessayer.';
                    }
                }
            }
        }

        return view('webinaire.index', [
            'secteurs' => $this->secteurs,
            'profils' => $this->profils,
            'niveaux' => $this->niveaux,
            'preferences' => $this->preferences,
            'errors' => $errors,
            'old' => $request->all(),
        ]);
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
