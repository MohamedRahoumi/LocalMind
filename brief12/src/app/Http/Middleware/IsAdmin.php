<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if (!($user instanceof User && $user->isAdmin())) {
            abort(403, 'Accès non autorisé.');
        }

        return $next($request);
    }
}