<?php

namespace App\Infrastructure\Http\Middleware;


use App\Infrastructure\Http\Traits\ApiResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiErrorHandler
{
    use ApiResponseTrait;

    public function handle(Request $request, Closure $next): Response
    {
        try {
            return $next($request);
        } catch (\Throwable $e) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return $this->handleException($e);
            }
            
            throw $e;
        }
    }
}