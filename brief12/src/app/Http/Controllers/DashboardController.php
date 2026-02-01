<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Response;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Middleware\IsAdmin;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', IsAdmin::class]);
    }

    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_questions' => Question::count(),
            'total_responses' => Response::count(),
            'recent_questions' => Question::with('user')->latest()->take(5)->get(),
            'popular_questions' => Question::withCount('responses')
                ->orderBy('responses_count', 'desc')
                ->take(5)
                ->get(),
        ];

        return view('dashboard', compact('stats'));
    }
}