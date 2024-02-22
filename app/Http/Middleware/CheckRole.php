<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->hasRole('Admin')) {
            return $next($request);
        }

        return redirect('/home'); // Redirecciona a la página principal o donde desees
    }
}
