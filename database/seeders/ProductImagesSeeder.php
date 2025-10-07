<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductImagesSeeder extends Seeder
{
    public function run()
    {
        $products = DB::select("
            SELECT 
                pv.id,
                p.name AS typeProduct,
                CONCAT(
                    p.name, ' ',
                    GROUP_CONCAT(av.value ORDER BY ma.name ASC SEPARATOR ' ')
                ) AS name,
                pv.sku AS sku,
                pv.created_at AS created_at
            FROM
                ecommerce_fs_db.products p
                JOIN ecommerce_fs_db.product_variants pv ON pv.product_id = p.id
                JOIN ecommerce_fs_db.product_variant_attributes pva ON pva.variant_id = pv.id
                JOIN ecommerce_fs_db.attribute_values av ON av.id = pva.value_id
                JOIN ecommerce_fs_db.master_attributes ma ON ma.id = av.attribute_id
            GROUP BY p.id, p.name, pv.id, pv.sku, pv.created_at
            ORDER BY p.name, pv.id;
        ");

        $basePath = public_path('img/Productos');
        $allowedExtensions = ['jpeg', 'jpg', 'png', 'webp'];

        foreach ($products as $product) {
            $skuFolder = $basePath . DIRECTORY_SEPARATOR . $product->sku;
            if (!file_exists($skuFolder)) {
                mkdir($skuFolder, 0777, true);
            }

            $cleanName = Str::slug($product->name, ' ');

            // Buscar archivo existente con alguna extensión válida
            $foundFile = null;
            foreach ($allowedExtensions as $ext) {
                $path = $skuFolder . DIRECTORY_SEPARATOR . "{$cleanName}.{$ext}";
                if (file_exists($path)) {
                    $foundFile = $path;
                    break;
                }
            }

            // Si no existe ningún archivo, crea uno vacío .jpeg
            if (!$foundFile) {
                $foundFile = $skuFolder . DIRECTORY_SEPARATOR . "{$cleanName}.jpeg";
                file_put_contents($foundFile, '');
            }

            // 🔧 Normalizar la ruta (para que quede siempre relativa y con "/")
            $normalizedFile = str_replace('\\', '/', $foundFile);
            $normalizedPublic = str_replace('\\', '/', public_path());
            $relativePath = str_replace($normalizedPublic . '/', '', $normalizedFile);

            // Guardar en la base de datos
            DB::table('product_variant_images')->insertOrIgnore([
                'variant_id' => $product->id,
                'url' => $relativePath,
                'is_primary' => 1,
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        echo "✅ Seeder ejecutado correctamente: rutas normalizadas.\n";
    }
}
