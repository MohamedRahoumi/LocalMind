@extends('layouts.app')

@section('title', 'Mes questions favorites')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Mes Questions Favorites</h1>
        <a href="{{ route('questions.index') }}" class="text-indigo-600 hover:text-indigo-800">
            <i class="fas fa-arrow-left mr-2"></i> Retour aux questions
        </a>
    </div>

    <!-- Favorites List -->
    <div class="space-y-6">
        @forelse($favorites as $favorite)
            <div class="bg-white shadow overflow-hidden sm:rounded-lg hover:shadow-md transition">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center flex-1">
                            <div class="shrink-0">
                                <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-yellow-100 text-yellow-600 font-bold">
                                    {{ strtoupper(substr($favorite->question->user->name ?? 'A', 0, 1)) }}
                                </span>
                            </div>
                            <div class="ml-4 flex-1">
                                <h2 class="text-lg font-medium text-indigo-600 truncate">
                                    <a href="{{ route('questions.show', $favorite->question) }}" class="hover:underline">
                                        {{ $favorite->question->title }}
                                    </a>
                                </h2>
                                <p class="text-sm text-gray-500">
                                    Par {{ $favorite->question->user->name ?? 'Anonyme' }} • {{ $favorite->question->created_at->diffForHumans() }}
                                    @if($favorite->question->location)
                                        • <span class="text-gray-400"><i class="fas fa-map-marker-alt"></i> {{ $favorite->question->location }}</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4 text-sm text-gray-500 ml-4">
                            <div class="flex items-center">
                                <i class="fas fa-comment-alt mr-1"></i> {{ $favorite->question->responses->count() }}
                            </div>
                            <form action="{{ route('favorites.toggle', $favorite->question) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-yellow-500 hover:text-gray-500 transition" title="Retirer des favoris">
                                    <i class="fas fa-star"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-gray-600 line-clamp-2">
                            {{ Str::limit($favorite->question->content, 150) }}
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-12 bg-white rounded-lg shadow">
                <i class="fas fa-star text-gray-300 text-5xl mb-4"></i>
                <p class="text-gray-500 text-lg">Vous n'avez pas encore de questions favorites.</p>
                <a href="{{ route('questions.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium mt-2 inline-block">
                    Explorez les questions et ajoutez vos favorites !
                </a>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $favorites->links() }}
    </div>
</div>
@endsection
