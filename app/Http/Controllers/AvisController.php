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

    public function show(Request $request)
    {
        $sessionId = (int) $request->query('session', 0);
        $session = null;

        if ($sessionId > 0) {
            $session = WebinaireSession::where('id', $sessionId)
                ->where('statut', 'ouverte')
                ->first();
        }

        return view('avis.show', [
            'session' => $session,
            'sessionId' => $sessionId,
            'secteurs' => $this->secteurs,
            'profils' => $this->profils,
            'niveaux' => $this->niveaux,
            'accompagnements' => $this->accompagnements,
            'pays' => Pays::liste(),
            'errors' => [],
            'old' => [],
        ]);
    }

    public function store(Request $request)
    {
        $sessionId = (int) $request->input('session_id', 0);
        $session = WebinaireSession::where('id', $sessionId)
            ->where('statut', 'ouverte')
            ->first();

        if (!$session) {
            return redirect()->route('avis.show');
        }

        $errors = [];
        $success = false;

        $ipKey = 'avis:' . $sessionId . ':' . $request->ip();
        if (RateLimiter::tooManyAttempts($ipKey, 2)) {
            $errors[] = 'Trop de soumissions. Veuillez patienter 1 minute.';
        } else {
            RateLimiter::hit($ipKey, 60);

            $nom = trim($request->input('nom', ''));
            $prenom = trim($request->input('prenom', ''));
            $email = trim($request->input('email', ''));
            $whatsapp = trim($request->input('whatsapp', ''));
            $pays = $request->input('pays', '');
            $secteur = $request->input('secteur', '');
            $profil = $request->input('profil', '');
            $niveau = $request->input('niveau', '');
            $accompagnement = $request->input('accompagnement');
            $note = (int) $request->input('note', 0);
            $commentaire = trim($request->input('commentaire', ''));

            if (empty($nom)) $errors[] = 'Votre nom est obligatoire.';
            if (empty($prenom)) $errors[] = 'Votre prénom est obligatoire.';
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Adresse email invalide.';
            if (empty($whatsapp)) $errors[] = 'Le numéro WhatsApp est obligatoire.';
            if (empty($pays)) $errors[] = 'Le pays est obligatoire.';
            if (empty($secteur)) $errors[] = 'Le secteur d\'activité est obligatoire.';
            if (empty($profil)) $errors[] = 'Le profil professionnel est obligatoire.';
            if (empty($niveau)) $errors[] = 'Le niveau en analyse de données est obligatoire.';
            if (!$accompagnement) $errors[] = 'Vous devez selectionner une option d\'accompagnement.';
            if ($note < 1 || $note > 5) $errors[] = 'Veuillez attribuer une note entre 1 et 5.';

            if (empty($errors)) {
                Avis::create([
                    'session_id' => $sessionId,
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'email' => $email,
                    'whatsapp' => $whatsapp,
                    'pays' => $pays,
                    'secteur' => $secteur,
                    'profil' => $profil,
                    'niveau' => $niveau,
                    'accompagnement' => $accompagnement,
                    'note' => $note,
                    'commentaire' => $commentaire,
                ]);
                $success = true;
            }
        }

        return view('avis.show', [
            'session' => $session,
            'sessionId' => $sessionId,
            'errors' => $errors,
            'success' => $success,
            'old' => $request->except(['session_id']),
            'secteurs' => $this->secteurs,
            'profils' => $this->profils,
            'niveaux' => $this->niveaux,
            'accompagnements' => $this->accompagnements,
            'pays' => Pays::liste(),
        ]);
    }
}
