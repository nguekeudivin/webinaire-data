@extends('layouts.app')

@section('title', 'Admin - Avis')

@section('content')
<body class="bg-[#f6f7fb] text-slate-900 min-h-screen">
    <header class="bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <strong class="text-lg text-slate-800">Webinaire Admin</strong>
            <nav class="flex gap-6 text-sm">
                <a href="{{ route('admin.dashboard') }}" class="text-slate-500 hover:text-primary-600 transition">Prospects</a>
                <a href="{{ route('admin.sessions') }}" class="text-slate-500 hover:text-primary-600 transition">Sessions</a>
                <a href="{{ route('admin.avis') }}" class="text-primary-600 font-medium">Avis</a>
                <a href="{{ route('admin.admins') }}" class="text-slate-500 hover:text-primary-600 transition">Admins</a>
                <a href="{{ route('admin.password.change') }}" class="text-slate-500 hover:text-primary-600 transition">Mon compte</a>
                <a href="{{ route('admin.logout') }}" class="text-slate-500 hover:text-red-500 transition">Déconnexion</a>
            </nav>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-10">
        <div class="bg-white rounded-2xl border border-slate-200/60 p-8 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-slate-800">Avis des participants</h2>
                <a href="?export=1{{ $sessionFilter ? '&session=' . $sessionFilter : '' }}" class="px-5 py-2.5 rounded-full bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium shadow-sm transition">Exporter Excel</a>
            </div>

            <form method="GET" action="" class="mb-6">
                <select name="session" onchange="this.form.submit()"
                    class="px-4 py-3 rounded-xl bg-white border border-black/10 focus:border-primary-500 outline-none focus:ring-2 focus:ring-primary-200 transition cursor-pointer">
                    <option value="0">Toutes les sessions</option>
                    @foreach ($sessions as $s)
                        <option value="{{ $s->id }}" {{ $sessionFilter == $s->id ? 'selected' : '' }}>{{ $s->titre }}</option>
                    @endforeach
                </select>
            </form>

            @if (!empty($stats))
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
                    @foreach ($sessions as $s)
                        <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                            <div class="text-sm text-slate-500">{{ $s->titre }}</div>
                            <div class="text-2xl font-bold text-slate-800 mt-1">{{ $stats[$s->id]->moyenne ?? '-' }} <span class="text-sm text-slate-400 font-normal">/ 5</span></div>
                            <div class="text-sm text-slate-400 mt-1">{{ $stats[$s->id]->total ?? 0 }} avis</div>
                        </div>
                    @endforeach
                </div>
            @endif

            @if ($avisList->isEmpty())
                <p class="text-slate-500">Aucun avis pour le moment.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-slate-100 text-slate-500 text-left">
                                <th class="pb-3 font-medium">Nom</th>
                                <th class="pb-3 font-medium">Prénom</th>
                                <th class="pb-3 font-medium">Email</th>
                                <th class="pb-3 font-medium">WhatsApp</th>
                                <th class="pb-3 font-medium">Session</th>
                                <th class="pb-3 font-medium">Secteur</th>
                                <th class="pb-3 font-medium">Profil</th>
                                <th class="pb-3 font-medium">Niveau</th>
                                <th class="pb-3 font-medium">Note</th>
                                <th class="pb-3 font-medium">Commentaire</th>
                                <th class="pb-3 font-medium">Accompagnement</th>
                                <th class="pb-3 font-medium">Date</th>
                            </tr>
                        </thead>
                        <tbody class="text-slate-700">
                            @foreach ($avisList as $a)
                                <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition">
                                    <td class="py-4 font-medium">{{ $a->nom }}</td>
                                    <td class="py-4">{{ $a->prenom ?: '-' }}</td>
                                    <td class="py-4 text-xs text-slate-500">{{ $a->email }}</td>
                                    <td class="py-4 text-xs">{{ $a->whatsapp ?: '-' }}</td>
                                    <td class="py-4">{{ $a->session->titre ?? '-' }}</td>
                                    <td class="py-4"><span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-primary-50 text-primary-700 border border-primary-200">{{ $a->secteur ?: '-' }}</span></td>
                                    <td class="py-4">{{ $a->profil ?: '-' }}</td>
                                    <td class="py-4">{{ $a->niveau ?: '-' }}</td>
                                    <td class="py-4 text-yellow-400 text-lg">
                                        {!! str_repeat('&#9733;', $a->note) . str_repeat('&#9734;', 5 - $a->note) !!}
                                    </td>
                                    <td class="py-4">{{ $a->commentaire ?: '-' }}</td>
                                    <td class="py-4">{{ $a->accompagnement ?: '-' }}</td>
                                    <td class="py-4 text-slate-500">{{ \Carbon\Carbon::parse($a->date_avis)->format('d/m/Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </main>
</body>
@endsection
