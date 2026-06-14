@extends('layouts.app')

@section('title', 'Espace Admin')

@section('content')
<body class=" ">

    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-50 to-gray-100"> 
        <div class="w-full max-w-sm bg-white rounded-2xl shadow-xl p-8 space-y-6">
            <h1 class="text-2xl font-bold text-gray-800 text-center">Espace Admin</h1>
            @if (!empty($error))
                <div class="bg-red-50 text-red-700 px-4 py-3 rounded-lg text-sm">{{ $error }}</div>
            @endif
            <form method="POST" action="" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Adresse email</label>
                    <input type="email" name="email" required autofocus class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                    <input type="password" name="password" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>
                <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-medium py-2.5 rounded-lg transition-colors cursor-pointer">Se connecter</button>
            </form>

            <p class="text-center text-sm text-gray-500">
                <a href="{{ route('admin.password.forgot') }}" class="text-primary-600 hover:text-primary-700">Mot de passe oublié ?</a>
            </p>
        </div>
    </div>
    
</body>
@endsection
