<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $query = Question::with(['user', 'responses']);

   
        if ($request->has('search') && $request->search) {
            $query->where('title', 'like', "%{$request->search}%")
                  ->orWhere('content', 'like', "%{$request->search}%");
        }

       
        if (Auth::check() && Auth::user()->latitude && Auth::user()->longitude) {
            
            $questions = $query->latest()->paginate(10); 
        } else {
            $questions = $query->latest()->paginate(10);
        }

        return view('questions.index', compact('questions'));
    }

    public function create()
    {
        return view('questions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'location' => 'nullable|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        $validated['user_id'] = Auth::id();

        Question::create($validated);

        return redirect()->route('questions.index')
            ->with('success', 'Question publiée avec succès!');
    }

    public function show(Question $question)
    {
        $question->load(['user', 'responses.user', 'favorites']);
        $question->incrementViews();

        return view('questions.show', compact('question'));
    }

    public function edit(Question $question)
    {
        $user = Auth::user();
        if ($question->user_id !== Auth::id() && !($user instanceof User && $user->isAdmin())) {
            abort(403);
        }

        return view('questions.edit', compact('question'));
    }

    public function update(Request $request, Question $question)
    {
        $user = Auth::user();
        if ($question->user_id !== Auth::id() && !($user instanceof User && $user->isAdmin())) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'location' => 'nullable|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        $question->update($validated);

        return redirect()->route('questions.show', $question)
            ->with('success', 'Question modifiée avec succès!');
    }

    public function destroy(Question $question)
    {
        $user = Auth::user();
        if ($question->user_id !== Auth::id() && !($user instanceof User && $user->isAdmin())) {
            abort(403);
        }

        $question->delete();

        return redirect()->route('questions.index')
            ->with('success', 'Question supprimée avec succès!');
    }
}