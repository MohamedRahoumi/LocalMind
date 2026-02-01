@extends('layouts.app')

@section('title', 'Mon profil')

@section('content')
<div class="max-w-3xl mx-auto px-4">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Mon profil</h1>

    <div class="bg-white rounded-lg shadow-md p-8">
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">
                    Nom complet
                </label>
                <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                    Email
                </label>
                <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="location" class="block text-gray-700 text-sm font-bold mb-2">
                    Localisation
                </label>
                <input type="text" name="location" id="location" value="{{ old('location', Auth::user()->location) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
            </div>

            <input type="hidden" name="latitude" value="{{ Auth::user()->latitude }}">
            <input type="hidden" name="longitude" value="{{ Auth::user()->longitude }}">

            <hr class="my-6">

            <h3 class="text-lg font-semibold mb-4">Changer le mot de passe</h3>

            <div class="mb-4">
                <label for="current_password" class="block text-gray-700 text-sm font-bold mb-2">
                    Mot de passe actuel
                </label>
                <input type="password" name="current_password" id="current_password"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 @error('current_password') border-red-500 @enderror">
                @error('current_password')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="new_password" class="block text-gray-700 text-sm font-bold mb-2">
                    Nouveau mot de passe
                </label>
                <input type="password" name="new_password" id="new_password"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 @error('new_password') border-red-500 @enderror">
                @error('new_password')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="new_password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">
                    Confirmer le nouveau mot de passe
                </label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded">
                    Mettre à jour le profil
                </button>
                <a href="{{ route('questions.index') }}" class="text-gray-600 hover:text-gray-800">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection