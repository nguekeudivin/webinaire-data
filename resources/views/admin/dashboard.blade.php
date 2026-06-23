@extends('layouts.app')

@section('title', 'Admin - Prospects')

@section('content')
<body class="bg-[#f6f7fb] text-slate-900 min-h-screen">
    <header class="bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <strong class="text-lg text-slate-800">Webinaire Admin</strong>
            <nav class="flex gap-6 text-sm">
                <a href="{{ route('admin.dashboard') }}" class="text-primary-600 font-medium">Prospects</a>
                <a href="{{ route('admin.sessions') }}" class="text-slate-500 hover:text-primary-600 transition">Sessions</a>
                <a href="{{ route('admin.avis') }}" class="text-slate-500 hover:text-primary-600 transition">Avis</a>
                <a href="{{ route('admin.admins') }}" class="text-slate-500 hover:text-primary-600 transition">Admins</a>
                <a href="{{ route('admin.password.change') }}" class="text-slate-500 hover:text-primary-600 transition">Mon compte</a>
                <a href="{{ route('admin.logout') }}" class="text-slate-500 hover:text-red-500 transition">Déconnexion</a>
            </nav>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white rounded-2xl border border-slate-200/60 p-6 shadow-sm">
                <div class="text-3xl font-bold text-primary-600">{{ $total }}</div>
                <div class="text-sm text-slate-500 mt-1">Inscriptions</div>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200/60 p-6 shadow-sm">
                <div class="text-3xl font-bold text-secondary-600">{{ $totalAvis }}</div>
                <div class="text-sm text-slate-500 mt-1">Avis reçus</div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200/60 p-8 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-slate-800">Liste des prospects</h2>
                <a href="?export=1" class="px-4 py-2 rounded-full bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium shadow-sm transition">Exporter Excel</a>
            </div>

            <form method="GET" action="" class="mb-6">
                <div class="flex gap-3">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Rechercher..."
                        class="flex-1 px-4 py-3 rounded-xl bg-white border border-black/10 focus:border-primary-500 outline-none focus:ring-2 focus:ring-primary-200 transition">
                    <button type="submit" class="px-4 py-1.5 text-sm rounded-full bg-slate-800 hover:bg-slate-900 text-white shadow-sm transition">Rechercher</button>
                </div>
            </form>

            @if ($prospects->isEmpty())
                <p class="text-slate-500">Aucun prospect trouvé.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-slate-100 text-slate-500 text-left">
                                <th class="pb-3 font-medium w-16">ID</th>
                                <th class="pb-3 font-medium">Prospect</th>
                                <th class="pb-3 font-medium">Contact</th>
                                <th class="pb-3 font-medium">Secteur</th>
                                <th class="pb-3 font-medium">Profil</th>
                                <th class="pb-3 font-medium">Date</th>
                                <th class="pb-3 font-medium"></th>
                            </tr>
                        </thead>
                        <tbody class="text-slate-700">
                            @foreach ($prospects as $p)
                                <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition">
                                    <td class="py-4 align-top">#{{ $p->id }}</td>
                                    <td class="py-4 align-top">
                                        <div class="font-medium text-slate-800">{{ $p->prenom }} {{ $p->nom }}</div>
                                        <div class="text-slate-400 mt-0.5">{{ $p->email }}</div>
                                    </td>
                                    <td class="py-4 align-top">
                                        <div class="text-slate-700">{{ $p->whatsapp }}</div>
                                        <div class="text-slate-400 mt-0.5">{{ $p->pays ?: '-' }}</div>
                                    </td>
                                    <td class="py-4 align-top"><span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-primary-50 text-primary-700 border border-primary-200">{{ $p->secteur }}</span></td>
                                    <td class="py-4 align-top">{{ $p->profil }}</td>
                                    <td class="py-4 align-top text-xs text-slate-400 whitespace-nowrap">{{ \Carbon\Carbon::parse($p->date_inscription)->format('d/m/Y H:i') }}</td>
                                    <td class="py-4 align-top">
                                        <div class="flex items-center gap-3">
                                            <a href="{{ route('admin.prospect', $p->id) }}" class="text-primary-600 hover:text-primary-700 font-medium transition">Voir</a>
                                            <form method="POST" action="{{ route('admin.prospects.destroy') }}" class="inline" onsubmit="return confirm('Voulez-vous vraiment supprimer ce prospect ? Cette action est irréversible.');">
                                                @csrf
                                                <input type="hidden" name="delete_id" value="{{ $p->id }}">
                                                <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-medium transition">Supprimer</button>
                                            </form>
                                        </div>
                                    </td>
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
