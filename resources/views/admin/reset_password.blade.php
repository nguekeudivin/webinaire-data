@extends('layouts.app')

@section('title', 'Réinitialiser le mot de passe')

@section('content')
<body class="bg-gradient-to-br from-gray-50 to-gray-100">
    <div class="min-h-screen flex items-center justify-center "> 
        <div class="w-full max-w-sm bg-white rounded-2xl shadow-xl p-8 space-y-6">
            <h1 class="text-2xl font-bold text-gray-800 text-center">Nouveau mot de passe</h1>

            @if (session('error'))
                <div class="bg-red-50 text-red-700 px-4 py-3 rounded-lg text-sm">{{ session('error') }}</div>
            @endif

            @if ($errors->any())
                <div class="bg-red-50 text-red-700 px-4 py-3 rounded-lg text-sm">
                    @foreach ($errors->all() as $e)
                        {{ $e }}<br>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="" class="space-y-4">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nouveau mot de passe</label>
                    <input type="password" name="password" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>
                <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-medium py-2.5 rounded-lg transition-colors cursor-pointer">Réinitialiser</button>
            </form>
        </div>
    </div>
</body>
@endsection
