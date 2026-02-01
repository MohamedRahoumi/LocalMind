<?php

namespace App\Http\Controllers;

use App\Models\Response;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ResponseController extends Controller
{
    public function store(Request $request, Question $question)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['question_id'] = $question->id;

        Response::create($validated);

        return redirect()->route('questions.show', $question)
            ->with('success', 'Réponse ajoutée avec succès!');
    }

    public function destroy(Response $response)
    {
        $user = Auth::user();
        if ($response->user_id !== Auth::id() && !($user instanceof User && $user->isAdmin())) {
            abort(403);
        }

        $question = $response->question;
        $response->delete();

        return redirect()->route('questions.show', $question)
            ->with('success', 'Réponse supprimée avec succès!');
    }}