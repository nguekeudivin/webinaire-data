<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\WebinaireSession;
use App\Support\Pays;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class AvisController extends Controller
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

    private array $accompagnements = ['Oui bien sûr', 'Non pas pour le moment'];

    public function show(int $sessionId)
    {
        $session = WebinaireSession::where('id', $sessionId)
            ->where('statut', 'ouverte')
            ->first();

        return view('avis.show', [
            'session' => $session,
            'sessionId' => $sessionId,
            'secteurs' => $this->secteurs,
            'profils' => $this->profils,
            'niveaux' => $this->niveaux,
            'accompagnements' => $this->accompagnements,
            'pays' => Pays::liste(),
        ]);
    }

    public function store(Request $request)
    {
        $sessionId = (int) $request->input('session_id', 0);

        $ipKey = 'avis:' . $sessionId . ':' . $request->ip();
        if (RateLimiter::tooManyAttempts($ipKey, 2)) {
            return back()->with('error', 'Trop de soumissions. Veuillez patienter 1 minute.');
        }
        RateLimiter::hit($ipKey, 60);

        $validated = $request->validate([
            'session_id' => 'required|integer|exists:webinaire_sessions,id,statut,ouverte',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'whatsapp' => 'required|string|min:6|max:255',
            'pays' => 'required|string',
            'secteur' => 'required|string',
            'profil' => 'required|string',
            'niveau' => 'required|string',
            'accompagnement' => 'required|string',
            'note' => 'required|integer|between:1,5',
            'commentaire' => 'nullable|string|max:2000',
        ], [
            'session_id.required' => 'La session est obligatoire.',
            'nom.required' => 'Votre nom est obligatoire.',
            'prenom.required' => 'Votre prénom est obligatoire.',
            'email.required' => 'L\'adresse email est obligatoire.',
            'email.email' => 'L\'adresse email n\'est pas valide.',
            'whatsapp.required' => 'Le numéro WhatsApp est obligatoire.',
            'whatsapp.min' => 'Le numéro WhatsApp est invalide',
            'pays.required' => 'Le pays est obligatoire.',
            'secteur.required' => 'Le secteur d\'activité est obligatoire.',
            'profil.required' => 'Le profil professionnel est obligatoire.',
            'niveau.required' => 'Le niveau en analyse de données est obligatoire.',
            'accompagnement.required' => 'Vous devez sélectionner une option d\'accompagnement.',
            'note.required' => 'Veuillez attribuer une note.',
            'note.between' => 'La note doit être comprise entre 1 et 5.',
        ]);

        Avis::create($validated);

        return redirect()->route('avis.show', ['sessionId' => $sessionId])
            ->with('success', 'Votre avis a bien été enregistré.');
    }
}
