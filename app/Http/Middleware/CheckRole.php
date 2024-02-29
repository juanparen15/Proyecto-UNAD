<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, $role)
    {
        // Verificar si el usuario está autenticado y tiene el rol especificado
        if (Auth::check() && Auth::user()->hasRole($role)) {
            // Si la acción actual no está en la lista de acciones excluidas, continuar con la solicitud
                return $next($request);
        }

        // Redireccionar al usuario si no cumple con los requisitos
        return redirect('/home');
    }
}
