<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductsSeeder extends Seeder
{

    public function run(): void
    {
        $products = [
            "ACEITUNA",
            "ALMENDRA",
            "AMERICANA",
            "ARROZ",
            "AVELLANA",
            "AVENA",
            "AZUCAR",
            "BANANA CHIPS",
            "CAFE",
            "CANELA",
            "CARDAMOMO",
            "CARNE VEGETAL",
            "CASTAÑA CAJU",
            "CHIA KILO",
            "CHOCOLATE",
            "CHOLITO",
            "CHUBI",
            "CHUCHOCA",
            "CHUCRUT",
            "CIRUELA",
            "CLAVO OLOR",
            "CLAVO OLOR MOLIDO",
            "COCO RALLADO",
            "CRANBERRY",
            "DAMASCO TURCO",
            "DATILES",
            "DURANZO",
            "EDULZOR",
            "FLOR DE HIBISCO",
            "FONDO DE ALCACHOFA",
            "FRUTA DESHIDRATADA",
            "FRUTA CONFITADA ROCOFRUT",
            "GARBANZO",
            "GELATINA",
            "GOJI",
            "HARINA ALMENDRA",
            "HARINA DE COCO",
            "HARINA INTEGRAL",
            "HARINA TOSTADA",
            "HUESILLO",
            "LENTEJA",
            "LEVADURA",
            "LINAZA",
            "MAICENA",
            "MAIZ",
            "MANI",
            "MARAVILLA",
            "MIEL",
            "MIX FRUTOS SECOS",
            "NUEZ",
            "NUEZ MOSCADA",
            "NUTELA",
            "OLIVA",
            "PAPAYAS",
            "PASA",
            "PEPITA CROCANTE",
            "PEPITA ZAPALLO",
            "PISTACHO",
            "POLVO DE HORNEAR",
            "POROTO",
            "QUINOA",
            "SAL",
            "SEMILLA MOSTAZA",
            "SEMOLA",
            "SOYA",
            "TABASCO",
            "TE CEYLAN",
            "TE CHINO VERDE",
        ];

        $categoryKeywords = [
            "Aceitunas y Olivas" => ["ACEITUNA", "OLIVA"],
            "Café, Té y Especias" => ["CAFE", "TE", "CANELA", "CARDAMOMO", "CLAVO"],
            "Cereales y Legumbres" => ["ARROZ", "AVENA", "GARBANZO", "LENTEJA", "MAIZ", "POROTO", "SOYA", "QUINOA"],
            "Chocolates y Dulces" => ["CHOCOLATE", "CHUBI", "CHUCHOCA", "CHOLITO", "NUTELA", "EDULZOR"],
            "Conservas y Vegetales" => ["CARNE VEGETAL", "CHUCRUT", "FONDO DE ALCACHOFA"],
            "Frutas Deshidratadas" => ["FRUTA DESHIDRATADA", "FRUTA CONFITADA", "DAMASCO", "PAPAYAS", "PASA", "CIRUELA", "HUESILLO"],
            "Frutos Secos" => ["ALMENDRA", "AVELLANA", "CASTAÑA", "MANI", "MARAVILLA", "PISTACHO", "MIX FRUTOS SECOS", "NUEZ"],
            "Harinas y Preparación" => ["HARINA", "MAICENA", "POLVO DE HORNEAR", "SEMOLA", "LEVADURA"],
            "Snacks y Otros" => ["BANANA CHIPS", "TABASCO", "FLOR DE HIBISCO", "CHIA", "SEMILLA MOSTAZA"],
        ];

        $now = Carbon::now();

        foreach ($products as $product) {
            $formattedName = ucwords(strtolower($product)); // Capitaliza cada palabra

            $categoryId = 1; // Default
            foreach ($categoryKeywords as $categoryName => $keywords) {
                foreach ($keywords as $keyword) {
                    if (stripos($product, $keyword) !== false) { // si el producto contiene la keyword
                        $categoryId = DB::table('categories')->where('name', $categoryName)->value('id');
                        break 2; // sale de ambos foreach
                    }
                }
            }

            DB::table('products')->insert([
                'name' => $formattedName,
                'slug' => Str::slug($formattedName),
                'description' => null,
                'short_description' => null,
                'is_active' => true,
                'is_featured' => false,
                'category_id' => $categoryId,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
