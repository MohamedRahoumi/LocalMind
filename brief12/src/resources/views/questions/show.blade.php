@extends('layouts.app')

@section('title', $question->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content: Question & Responses -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Question Detailed Card -->
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6 flex justify-between items-start">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $question->title }}</h1>
                        <div class="mt-1 flex items-center text-sm text-gray-500">
                            <span class="mr-3">Par {{ $question->user->name ?? 'Anonyme' }}</span>
                            <span>{{ $question->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    
                    @if(Auth::id() === $question->user_id || (Auth::check() && Auth::user()->isAdmin()))
                        <div class="flex space-x-2">
                            <a href="{{ route('questions.edit', $question) }}" class="text-indigo-600 hover:text-indigo-900 border border-indigo-200 rounded px-2 py-1 text-sm">
                                Editer
                            </a>
                            <form action="{{ route('questions.destroy', $question) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr ?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 border border-red-200 rounded px-2 py-1 text-sm">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    @endif
                </div>

                <div class="px-4 py-5 sm:p-6 border-t border-gray-200">
                    <div class="prose max-w-none text-gray-800">
                        {!! nl2br(e($question->content)) !!}
                    </div>
                </div>

                <div class="bg-gray-50 px-4 py-4 sm:px-6 flex justify-between items-center border-t border-gray-200">
                    <div class="flex space-x-4">
                        @auth
                            <form action="{{ route('likes.toggle', $question) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-500 hover:text-blue-600 transition {{ Auth::user()->hasLiked($question) ? 'text-blue-600' : '' }}">
                                    <i class="{{ Auth::user()->hasLiked($question) ? 'fas' : 'far' }} fa-thumbs-up"></i> 
                                    {{ Auth::user()->hasLiked($question) ? 'Aimé' : 'Aimer' }} ({{ $question->likes()->count() }})
                                </button>
                            </form>
                            <form action="{{ route('favorites.toggle', $question) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-gray-500 hover:text-yellow-500 transition {{ Auth::user()->hasFavorited($question) ? 'text-yellow-500' : '' }}">
                                    <i class="{{ Auth::user()->hasFavorited($question) ? 'fas' : 'far' }} fa-star"></i> 
                                    {{ Auth::user()->hasFavorited($question) ? 'Favori' : 'Ajouter aux favoris' }}
                                </button>
                            </form>
                        @endauth
                    </div>
                    @if($question->location)
                        <div class="text-sm text-gray-500">
                            <i class="fas fa-map-marker-alt text-red-500"></i> {{ $question->location }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Responses Section -->
            <div class="bg-white shadow sm:rounded-lg overflow-hidden">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        {{ $question->responses->count() }} Réponses
                    </h3>
                </div>
                
                <ul class="divide-y divide-gray-200">
                    @forelse($question->responses as $response)
                        <li class="p-4 sm:p-6">
                            <div class="flex space-x-3">
                                <div class="shrink-0">
                                    <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-gray-200 text-gray-500 font-bold">
                                        {{ strtoupper(substr($response->user->name ?? 'U', 0, 1)) }}
                                    </span>
                                </div>
                                <div class="flex-1 space-y-1">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-sm font-medium text-gray-900">{{ $response->user->name ?? 'Anonyme' }}</h3>
                                        <p class="text-sm text-gray-500">{{ $response->created_at->diffForHumans() }}</p>
                                    </div>
                                    <div class="text-sm text-gray-700">
                                        {!! nl2br(e($response->content)) !!}
                                    </div>
                                    @if(Auth::id() === $response->user_id || (Auth::check() && Auth::user()->isAdmin()))
                                        <div class="mt-2 text-right">
                                            <form action="{{ route('responses.destroy', $response) }}" method="POST" onsubmit="return confirm('Supprimer cette réponse ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-xs text-red-500 hover:text-red-700">Supprimer</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="p-8 text-center text-gray-500">
                            Aucune réponse pour le moment. Soyez le premier à répondre !
                        </li>
                    @endforelse
                </ul>

                <!-- Add Response Form -->
                @auth
                    <div class="bg-gray-50 px-4 py-6 sm:px-6 border-t border-gray-200">
                        <h4 class="text-sm font-medium text-gray-900 mb-3">Votre réponse</h4>
                        <form action="{{ route('responses.store', $question) }}" method="POST">
                            @csrf
                            <div>
                                <label for="content" class="sr-only">Réponse</label>
                                <textarea id="content" name="content" rows="3" class="shadow-sm block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md p-2" placeholder="Partagez votre avis ou votre solution..."></textarea>
                            </div>
                            @error('content')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <div class="mt-3 flex justify-end">
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Publier la réponse
                                </button>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="bg-gray-50 px-4 py-6 sm:px-6 border-t border-gray-200 text-center">
                        <p class="text-gray-600">
                            <a href="{{ route('login') }}" class="text-indigo-600 font-medium hover:underline">Connectez-vous</a> pour répondre à cette question.
                        </p>
                    </div>
                @endauth
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Author Info or Related (Placeholder) -->
            <div class="bg-white shadow sm:rounded-lg overflow-hidden">
                <div class="px-4 py-5 sm:px-6 bg-gray-50">
                    <h3 class="text-lg font-medium text-gray-900">Conseils</h3>
                </div>
                <div class="px-4 py-5 sm:p-6 text-sm text-gray-500 space-y-3">
                    <p><i class="fas fa-check-circle text-green-500 mr-2"></i> Soyez précis et courtois.</p>
                    <p><i class="fas fa-check-circle text-green-500 mr-2"></i> Vérifiez si la question n'a pas déjà été posée.</p>
                    <p><i class="fas fa-check-circle text-green-500 mr-2"></i> Partagez votre propre expérience locale.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
