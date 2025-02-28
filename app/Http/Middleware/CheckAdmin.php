<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Manejo una solicitud entrante y verifico si el usuario es administrador.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Verifica si el usuario tiene el rol de 'admin'
        if ($user && $user->roles()->where('name', 'admin')->exists()) {
            return $next($request);
        }

        // Redirige si no tiene el rol de admin
        return redirect('/')->with([
            'message' => 'Acceso denegado. Necesitas permisos de administrador.',
            'alert-type' => 'error'
        ]);
    }
}
