
// Interface que representa la categoría
export interface ICategory {
  name: string;
  slug: string;
  description?: string;
  image?: string;
  bg_class?: string;
  sort_order?: number;
  is_active: boolean;
  parent_id?: number | null;
}
