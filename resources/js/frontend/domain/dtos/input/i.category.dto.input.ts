// Input para crear o actualizar categoría
export interface ISetCategoryDtoInput {
  name: string;
  slug?: string;            // opcional si se genera automáticamente
  description?: string;
  image?: string;           // URL o ruta de la imagen
  bg_class?: string;        // clase CSS para fondo
  sort_order?: number;      // orden de visualización
  is_active?: boolean;      // activo o inactivo
  parent_id?: number | null; // si tiene categoría padre
}

// Input para buscar categorías (filtros)
export interface ISearchCategoryDtoInput {
  name?: string;
  slug?: string;
  is_active?: boolean;
  parent_id?: number | null;
  limit?: number;           // cantidad de resultados
  offset?: number;          // para paginación
}

// Input para traer una categoría específica
export interface ITraerCategoryDtoInput {
  id: number;
}

// Input para acciones generales (activar/desactivar, eliminar, etc.)
export interface IActionCategoryDtoInput {
  id: number;
  action: 'activate' | 'deactivate' | 'delete';
}

