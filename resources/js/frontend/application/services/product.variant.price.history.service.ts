import axios from "axios";
import { ProductVariantPriceHistoryInstance, BasicRequestProductVariantPriceHistory } from "../../infrastructure/configuration/service.config";
import { ISetProductVariantPriceHistoryDtoInput, ISearchProductVariantPriceHistoryDtoInput, ITraerProductVariantPriceHistoryDtoInput } from "../../domain/dtos/input/i.product.variant.price.history.dto.input";

/**
 * Buscar historial de precios según filtros
 */
export const buscarProductVariantPriceHistoryService = async (params: ISearchProductVariantPriceHistoryDtoInput) => {
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
export const traerProductVariantPriceHistoryService = async (params: ITraerProductVariantPriceHistoryDtoInput) => {
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
 * Crear un nuevo historial de precio
 */
export const crearProductVariantPriceHistoryService = async (params: ISetProductVariantPriceHistoryDtoInput) => {
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
export const modificarProductVariantPriceHistoryService = async (params: ISetProductVariantPriceHistoryDtoInput) => {
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
export const eliminarProductVariantPriceHistoryService = async (params: ISearchProductVariantPriceHistoryDtoInput) => {
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
