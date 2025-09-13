// Output de categoría (lo que retorna el use-case)
export interface ITraerCategoryDtoOutput {
  id: number;
  name: string;
  slug: string;
  description?: string;
  image?: string;
  bgClass?: string;
  sortOrder?: number;
  isActive: boolean;
  parentId?: number | null;
}
