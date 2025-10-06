<?php

namespace App\Infrastructure\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * Los nombres de las cookies que NO deben ser encriptadas.
     *
     * @var array<int, string>
     */
    protected $except = [
        // Agrega aquí cookies que no quieras encriptar
        // ejemplo: 'XSRF-TOKEN'
    ];
}
