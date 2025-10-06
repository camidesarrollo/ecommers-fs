<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductVariantAttributesSeeder extends Seeder
{
    /**
     * Este seeder asume que ProductVariantsSeeder ya fue ejecutado
     * y asigna los atributos correspondientes a cada variante
     */
    public function run(): void
    {
        $now = Carbon::now();
        
        // Helper functions
        $getVariantId = function($sku) {
            return DB::table('product_variants')->where('sku', $sku)->value('id');
        };
        
        $getAttributeValueId = function($value) {
            return DB::table('attribute_values')->where('value', $value)->value('id');
        };

        // Mapeo de SKU => Atributos
        $variantAttributes = [
            // ACEITUNAS
            'ACEIT-AMARGA' => ['Amargas'],
            'ACEIT-ENV-1K-NEG' => ['1 Kilo', 'Envasadas', 'Negras'],
            'ACEIT-ENV-1K-VER' => ['1 Kilo', 'Envasadas', 'Verdes'],
            'ACEIT-JUMBO' => ['Jumbo'],
            'ACEIT-RELLENA' => ['Rellenas'],
            'ACEIT-SUPER' => ['Super'],

            // ALMENDRAS
            'ALM-1ERA' => ['Sin Piel'],
            'ALM-CHOC' => ['Con Chocolate'],
            'ALM-LAM-SP' => ['Laminadas', 'Sin Piel'],

            // AMERICANA
            'AMER-1K' => ['1 Kilo'],
            'AMER-200G' => ['200 Gramos'],

            // ARROZ
            'ARROZ-ARBORIO' => ['Arborio'],
            'ARROZ-BASMA-1K' => ['Basmati', '1 Kilo'],

            // AVELLANAS
            'AVEL-CHILE' => ['Chilena'],
            'AVEL-EUROP' => ['Europea'],

            // AVENA
            'AVEN-INST' => ['Instantánea'],
            'AVEN-INTEG' => ['Integral'],

            // AZÚCAR
            'AZUC-FLOR-K' => ['Flor (Impalpable)', '1 Kilo'],
            'AZUC-CANA' => ['De Caña'],

            // BANANA CHIPS
            'BAN-CHIPS' => [],

            // CAFÉ
            'CAFE-VERG-1K' => ['1 Kilo', 'Vergnano', 'Molido'],

            // CANELA
            'CANE-ENT-100' => ['100 Gramos', 'Entera'],
            'CANE-MOL' => ['Molida'],

            // CARDAMOMO
            'CARD-100G' => ['100 Gramos'],

            // CARNE VEGETAL
            'CARNE-VEG-K' => ['1 Kilo'],

            // CASTAÑA
            'CAST-CAJU' => [],

            // CHIA
            'CHIA-K' => [],

            // CHOCOLATE
            'CHOC-AMARGO' => ['Amargo'],
            'CHOC-DULCE-K' => ['Dulce', '1 Kilo'],
            'CHOC-GRAN-K' => ['Granulado', '1 Kilo'],

            // CHOLITO
            'CHOL-BLAN' => ['Blanco'],
            'CHOL-NEG' => ['Negro'],

            // CHUBI
            'CHUBI-500-MINI' => ['500 Gramos', 'Mini'],

            // CHUCHOCA
            'CHUCH' => [],

            // CHUCRUT
            'CHUC-1K' => ['1 Kilo'],
            'CHUC-200G' => ['200 Gramos'],

            // CIRUELA
            'CIRU-SC' => ['Sin Cuesco'],

            // CLAVO DE OLOR
            'CLAV-ENT-100' => ['100 Gramos', 'Entera'],
            'CLAV-MOL-100' => ['100 Gramos', 'Molida'],

            // COCO
            'COCO-RALL-K' => ['Rallado', '1 Kilo'],

            // CRANBERRY
            'CRAN' => [],
            'CRAN-CHOC' => ['Con Chocolate'],

            // DAMASCO
            'DAMA-TURCO' => ['Turca'],

            // DÁTILES
            'DAT-SC' => ['Sin Cuesco'],

            // DURAZNO
            'DUR-3K-JARD' => ['3 Kilos', 'Del Jardín'],
            'DUR-822G' => ['822 Gramos'],

            // EDULCORANTE
            'EDUL-GOUR' => ['Gourmet'],

            // FLOR DE HIBISCO
            'HIBI-250G' => ['250 Gramos'],

            // FONDO DE ALCACHOFA
            'FOND-ALCA' => [],

            // FRUTA DESHIDRATADA
            'FRUT-DESH-MANGO' => ['Deshidratada'],
            'FRUT-DESH-PINA' => ['Deshidratada'],

            // FRUTA CONFITADA
            'FRUT-CONF-ROCO' => ['Confitada', 'Rocofrut'],

            // GARBANZO
            'GARB-SP' => ['Sin Piel'],

            // GELATINA
            'GEL-SS-500G' => ['500 Gramos', 'Sin Sabor'],
            'GEL-SS-250G' => ['250 Gramos', 'Sin Sabor'],

            // GOJI
            'GOJI' => [],

            // HARINAS
            'HAR-ALM' => [],
            'HAR-COCO' => [],
            'HAR-INTEG' => [],
            'HAR-TOST' => [],

            // HUESILLO
            'HUES-EXTRA' => ['Extra'],
            'HUES-JUMBO' => ['Jumbo'],
            'HUES-MED' => ['Mediano'],

            // LENTEJAS
            'LENT-6MM' => ['6mm'],
            'LENT-BABY' => ['Baby'],
            'LENT-NEG' => ['Negro'],
            'LENT-ROJA' => ['Rojo'],

            // LEVADURA
            'LEV-125G' => ['125 Gramos'],
            'LEV-500G' => ['500 Gramos'],

            // LINAZA
            'LIN-ENT' => ['Entera'],
            'LIN-MOL' => ['Molida'],

            // MAICENA
            'MAIC-1K' => ['1 Kilo'],

            // MAÍZ
            'MAIZ-CURAG' => ['Curagua'],

            // MANÍ
            'MANI-CHOC' => ['Con Chocolate'],
            'MANI-CASC-TOST' => ['Con Cáscara', 'Tostado'],
            'MANI-MERK' => ['Con Merken'],
            'MANI-SAL' => ['Salado'],
            'MANI-SS' => ['Sin Sal'],
            'MANI-CONF' => ['Confitado'],
            'MANI-JAP-GRAN' => ['Japonés', 'Granel'],

            // MARAVILLA
            'MARA-CRUD-CP' => ['Cruda', 'Con Piel'],
            'MARA-CHOC' => ['Con Chocolate'],
            'MARA-PEL' => ['Pelada'],

            // MIEL
            'MIEL-1K-MF' => ['1 Kilo', 'Multi Flora'],

            // MIX FRUTOS SECOS
            'MIX-FS' => [],

            // NUEZ
            'NUEZ-MAR-500G' => ['Mariposa', '500 Gramos'],
            'NUEZ-MOSC-MOL-100' => ['Molida', '100 Gramos'],
            'NUEZ-MOSC-ENT-100' => ['Entera', '100 Gramos'],

            // NUTELLA
            'NUT-350G' => ['350 Gramos'],

            // OLIVA
            'OLIV-500-MAY' => ['500 Gramos', 'Mayaca'],

            // PAPAYAS
            'PAPA' => [],

            // PASAS
            'PASA-NEG' => ['Negro'],
            'PASA-RUB' => ['Rubia'],

            // PEPITAS
            'PEP-CROC' => ['Crocante'],
            'PEP-ZAP' => [],

            // PISTACHO
            'PIST' => [],

            // POLVO DE HORNEAR
            'POLV-1K-GOUR' => ['1 Kilo', 'Gourmet'],

            // POROTOS
            'POR-BLAN-ALU' => ['Blanco', 'Alubia'],
            'POR-CANA' => ['Canario'],
            'POR-HALL' => ['Hallado'],
            'POR-TORT' => ['Tórtola'],
            'POR-NEG' => ['Negro'],
            'POR-PALL' => ['Pallar'],
            'POR-ROJO' => ['Rojo'],

            // QUINOA
            'QUIN-BLAN' => ['Blanco'],
            'QUIN-NEG' => ['Negro'],
            'QUIN-POP' => ['Pop'],
            'QUIN-ROJA' => ['Rojo'],

            // SAL
            'SAL-HIM-1K' => ['Himalaya', '1 Kilo'],

            // SEMILLA MOSTAZA
            'SEM-MOST-250' => ['250 Gramos'],

            // SÉMOLA
            'SEMO' => [],

            // SOYA
            'SOYA-KIK' => ['Kikkoman'],

            // TABASCO
            'TAB-60ML' => ['Tabasco'],

            // TÉ
            'TE-CEY-112' => [],
            'TE-CHIN-VER' => [],
        ];

        $insertedCount = 0;
        $skippedCount = 0;

        foreach ($variantAttributes as $sku => $attributes) {
            $variantId = $getVariantId($sku);
            
            if (!$variantId) {
                echo "⚠️  Variante no encontrada: {$sku}\n";
                $skippedCount++;
                continue;
            }

            foreach ($attributes as $attributeValue) {
                $attributeValueId = $getAttributeValueId($attributeValue);
                
                if (!$attributeValueId) {
                    echo "⚠️  Valor de atributo no encontrado: {$attributeValue} para SKU: {$sku}\n";
                    continue;
                }

                // Verificar si la relación ya existe
                $exists = DB::table('product_variant_attributes')
                    ->where('variant_id', $variantId)
                    ->where('value_id', $attributeValueId)
                    ->exists();

                if (!$exists) {
                    DB::table('product_variant_attributes')->insert([
                        'variant_id' => $variantId,
                        'value_id' => $attributeValueId,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                    $insertedCount++;
                }
            }
        }

        echo "\n✓ Proceso completado:\n";
        echo "  - Relaciones creadas: {$insertedCount}\n";
        echo "  - SKUs no encontrados: {$skippedCount}\n";
    }
}