<?php

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
        Schema::table('users', function (Blueprint $table) {
            // Contacto
            $table->string('phone', 20)->nullable()->after('email');

            // Identificación
            $table->string('rut', 20)->nullable()->after('phone');
            $table->string('avatar', 20)->nullable()->after('rut');
            $table->string('pasaporte', 50)->nullable()->after('rut');

            // Datos personales
            $table->string('apellido')->nullable()->after('name');

            // Estado activo/inactivo
            $table->boolean('status')->default(true)->after('apellido'); // booleano, default true
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'rut', 'pasaporte', 'apellido', 'status']);
        });
    }
};
