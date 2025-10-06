<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoreSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('store_settings')->truncate();
        
        DB::table('store_settings')->insert([
            // Información General
            [
                'type' => 'general',
                'key' => 'store_name',
                'value' => 'Mi Tienda Natural',
                'description' => 'Nombre de la tienda',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'general',
                'key' => 'store_slogan',
                'value' => 'Productos naturales para una vida saludable',
                'description' => 'Eslogan de la tienda',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'general',
                'key' => 'store_description',
                'value' => 'Ofrecemos los mejores frutos secos, semillas y productos naturales',
                'description' => 'Descripción corta de la tienda',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Información de Contacto
            [
                'type' => 'contact',
                'key' => 'contact_email',
                'value' => 'contacto@mitienda.cl',
                'description' => 'Email principal de contacto',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'contact',
                'key' => 'support_email',
                'value' => 'soporte@mitienda.cl',
                'description' => 'Email de soporte técnico',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'contact',
                'key' => 'sales_email',
                'value' => 'ventas@mitienda.cl',
                'description' => 'Email de ventas',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'contact',
                'key' => 'phone',
                'value' => '+56912345678',
                'description' => 'Teléfono principal',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'contact',
                'key' => 'whatsapp',
                'value' => '+56912345678',
                'description' => 'Número de WhatsApp',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'contact',
                'key' => 'address',
                'value' => 'Av. Providencia 123, Santiago, Chile',
                'description' => 'Dirección física de la tienda',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Redes Sociales
            [
                'type' => 'social',
                'key' => 'facebook_url',
                'value' => 'https://facebook.com/mitienda',
                'description' => 'URL de Facebook',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'social',
                'key' => 'instagram_url',
                'value' => 'https://instagram.com/mitienda',
                'description' => 'URL de Instagram',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'social',
                'key' => 'twitter_url',
                'value' => 'https://twitter.com/mitienda',
                'description' => 'URL de Twitter/X',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'social',
                'key' => 'tiktok_url',
                'value' => 'https://tiktok.com/@mitienda',
                'description' => 'URL de TikTok',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'social',
                'key' => 'youtube_url',
                'value' => 'https://youtube.com/@mitienda',
                'description' => 'URL de YouTube',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'social',
                'key' => 'linkedin_url',
                'value' => 'https://linkedin.com/company/mitienda',
                'description' => 'URL de LinkedIn',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Configuraciones de la tienda
            [
                'type' => 'config',
                'key' => 'discount_welcome_code',
                'value' => 'BIENVENIDO15',
                'description' => 'Código de descuento para nuevos usuarios',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'config',
                'key' => 'free_shipping_amount',
                'value' => '50000',
                'description' => 'Monto mínimo para envío gratis (en pesos)',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'config',
                'key' => 'business_hours',
                'value' => 'Lunes a Viernes: 9:00 - 18:00, Sábado: 10:00 - 14:00',
                'description' => 'Horario de atención',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // SEO
            [
                'type' => 'seo',
                'key' => 'meta_title',
                'value' => 'Tienda de Frutos Secos y Productos Naturales | Mi Tienda',
                'description' => 'Título para SEO',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'seo',
                'key' => 'meta_description',
                'value' => 'Compra los mejores frutos secos, semillas y productos naturales. Envío gratis sobre $50.000',
                'description' => 'Descripción para SEO',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'seo',
                'key' => 'meta_keywords',
                'value' => 'frutos secos, almendras, nueces, semillas, productos naturales, snacks saludables',
                'description' => 'Palabras clave para SEO',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
