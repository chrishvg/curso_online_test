<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Verifica si el usuario está autenticado y tiene uno de los roles requeridos
        if (!Auth::check() || !$request->user()->roles->contains('name', $role)) {
            // Si no tiene el rol, redirige o lanza un error
            abort(403, 'Acceso no autorizado');
        }

        return $next($request);
    }
}
