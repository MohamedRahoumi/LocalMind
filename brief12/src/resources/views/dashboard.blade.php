@extends('layouts.app')

@section('title', 'Tableau de bord - Admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Tableau de bord Administrateur</h1>

    <!-- First Row: Global Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Users Card -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Utilisateurs inscrits</dt>
                            <dd class="text-3xl font-semibold text-gray-900">{{ $stats['total_users'] }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Questions Card -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                        <i class="fas fa-question-circle text-white text-2xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Questions posées</dt>
                            <dd class="text-3xl font-semibold text-gray-900">{{ $stats['total_questions'] }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Responses Card -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                        <i class="fas fa-comments text-white text-2xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Réponses totales</dt>
                            <dd class="text-3xl font-semibold text-gray-900">{{ $stats['total_responses'] }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Row: Recent & Popular -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Questions -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Questions Récentes</h3>
            </div>
            <ul class="divide-y divide-gray-200">
                @forelse($stats['recent_questions'] as $question)
                    <li class="p-4 hover:bg-gray-50">
                        <div class="flex space-x-3">
                            <div class="flex-1 space-y-1">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-sm font-medium">
                                        <a href="{{ route('questions.show', $question) }}" class="text-indigo-600 hover:text-indigo-900">
                                            {{ $question->title }}
                                        </a>
                                    </h3>
                                    <p class="text-xs text-gray-500">{{ $question->created_at->diffForHumans() }}</p>
                                </div>
                                <p class="text-sm text-gray-500">Par {{ $question->user->name ?? 'Anonyme' }}</p>
                            </div>
                        </div>
                    </li>
                @empty
                    <li class="p-4 text-center text-gray-500">Aucune question récente.</li>
                @endforelse
            </ul>
        </div>

        <!-- Popular Questions -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Questions Populaires</h3>
            </div>
            <ul class="divide-y divide-gray-200">
                @forelse($stats['popular_questions'] as $question)
                    <li class="p-4 hover:bg-gray-50">
                        <div class="flex justify-between items-center">
                            <div>
                                <a href="{{ route('questions.show', $question) }}" class="text-indigo-600 font-medium hover:text-indigo-900">
                                    {{ $question->title }}
                                </a>
                                <p class="text-xs text-gray-400 mt-1">
                                    <i class="fas fa-comment-alt mr-1"></i> {{ $question->responses_count }} réponses
                                </p>
                              
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Populaire
                            </span>
                        </div>
                    </li>
                @empty
                    <li class="p-4 text-center text-gray-500">Pas assez de données.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
