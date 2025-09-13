<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductVariantPriceHistoryController;

Route::get('/', function () {
    return view('welcome');
});

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
});
