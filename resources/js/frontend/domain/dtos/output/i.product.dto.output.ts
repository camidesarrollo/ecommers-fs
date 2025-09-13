
// Output de producto (lo que retorna el use-case)
export interface ITraerProductDtoOutput {
  id: number;
  name: string;
  slug: string;
  description?: string;
  shortDescription?: string;
  sku?: string;
  price: number;
  salePrice?: number | null;
  stockQuantity?: number;
  manageStock?: boolean;
  stockStatus?: 'in_stock' | 'out_of_stock';
  images?: string[];
  attributes?: Record<string, any>;
  weight?: number;
  dimensions?: {
    length?: number;
    width?: number;
    height?: number;
  };
  isActive: boolean;
  isFeatured: boolean;
  category_id?: number;
  effectivePrice: number; // viene de la lógica sale_price ?? price
}
