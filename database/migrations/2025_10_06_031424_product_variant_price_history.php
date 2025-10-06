<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_variant_price_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_variant_id')
                  ->constrained('product_variants')
                  ->onDelete('cascade');
            $table->decimal('price', 10, 2);
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->string('reason', 255)->nullable()->comment('Motivo del cambio o promoción');
            $table->timestamps(); // Crea created_at y updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_variant_price_history');
    }
};
