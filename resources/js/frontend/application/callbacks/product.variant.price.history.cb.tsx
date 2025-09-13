// src/application/callbacks/product-variant-price-history.cb.ts
import { ref, Ref } from "vue";
import { 
  traerTodoProductVariantPriceHistoryUseCase, 
  buscarProductVariantPriceHistoryUseCase,
} from "../use-cases/product.variant.price.history.use.case";
import type { IProductVariantPriceHistoryDtoOutput } from "../../domain/dtos/output/i.product.variant.price.history.dto.output";
import type { ISearchProductVariantPriceHistoryDtoInput } from "../../domain/dtos/input/i.product.variant.price.history.dto.input";

export function useProductVariantPriceHistory(): { histories: Ref<IProductVariantPriceHistoryDtoOutput[]>, traerHistories: () => void } {
    const histories = ref<IProductVariantPriceHistoryDtoOutput[]>([]);

    const callbackObtenerHistories = (response: any) => {
        histories.value = response.data ?? [];
    };

    const traerHistories = () => {
        traerTodoProductVariantPriceHistoryUseCase(callbackObtenerHistories);
    };

    return { histories, traerHistories };
}

export function useProductVariantPriceHistorySearch() {
  const histories = ref<IProductVariantPriceHistoryDtoOutput[]>([]);

  const buscarHistories = (filtros: ISearchProductVariantPriceHistoryDtoInput) => {
    return new Promise<IProductVariantPriceHistoryDtoOutput[]>((resolve, reject) => {
      buscarProductVariantPriceHistoryUseCase(filtros, (response: any) => {
        try {
          histories.value = response?.data ?? [];
          resolve(histories.value);
        } catch (error) {
          reject(error);
        }
      });
    });
  };

  return { histories, buscarHistories };
}
