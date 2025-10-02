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
import { ISetProductVariantPriceHistoryRequest, ISearchProductVariantPriceHistoryRequest, ITraerProductVariantPriceHistoryRequest } from "../../domain/dtos/input/i.product.variant.price.history.dto.input";

/**
 * Traer una categoría específica
 */
export const traerProductVariantPriceHistoryUseCase = async (
  param: ITraerProductVariantPriceHistoryRequest,
  setState: SetStateFunction
) => {
  traerProductVariantPriceHistoryService(param).then((response: AxiosResponse<IConfigType>) => {
    setState(procesarRespuesta(response));
  });
};

export const listarProductVariantPriceHistoryUseCase = async (
  // param: ITraerProductVariantPriceHistoryRequest,
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
  param: ISearchProductVariantPriceHistoryRequest,
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
  param: ISetProductVariantPriceHistoryRequest,
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
  param: ISetProductVariantPriceHistoryRequest,
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
  param: ISearchProductVariantPriceHistoryRequest,
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

