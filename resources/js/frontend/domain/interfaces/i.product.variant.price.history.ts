// Interface que representa la ProductVariantPriceHistory

export interface IProductVariantPriceHistory {
  id: number;
  product_variant_id: number;
  sku?: string;                  // SKU de la variante
  product_name?: string;         // Nombre del producto
  slug?: string;                 // Slug del producto
  price: number;                 // Precio base
  sale_price?: number | null;    // Precio en oferta, puede ser null
  start_date: string;            // Fecha de inicio de vigencia (ISO 8601)
  end_date?: string | null;      // Fecha de fin de vigencia, puede ser null
  reason?: string;               // Motivo del cambio de precio
  created_at: string;            // Fecha de creación
  updated_at: string;            // Fecha de última actualización
}