@extends('layouts.app')

@section('title', 'Admin - Administrateurs')

@section('content')
<body class="bg-[#f6f7fb] text-slate-900 min-h-screen">
    <header class="bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <strong class="text-lg text-slate-800">Webinaire Admin</strong>
            <nav class="flex gap-6 text-sm">
                <a href="{{ route('admin.dashboard') }}" class="text-slate-500 hover:text-primary-600 transition">Prospects</a>
                <a href="{{ route('admin.sessions') }}" class="text-slate-500 hover:text-primary-600 transition">Sessions</a>
                <a href="{{ route('admin.avis') }}" class="text-slate-500 hover:text-primary-600 transition">Avis</a>
                <a href="{{ route('admin.admins') }}" class="text-primary-600 font-medium">Admins</a>
                <a href="{{ route('admin.logout') }}" class="text-slate-500 hover:text-red-500 transition">Déconnexion</a>
            </nav>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Create form -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl border border-slate-200/60 p-8 shadow-sm">
                    <h2 class="text-lg font-bold text-slate-800 mb-6">Nouvel administrateur</h2>

                    @if (session('status'))
                        <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-600">{{ session('status') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="mb-4 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-600">{{ session('error') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="mb-4 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-600">
                            @foreach ($errors->all() as $e)
                                {{ $e }}<br>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="" class="space-y-5">
                        @csrf
                        <div>
                            <label class="block text-sm text-slate-500 mb-2">Adresse email (nom d'utilisateur)</label>
                            <input type="email" name="email" required placeholder="admin@exemple.com"
                                value="{{ old('email') }}"
                                class="w-full px-4 py-3 rounded-xl bg-white border border-black/10 focus:border-primary-500 outline-none focus:ring-2 focus:ring-primary-200 transition @error('email') border-red-400 @enderror">
                        </div>
                        <div>
                            <label class="block text-sm text-slate-500 mb-2">Mot de passe</label>
                            <input type="password" name="password" required
                                class="w-full px-4 py-3 rounded-xl bg-white border border-black/10 focus:border-primary-500 outline-none focus:ring-2 focus:ring-primary-200 transition">
                        </div>
                        <label class="flex items-center gap-3 text-slate-700">
                            <input type="checkbox" name="receive_notification" value="1" class="accent-primary-600 w-5 h-5" {{ old('receive_notification') ? 'checked' : '' }}>
                            Recevoir les notifications d'inscription
                        </label>
                        <button type="submit" class="w-full px-4 py-2.5 rounded-full bg-primary-600 hover:bg-primary-700 text-white font-medium shadow-sm transition">
                            Créer
                        </button>
                    </form>
                </div>
            </div>

            <!-- List -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl border border-slate-200/60 p-8 shadow-sm">
                    <h2 class="text-lg font-bold text-slate-800 mb-6">Administrateurs</h2>

                    @if ($admins->isEmpty())
                        <p class="text-slate-500">Aucun administrateur.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="border-b border-slate-100 text-slate-500 text-left">
                                        <th class="pb-3 font-medium">ID</th>
                                        <th class="pb-3 font-medium">Email</th>
                                        <th class="pb-3 font-medium">Notifications</th>
                                        <th class="pb-3 font-medium"></th>
                                    </tr>
                                </thead>
                                <tbody class="text-slate-700">
                                    @foreach ($admins as $a)
                                        <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition">
                                            <td class="py-4">#{{ $a->id }}</td>
                                            <td class="py-4">{{ $a->email }}</td>
                                            <td class="py-4">
                                                @if ($a->receive_notification)
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">Activé</span>
                                                @else
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-slate-50 text-slate-600 border border-slate-200">Désactivé</span>
                                                @endif
                                            </td>
                                            <td class="py-4 text-right">
                                                <form method="POST" action="{{ route('admin.admins.destroy') }}" class="inline" onsubmit="return confirm('Supprimer cet administrateur ?')">
                                                    @csrf
                                                    <input type="hidden" name="delete_id" value="{{ $a->id }}">
                                                    <button type="submit" class="text-red-500 hover:text-red-600 text-sm font-medium transition cursor-pointer">Supprimer</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
</body>
@endsection
