// Output de categoría (lo que retorna el use-case)
export interface ITraerCategoryDtoOutput {
  id: number;
  name: string;
  slug: string;
  description?: string;
  short_description?: string;
  product_count?: string;
  is_new?: boolean; 
  image?: string;
  bgClass?: string;
  sortOrder?: number;
  isActive: boolean;
  parentId?: number | null;
}
