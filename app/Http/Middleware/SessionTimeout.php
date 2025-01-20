<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SessionTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Tiempo máximo de inactividad en minutos
        $maxIdleTime = 30;

        // Verificar si la sesión tiene una marca de tiempo de última actividad
        if (Session::has('last_activity')) {
            $lastActivity = Session::get('last_activity');

            // Verificar si la sesión ha expirado
            if (now()->diffInMinutes($lastActivity) >= $maxIdleTime) {
                Auth::logout(); // Cerrar sesión
                Session::flush(); // Limpiar la sesión
                return redirect()->route('login')->with('mensaje', 'Tu sesión ha expirado debido por inactividad.');
            }
        }

        // Actualizar la marca de tiempo de la última actividad
        Session::put('last_activity', now());

        return $next($request);
    }
}
