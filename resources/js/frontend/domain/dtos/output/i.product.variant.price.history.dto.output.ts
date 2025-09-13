// i.product.variant.price.history.dto.output.ts

export interface IProductVariantPriceHistoryDtoOutput {
  id: number;
  product_variant_id: number;
  sku?: string;                  // SKU de la variante (si se hace join con product_variants)
  product_name?: string;         // Nombre del producto (si se hace join con lista_productos)
  slug?: string;                 // Slug del producto
  price: number;
  sale_price?: number | null;
  start_date: string;            // fecha inicio vigencia ISO 8601
  end_date?: string | null;      // fecha fin vigencia
  reason?: string;               // motivo del cambio de precio
  created_at: string;
  updated_at: string;
}