<?php

/**
 * =============================================================================
 * MIGRACIÓN: database/migrations/xxxx_create_email_preferences_table.php
 * =============================================================================
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('email_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('unsubscribe_token')->unique();
            $table->boolean('marketing_emails')->default(true);
            $table->boolean('order_emails')->default(true);
            $table->boolean('newsletter')->default(true);
            $table->boolean('promotions')->default(true);
            $table->boolean('product_updates')->default(true);
            $table->boolean('is_unsubscribed')->default(false);
            $table->timestamp('unsubscribed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('email_preferences');
    }
};