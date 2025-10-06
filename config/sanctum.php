<?php

use Laravel\Sanctum\Sanctum;

return [

    /*
    |--------------------------------------------------------------------------
    | Stateful Domains
    |--------------------------------------------------------------------------
    |
    | Estos son los dominios que deben recibir cookies de sesión cuando se
    | hace login desde SPA. Puedes agregar localhost, IPs o dominios
    | de producción.
    |
    */
    'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', sprintf(
        '%s%s',
        'localhost,localhost:3000,localhost:8080,127.0.0.1,127.0.0.1:8000,::1',
        Sanctum::currentApplicationUrlWithPort()
    ))),

    /*
    |--------------------------------------------------------------------------
    | Guard
    |--------------------------------------------------------------------------
    |
    | Qué guardias usar para autenticar la sesión. Por defecto usamos 'web'.
    |
    */
    'guard' => ['web'],

    /*
    |--------------------------------------------------------------------------
    | Expiration
    |--------------------------------------------------------------------------
    |
    | Duración de los tokens en minutos. Null = no expira.
    |
    */
    'expiration' => null,

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | Middleware que Sanctum usará para verificar CSRF y encriptar cookies.
    |
    */
    'middleware' => [
        'verify_csrf_token' => App\Infrastructure\Http\Middleware\VerifyCsrfToken::class,
        'encrypt_cookies' => App\Infrastructure\Http\Middleware\EncryptCookies::class,
    ],

];
