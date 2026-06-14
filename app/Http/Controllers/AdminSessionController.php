<?php

namespace App\Http\Controllers;

use App\Models\WebinaireSession;
use Illuminate\Http\Request;

class AdminSessionController extends Controller
{
    public function index()
    {
        $sessions = WebinaireSession::orderBy('date_session', 'desc')->get();
        return view('admin.sessions', ['sessions' => $sessions]);
    }

    public function store(Request $request)
    {
        $id = (int) $request->input('id', 0);
        $titre = trim($request->input('titre', ''));
        $dateSession = trim($request->input('date_session', ''));
        $description = trim($request->input('description', ''));
        $statut = in_array($request->input('statut'), ['ouverte', 'fermee']) ? $request->input('statut') : 'ouverte';

        if (!empty($titre) && !empty($dateSession)) {
            if ($id > 0) {
                $session = WebinaireSession::find($id);
                if ($session) {
                    $session->update([
                        'titre' => $titre,
                        'date_session' => $dateSession,
                        'description' => $description,
                        'statut' => $statut,
                    ]);
                }
            } else {
                WebinaireSession::create([
                    'titre' => $titre,
                    'date_session' => $dateSession,
                    'description' => $description,
                    'statut' => $statut,
                ]);
            }
        }

        return redirect()->route('admin.sessions');
    }

    public function destroy(Request $request)
    {
        $id = (int) $request->input('delete_id', 0);
        if ($id > 0) {
            WebinaireSession::destroy($id);
        }
        return redirect()->route('admin.sessions');
    }
}
