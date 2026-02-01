@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<div class="max-w-md mx-auto px-4">
    <div class="bg-white rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Connexion</h2>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                    Email
                </label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">
                    Mot de passe
                </label>
                <input type="password" name="password" id="password" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="form-checkbox h-4 w-4 text-indigo-600">
                    <span class="ml-2 text-sm text-gray-700">Se souvenir de moi</span>
                </label>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                    Se connecter
                </button>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">
                    Pas encore inscrit ? Créer un compte
                </a>
            </div>
        </form>
    </div>

   
</div>
@endsection