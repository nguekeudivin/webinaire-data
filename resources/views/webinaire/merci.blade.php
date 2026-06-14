@extends('layouts.app')

@section('title', 'Inscription confirmée')

@push('styles')
<style>
body {
    background: #f6f7fb;
}
.grid-bg {
    background-image:
        linear-gradient(rgba(0,0,0,.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0,0,0,.04) 1px, transparent 1px);
    background-size: 80px 80px;
}
</style>
@endpush

@section('content')
<!-- Background grid -->
<div class="fixed inset-0 grid-bg"></div>

<!-- Soft blobs -->
<div class="fixed top-[-250px] left-[-150px] w-[700px] h-[700px] rounded-full bg-primary-600/30 blur-[180px]"></div>
<div class="fixed bottom-[-250px] right-[-150px] w-[700px] h-[700px] rounded-full bg-secondary-600/20 blur-[180px]"></div>

<!-- Content -->
<main class="relative z-10 min-h-screen flex items-center justify-center px-6 py-12">
    <section class="w-full max-w-3xl rounded-[40px] border border-slate-200/60 bg-white/60 backdrop-blur-2xl p-8 md:p-14 shadow-[0_20px_80px_rgba(0,0,0,0.08)]">
        <!-- Badge -->
        <div class="flex justify-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-slate-200 bg-white/70 text-xs uppercase tracking-[0.25em] text-slate-600">
                Webinaire confirmé
            </div>
        </div>

        <!-- Success -->
        <div class="relative flex justify-center mt-10">
            <div class="absolute w-32 h-32 rounded-full bg-emerald-400/20 blur-3xl"></div>
            <div class="relative w-20 h-20 rounded-full border border-emerald-400/30 bg-emerald-100/40 flex items-center justify-center">
                <svg class="w-10 h-10 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
        </div>

        <!-- Title -->
        <h1 class="mt-10 text-center text-3xl md:text-4xl font-semibold tracking-tight bg-gradient-to-b from-slate-900 to-slate-500 bg-clip-text text-transparent">
            Votre place est réservée
        </h1>

        <!-- Subtitle -->
        <p class="mt-8 text-center text-xl text-slate-700">
            Master of Data - De la donnée à la décision
        </p>
        <p class="mt-3 text-center text-slate-500">
            Samedi 28 Juin 2025 · 20h00 GMT
        </p>

        <!-- Divider -->
        <div class="my-12 h-px bg-gradient-to-r from-transparent via-slate-300 to-transparent"></div>

        <!-- Description -->
        <p class="max-w-xl mx-auto text-center leading-relaxed text-slate-600">
            Merci pour votre inscription.
            Nous vous enverrons les informations de connexion
            ainsi qu'un rappel avant le début du webinaire.
        </p>

        <!-- CTA -->
        <div class="mt-12 flex justify-center">
            <a href="#" class="group relative inline-flex items-center justify-center px-8 py-4 rounded-2xl bg-primary-600 overflow-hidden font-medium text-white">
                <span class="relative">Ajouter à mon agenda</span>
            </a>
        </div>

        <!-- Footer -->
        <p class="mt-8 text-center text-sm text-slate-500">
            Un email de confirmation a été envoyé à votre adresse.
        </p>
    </section>
</main>
@endsection
