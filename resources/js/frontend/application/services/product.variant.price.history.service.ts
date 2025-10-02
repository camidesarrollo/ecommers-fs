import { ProductVariantPriceHistoryInstance, BasicRequestProductVariantPriceHistory } from "../../infrastructure/configuration/service.config";
import { ISetProductVariantPriceHistoryRequest, ISearchProductVariantPriceHistoryRequest, ITraerProductVariantPriceHistoryRequest } from "../../domain/dtos/input/i.product.variant.price.history.dto.input";

/**
 * Buscar historial de precios según filtros
 */
export const buscarProductVariantPriceHistoryService = async (params: ISearchProductVariantPriceHistoryRequest) => {
  try {
    console.log("Parámetros enviados:", params);
    const response = await ProductVariantPriceHistoryInstance.get(BasicRequestProductVariantPriceHistory.Buscar, {
      params
    });
    return response.data;
  } catch (error) {
    console.error("Error en buscarProductVariantPriceHistoryService:", error);
    throw error;
  }
};

/**
 * Traer un historial de precio específico por ID
 */
export const traerProductVariantPriceHistoryService = async (params: ITraerProductVariantPriceHistoryRequest) => {
  try {
    const response = await ProductVariantPriceHistoryInstance.get(`${BasicRequestProductVariantPriceHistory.Traer}`, {
      params: { id: params.id },
    });
    return response.data;
  } catch (error) {
    console.error(error);
    throw error;
  }
};

/**
 * Listar un historial de precio específico por ID
 */
export const listarProductVariantPriceHistoryService = async () => {
  try {
    const response = await ProductVariantPriceHistoryInstance.get(`${BasicRequestProductVariantPriceHistory.Traer}`);
    return response.data;
  } catch (error) {
    console.error(error);
    throw error;
  }
};

/**
 * Crear un nuevo historial de precio
 */
export const crearProductVariantPriceHistoryService = async (params: ISetProductVariantPriceHistoryRequest) => {
  try {
    const response = await ProductVariantPriceHistoryInstance.post(BasicRequestProductVariantPriceHistory.Crear, params);
    return response.data;
  } catch (error) {
    console.error(error);
    throw error;
  }
};

/**
 * Modificar un historial de precio existente
 */
export const modificarProductVariantPriceHistoryService = async (params: ISetProductVariantPriceHistoryRequest) => {
  try {
    const response = await ProductVariantPriceHistoryInstance.post(BasicRequestProductVariantPriceHistory.Modificar, params);
    return response.data;
  } catch (error) {
    console.error(error);
    throw error;
  }
};

/**
 * Eliminar un historial de precio
 */
export const eliminarProductVariantPriceHistoryService = async (params: ISearchProductVariantPriceHistoryRequest) => {
  try {
    const response = await ProductVariantPriceHistoryInstance.post(BasicRequestProductVariantPriceHistory.Eliminar, params);
    return response.data;
  } catch (error) {
    console.error(error);
    throw error;
  }
};

/**
 * Traer todo el historial de precios
 */
export const traerTodoProductVariantPriceHistoryService = async () => {
  try {
    const response = await ProductVariantPriceHistoryInstance.get(BasicRequestProductVariantPriceHistory.TraerTodo);
    return response.data;
  } catch (error) {
    console.error(error);
    throw error;
  }
};
