<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            "Aceitunas y Olivas" => "bg-gradient-to-br from-lime-yellow to-magenta-strong",
            "Café, Té y Especias" => "bg-gradient-to-br from-dark-chocolate to-nut-brown",
            "Cereales y Legumbres" => "bg-gradient-to-br from-golden-yellow to-beige",
            "Chocolates y Dulces" => "bg-gradient-to-br from-nut-brown to-dark-chocolate",
            "Conservas y Vegetales" => "bg-gradient-to-br from-olive-green to-mint-green",
            "Frutas Deshidratadas" => "bg-gradient-to-br from-burgundy-red to-orange-warm",
            "Frutos Secos" => "bg-gradient-to-br from-nut-brown to-golden-yellow",
            "Harinas y Preparación" => "bg-gradient-to-br from-beige to-golden-yellow",
            "Snacks y Otros" => "bg-gradient-to-br from-orange-warm to-burgundy-red",
            // "Semillas y Granos" => "bg-gradient-to-br from-golden-yellow to-nut-brown",
            // "Condimentos y Salsas" => "bg-gradient-to-br from-burgundy-red to-olive-green",
            // "Productos Orgánicos" => "bg-gradient-to-br from-mint-green to-olive-green",
            // "Bebidas Naturales" => "bg-gradient-to-br from-mint-green to-beige",
            // "Superfoods" => "bg-gradient-to-br from-burgundy-red to-golden-yellow",
            // "Productos Sin Gluten" => "bg-gradient-to-br from-beige to-mint-green",
            // "Endulzantes Naturales" => "bg-gradient-to-br from-golden-yellow to-orange-warm",
            // "Aceites y Vinagres" => "bg-gradient-to-br from-olive-green to-golden-yellow",
        ];

        foreach ($categories as $name => $bg_class) {
            DB::table('categories')->insert([
                'name' => $name,
                'slug' => Str::slug($name),
                'bg_class' => $bg_class,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
                'image' => 'img\\Categorias\\' . $name . '.JPG'
            ]);
        }
    }
}
