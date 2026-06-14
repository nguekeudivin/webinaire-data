<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\Prospect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->query('search', ''));

        $query = Prospect::query()->orderBy('date_inscription', 'desc');

        if ($search) {
            $like = '%' . $search . '%';
            $query->where(function ($q) use ($like) {
                $q->where('nom', 'like', $like)
                  ->orWhere('prenom', 'like', $like)
                  ->orWhere('email', 'like', $like);
            });
        }

        $prospects = $query->get();
        $total = Prospect::count();
        $totalAvis = Avis::count();

        if ($request->has('export')) {
            return $this->exportProspects($prospects);
        }

        return view('admin.dashboard', [
            'prospects' => $prospects,
            'total' => $total,
            'totalAvis' => $totalAvis,
            'search' => $search,
        ]);
    }

    public function prospect(Request $request, int $id)
    {
        $prospect = Prospect::findOrFail($id);
        return view('admin.prospect', ['prospect' => $prospect]);
    }

    private function exportProspects($prospects)
    {
        $headers = ['ID', 'Nom', 'Prénom', 'Email', 'WhatsApp', 'Secteur', 'Profil', 'Niveau', 'Préférence', 'Consentement', 'Date inscription'];
        $data = [];
        foreach ($prospects as $p) {
            $data[] = [
                $p->id, $p->nom, $p->prenom, $p->email, $p->whatsapp,
                $p->secteur, $p->profil, $p->niveau, $p->preference,
                $p->consentement ? 'Oui' : 'Non', $p->date_inscription,
            ];
        }

        $filename = 'prospects_' . now()->format('Y-m-d') . '.csv';
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
