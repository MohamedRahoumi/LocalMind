<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggle(Question $question)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $like = Like::where('user_id', $user->id)
                    ->where('question_id', $question->id)
                    ->first();

        if ($like) {
            // Si le like existe, on le supprime (unlike)
            $like->delete();
            $liked = false;
        } else {
            // Sinon, on crée un nouveau like
            Like::create([
                'user_id' => $user->id,
                'question_id' => $question->id,
            ]);
            $liked = true;
        }

        // Retourner une réponse JSON pour les requêtes AJAX
        if (request()->expectsJson()) {
            return response()->json([
                'liked' => $liked,
                'likes_count' => $question->likes()->count(),
            ]);
        }

        return redirect()->back()->with('success', $liked ? 'Like ajouté!' : 'Like supprimé!');
    }
}
