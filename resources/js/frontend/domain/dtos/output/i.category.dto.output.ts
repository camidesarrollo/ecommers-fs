// Output de categoría (lo que retorna el use-case)
export interface ITraerCategoryResources {
  id: number;
  name: string;
  slug: string;
  description?: string;
  shortDescription?: string;
  productCount?: string;
  bg_class?: string;
  isNew?: boolean; 
  image?: string;
  bgClass?: string;
  sortOrder?: number;
  isActive: boolean;
  parentId?: number | null;
}
