<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW product_details_view AS
                SELECT 
                    p.name AS typeProduct,
                    CONCAT(
                        p.name, ' ',
                        GROUP_CONCAT(av.value ORDER BY ma.name ASC SEPARATOR ' ')
                    ) AS name,
                    GROUP_CONCAT(av.value ORDER BY ma.name ASC SEPARATOR ' ') AS variant,
                    p.slug AS slug,
                    pv.sku AS sku,
                    c.id AS category_id,
                    c.name AS name_categoria,
                    pv.sale_price AS price,
                    GROUP_CONCAT(av.value ORDER BY ma.name ASC SEPARATOR ' ') AS atributos,
                    p.is_active AS is_active,
                    p.is_featured AS is_featured,
                    pv.stock_status AS stock_status,
                    pv.id AS product_variant_id,
                    vi.url AS imagen,
                    pv.created_at AS created_at
                FROM
                    ecommerce_fs_db.products p
                    JOIN ecommerce_fs_db.categories c 
                        ON p.category_id = c.id
                    JOIN ecommerce_fs_db.product_variants pv 
                        ON pv.product_id = p.id
                    JOIN ecommerce_fs_db.product_variant_attributes pva 
                        ON pva.variant_id = pv.id
                    JOIN ecommerce_fs_db.attribute_values av 
                        ON av.id = pva.value_id
                    JOIN ecommerce_fs_db.master_attributes ma 
                        ON ma.id = av.attribute_id
                    LEFT JOIN ecommerce_fs_db.product_variant_images vi 
                        ON vi.variant_id = pv.id
                        AND vi.is_primary = 1
                        AND vi.url IS NOT NULL
                GROUP BY 
                    p.id, p.name, p.slug, p.is_active, p.is_featured, 
                    c.id, c.name, pv.id, pv.sku, pv.sale_price, 
                    pv.stock_status, vi.url, pv.created_at
                ORDER BY 
                    p.name, pv.id;

        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS product_details_view;");
    }
};
