<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserManagementController;
use App\Http\Controllers\Api\RolePermissionController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductVariantPriceHistoryController;

Route::get('/{any}', function () {
    return view('welcome'); // tu vista principal con <div id="app"></div>
})->where('any', '.*');

// Rutas públicas
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::prefix('api/v1')->group(function () {

    Route::prefix('categories')->group(function () {

        // Listar todas las categorías activas
        Route::get('active', [CategoryController::class, 'allActive']);

        // Obtener categoría por slug
        Route::get('slug/{slug}', [CategoryController::class, 'showBySlug']);

        // Listar todas las categorías con paginación
        Route::get('/', [CategoryController::class, 'index']);

        // Crear nueva categoría
        Route::post('/', [CategoryController::class, 'store']);

        // Obtener categoría por ID
        Route::get('{id}', [CategoryController::class, 'show'])->where('id', '[0-9]+');

        // Actualizar categoría existente
        Route::put('{id}', [CategoryController::class, 'update'])->where('id', '[0-9]+');

        // Eliminar categoría
        Route::delete('{id}', [CategoryController::class, 'destroy'])->where('id', '[0-9]+');
    });

    Route::prefix('products')->group(function () {
        // Listar todas las categorías con paginación
        Route::get('/', [ProductController::class, 'index']);

        Route::get('/ProductosDestacados', [ProductController::class, 'productosDestacados']);

        Route::get('/Get', [ProductController::class, 'list']);


        Route::get('/Search', [ProductController::class, 'search']);

        // Crear nueva categoría
        Route::post('/', [ProductController::class, 'store']);

        // Obtener categoría por ID
        Route::get('{id}', [ProductController::class, 'show'])->where('id', '[0-9]+');

        // Actualizar categoría existente
        Route::put('{id}', [ProductController::class, 'update'])->where('id', '[0-9]+');

        // Eliminar categoría
        Route::delete('{id}', [ProductController::class, 'destroy'])->where('id', '[0-9]+');
    });

    Route::prefix('price-history')->group(function () {
        // Listar historial con filtros y paginación
        Route::get('/', [ProductVariantPriceHistoryController::class, 'index']);

        Route::get('/Get', [ProductVariantPriceHistoryController::class, 'list']);

        // Obtener historial por ID
        Route::get('{id}', [ProductVariantPriceHistoryController::class, 'show'])->where('id', '[0-9]+');

        // Crear nuevo registro de historial
        Route::post('/', [ProductVariantPriceHistoryController::class, 'store']);

        // Actualizar historial existente
        Route::put('{id}', [ProductVariantPriceHistoryController::class, 'update'])->where('id', '[0-9]+');

        // Eliminar historial
        Route::delete('{id}', [ProductVariantPriceHistoryController::class, 'destroy'])->where('id', '[0-9]+');

        // Obtener historial actual por variante
        Route::get('current/{variantId}', [ProductVariantPriceHistoryController::class, 'currentByVariant'])->where('variantId', '[0-9]+');
    });
    Route::prefix('user')->group(function () {
        Route::post('/login', [UserManagementController::class, 'login']);
        Route::post('/register', [UserManagementController::class, 'register']);
    });         
});

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