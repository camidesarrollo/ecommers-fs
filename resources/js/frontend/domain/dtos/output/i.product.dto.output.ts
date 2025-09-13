
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

export interface IListaProductosDTOOutput {
  id: number | null;
  name: string;
  slug: string;
  description: string | null;
  short_description: string | null;
  sku: string;
  price: number;
  sale_price: number;
  effective_price: string | null;
  stock_quantity: number | null;
  stock_status: 'in_stock' | 'out_of_stock' | null;
  is_in_stock: boolean;
  images: string[] | null; // si manejas múltiples imágenes
  attributes: Record<string, any> | null; // atributos dinámicos
  weight: string | number | null;
  dimensions: string | null;
  is_featured: boolean | number; // según cómo lo guardes en DB
  created_at: string;
  updated_at: string | null;
}
