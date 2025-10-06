<?php

use Illuminate\Support\Facades\Route;
use App\Infrastructure\Http\Controllers\Api\AuthController;
use App\Infrastructure\Http\Controllers\Api\UserManagementController;
use App\Infrastructure\Http\Controllers\Api\RolePermissionController;
use App\Infrastructure\Http\Controllers\Api\CategoryController;
use App\Infrastructure\Http\Controllers\Api\ProductController;
use App\Infrastructure\Http\Controllers\Api\ProductVariantPriceHistoryController;

// Ruta principal
Route::get('/', function () {
    return view('welcome');
});

// Rutas de API
Route::prefix('api/v1')->group(function () {
    
    Route::prefix('categories')->group(function () {
        Route::get('active', [CategoryController::class, 'allActive']);
        Route::get('slug/{slug}', [CategoryController::class, 'showBySlug']);
        Route::get('/', [CategoryController::class, 'index']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::get('{id}', [CategoryController::class, 'show'])->where('id', '[0-9]+');
        Route::put('{id}', [CategoryController::class, 'update'])->where('id', '[0-9]+');
        Route::delete('{id}', [CategoryController::class, 'destroy'])->where('id', '[0-9]+');
    });

    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::get('/ProductosDestacados', [ProductController::class, 'productosDestacados']);
        Route::get('/Get', [ProductController::class, 'list']);
        Route::get('/Search', [ProductController::class, 'search']);
        Route::post('/', [ProductController::class, 'store']);
        Route::get('{id}', [ProductController::class, 'show'])->where('id', '[0-9]+');
        Route::put('{id}', [ProductController::class, 'update'])->where('id', '[0-9]+');
        Route::delete('{id}', [ProductController::class, 'destroy'])->where('id', '[0-9]+');
    });

    Route::prefix('price-history')->group(function () {
        Route::get('/', [ProductVariantPriceHistoryController::class, 'index']);
        Route::get('/Get', [ProductVariantPriceHistoryController::class, 'list']);
        Route::get('{id}', [ProductVariantPriceHistoryController::class, 'show'])->where('id', '[0-9]+');
        Route::post('/', [ProductVariantPriceHistoryController::class, 'store']);
        Route::put('{id}', [ProductVariantPriceHistoryController::class, 'update'])->where('id', '[0-9]+');
        Route::delete('{id}', [ProductVariantPriceHistoryController::class, 'destroy'])->where('id', '[0-9]+');
        Route::get('current/{variantId}', [ProductVariantPriceHistoryController::class, 'currentByVariant'])->where('variantId', '[0-9]+');
    });

    Route::prefix('user')->group(function () {
        Route::post('/login', [UserManagementController::class, 'login']);
        Route::post('/register', [UserManagementController::class, 'register']);
    });
});

// ✅ Catch-all para Vue Router - DEBE IR AL FINAL y EXCLUIR rutas API
Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '^(?!api).*$'); // ← Excluye cualquier ruta que empiece con "api"

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Gestión de usuarios (solo admins)
    Route::middleware('role:admin,super-admin')->group(function () {
        Route::apiResource('users', UserManagementController::class);
        Route::post('/users/{user}/assign-role', [UserManagementController::class, 'assignRole']);
        Route::post('/users/{user}/remove-role', [UserManagementController::class, 'removeRole']);

        // Roles y permisos
        Route::get('/roles', [RolePermissionController::class, 'roles']);
        Route::get('/permissions', [RolePermissionController::class, 'permissions']);
        Route::post('/roles', [RolePermissionController::class, 'createRole']);
        Route::put('/roles/{role}/permissions', [RolePermissionController::class, 'updateRolePermissions']);
    });

    // Rutas por permisos específicos
    Route::middleware('permission:view products')->group(function () {
        Route::get('/products', [ProductController::class, 'index']);
    });

    Route::middleware('permission:create products')->group(function () {
        Route::post('/products', [ProductController::class, 'store']);
    });
});