<?php

/**
 * MIGRACIÓN: database/migrations/2024_xx_xx_create_store_settings_table.php
 * 
 * Ejecutar: php artisan migrate
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('store_settings', function (Blueprint $table) {
            $table->id();
            $table->string('type', 50)->index()->comment('Tipo: general, social, contact, payment, etc.');
            $table->string('key', 100)->unique()->comment('Clave única de la configuración');
            $table->text('value')->nullable()->comment('Valor de la configuración');
            $table->text('description')->nullable()->comment('Descripción del campo');
            $table->boolean('is_active')->default(true)->comment('Si está activo o no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_settings');
    }
};
