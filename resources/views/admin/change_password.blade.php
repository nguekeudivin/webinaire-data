@extends('layouts.app')

@section('title', 'Modifier le mot de passe')

@section('content')
<body class="bg-[#f6f7fb] text-slate-900 min-h-screen">
    <header class="bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <strong class="text-lg text-slate-800">Webinaire Admin</strong>
            <nav class="flex gap-6 text-sm">
                <a href="{{ route('admin.dashboard') }}" class="text-slate-500 hover:text-primary-600 transition">Prospects</a>
                <a href="{{ route('admin.sessions') }}" class="text-slate-500 hover:text-primary-600 transition">Sessions</a>
                <a href="{{ route('admin.avis') }}" class="text-slate-500 hover:text-primary-600 transition">Avis</a>
                <a href="{{ route('admin.admins') }}" class="text-slate-500 hover:text-primary-600 transition">Admins</a>
                <a href="{{ route('admin.logout') }}" class="text-slate-500 hover:text-red-500 transition">Déconnexion</a>
            </nav>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-10">
        <div class="bg-white rounded-2xl border border-slate-200/60 p-8 shadow-sm max-w-lg mx-auto">
            <h2 class="text-xl font-bold text-slate-800 mb-6">Modifier mon mot de passe</h2>

            @if (session('status'))
                <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-600">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-600">
                    @foreach ($errors->all() as $e)
                        {{ $e }}<br>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm text-slate-500 mb-2">Mot de passe actuel</label>
                    <input type="password" name="current_password" required
                        class="w-full px-4 py-3 rounded-xl bg-white border border-black/10 focus:border-primary-500 outline-none focus:ring-2 focus:ring-primary-200 transition">
                </div>
                <div>
                    <label class="block text-sm text-slate-500 mb-2">Nouveau mot de passe</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 rounded-xl bg-white border border-black/10 focus:border-primary-500 outline-none focus:ring-2 focus:ring-primary-200 transition">
                </div>
                <div>
                    <label class="block text-sm text-slate-500 mb-2">Confirmer le nouveau mot de passe</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full px-4 py-3 rounded-xl bg-white border border-black/10 focus:border-primary-500 outline-none focus:ring-2 focus:ring-primary-200 transition">
                </div>
                <button type="submit" class="px-6 py-3 rounded-full bg-primary-600 hover:bg-primary-700 text-white font-medium shadow-sm transition">
                    Mettre à jour
                </button>
            </form>
        </div>
    </main>
</body>
@endsection
