<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Si quieres crear un usuario de prueba:
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Llamar a todos tus seeders personalizados
        $this->call([
            ApiRolePermissionSeeder::class,
            CategoriesSeeder::class,
            StoreSettingsSeeder::class,
            StoreSettingsSeeder::class,
            UserRolePermissionSeeder::class,
            MasterAttributesSeeder::class,
            AttributeValuesSeeder::class,
            ProductsSeeder::class,
            ProductVariantsSeeder::class,
            ProductVariantAttributesSeeder::class,
            ProductImagesSeeder::class
            // 👇 agrega aquí todos los demás seeders que tengas
            // Ejemplo:
            // OrdersSeeder::class,
            // PaymentMethodsSeeder::class,
        ]);
    }
}
