<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->is_admin) {
            // Si no está autenticado o no es admin, redirige al home o a una ruta de acceso denegado
            return redirect('/')->with('error', 'Acceso denegado. No eres un administrador.');

        }

        return $next($request);
    }
}
