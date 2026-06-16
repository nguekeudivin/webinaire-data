@extends('layouts.app')

@section('title', 'Admin - Sessions')

@section('content')
<body class="bg-[#f6f7fb] text-slate-900 min-h-screen">
    <header class="bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <strong class="text-lg text-slate-800">Webinaire Admin</strong>
            <nav class="flex gap-6 text-sm">
                <a href="{{ route('admin.dashboard') }}" class="text-slate-500 hover:text-primary-600 transition">Prospects</a>
                <a href="{{ route('admin.sessions') }}" class="text-primary-600 font-medium">Sessions</a>
                <a href="{{ route('admin.avis') }}" class="text-slate-500 hover:text-primary-600 transition">Avis</a>
                <a href="{{ route('admin.admins') }}" class="text-slate-500 hover:text-primary-600 transition">Admins</a>
                <a href="{{ route('admin.password.change') }}" class="text-slate-500 hover:text-primary-600 transition">Mon compte</a>
                <a href="{{ route('admin.logout') }}" class="text-slate-500 hover:text-red-500 transition">Déconnexion</a>
            </nav>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-10">
        <div class="bg-white rounded-2xl border border-slate-200/60 p-8 shadow-sm">
            <h2 class="text-xl font-bold text-slate-800 mb-6">Nouvelle session</h2>
            <form method="POST" action="" class="grid grid-cols-1 md:grid-cols-3 gap-5">
                @csrf
                <div>
                    <label class="block text-sm text-slate-500 mb-2">Titre</label>
                    <input type="text" name="titre" required placeholder="ex: Masterclass Data"
                        class="w-full px-4 py-3 rounded-xl bg-white border border-black/10 focus:border-primary-500 outline-none focus:ring-2 focus:ring-primary-200 transition">
                </div>
                <div>
                    <label class="block text-sm text-slate-500 mb-2">Date</label>
                    <input type="date" name="date_session" required
                        class="w-full px-4 py-3 rounded-xl bg-white border border-black/10 focus:border-primary-500 outline-none focus:ring-2 focus:ring-primary-200 transition">
                </div>
                <div>
                    <label class="block text-sm text-slate-500 mb-2">Statut</label>
                    <select name="statut"
                        class="w-full px-4 py-3 rounded-xl bg-white border border-black/10 focus:border-primary-500 outline-none focus:ring-2 focus:ring-primary-200 transition">
                        <option value="ouverte">Ouverte</option>
                        <option value="fermee">Fermée</option>
                    </select>
                </div>
                <div class="md:col-span-3">
                    <label class="block text-sm text-slate-500 mb-2">Description</label>
                    <textarea name="description" rows="2" placeholder="Description de la session..."
                        class="w-full px-4 py-3 rounded-xl bg-white border border-black/10 focus:border-primary-500 outline-none focus:ring-2 focus:ring-primary-200 transition"></textarea>
                </div>
                <div>
                    <button type="submit" class="text-sm px-4 py-2 rounded-full bg-primary-600 hover:bg-primary-700 text-white font-medium shadow-sm transition">
                        Créer la session
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200/60 p-8 shadow-sm mt-8">
            <h2 class="text-xl font-bold text-slate-800 mb-6">Sessions</h2>
            @if ($sessions->isEmpty())
                <p class="text-slate-500">Aucune session créée.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-slate-100 text-slate-500 text-left">
                                <th class="pb-3 font-medium">ID</th>
                                <th class="pb-3 font-medium">Titre</th>
                                <th class="pb-3 font-medium">Date</th>
                                <th class="pb-3 font-medium">Statut</th>
                                <th class="pb-3 font-medium">Lien avis</th>
                                <th class="pb-3 font-medium"></th>
                            </tr>
                        </thead>
                        <tbody class="text-slate-700">
                            @foreach ($sessions as $s)
                                @php $link = route('avis.show', ['sessionId' => $s->id]); @endphp
                                <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition">
                                    <td class="py-4">#{{ $s->id }}</td>
                                    <td class="py-4 font-medium">{{ $s->titre }}</td>
                                    <td class="py-4">{{ \Carbon\Carbon::parse($s->date_session)->format('d/m/Y') }}</td>
                                    <td class="py-4">
                                        <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium {{ $s->statut === 'ouverte' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-slate-100 text-slate-600 border border-slate-200' }}">
                                            {{ $s->statut === 'ouverte' ? 'Ouverte' : 'Fermée' }}
                                        </span>
                                    </td>
                                    <td class="py-4">
                                        <div class="flex items-center gap-2">
                                            <span class="inline-block w-72 px-3 py-2 rounded-lg border border-slate-200 text-xs text-slate-600 bg-slate-50 font-mono truncate">
                                                {{ $link }}
                                            </span>
                                            <button type="button" onclick="copyLink(this)"
                                                class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg bg-primary-50 text-primary-700 text-xs font-medium hover:bg-primary-100 border border-primary-200 transition">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                                Copier
                                            </button>
                                        </div>
                                    </td>
                                    <td class="py-4">
                                        <form method="POST" action="{{ route('admin.sessions.destroy') }}" class="inline" onsubmit="return confirm('Supprimer cette session ?')">
                                            @csrf
                                            <input type="hidden" name="delete_id" value="{{ $s->id }}">
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
    </main>
<script>
function copyLink(btn) {
    const url = btn.previousElementSibling.textContent.trim();
    navigator.clipboard.writeText(url).then(() => {
        const original = btn.innerHTML;
        btn.innerHTML = '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Copié !';
        btn.classList.replace('bg-primary-50', 'bg-emerald-50');
        btn.classList.replace('text-primary-700', 'text-emerald-700');
        btn.classList.replace('border-primary-200', 'border-emerald-200');
        setTimeout(() => {
            btn.innerHTML = original;
            btn.classList.replace('bg-emerald-50', 'bg-primary-50');
            btn.classList.replace('text-emerald-700', 'text-primary-700');
            btn.classList.replace('border-emerald-200', 'border-primary-200');
        }, 1500);
    });
}
</script>
</body>
@endsection
