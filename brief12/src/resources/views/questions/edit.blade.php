@extends('layouts.app')

@section('title', 'Modifier la question')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow sm:rounded-lg overflow-hidden">
        <div class="px-4 py-5 sm:px-6 bg-indigo-50">
            <h3 class="text-lg leading-6 font-medium text-indigo-900">
                Modifier votre question
            </h3>
        </div>
        <div class="px-4 py-5 sm:p-6">
            <form action="{{ route('questions.update', $question) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Titre -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700">Titre</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input type="text" name="title" id="title" required
                            class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-3 pr-12 sm:text-sm border-gray-300 rounded-md py-2"
                            value="{{ old('title', $question->title) }}">
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
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-3">{{ old('content', $question->content) }}</textarea>
                    </div>
                    @error('content')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Location -->
                <div class="mb-6">
                    <label for="location" class="block text-sm font-medium text-gray-700">Localisation</label>
                    <input type="text" name="location" id="location"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md py-2 px-3"
                        value="{{ old('location', $question->location) }}">
                </div>

                <!-- Actions -->
                <div class="flex justify-end pt-4">
                    <a href="{{ route('questions.show', $question) }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-3">
                        Annuler
                    </a>
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
