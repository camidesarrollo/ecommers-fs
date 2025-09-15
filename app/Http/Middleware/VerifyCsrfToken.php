<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Las rutas que deben excluirse de la verificación CSRF.
     *
     * @var array<int, string>
     */
    protected $except = [
        // Ejemplo: rutas API que no necesiten CSRF
        // 'api/*',
    ];
}
