// Input para crear o actualizar historial de precio de variante
export interface ISetProductVariantPriceHistoryDtoInput {
  product_variant_id: number;       // ID de la variante del producto
  price: number;                    // precio normal
  sale_price?: number | null;       // precio de oferta, opcional
  start_date: string;               // fecha de inicio de vigencia (ISO 8601)
  end_date?: string | null;         // fecha fin de vigencia, opcional
  reason?: string;                  // motivo de cambio de precio
}

// Input para buscar historial de precios (filtros)
export interface ISearchProductVariantPriceHistoryDtoInput {
  id?: number;
  productVariantId?: number;
  minPrice?: number;
  maxPrice?: number;
  minSalePrice?: number;
  maxSalePrice?: number;
  startDateFrom?: string;
  startDateTo?: string;
  endDateFrom?: string;
  endDateTo?: string;
  reason?: string;
  perPage?: number;                 // opcional para paginación
}

// Input para traer un historial específico
export interface ITraerProductVariantPriceHistoryDtoInput {
  id: number;
}

// Input para acciones generales (activar/desactivar, eliminar, etc.)
export interface IActionProductVariantPriceHistoryDtoInput {
  id: number;
  action: 'delete';                 // generalmente solo delete para historial
}
