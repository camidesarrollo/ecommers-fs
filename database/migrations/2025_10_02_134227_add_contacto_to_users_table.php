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
            $table->string('telefono', 20)->nullable()->after('email');

            // Identificación
            $table->string('rut', 20)->nullable()->after('telefono'); 
            $table->string('pasaporte', 50)->nullable()->after('rut');

            // Datos personales
            $table->string('apellido')->nullable()->after('nombre');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['telefono', 'rut', 'pasaporte', 'apellido']);
        });
    }
};
