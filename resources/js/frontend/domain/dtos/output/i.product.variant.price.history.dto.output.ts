// i.product.variant.price.history.dto.output.ts

export interface IProductVariantPriceHistoryResources {
  id: number;
  product_variant_id: number;
  sku?: string;                  // SKU de la variante (si se hace join con product_variants)
  name?: string;         // Nombre del producto (si se hace join con lista_productos)
  slug?: string;                 // Slug del producto
  price: number;
  sale_price?: number | 0;
  start_date: Date;              // fecha inicio vigencia
  end_date?: Date | null;        // fecha fin vigencia
  reason?: string;               // motivo del cambio de precio
  created_at: string;
  updated_at: string;
  typeProduct: string; //Tipo de producto
  variant: string //Variante
  imagen: string,
  stock_status: string,
  stock_quantity: string, 
}
