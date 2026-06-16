@extends('layouts.app')

@section('title', $session ? $session->titre : 'Session introuvable')

@section('content')

<section class="w-full h-[250px] overflow-hidden">
   <div class="max-w-4xl mx-auto md:-my-24 rounded-3xl overflow-hidden bg-red-500">
        <img src="{{ asset('visuel.jpeg') }}" alt="Webinaire visual" class="md:h-auto rounded-b-[80px]">
    </div>
</section>

<div class="mt-12 text-slate-900 min-h-screen my-gradient">
    <main class=" flex items-center justify-center px-6 border-red-500">
        <div class="w-full max-w-2xl">
            <div class="bg-white rounded-3xl border border-slate-200/60 p-8 md:p-10 shadow-[0_20px_80px_rgba(0,0,0,0.08)]">
                @if (!$session)
                    <div class="text-center">
                        <div class="w-16 h-16 rounded-full bg-red-50 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </div>
                        <h2 class="text-2xl font-bold text-slate-800">Session introuvable</h2>
                        <p class="text-slate-500 mt-2">Le lien que vous avez suivi n'est pas valide ou la session est fermée.</p>
                    </div>
                @elseif (session('success'))
                    <div class="text-center">
                        <div class="w-16 h-16 rounded-full bg-emerald-50 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <h2 class="text-2xl font-bold text-slate-800">Merci !</h2>
                        <p class="text-slate-600 mt-3">Votre avis a bien été enregistré pour <strong class="text-primary-600">{{ $session->titre }}</strong>.</p>
                    </div>
                @else
                    <div class="text-center mb-8">
                        <div class="inline-flex px-4 py-2 rounded-full border border-primary-300/50 bg-primary-50/50 text-xs tracking-[0.25em] uppercase text-primary-800 mb-4">
                            Avis Session
                        </div>
                        <h2 class="text-2xl font-bold text-slate-800">{{ $session->titre }}</h2>
                        <p class="text-slate-500 mt-2">Partagez votre retour d'expérience sur cette session.</p>
                    </div>

                    @if ($errors->any())
                        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-600">
                            @foreach ($errors->all() as $e)
                                {{ $e }}<br>
                            @endforeach
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-600">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="https://masterclass-data.com/avis" id="wizardForm" class="space-y-8">
                        @csrf
                        <input type="hidden" name="session_id" value="{{ $session->id }}">

                        <!-- STEP 1 -->
                        <div class="step space-y-5">
                            <div class="grid md:grid-cols-2 gap-5">
                                <div>
                                    <label class="text-base text-slate-800 font-medium">Votre nom *</label>
                                    <input type="text" name="nom" 
                                        class="mt-2 w-full px-4 py-3 rounded-xl bg-white border border-black/10 focus:border-primary-500 outline-none focus:ring-2 focus:ring-primary-200 transition"
                                        value="{{ old('nom') }}">
                                </div>
                                <div>
                                    <label class="text-base text-slate-800 font-medium">Votre (ou ves) prénom(s) *</label>
                                    <input type="text" name="prenom" 
                                        class="mt-2 w-full px-4 py-3 rounded-xl bg-white border border-black/10 focus:border-primary-500 outline-none focus:ring-2 focus:ring-primary-200 transition"
                                        value="{{ old('prenom') }}">
                                </div>
                            </div>

                            <div>
                                <label class="text-base text-slate-800 font-medium">Adresse email *</label>
                                <input  name="email" 
                                    class="mt-2 w-full px-4 py-3 rounded-xl bg-white border border-black/10 focus:border-primary-500 outline-none focus:ring-2 focus:ring-primary-200 transition"
                                    value="{{ old('email') }}">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-base text-slate-800 font-medium">Pays *</label>
                                    <select name="pays" id="paysSelect" 
                                        class="mt-2 w-full px-4 py-3 rounded-xl bg-white border border-black/10 focus:border-primary-500 outline-none focus:ring-2 focus:ring-primary-200 transition">
                                        <option value="" disabled {{ old('pays') ? '' : 'selected' }}>Choisissez votre pays</option>
                                        @foreach ($pays as $p)
                                            <option value="{{ $p['nom'] }}" data-indicatif="{{ $p['indicatif'] }}" {{ old('pays') === $p['nom'] ? 'selected' : '' }}>
                                                {{ $p['nom'] }} ({{ $p['indicatif'] }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="text-base text-slate-800 font-medium">Numero WhatsApp *</label>
                                    <div class="flex items-center mt-2">
                                        <div class="h-12.5 bg-gray-100 px-2 border border-black/10 border-r-0 flex items-center justify-center rounded-l-xl whatsapp_prefix"> +237 </div>
                                        <input type="hidden" name="whatsapp"  value="{{ old('whatsapp') }}" />
                                        <input type="tel" name="whatsapp_suffix" 
                                            placeholder=""
                                            class="w-full pl-2 pr-4 py-3 rounded-xl border-l-0 rounded-l-none bg-white border border-black/10 focus:border-primary-500 outline-none focus:ring-2 focus:ring-primary-200 transition">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- STEP 2 -->
                        <div class="step hidden space-y-4">
                            <p class="text-slate-800 font-medium text-lg text-center">Quel est votre secteur d'activite ?</p>
                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($secteurs as $label)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="secteur" value="{{ $label }}" class="hidden peer" {{ old('secteur') === $label ? 'checked' : '' }}>
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
                                        <input type="radio" name="profil" value="{{ $label }}" class="hidden peer" {{ old('profil') === $label ? 'checked' : '' }}>
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
                                        <input type="radio" name="niveau" value="{{ $label }}" class="hidden peer" {{ old('niveau') === $label ? 'checked' : '' }}>
                                        <div class="p-4 rounded-xl border border-black/10 bg-white text-center text-sm hover:shadow-md peer-checked:border-primary-500 peer-checked:bg-primary-50 transition">
                                            {{ $label }}
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                         <!-- STEP 5 -->
                        <div class="step hidden space-y-5">
                            <p class="text-slate-800 font-medium text-lg text-center"> Êtes-vous intéressé(e) par un accompagnement complet ? </p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                @foreach ($accompagnements as $label)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="accompagnement" value="{{ $label }}" class="hidden peer" {{ old('accompagnement') === $label ? 'checked' : '' }}>
                                        <div class="p-4 rounded-xl border border-black/10 bg-white text-center text-sm hover:shadow-md peer-checked:border-primary-500 peer-checked:bg-primary-50 transition">
                                            {{ $label }}
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- STEP 5 : Note & Commentaire -->
                        <div class="step hidden space-y-5">
                            <p class="text-slate-800 font-medium text-lg text-center">Votre avis sur la session</p>

                            <div class="text-center">
                                <label class="block text-sm text-slate-500 mb-3">Note <span class="text-red-500">*</span></label>
                                <div class="flex flex-row-reverse justify-center gap-2">
                                    @for ($i = 5; $i >= 1; $i--)
                                        <input type="radio" id="star{{ $i }}" name="note" value="{{ $i }}" {{ (int)(old('note') ?? 0) === $i ? 'checked' : '' }} class="hidden peer">
                                        <label for="star{{ $i }}" class="text-4xl text-slate-200 cursor-pointer hover:text-yellow-400 peer-checked:text-yellow-400 transition-colors">&#9733;</label>
                                    @endfor
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm text-slate-500 mb-2">Commentaire</label>
                                <textarea name="commentaire" rows="3" placeholder="Décrivez votre expérience..."
                                    class="w-full px-4 py-3 rounded-xl bg-white border border-black/10 focus:border-primary-500 outline-none focus:ring-2 focus:ring-primary-200 transition resize-none">{{ old('commentaire') }}</textarea>
                            </div>
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
                                Envoyer mon avis
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </main>
</div>

<!-- LOADER OVERLAY -->
<div id="submitLoader" class="fixed inset-0 z-50 bg-white/80 backdrop-blur-sm hidden items-center justify-center">
    <div class="text-center">
        <div class="w-12 h-12 border-4 border-primary-200 border-t-primary-600 rounded-full animate-spin mx-auto mb-4"></div>
        <p class="text-slate-600 font-medium">Envoi en cours...</p>
    </div>
</div>
@endsection

@push('styles')
<style>
    .step-indicator.active {
        background-color: #12985F;
        border-color: #12985F;
        color: white;
    }
</style>
@endpush

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

        const paysSelect = document.getElementById('paysSelect');
        const whatsappInput = document.querySelector('input[name="whatsapp"]');
        const whatsappSuffix = document.querySelector('input[name="whatsapp_suffix"]');
        const whatsappPrefix = document.querySelector('.whatsapp_prefix');

        function getIndicatif() {
            if (paysSelect && paysSelect.value) {
                const option = paysSelect.options[paysSelect.selectedIndex];
                return option.getAttribute('data-indicatif') || '';
            }
            return '';
        }

        function getAllIndicatifs() {
            const indicatifs = [];
            if (paysSelect) {
                for (let i = 0; i < paysSelect.options.length; i++) {
                    const ind = paysSelect.options[i].getAttribute('data-indicatif');
                    if (ind) indicatifs.push(ind);
                }
            }
            return indicatifs.sort((a, b) => b.length - a.length);
        }

        function extractSuffix(fullNumber) {
            let num = fullNumber;
            const indicatifs = getAllIndicatifs();
            let changed = true;
            while (changed && num) {
                changed = false;
                for (const ind of indicatifs) {
                    if (num.startsWith(ind)) {
                        num = num.slice(ind.length);
                        changed = true;
                        break;
                    }
                }
            }
            return num;
        }

        function updateWhatsapp() {
            const indicatif = getIndicatif();
            const suffix = whatsappSuffix.value.trim();
            whatsappInput.value = indicatif + suffix;
        }

        function updatePrefix() {
            const indicatif = getIndicatif();
            if (whatsappPrefix) {
                whatsappPrefix.textContent = indicatif || '+';
            }
        }

        function initFromServerValue() {
            updatePrefix();
            const suffix = extractSuffix(whatsappInput.value.trim());
            whatsappSuffix.value = suffix;
            updateWhatsapp();
        }

        if (paysSelect) {
            paysSelect.addEventListener('change', function() {
                updatePrefix();
                updateWhatsapp();
            });
            initFromServerValue();
        }

        if (whatsappSuffix) {
            whatsappSuffix.addEventListener('input', function() {
                updateWhatsapp();
            });
        }
    });
</script>
@endpush
