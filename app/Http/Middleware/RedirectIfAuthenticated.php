<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class RedirectIfAuthenticated extends Middleware
{
    /**
     * Redirigir a la ruta de inicio si el usuario ya está autenticado.
     */
    protected function redirectTo($request)
    {
        return route('home');
    }
}
