// src/application/callbacks/product.cb.ts
import { ref, Ref } from "vue";
import { traerTodoProductUseCase, buscarProductUseCase } from "../use-cases/product.use.case";
import type { ITraerProductDtoOutput } from "../../domain/dtos/output/i.product.dto.output";
import type { ISearchProductDtoInput } from "../../domain/dtos/input/i.product.dto.input";

export function useProduct(): { productos: Ref<ITraerProductDtoOutput[]>, traerProduct: () => void } {
    const productos = ref<ITraerProductDtoOutput[]>([]);

    const CallBackFunctionObtenerproductos = (response: any) => {
        productos.value = response.data ?? [];
    };

    const traerProduct = () => {
        traerTodoProductUseCase(CallBackFunctionObtenerproductos);
    };

    return { productos, traerProduct };
}

export function useProductSearch() {
  const productos = ref<ITraerProductDtoOutput[]>([]);

  const buscarProduct = (filtros: ISearchProductDtoInput) => {
    return new Promise<ITraerProductDtoOutput[]>((resolve, reject) => {
      // Llamamos al use case y le pasamos el callback
      buscarProductUseCase(filtros, (response: any) => {
        try {
          productos.value = response?.data ?? [];
          resolve(productos.value); // resuelve la promesa cuando llega la respuesta
        } catch (error) {
          reject(error);
        }
      });
    });
  };

  return { productos, buscarProduct };
}

