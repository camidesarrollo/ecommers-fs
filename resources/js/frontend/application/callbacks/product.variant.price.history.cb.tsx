// src/application/callbacks/product-variant-price-history.cb.ts
import { ref, Ref } from "vue";
import { 
  listarProductVariantPriceHistoryUseCase, 
  buscarProductVariantPriceHistoryUseCase,
} from "../use-cases/product.variant.price.history.use.case";
import type { IProductVariantPriceHistoryDtoOutput } from "../../domain/dtos/output/i.product.variant.price.history.dto.output";
import type { ISearchProductVariantPriceHistoryRequest } from "../../domain/dtos/input/i.product.variant.price.history.dto.input";
import { IApiRespuesta } from "../../domain/interfaces/i.apiRespuesta";

export function useProductVariantPriceHistory(): { histories: Ref<IProductVariantPriceHistoryDtoOutput[]>, traerHistories: () => void } {
    const histories = ref<IProductVariantPriceHistoryDtoOutput[]>([]);

    const callbackObtenerHistories = (response: IApiRespuesta) => {
        histories.value = response.data ?? [];
    };

    const traerHistories = () => {
        listarProductVariantPriceHistoryUseCase(callbackObtenerHistories);
    };

    return { histories, traerHistories };
}

export function useProductVariantPriceHistorySearch() {
  const histories = ref<IProductVariantPriceHistoryDtoOutput[]>([]);

  const buscarHistories = (filtros: ISearchProductVariantPriceHistoryRequest) => {
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
