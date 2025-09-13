import axios from "axios";
import { ProductInstance, BasicRequestProduct } from "../../infrastructure/configuration/service.config";
import { ISetProductDtoInput, ISearchProductDtoInput, ITraerProductDtoInput } from "../../domain/dtos/input/i.product.dto.input.ts";

/**
 * Buscar productos según filtros
 */
export const buscarProductService = async (params: ISearchProductDtoInput) => {
  try {
    console.log("Parámetros enviados:", params);
    const response = await ProductInstance.get(BasicRequestProduct.Buscar, {
      params // Axios convierte este objeto en query string automáticamente
    });
    return response.data;
  } catch (error) {
    console.error("Error en buscarProductService:", error);
    throw error;
  }
};


/**
 * Crear una nueva producto
 */
/**
 * Traer un producto específico
 */
export const traerProductService = async (params: ITraerProductDtoInput) => {
  try {
    const response = await ProductInstance.get(`${BasicRequestProduct.Traer}`, {
      params: { id: params.id },
    });
    return response.data;
  } catch (error) {
    return error;
  }
};

/**
 * Crear un nuevo producto
 */
export const crearProductService = async (params: ISetProductDtoInput) => {
  try {
    const response = await ProductInstance.post(BasicRequestProduct.Crear, params);
    return response.data;
  } catch (error) {
    return error;
  }
};

/**
 * Modificar un producto existente
 */
export const modificarProductService = async (params: ISetProductDtoInput) => {
  try {
    const response = await ProductInstance.post(BasicRequestProduct.Modificar, params);
    return response.data;
  } catch (error) {
    return error;
  }
};

/**
 * Eliminar un producto
 */
export const eliminarProductService = async (params: ISearchProductDtoInput) => {
  try {
    const response = await ProductInstance.post(BasicRequestProduct.Eliminar, params);
    return response.data;
  } catch (error) {
    return error;
  }
};


/**
 * Traer todas las productos
 */
export const traerTodoProductService = async () => {
  try {
    const response = await ProductInstance.get(BasicRequestProduct.TraerTodo);
    return response.data;
  } catch (error) {
    console.error(error);
    throw error;
  }
};
