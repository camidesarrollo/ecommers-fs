// Input para crear o actualizar producto
export interface ISetProductDtoInput {
  name: string;
  slug?: string;
  description?: string;
  short_description?: string;
  sku?: string;
  price: number;
  sale_price?: number | null;   // puede ser null si no hay oferta
  stock_quantity?: number;
  manage_stock?: boolean;       // true = controlar stock
  stock_status?: 'in_stock' | 'out_of_stock';
  images?: string[];            // lista de URLs de imágenes
  attributes?: Record<string, any>; // atributos dinámicos (ej: talla, color)
  weight?: number;
  dimensions?: {
    length?: number;
    width?: number;
    height?: number;
  };
  is_active?: boolean;
  is_featured?: boolean;
  category_id?: number;
}

// Input para buscar productos (filtros)
export interface ISearchProductDtoInput {
  search?: string;
  category_id?: number;
  isActive?: boolean;
  isFeatured?: boolean;
  minPrice?: number;
  maxPrice?: number;
  stockStatus?: 'in_stock' | 'out_of_stock';
  orderBy?: string;
  orderDirection?: 'asc' | 'desc';
  perPage?: number; // puedes dar un valor por defecto al usarlo en la función, no en la interfaz
}


// Input para traer un producto específico
export interface ITraerProductDtoInput {
  id: number;
}

// Input para acciones generales (activar/desactivar, eliminar, etc.)
export interface IActionProductDtoInput {
  id: number;
  action: 'activate' | 'deactivate' | 'delete';
}
