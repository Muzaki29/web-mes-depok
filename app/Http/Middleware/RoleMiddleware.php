<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (app()->environment('local') && ! Auth::check()) {
            return $next($request);
        }

        if (! Auth::check()) {
            return redirect('/')->with('error', 'Please sign in');
        }

        $userRole = Auth::user()->role ?? 'public_user';
        if (! in_array($userRole, $roles, true)) {
            abort(403);
        }

        return $next($request);
    }
}
