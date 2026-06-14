@extends('layouts.app')

@section('title', 'Admin - Prospect')

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
        <div class="bg-white rounded-2xl border border-slate-200/60 p-8 shadow-sm">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold text-slate-800">{{ $prospect->prenom }} {{ $prospect->nom }}</h2>
                <a href="{{ route('admin.dashboard') }}" class="px-5 py-2.5 rounded-full border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 text-sm font-medium transition">Retour</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                    <div class="text-xs text-slate-400 uppercase tracking-wider mb-1">Prénom</div>
                    <div class="font-semibold text-slate-800">{{ $prospect->prenom }}</div>
                </div>
                <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                    <div class="text-xs text-slate-400 uppercase tracking-wider mb-1">Nom</div>
                    <div class="font-semibold text-slate-800">{{ $prospect->nom }}</div>
                </div>
                <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                    <div class="text-xs text-slate-400 uppercase tracking-wider mb-1">Email</div>
                    <div class="font-semibold text-slate-800">{{ $prospect->email }}</div>
                </div>
                <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                    <div class="text-xs text-slate-400 uppercase tracking-wider mb-1">WhatsApp</div>
                    <div class="font-semibold text-slate-800">{{ $prospect->whatsapp }}</div>
                </div>
                <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                    <div class="text-xs text-slate-400 uppercase tracking-wider mb-1">Secteur</div>
                    <div class="font-semibold text-slate-800">{{ $prospect->secteur }}</div>
                </div>
                <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                    <div class="text-xs text-slate-400 uppercase tracking-wider mb-1">Profil</div>
                    <div class="font-semibold text-slate-800">{{ $prospect->profil }}</div>
                </div>
                <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                    <div class="text-xs text-slate-400 uppercase tracking-wider mb-1">Niveau</div>
                    <div class="font-semibold text-slate-800">{{ $prospect->niveau }}</div>
                </div>
                <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                    <div class="text-xs text-slate-400 uppercase tracking-wider mb-1">Inscrit le</div>
                    <div class="font-semibold text-slate-800">{{ \Carbon\Carbon::parse($prospect->date_inscription)->format('d/m/Y à H:i') }}</div>
                </div>
                <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                    <div class="text-xs text-slate-400 uppercase tracking-wider mb-1">Préférence</div>
                    <div class="font-semibold text-slate-800">{{ $prospect->preference }}</div>
                </div>
                <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                    <div class="text-xs text-slate-400 uppercase tracking-wider mb-1">Consentement</div>
                    <div class="font-semibold text-slate-800">{{ $prospect->consentement ? 'Oui' : 'Non' }}</div>
                </div>
            </div>
        </div>
    </main>
</body>
@endsection
