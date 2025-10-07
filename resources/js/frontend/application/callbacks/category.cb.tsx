// src/application/callbacks/category.cb.ts
import { ref, onMounted, Ref } from "vue";
import { allActiveCategoryUseCase } from "../use-cases/category.use.case";
import type { ITraerCategoryResources } from "../../domain/dtos/output/i.category.dto.output";
import { IApiRespuesta } from "../../domain/interfaces/i.apiRespuesta";

export function useCategory(): { categorias: Ref<ITraerCategoryResources[]> } {
  const categorias = ref<ITraerCategoryResources[]>([]);

  // Callback para cuando lleguen las categorías
  const CallBackFunctionObtenerCategorias = (data: IApiRespuesta) => {
    console.log(data.data);
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
