<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MasterAttributesSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $attributes = [
            ['name' => 'Color', 'description' => 'Color principal del producto, ej: Rojo, Verde, Marrón'],
            ['name' => 'Sabor', 'description' => 'Sabor del producto, ej: Dulce, Salado, Amargo, Picante'],
            ['name' => 'Peso', 'description' => 'Peso del producto, ej: 100g, 500g, 1kg'],
            ['name' => 'Tamaño', 'description' => 'Tamaño del producto o empaque, ej: Pequeño, Mediano, Grande'],
            ['name' => 'Tipo de Empaque', 'description' => 'Forma de empaque, ej: Bolsa, Frasco, Caja, Lata'],
            ['name' => 'Origen', 'description' => 'País o región de origen del producto'],
            ['name' => 'Variedad', 'description' => 'Variedad específica del producto, ej: Arroz Integral, Aceituna Kalamata'],
            ['name' => 'Ingredientes', 'description' => 'Ingredientes principales del producto'],
            ['name' => 'Fecha de Vencimiento', 'description' => 'Duración o fecha de caducidad del producto'],
            ['name' => 'Tipo de Producto', 'description' => 'Clasificación general, ej: Orgánico, Sin Gluten, Vegano'],
            ['name' => 'Nivel de Dulzura', 'description' => 'Solo para productos dulces: Bajo, Medio, Alto'],
            ['name' => 'Textura', 'description' => 'Textura del producto, ej: Crujiente, Suave, Cremoso'],
            ['name' => 'Presentación', 'description' => 'Presentación del producto, ej: Entero, Molido, En Polvo'],
            ['name' => 'Calorías', 'description' => 'Contenido calórico aproximado'],
            ['name' => 'Certificaciones', 'description' => 'Certificaciones como orgánico, kosher, halal, etc.'],
            ['name' => 'Marca', 'description' => 'Marca o productor del producto'],
        ];

        foreach ($attributes as $attribute) {
            DB::table('master_attributes')->insert([
                'name' => $attribute['name'],
                'description' => $attribute['description'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
