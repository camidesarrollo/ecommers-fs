<?php
// MIDDLEWARE PERSONALIZADO PARA API

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckApiPermission
{
    public function handle(Request $request, Closure $next, $permission)
    {
        if (!auth('sanctum')->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Token no válido'
            ], 401);
        }

        if (!auth('sanctum')->user()->can($permission)) {
            return response()->json([
                'success' => false,
                'message' => 'No tienes permisos para realizar esta acción'
            ], 403);
        }

        return $next($request);
    }
}

class CheckApiRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth('sanctum')->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Token no válido'
            ], 401);
        }

        if (!auth('sanctum')->user()->hasAnyRole($roles)) {
            return response()->json([
                'success' => false,
                'message' => 'No tienes el rol necesario para acceder'
            ], 403);
        }

        return $next($request);
    }
}
