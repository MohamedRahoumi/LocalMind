<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!($user instanceof User)) {
            return redirect()->route('login');
        }

        $favorites = $user->favorites()->with(['question.user'])->paginate(10);

        return view('favorites.index', compact('favorites'));
    }

    public function toggle(Question $question)
    {
        $user = Auth::user();

        if (!($user instanceof User)) {
            return redirect()->route('login');
        }

        $existing = Favorite::where('user_id', $user->id)
            ->where('question_id', $question->id)
            ->first();

        if ($existing) {
            $existing->delete();
            return redirect()->back()
                ->with('success', 'Question retirée des favoris!');
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'question_id' => $question->id,
            ]);

            return redirect()->back()
                ->with('success', 'Question ajoutée aux favoris!');
        }
    }}