<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): mixed
    {
        // Comprobar si el usuario tiene el rol necesario
        if (!$request->user() || !$request->user()->hasRole($role)) {
            // Redirigir o devolver error si no tiene el rol
            return redirect('/home'); // O lanzar un 403
        }

        return $next($request);
    }
}
