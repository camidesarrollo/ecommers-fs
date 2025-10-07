// src/application/callbacks/product-variant-price-history.cb.ts
import { ref, Ref } from "vue";
import { 
  listarProductVariantPriceHistoryUseCase, 
  buscarProductVariantPriceHistoryUseCase,
} from "../use-cases/product.variant.price.history.use.case";
import type { IProductVariantPriceHistoryResources } from "../../domain/dtos/output/i.product.variant.price.history.dto.output";
import type { ISearchProductVariantPriceHistoryRequest } from "../../domain/dtos/input/i.product.variant.price.history.dto.input";
import { IApiRespuesta } from "../../domain/interfaces/i.apiRespuesta";

export function useProductVariantPriceHistory(): { histories: Ref<IProductVariantPriceHistoryResources[]>, traerHistories: () => void } {
    const histories = ref<IProductVariantPriceHistoryResources[]>([]);

    const callbackObtenerHistories = (response: IApiRespuesta) => {
        histories.value = response.data ?? [];
    };

    const traerHistories = () => {
        listarProductVariantPriceHistoryUseCase(callbackObtenerHistories);
    };

    return { histories, traerHistories };
}

export function useProductVariantPriceHistorySearch() {
  const histories = ref<IProductVariantPriceHistoryResources[]>([]);

  const buscarHistories = (filtros: ISearchProductVariantPriceHistoryRequest) => {
    return new Promise<IProductVariantPriceHistoryResources[]>((resolve, reject) => {
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
