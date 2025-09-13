import { AxiosResponse } from "axios";
import { IConfigType } from "../../domain/interfaces/i.config.type";
import { SetStateFunction, procesarRespuesta } from "../../infrastructure/configuration/state";
import {
  traerProductVariantPriceHistoryService,
  buscarProductVariantPriceHistoryService,
  crearProductVariantPriceHistoryService,
  modificarProductVariantPriceHistoryService,
  eliminarProductVariantPriceHistoryService,
  traerTodoProductVariantPriceHistoryService,
  listarProductVariantPriceHistoryService,
} from "../services/product.variant.price.history.service";
import { ISetProductVariantPriceHistoryDtoInput, ISearchProductVariantPriceHistoryDtoInput, ITraerProductVariantPriceHistoryDtoInput } from "../../domain/dtos/input/i.product.variant.price.history.dto.input";

/**
 * Traer una categoría específica
 */
export const traerProductVariantPriceHistoryUseCase = async (
  param: ITraerProductVariantPriceHistoryDtoInput,
  setState: SetStateFunction
) => {
  traerProductVariantPriceHistoryService(param).then((response: AxiosResponse<IConfigType>) => {
    setState(procesarRespuesta(response));
  });
};

export const listarProductVariantPriceHistoryUseCase = async (
  // param: ITraerProductVariantPriceHistoryDtoInput,
  setState: SetStateFunction
) => {
  listarProductVariantPriceHistoryService().then((response: AxiosResponse<IConfigType>) => {
    setState(procesarRespuesta(response));
  });
};



/**
 * Buscar ProductVariantPriceHistoryos según filtros
 */
export const buscarProductVariantPriceHistoryUseCase = async (
  param: ISearchProductVariantPriceHistoryDtoInput,
  setState: SetStateFunction
) => {
  buscarProductVariantPriceHistoryService(param).then((response: AxiosResponse<IConfigType>) => {
    setState(procesarRespuesta(response));
  });
};

/**
 * Crear una nueva categoría
 */
export const crearProductVariantPriceHistoryUseCase = async (
  param: ISetProductVariantPriceHistoryDtoInput,
  setState: SetStateFunction
) => {
  crearProductVariantPriceHistoryService(param).then((response: AxiosResponse<IConfigType>) => {
    setState(procesarRespuesta(response));
  });
};

/**
 * Modificar una categoría existente
 */
export const modificarProductVariantPriceHistoryUseCase = async (
  param: ISetProductVariantPriceHistoryDtoInput,
  setState: SetStateFunction
) => {
  modificarProductVariantPriceHistoryService(param).then((response: AxiosResponse<IConfigType>) => {
    setState(procesarRespuesta(response));
  });
};

/**
 * Eliminar una categoría
 */
export const eliminarProductVariantPriceHistoryUseCase = async (
  param: ISearchProductVariantPriceHistoryDtoInput,
  setState: SetStateFunction
) => {
  eliminarProductVariantPriceHistoryService(param).then((response: AxiosResponse<IConfigType>) => {
    setState(procesarRespuesta(response));
  });
};

/**
 * Traer todas las ProductVariantPriceHistoryos
 */
export const traerTodoProductVariantPriceHistoryUseCase = async (
  setState: SetStateFunction
) => {
  traerTodoProductVariantPriceHistoryService().then((response: AxiosResponse<IConfigType>) => {
    setState(procesarRespuesta(response));
  });
};

