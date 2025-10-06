<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AttributeValuesSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $attributes = [
            // Sabor (attribute_id: 2)
            ['attribute_id' => 2, 'value' => 'Amargas'],
            ['attribute_id' => 2, 'value' => 'Dulce'],
            ['attribute_id' => 2, 'value' => 'Salado'],
            ['attribute_id' => 2, 'value' => 'Sin Sal'],
            
            // Peso (attribute_id: 3)
            ['attribute_id' => 3, 'value' => '100 Gramos'],
            ['attribute_id' => 3, 'value' => '200 Gramos'],
            ['attribute_id' => 3, 'value' => '250 Gramos'],
            ['attribute_id' => 3, 'value' => '350 Gramos'],
            ['attribute_id' => 3, 'value' => '500 Gramos'],
            ['attribute_id' => 3, 'value' => '822 Gramos'],
            ['attribute_id' => 3, 'value' => '1 Kilo'],
            ['attribute_id' => 3, 'value' => '3 Kilos'],
            ['attribute_id' => 3, 'value' => '125 Gramos'],
            
            // Tamaño (attribute_id: 4)
            ['attribute_id' => 4, 'value' => 'Jumbo'],
            ['attribute_id' => 4, 'value' => 'Super'],
            ['attribute_id' => 4, 'value' => 'Extra'],
            ['attribute_id' => 4, 'value' => 'Mediano'],
            ['attribute_id' => 4, 'value' => 'Baby'],
            ['attribute_id' => 4, 'value' => '6mm'],
            ['attribute_id' => 4, 'value' => 'Mini'],
            
            // Tipo de Empaque (attribute_id: 5)
            ['attribute_id' => 5, 'value' => 'Bolsa'],
            ['attribute_id' => 5, 'value' => 'Frasco'],
            ['attribute_id' => 5, 'value' => 'Botella'],
            
            // Origen (attribute_id: 6)
            ['attribute_id' => 6, 'value' => 'Chilena'],
            ['attribute_id' => 6, 'value' => 'Europea'],
            ['attribute_id' => 6, 'value' => 'Turca'],
            ['attribute_id' => 6, 'value' => 'Himalaya'],
            
            // Variedad (attribute_id: 7)
            ['attribute_id' => 7, 'value' => 'Negras'],
            ['attribute_id' => 7, 'value' => 'Verdes'],
            ['attribute_id' => 7, 'value' => 'Rellenas'],
            ['attribute_id' => 7, 'value' => 'Con Chocolate'],
            ['attribute_id' => 7, 'value' => 'Laminadas'],
            ['attribute_id' => 7, 'value' => 'Sin Piel'],
            ['attribute_id' => 7, 'value' => 'Con Piel'],
            ['attribute_id' => 7, 'value' => 'Con Cáscara'],
            ['attribute_id' => 7, 'value' => 'Sin Cuesco'],
            ['attribute_id' => 7, 'value' => 'Arborio'],
            ['attribute_id' => 7, 'value' => 'Basmati'],
            ['attribute_id' => 7, 'value' => 'Integral'],
            ['attribute_id' => 7, 'value' => 'Instantánea'],
            ['attribute_id' => 7, 'value' => 'De Caña'],
            ['attribute_id' => 7, 'value' => 'Blanco'],
            ['attribute_id' => 7, 'value' => 'Negro'],
            ['attribute_id' => 7, 'value' => 'Rojo'],
            ['attribute_id' => 7, 'value' => 'Amargo'],
            ['attribute_id' => 7, 'value' => 'Granulado'],
            ['attribute_id' => 7, 'value' => 'Entera'],
            ['attribute_id' => 7, 'value' => 'Molida'],
            ['attribute_id' => 7, 'value' => 'Rallado'],
            ['attribute_id' => 7, 'value' => 'Cruda'],
            ['attribute_id' => 7, 'value' => 'Pelada'],
            ['attribute_id' => 7, 'value' => 'Tostado'],
            ['attribute_id' => 7, 'value' => 'Confitado'],
            ['attribute_id' => 7, 'value' => 'Crocante'],
            ['attribute_id' => 7, 'value' => 'Con Merken'],
            ['attribute_id' => 7, 'value' => 'Japonés'],
            ['attribute_id' => 7, 'value' => 'Mariposa'],
            ['attribute_id' => 7, 'value' => 'Rubia'],
            ['attribute_id' => 7, 'value' => 'Pop'],
            ['attribute_id' => 7, 'value' => 'Alubia'],
            ['attribute_id' => 7, 'value' => 'Canario'],
            ['attribute_id' => 7, 'value' => 'Hallado'],
            ['attribute_id' => 7, 'value' => 'Tórtola'],
            ['attribute_id' => 7, 'value' => 'Pallar'],
            ['attribute_id' => 7, 'value' => 'Curagua'],
            ['attribute_id' => 7, 'value' => 'Multi Flora'],
            
            // Color (attribute_id: 1)
            ['attribute_id' => 1, 'value' => 'Negro'],
            ['attribute_id' => 1, 'value' => 'Verde'],
            ['attribute_id' => 1, 'value' => 'Blanco'],
            ['attribute_id' => 1, 'value' => 'Rojo'],
            
            // Tipo de Producto (attribute_id: 10)
            ['attribute_id' => 10, 'value' => 'Sin Gluten'],
            ['attribute_id' => 10, 'value' => 'Vegano'],
            ['attribute_id' => 10, 'value' => 'Orgánico'],
            ['attribute_id' => 10, 'value' => 'Sin Sabor'],
            
            // Presentación (attribute_id: 13)
            ['attribute_id' => 13, 'value' => 'Envasadas'],
            ['attribute_id' => 13, 'value' => 'Flor (Impalpable)'],
            ['attribute_id' => 13, 'value' => 'Molido'],
            ['attribute_id' => 13, 'value' => 'Granel'],
            ['attribute_id' => 13, 'value' => 'Deshidratada'],
            ['attribute_id' => 13, 'value' => 'Confitada'],
            
            // Marca (attribute_id: 16)
            ['attribute_id' => 16, 'value' => 'Vergnano'],
            ['attribute_id' => 16, 'value' => 'Gourmet'],
            ['attribute_id' => 16, 'value' => 'Del Jardín'],
            ['attribute_id' => 16, 'value' => 'Rocofrut'],
            ['attribute_id' => 16, 'value' => 'Mayaca'],
            ['attribute_id' => 16, 'value' => 'Kikkoman'],
            ['attribute_id' => 16, 'value' => 'Tabasco'],
        ];

        foreach ($attributes as $attribute) {
            DB::table('attribute_values')->insert([
                'attribute_id' => $attribute['attribute_id'],
                'value' => $attribute['value'], // ← CORRECCIÓN AQUÍ
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}