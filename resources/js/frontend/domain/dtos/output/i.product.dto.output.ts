
// Output de producto (lo que retorna el use-case)
export interface ITraerProductResources {
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

export interface IListaProductosResources {
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

export interface IProductDetailResources {
  product_variant_id: number;
  type_product: string;
  name: string;
  variant: string;
  slug: string;
  sku: string;
  category_id: string,
  category_name: string;
  price: number;
  atributos: string | null;
  is_active: boolean;
  is_featured: boolean;
  stock_status: string;
  is_in_stock: boolean;
  imagen: string | null;
  created_at: string;
}
