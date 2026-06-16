<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\WebinaireSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AdminAvisController extends Controller
{
    public function index(Request $request)
    {
        $sessionFilter = (int) $request->query('session', 0);

        $sessions = WebinaireSession::orderBy('date_session', 'desc')->get();

        $query = Avis::with('session')->orderBy('date_avis', 'desc');
        if ($sessionFilter) {
            $query->where('session_id', $sessionFilter);
        }
        $avisList = $query->get();

        $stats = [];
        foreach ($sessions as $s) {
            $stats[$s->id] = Avis::where('session_id', $s->id)
                ->selectRaw('COUNT(*) as total, ROUND(AVG(note), 1) as moyenne')
                ->first();
        }

        if ($request->has('export')) {
            return $this->exportAvis($avisList);
        }

        return view('admin.avis', [
            'avisList' => $avisList,
            'sessions' => $sessions,
            'sessionFilter' => $sessionFilter,
            'stats' => $stats,
        ]);
    }

    public function show($id)
    {
        $avis = Avis::with('session')->findOrFail($id);
        return view('admin.avis_detail', compact('avis'));
    }

    private function exportAvis($avisList)
    {
        $headers = ['ID', 'Nom', 'Prénom', 'Email', 'WhatsApp', 'Pays', 'Session', 'Secteur', 'Profil', 'Niveau', 'Note', 'Commentaire', 'Accompagnement', 'Date avis'];
        $data = [];
        foreach ($avisList as $a) {
            $data[] = [
                $a->id, $a->nom, $a->prenom, $a->email, $a->whatsapp, $a->pays,
                $a->session->titre ?? '', $a->secteur, $a->profil, $a->niveau,
                $a->note, $a->commentaire, $a->accompagnement, $a->date_avis,
            ];
        }

        $filename = 'avis_' . now()->format('Y-m-d') . '.csv';
        $callback = function () use ($headers, $data) {
            $output = fopen('php://output', 'w');
            fprintf($output, "\xEF\xBB\xBF");
            fputcsv($output, $headers, ';', '"', '\\');
            foreach ($data as $row) {
                fputcsv($output, $row, ';', '"', '\\');
            }
            fclose($output);
        };

        return Response::stream($callback, 200, [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename=' . $filename,
        ]);
    }
}
