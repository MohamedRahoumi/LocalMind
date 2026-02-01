@extends('layouts.app')

@section('title', 'Poser une question')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow sm:rounded-lg overflow-hidden">
        <div class="px-4 py-5 sm:px-6 bg-indigo-50">
            <h3 class="text-lg leading-6 font-medium text-indigo-900">
                Poser une nouvelle question
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-indigo-700">
                Partagez vos interrogations avec la communauté locale.
            </p>
        </div>
        <div class="px-4 py-5 sm:p-6">
            <form action="{{ route('questions.store') }}" method="POST">
                @csrf

                <!-- Titre -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700">Titre de votre question</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input type="text" name="title" id="title" required
                            class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-3 pr-12 sm:text-sm border-gray-300 rounded-md py-2"
                            placeholder="Ex: Où trouver le meilleur café à..." value="{{ old('title') }}">
                    </div>
                    @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Contenu -->
                <div class="mb-6">
                    <label for="content" class="block text-sm font-medium text-gray-700">Détails</label>
                    <div class="mt-1">
                        <textarea id="content" name="content" rows="5" required
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-3"
                            placeholder="Décrivez votre question en détail...">{{ old('content') }}</textarea>
                    </div>
                    @error('content')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Location (Simple Text for now, could be Google Maps or similar later) -->
                <div class="mb-6">
                    <label for="location" class="block text-sm font-medium text-gray-700">Localisation (Optionnel)</label>
                    <input type="text" name="location" id="location"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md py-2 px-3"
                        placeholder="Ex: Centre-ville, Quartier Nord..." value="{{ old('location') }}">
                </div>

                <!-- Hidden Latitude/Longitude fields (Mocking mechanism for now) -->
                <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', '0') }}">
                <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', '0') }}">

                <!-- Actions -->
                <div class="flex justify-end pt-4">
                    <a href="{{ route('questions.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-3">
                        Annuler
                    </a>
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Publier ma question
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Simple script to get browser location if possible
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(function(position) {
            document.getElementById('latitude').value = position.coords.latitude;
            document.getElementById('longitude').value = position.coords.longitude;
        });
    }
</script>
@endsection
