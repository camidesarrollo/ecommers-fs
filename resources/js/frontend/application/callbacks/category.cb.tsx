// src/application/callbacks/category.cb.ts
import { ref, onMounted, Ref } from "vue";
import { allActiveCategoryUseCase } from "../use-cases/category.use.case";
import type { ITraerCategoryDtoOutput } from "../../domain/dtos/output/i.category.dto.output";

export function useCategory(): { categorias: Ref<ITraerCategoryDtoOutput[]> } {
  const categorias = ref<ITraerCategoryDtoOutput[]>([]);

  // Callback para cuando lleguen las categorías
  const CallBackFunctionObtenerCategorias = (data: any) => {
    categorias.value = data.data;
  };

  // Llamada al use-case
  const traerCategory = () => {
    allActiveCategoryUseCase(CallBackFunctionObtenerCategorias);
  };

  // Traer categorías al montar el hook
  onMounted(() => {
    traerCategory();
  });

  return { categorias };
}
