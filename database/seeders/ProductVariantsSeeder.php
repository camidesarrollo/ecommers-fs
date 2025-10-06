<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductVariantsSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        
        // Helper functions
        $getProductId = function($name) {
            return DB::table('products')->where('name', 'like', "%{$name}%")->value('id');
        };
        
        $getAttributeValueId = function($value) {
            return DB::table('attribute_values')->where('value', $value)->value('id');
        };

        // Definir variantes para cada producto
        $variants = [
            // ACEITUNAS
            ['product' => 'Aceituna', 'sku' => 'ACEIT-AMARGA', 'price' => 8500, 'stock' => 50, 'attributes' => ['Amargas']],
            ['product' => 'Aceituna', 'sku' => 'ACEIT-ENV-1K-NEG', 'price' => 9500, 'stock' => 30, 'attributes' => ['1 Kilo', 'Envasadas', 'Negras']],
            ['product' => 'Aceituna', 'sku' => 'ACEIT-ENV-1K-VER', 'price' => 9500, 'stock' => 30, 'attributes' => ['1 Kilo', 'Envasadas', 'Verdes']],
            ['product' => 'Aceituna', 'sku' => 'ACEIT-JUMBO', 'price' => 10500, 'stock' => 25, 'attributes' => ['Jumbo']],
            ['product' => 'Aceituna', 'sku' => 'ACEIT-RELLENA', 'price' => 11000, 'stock' => 20, 'attributes' => ['Rellenas']],
            ['product' => 'Aceituna', 'sku' => 'ACEIT-SUPER', 'price' => 9800, 'stock' => 35, 'attributes' => ['Super']],

            // ALMENDRAS
            ['product' => 'Almendra', 'sku' => 'ALM-1ERA', 'price' => 12000, 'stock' => 40, 'attributes' => ['Sin Piel']],
            ['product' => 'Almendra', 'sku' => 'ALM-CHOC', 'price' => 14500, 'stock' => 30, 'attributes' => ['Con Chocolate']],
            ['product' => 'Almendra', 'sku' => 'ALM-LAM-SP', 'price' => 13500, 'stock' => 25, 'attributes' => ['Laminadas', 'Sin Piel']],

            // AMERICANA
            ['product' => 'Americana', 'sku' => 'AMER-1K', 'price' => 7500, 'stock' => 50, 'attributes' => ['1 Kilo']],
            ['product' => 'Americana', 'sku' => 'AMER-200G', 'price' => 2000, 'stock' => 80, 'attributes' => ['200 Gramos']],

            // ARROZ
            ['product' => 'Arroz', 'sku' => 'ARROZ-ARBORIO', 'price' => 4500, 'stock' => 60, 'attributes' => ['Arborio']],
            ['product' => 'Arroz', 'sku' => 'ARROZ-BASMA-1K', 'price' => 5200, 'stock' => 45, 'attributes' => ['Basmati', '1 Kilo']],

            // AVELLANAS
            ['product' => 'Avellana', 'sku' => 'AVEL-CHILE', 'price' => 15000, 'stock' => 20, 'attributes' => ['Chilena']],
            ['product' => 'Avellana', 'sku' => 'AVEL-EUROP', 'price' => 17500, 'stock' => 15, 'attributes' => ['Europea']],

            // AVENA
            ['product' => 'Avena', 'sku' => 'AVEN-INST', 'price' => 3200, 'stock' => 70, 'attributes' => ['Instantánea']],
            ['product' => 'Avena', 'sku' => 'AVEN-INTEG', 'price' => 3500, 'stock' => 65, 'attributes' => ['Integral']],

            // AZÚCAR
            ['product' => 'Azucar', 'sku' => 'AZUC-FLOR-K', 'price' => 2800, 'stock' => 100, 'attributes' => ['Flor (Impalpable)', '1 Kilo']],
            ['product' => 'Azucar', 'sku' => 'AZUC-CANA', 'price' => 3200, 'stock' => 80, 'attributes' => ['De Caña']],

            // BANANA CHIPS
            ['product' => 'Banana Chips', 'sku' => 'BAN-CHIPS', 'price' => 5500, 'stock' => 40, 'attributes' => []],

            // CAFÉ
            ['product' => 'Cafe', 'sku' => 'CAFE-VERG-1K', 'price' => 18500, 'stock' => 30, 'attributes' => ['1 Kilo', 'Vergnano', 'Molido']],

            // CANELA
            ['product' => 'Canela', 'sku' => 'CANE-ENT-100', 'price' => 2500, 'stock' => 50, 'attributes' => ['100 Gramos', 'Entera']],
            ['product' => 'Canela', 'sku' => 'CANE-MOL', 'price' => 2200, 'stock' => 60, 'attributes' => ['Molida']],

            // CARDAMOMO
            ['product' => 'Cardamomo', 'sku' => 'CARD-100G', 'price' => 8500, 'stock' => 20, 'attributes' => ['100 Gramos']],

            // CARNE VEGETAL
            ['product' => 'Carne Vegetal', 'sku' => 'CARNE-VEG-K', 'price' => 12000, 'stock' => 25, 'attributes' => ['1 Kilo']],

            // CASTAÑA
            ['product' => 'Castaña Caju', 'sku' => 'CAST-CAJU', 'price' => 16500, 'stock' => 30, 'attributes' => []],

            // CHIA
            ['product' => 'Chia Kilo', 'sku' => 'CHIA-K', 'price' => 7800, 'stock' => 55, 'attributes' => []],

            // CHOCOLATE
            ['product' => 'Chocolate', 'sku' => 'CHOC-AMARGO', 'price' => 9500, 'stock' => 40, 'attributes' => ['Amargo']],
            ['product' => 'Chocolate', 'sku' => 'CHOC-DULCE-K', 'price' => 8900, 'stock' => 45, 'attributes' => ['Dulce', '1 Kilo']],
            ['product' => 'Chocolate', 'sku' => 'CHOC-GRAN-K', 'price' => 9200, 'stock' => 35, 'attributes' => ['Granulado', '1 Kilo']],

            // CHOLITO
            ['product' => 'Cholito', 'sku' => 'CHOL-BLAN', 'price' => 4500, 'stock' => 50, 'attributes' => ['Blanco']],
            ['product' => 'Cholito', 'sku' => 'CHOL-NEG', 'price' => 4500, 'stock' => 50, 'attributes' => ['Negro']],

            // CHUBI
            ['product' => 'Chubi', 'sku' => 'CHUBI-500-MINI', 'price' => 6500, 'stock' => 30, 'attributes' => ['500 Gramos', 'Mini']],

            // CHUCHOCA
            ['product' => 'Chuchoca', 'sku' => 'CHUCH', 'price' => 3200, 'stock' => 40, 'attributes' => []],

            // CHUCRUT
            ['product' => 'Chucrut', 'sku' => 'CHUC-1K', 'price' => 5500, 'stock' => 30, 'attributes' => ['1 Kilo']],
            ['product' => 'Chucrut', 'sku' => 'CHUC-200G', 'price' => 1500, 'stock' => 50, 'attributes' => ['200 Gramos']],

            // CIRUELA
            ['product' => 'Ciruela', 'sku' => 'CIRU-SC', 'price' => 7500, 'stock' => 35, 'attributes' => ['Sin Cuesco']],

            // CLAVO DE OLOR
            ['product' => 'Clavo Olor', 'sku' => 'CLAV-ENT-100', 'price' => 3500, 'stock' => 40, 'attributes' => ['100 Gramos', 'Entera']],
            ['product' => 'Clavo Olor Molido', 'sku' => 'CLAV-MOL-100', 'price' => 3200, 'stock' => 45, 'attributes' => ['100 Gramos', 'Molida']],

            // COCO
            ['product' => 'Coco Rallado', 'sku' => 'COCO-RALL-K', 'price' => 8500, 'stock' => 50, 'attributes' => ['Rallado', '1 Kilo']],

            // CRANBERRY
            ['product' => 'Cranberry', 'sku' => 'CRAN', 'price' => 9800, 'stock' => 40, 'attributes' => []],
            ['product' => 'Cranberry', 'sku' => 'CRAN-CHOC', 'price' => 11500, 'stock' => 30, 'attributes' => ['Con Chocolate']],

            // DAMASCO
            ['product' => 'Damasco Turco', 'sku' => 'DAMA-TURCO', 'price' => 11000, 'stock' => 25, 'attributes' => ['Turca']],

            // DÁTILES
            ['product' => 'Datiles', 'sku' => 'DAT-SC', 'price' => 10500, 'stock' => 30, 'attributes' => ['Sin Cuesco']],

            // DURAZNO
            ['product' => 'Duranzo', 'sku' => 'DUR-3K-JARD', 'price' => 15500, 'stock' => 20, 'attributes' => ['3 Kilos', 'Del Jardín']],
            ['product' => 'Duranzo', 'sku' => 'DUR-822G', 'price' => 5500, 'stock' => 35, 'attributes' => ['822 Gramos']],

            // EDULCORANTE
            ['product' => 'Edulzor', 'sku' => 'EDUL-GOUR', 'price' => 6500, 'stock' => 40, 'attributes' => ['Gourmet']],

            // FLOR DE HIBISCO
            ['product' => 'Flor De Hibisco', 'sku' => 'HIBI-250G', 'price' => 4500, 'stock' => 30, 'attributes' => ['250 Gramos']],

            // FONDO DE ALCACHOFA
            ['product' => 'Fondo De Alcachofa', 'sku' => 'FOND-ALCA', 'price' => 8500, 'stock' => 25, 'attributes' => []],

            // FRUTA DESHIDRATADA
            ['product' => 'Fruta Deshidratada', 'sku' => 'FRUT-DESH-MANGO', 'price' => 8900, 'stock' => 30, 'attributes' => ['Deshidratada']],
            ['product' => 'Fruta Deshidratada', 'sku' => 'FRUT-DESH-PINA', 'price' => 8900, 'stock' => 30, 'attributes' => ['Deshidratada']],

            // FRUTA CONFITADA
            ['product' => 'Fruta Confitada Rocofrut', 'sku' => 'FRUT-CONF-ROCO', 'price' => 7500, 'stock' => 35, 'attributes' => ['Confitada', 'Rocofrut']],

            // GARBANZO
            ['product' => 'Garbanzo', 'sku' => 'GARB-SP', 'price' => 4200, 'stock' => 60, 'attributes' => ['Sin Piel']],

            // GELATINA
            ['product' => 'Gelatina', 'sku' => 'GEL-SS-500G', 'price' => 6500, 'stock' => 40, 'attributes' => ['500 Gramos', 'Sin Sabor']],
            ['product' => 'Gelatina', 'sku' => 'GEL-SS-250G', 'price' => 3500, 'stock' => 50, 'attributes' => ['250 Gramos', 'Sin Sabor']],

            // GOJI
            ['product' => 'Goji', 'sku' => 'GOJI', 'price' => 14500, 'stock' => 20, 'attributes' => []],

            // HARINAS
            ['product' => 'Harina Almendra', 'sku' => 'HAR-ALM', 'price' => 12500, 'stock' => 30, 'attributes' => []],
            ['product' => 'Harina De Coco', 'sku' => 'HAR-COCO', 'price' => 9800, 'stock' => 25, 'attributes' => []],
            ['product' => 'Harina Integral', 'sku' => 'HAR-INTEG', 'price' => 2500, 'stock' => 80, 'attributes' => []],
            ['product' => 'Harina Tostada', 'sku' => 'HAR-TOST', 'price' => 2800, 'stock' => 70, 'attributes' => []],

            // HUESILLO
            ['product' => 'Huesillo', 'sku' => 'HUES-EXTRA', 'price' => 6500, 'stock' => 40, 'attributes' => ['Extra']],
            ['product' => 'Huesillo', 'sku' => 'HUES-JUMBO', 'price' => 7200, 'stock' => 35, 'attributes' => ['Jumbo']],
            ['product' => 'Huesillo', 'sku' => 'HUES-MED', 'price' => 5800, 'stock' => 45, 'attributes' => ['Mediano']],

            // LENTEJAS
            ['product' => 'Lenteja', 'sku' => 'LENT-6MM', 'price' => 3800, 'stock' => 60, 'attributes' => ['6mm']],
            ['product' => 'Lenteja', 'sku' => 'LENT-BABY', 'price' => 4200, 'stock' => 50, 'attributes' => ['Baby']],
            ['product' => 'Lenteja', 'sku' => 'LENT-NEG', 'price' => 4500, 'stock' => 40, 'attributes' => ['Negro']],
            ['product' => 'Lenteja', 'sku' => 'LENT-ROJA', 'price' => 4500, 'stock' => 40, 'attributes' => ['Rojo']],

            // LEVADURA
            ['product' => 'Levadura', 'sku' => 'LEV-125G', 'price' => 1800, 'stock' => 80, 'attributes' => ['125 Gramos']],
            ['product' => 'Levadura', 'sku' => 'LEV-500G', 'price' => 5500, 'stock' => 50, 'attributes' => ['500 Gramos']],

            // LINAZA
            ['product' => 'Linaza', 'sku' => 'LIN-ENT', 'price' => 3200, 'stock' => 60, 'attributes' => ['Entera']],
            ['product' => 'Linaza', 'sku' => 'LIN-MOL', 'price' => 3500, 'stock' => 55, 'attributes' => ['Molida']],

            // MAICENA
            ['product' => 'Maicena', 'sku' => 'MAIC-1K', 'price' => 2800, 'stock' => 70, 'attributes' => ['1 Kilo']],

            // MAÍZ
            ['product' => 'Maiz', 'sku' => 'MAIZ-CURAG', 'price' => 4200, 'stock' => 50, 'attributes' => ['Curagua']],

            // MANÍ
            ['product' => 'Mani', 'sku' => 'MANI-CHOC', 'price' => 7500, 'stock' => 40, 'attributes' => ['Con Chocolate']],
            ['product' => 'Mani', 'sku' => 'MANI-CASC-TOST', 'price' => 5500, 'stock' => 50, 'attributes' => ['Con Cáscara', 'Tostado']],
            ['product' => 'Mani', 'sku' => 'MANI-MERK', 'price' => 6800, 'stock' => 35, 'attributes' => ['Con Merken']],
            ['product' => 'Mani', 'sku' => 'MANI-SAL', 'price' => 5200, 'stock' => 60, 'attributes' => ['Salado']],
            ['product' => 'Mani', 'sku' => 'MANI-SS', 'price' => 4800, 'stock' => 60, 'attributes' => ['Sin Sal']],
            ['product' => 'Mani', 'sku' => 'MANI-CONF', 'price' => 6200, 'stock' => 45, 'attributes' => ['Confitado']],
            ['product' => 'Mani', 'sku' => 'MANI-JAP-GRAN', 'price' => 5800, 'stock' => 50, 'attributes' => ['Japonés', 'Granel']],

            // MARAVILLA
            ['product' => 'Maravilla', 'sku' => 'MARA-CRUD-CP', 'price' => 3500, 'stock' => 70, 'attributes' => ['Cruda', 'Con Piel']],
            ['product' => 'Maravilla', 'sku' => 'MARA-CHOC', 'price' => 5200, 'stock' => 40, 'attributes' => ['Con Chocolate']],
            ['product' => 'Maravilla', 'sku' => 'MARA-PEL', 'price' => 4200, 'stock' => 60, 'attributes' => ['Pelada']],

            // MIEL
            ['product' => 'Miel', 'sku' => 'MIEL-1K-MF', 'price' => 8500, 'stock' => 35, 'attributes' => ['1 Kilo', 'Multi Flora']],

            // MIX FRUTOS SECOS
            ['product' => 'Mix Frutos Secos', 'sku' => 'MIX-FS', 'price' => 9800, 'stock' => 40, 'attributes' => []],

            // NUEZ
            ['product' => 'Nuez', 'sku' => 'NUEZ-MAR-500G', 'price' => 11500, 'stock' => 30, 'attributes' => ['Entera', 'Mariposa', '500 Gramos']],
            ['product' => 'Nuez Moscada', 'sku' => 'NUEZ-MOSC-MOL-100', 'price' => 4500, 'stock' => 40, 'attributes' => ['Molida', '100 Gramos']],
            ['product' => 'Nuez Moscada', 'sku' => 'NUEZ-MOSC-ENT-100', 'price' => 4200, 'stock' => 40, 'attributes' => ['Entera', '100 Gramos']],

            // NUTELLA
            ['product' => 'Nutela', 'sku' => 'NUT-350G', 'price' => 6500, 'stock' => 50, 'attributes' => ['350 Gramos']],

            // OLIVA
            ['product' => 'Oliva', 'sku' => 'OLIV-500-MAY', 'price' => 7500, 'stock' => 40, 'attributes' => ['500 Gramos', 'Mayaca']],

            // PAPAYAS
            ['product' => 'Papayas', 'sku' => 'PAPA', 'price' => 8200, 'stock' => 30, 'attributes' => []],

            // PASAS
            ['product' => 'Pasa', 'sku' => 'PASA-NEG', 'price' => 5500, 'stock' => 50, 'attributes' => ['Negro']],
            ['product' => 'Pasa', 'sku' => 'PASA-RUB', 'price' => 6200, 'stock' => 45, 'attributes' => ['Rubia']],

            // PEPITAS
            ['product' => 'Pepita Crocante', 'sku' => 'PEP-CROC', 'price' => 4500, 'stock' => 50, 'attributes' => ['Crocante']],
            ['product' => 'Pepita Zapallo', 'sku' => 'PEP-ZAP', 'price' => 5200, 'stock' => 45, 'attributes' => []],

            // PISTACHO
            ['product' => 'Pistacho', 'sku' => 'PIST', 'price' => 18500, 'stock' => 20, 'attributes' => []],

            // POLVO DE HORNEAR
            ['product' => 'Polvo De Hornear', 'sku' => 'POLV-1K-GOUR', 'price' => 5500, 'stock' => 50, 'attributes' => ['1 Kilo', 'Gourmet']],

            // POROTOS
            ['product' => 'Poroto', 'sku' => 'POR-BLAN-ALU', 'price' => 3800, 'stock' => 60, 'attributes' => ['Blanco', 'Alubia']],
            ['product' => 'Poroto', 'sku' => 'POR-CANA', 'price' => 3500, 'stock' => 65, 'attributes' => ['Canario']],
            ['product' => 'Poroto', 'sku' => 'POR-HALL', 'price' => 3800, 'stock' => 60, 'attributes' => ['Hallado']],
            ['product' => 'Poroto', 'sku' => 'POR-TORT', 'price' => 3600, 'stock' => 60, 'attributes' => ['Tórtola']],
            ['product' => 'Poroto', 'sku' => 'POR-NEG', 'price' => 3900, 'stock' => 55, 'attributes' => ['Negro']],
            ['product' => 'Poroto', 'sku' => 'POR-PALL', 'price' => 4500, 'stock' => 45, 'attributes' => ['Pallar']],
            ['product' => 'Poroto', 'sku' => 'POR-ROJO', 'price' => 3700, 'stock' => 60, 'attributes' => ['Rojo']],

            // QUINOA
            ['product' => 'Quinoa', 'sku' => 'QUIN-BLAN', 'price' => 6500, 'stock' => 50, 'attributes' => ['Blanco']],
            ['product' => 'Quinoa', 'sku' => 'QUIN-NEG', 'price' => 7200, 'stock' => 40, 'attributes' => ['Negro']],
            ['product' => 'Quinoa', 'sku' => 'QUIN-POP', 'price' => 7800, 'stock' => 35, 'attributes' => ['Pop']],
            ['product' => 'Quinoa', 'sku' => 'QUIN-ROJA', 'price' => 6800, 'stock' => 45, 'attributes' => ['Rojo']],

            // SAL
            ['product' => 'Sal', 'sku' => 'SAL-HIM-1K', 'price' => 4500, 'stock' => 60, 'attributes' => ['Himalaya', '1 Kilo']],

            // SEMILLA MOSTAZA
            ['product' => 'Semilla Mostaza', 'sku' => 'SEM-MOST-250', 'price' => 3500, 'stock' => 40, 'attributes' => ['250 Gramos']],

            // SÉMOLA
            ['product' => 'Semola', 'sku' => 'SEMO', 'price' => 2800, 'stock' => 70, 'attributes' => []],

            // SOYA
            ['product' => 'Soya', 'sku' => 'SOYA-KIK', 'price' => 5500, 'stock' => 50, 'attributes' => ['Kikkoman']],

            // TABASCO
            ['product' => 'Tabasco', 'sku' => 'TAB-60ML', 'price' => 4500, 'stock' => 60, 'attributes' => ['Tabasco']],

            // TÉ
            ['product' => 'Te Ceylan', 'sku' => 'TE-CEY-112', 'price' => 3800, 'stock' => 50, 'attributes' => []],
            ['product' => 'Te Chino Verde', 'sku' => 'TE-CHIN-VER', 'price' => 4200, 'stock' => 45, 'attributes' => []],
        ];

        foreach ($variants as $variantData) {
            $productId = $getProductId($variantData['product']);
            
            if (!$productId) {
                echo "Producto no encontrado: {$variantData['product']}\n";
                continue;
            }

            // Insertar variante
            $variantId = DB::table('product_variants')->insertGetId([
                'product_id' => $productId,
                'sku' => $variantData['sku'],
                'price' => $variantData['price'],
                'sale_price' => null,
                'stock_quantity' => $variantData['stock'],
                'manage_stock' => true,
                'stock_status' => $variantData['stock'] > 0 ? 'in_stock' : 'out_of_stock',
                'weight' => null,
                'dimensions' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            // Insertar atributos de la variante
            foreach ($variantData['attributes'] as $attributeValue) {
                $attributeValueId = $getAttributeValueId($attributeValue);
                
                if ($attributeValueId) {
                    DB::table('product_variant_attributes')->insert([
                        'variant_id' => $variantId,
                        'value_id' => $attributeValueId,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }
        }

        echo "✓ Se han creado " . count($variants) . " variantes de productos\n";
    }
}