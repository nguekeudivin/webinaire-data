@extends('layouts.app')

@section('title', 'Webinaire - Inscrivez-vous')

@section('content')
<section class="w-full">
    <div class="my-gradient pb-8 rounded-b-4xl">
        <div class="max-w-5xl mx-auto md:-my-24">
            <img src="{{ asset('visuel.jpeg') }}" alt="Webinaire visual" class="md:h-auto rounded-b-[80px]">
        </div>
    </div>
</section>

<section class="relative mt-4 md:mt-32 mb-28 px-2 md:px-6 text-slate-900">
    <div class="absolute top-[-180px] w-[50px] h-[50px] md:w-[420px] md:h-[420px] bg-primary/20 blur-[120px] rounded-full pointer-events-none"></div>
    <div class="absolute bottom-[-200px] right-0 w-[50px] h-[50px] md:w-[420px] md:h-[420px] bg-secondary/20 blur-[120px] rounded-full pointer-events-none"></div>

    <div class="text-center mb-10 max-w-3xl mx-auto">
        <div class="inline-flex px-4 py-2 rounded-full border border-primary-300/50 bg-primary-50/50 text-xs tracking-[0.25em] uppercase text-primary-800">
            Inscription Webinaire
        </div>

        <h2 class="mt-6 text-3xl md:text-4xl font-bold text-secondary-800">
            Réservez votre place maintenant
        </h2>

        <p class="mt-3 text-slate-600 text-lg">
            Decouvrez comment expoitez pleinement le potentiel de vos données grâce à meilleures outils d'analyse de donnees.
        </p>
    </div>

    <div class="relative z-10 max-w-3xl bg-white rounded-4xl shadow-xl p-4 md:p-12 mx-auto">
        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-600">
                @foreach ($errors->all() as $e)
                    {{ $e }}<br>
                @endforeach
            </div>
        @endif

        <form method="POST" id="wizardForm" class="space-y-8">
            @csrf

            <!-- STEP 1 -->
            <div class="step space-y-5">
                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="text-base text-slate-800 font-medium">Votre nom *</label>
                        <input type="text" name="nom" required
                            class="mt-2 w-full px-4 py-3 rounded-xl bg-white border border-black/10 focus:border-primary-500 outline-none focus:ring-2 focus:ring-primary-200 transition"
                            value="{{ old('nom', $old['nom'] ?? '') }}">
                    </div>
                    <div>
                        <label class="text-base text-slate-800 font-medium">Votre (ou ves) prénom(s) *</label>
                        <input type="text" name="prenom" required
                            class="mt-2 w-full px-4 py-3 rounded-xl bg-white border border-black/10 focus:border-primary-500 outline-none focus:ring-2 focus:ring-primary-200 transition"
                            value="{{ old('prenom', $old['prenom'] ?? '') }}">
                    </div>
                </div>

                <div>
                    <label class="text-base text-slate-800 font-medium">Adresse email *</label>
                    <input type="email" name="email" required
                        class="mt-2 w-full px-4 py-3 rounded-xl bg-white border border-black/10 focus:border-primary-500 outline-none focus:ring-2 focus:ring-primary-200 transition"
                        value="{{ old('email', $old['email'] ?? '') }}">
                </div>

                <div>
                    <label class="text-base text-slate-800 font-medium">Numero WhatsApp *</label>
                    <input type="tel" name="whatsapp" required
                        placeholder="+2250102030405"
                        class="mt-2 w-full px-4 py-3 rounded-xl bg-white border border-black/10 focus:border-primary-500 outline-none focus:ring-2 focus:ring-primary-200 transition"
                        value="{{ old('whatsapp', $old['whatsapp'] ?? '') }}">
                </div>
            </div>

            <!-- STEP 2 -->
            <div class="step hidden space-y-4">
                <p class="text-slate-800 font-medium text-lg text-center">Quel est votre secteur d'activite ?</p>
                <div class="grid grid-cols-2 gap-3">
                    @foreach ($secteurs as $label)
                        <label class="cursor-pointer">
                            <input type="radio" name="secteur" value="{{ $label }}" class="hidden peer" {{ (old('secteur', $old['secteur'] ?? '') === $label) ? 'checked' : '' }}>
                            <div class="flex items-center justify-center p-4 rounded-xl border border-black/10 bg-white text-center text-sm hover:shadow-md peer-checked:border-primary-500 peer-checked:bg-primary-50 transition">
                                {{ $label }}
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- STEP 3 -->
            <div class="step hidden space-y-4">
                <p class="text-slate-800 font-medium text-lg text-center">Quel est votre profil professionnel</p>
                <div class="grid grid-cols-2 gap-3">
                    @foreach ($profils as $label)
                        <label class="cursor-pointer">
                            <input type="radio" name="profil" value="{{ $label }}" class="hidden peer" {{ (old('profil', $old['profil'] ?? '') === $label) ? 'checked' : '' }}>
                            <div class="h-[100px] md:h-auto flex items-center justify-center p-4 rounded-xl border border-black/10 bg-white text-center text-sm hover:shadow-md peer-checked:border-secondary-500 peer-checked:bg-secondary-50 transition">
                                {{ $label }}
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- STEP 4 -->
            <div class="step hidden space-y-5">
                <p class="text-slate-800 font-medium text-lg text-center">Ton niveau actuel en analyse de données (sur excel, power bi ou autre) ? (choix unique)</p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    @foreach ($niveaux as $label)
                        <label class="cursor-pointer">
                            <input type="radio" name="niveau" value="{{ $label }}" class="hidden peer" {{ (old('niveau', $old['niveau'] ?? '') === $label) ? 'checked' : '' }}>
                            <div class="p-4 rounded-xl border border-black/10 bg-white text-center text-sm hover:shadow-md peer-checked:border-primary-500 peer-checked:bg-primary-50 transition">
                                {{ $label }}
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

             <!-- STEP 5 -->
            <div class="step hidden space-y-5">
                <p class="text-slate-800 font-medium text-lg text-center"> Pour une formation plus complète que préférez vous ? </p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    @foreach ($preferences as $label)
                        <label class="cursor-pointer">
                            <input type="radio" name="preference" value="{{ $label }}" class="hidden peer" {{ (old('preference', $old['preference'] ?? '') === $label) ? 'checked' : '' }}>
                            <div class="p-4 rounded-xl border border-black/10 bg-white text-center text-sm hover:shadow-md peer-checked:border-primary-500 peer-checked:bg-primary-50 transition">
                                {{ $label }}
                            </div>
                        </label>
                    @endforeach
                </div>

                <label class="flex gap-3 text-slate-700 mt-12 bg-green-50 p-4">
                    <input type="checkbox" name="consentement" value="1" required class="accent-primary-600 mt-1 w-8 h-8" {{ old('consentement', $old['consentement'] ?? false) ? 'checked' : '' }}>
                    J'accepte de recevoir les ressources gratuites, les invitations aux webinaires et autres infos exclusives par email ou WhatsApp.
                </label>
            </div>

            <!-- NAVIGATION -->
            <div class="flex justify-between pt-6">
                <button type="button" id="btnPrev"
                    class="text-lg px-6 py-3 rounded-full border border-black/10 bg-white text-sm text-slate-600 hover:bg-slate-50 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                    Précédent
                </button>

                <button type="button" id="btnNext"
                    class="text-lg px-6 py-3 rounded-full bg-primary-600 hover:bg-primary-700 text-white text-lg font-medium shadow-sm transition flex items-center gap-2">
                    Suivant
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                </button>

                <button type="submit" id="btnSubmit"
                    class="hidden px-6 py-3 rounded-full bg-secondary-600 hover:bg-secondary-700 text-white text-lg font-medium shadow-sm transition flex items-center gap-2">
                    S'inscrire
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </button>
            </div>
        </form>
    </div>
</section>

<!-- LOADER OVERLAY -->
<div id="submitLoader" class="fixed inset-0 z-50 bg-white/80 backdrop-blur-sm hidden items-center justify-center">
    <div class="text-center">
        <div class="w-12 h-12 border-4 border-primary-200 border-t-primary-600 rounded-full animate-spin mx-auto mb-4"></div>
        <p class="text-slate-600 font-medium">Envoi en cours...</p>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if ($errors->any())
            document.getElementById('wizardForm').scrollIntoView({ behavior: 'smooth', block: 'start' });
        @endif

        document.getElementById('wizardForm').addEventListener('submit', function(e) {
            const btnSubmit = document.getElementById('btnSubmit');
            if (!btnSubmit.classList.contains('hidden')) {
                document.getElementById('submitLoader').classList.remove('hidden');
                document.getElementById('submitLoader').classList.add('flex');
            }
        });
    });
</script>
@endpush

@push('styles')
<style>
.my-gradient {
    width: 100%;
    background:
        linear-gradient(
            to bottom,
            rgba(255, 255, 255, 0) 0%,
            rgba(255, 255, 255, 0.85) 80%,
            rgba(255, 255, 255, 1) 100%
        ),
        linear-gradient(to right, #cef7f0 30%, #d4efd1 100%);
}
</style>
@endpush
