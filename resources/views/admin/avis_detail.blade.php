@extends('layouts.app')

@section('title', 'Admin - Détails Avis')

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
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold text-slate-800">{{ $avis->prenom }} {{ $avis->nom }}</h2>
                <a href="{{ route('admin.avis') }}" class="px-5 py-2.5 rounded-full border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 text-sm font-medium transition">Retour</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                    <div class="text-xs text-slate-400 uppercase tracking-wider mb-1">Prénom</div>
                    <div class="font-semibold text-slate-800">{{ $avis->prenom ?: '-' }}</div>
                </div>
                <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                    <div class="text-xs text-slate-400 uppercase tracking-wider mb-1">Nom</div>
                    <div class="font-semibold text-slate-800">{{ $avis->nom }}</div>
                </div>
                <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                    <div class="text-xs text-slate-400 uppercase tracking-wider mb-1">Email</div>
                    <div class="font-semibold text-slate-800">{{ $avis->email }}</div>
                </div>
                <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                    <div class="text-xs text-slate-400 uppercase tracking-wider mb-1">WhatsApp</div>
                    <div class="font-semibold text-slate-800">{{ $avis->whatsapp ?: '-' }}</div>
                </div>
                <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                    <div class="text-xs text-slate-400 uppercase tracking-wider mb-1">Pays</div>
                    <div class="font-semibold text-slate-800">{{ $avis->pays ?: '-' }}</div>
                </div>
                <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                    <div class="text-xs text-slate-400 uppercase tracking-wider mb-1">Session</div>
                    <div class="font-semibold text-slate-800">{{ $avis->session->titre ?? '-' }}</div>
                </div>
                <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                    <div class="text-xs text-slate-400 uppercase tracking-wider mb-1">Secteur</div>
                    <div class="font-semibold text-slate-800">{{ $avis->secteur ?: '-' }}</div>
                </div>
                <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                    <div class="text-xs text-slate-400 uppercase tracking-wider mb-1">Profil</div>
                    <div class="font-semibold text-slate-800">{{ $avis->profil ?: '-' }}</div>
                </div>
                <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                    <div class="text-xs text-slate-400 uppercase tracking-wider mb-1">Niveau</div>
                    <div class="font-semibold text-slate-800">{{ $avis->niveau ?: '-' }}</div>
                </div>
                <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                    <div class="text-xs text-slate-400 uppercase tracking-wider mb-1">Accompagnement</div>
                    <div class="font-semibold text-slate-800">{{ $avis->accompagnement ?: '-' }}</div>
                </div>
                <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                    <div class="text-xs text-slate-400 uppercase tracking-wider mb-1">Note</div>
                    <div class="font-semibold text-yellow-400 text-lg">
                        {!! str_repeat('&#9733;', $avis->note) . str_repeat('&#9734;', 5 - $avis->note) !!}
                    </div>
                </div>
                <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                    <div class="text-xs text-slate-400 uppercase tracking-wider mb-1">Date</div>
                    <div class="font-semibold text-slate-800">{{ \Carbon\Carbon::parse($avis->date_avis)->format('d/m/Y à H:i') }}</div>
                </div>
            </div>

            <div class="mt-6 bg-slate-50 rounded-xl p-5 border border-slate-100">
                <div class="text-xs text-slate-400 uppercase tracking-wider mb-1">Commentaire</div>
                <div class="font-semibold text-slate-800">{{ $avis->commentaire ?: 'Aucun commentaire' }}</div>
            </div>
        </div>
    </main>
</body>
@endsection
