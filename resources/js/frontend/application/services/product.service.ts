import axios from "axios";
import { ProductInstance, BasicRequestProduct } from "../../infrastructure/configuration/service.config";
import { ISetProductRequest, ISearchProductRequest, ITraerProductRequest } from "../../domain/dtos/input/i.product.dto.input.ts";

/**
 * Buscar productos según filtros
 */
export const buscarProductService = async (params: ISearchProductRequest) => {
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
export const traerProductService = async (params: ITraerProductRequest) => {
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
export const crearProductService = async (params: ISetProductRequest) => {
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
export const modificarProductService = async (params: ISetProductRequest) => {
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
export const eliminarProductService = async (params: ISearchProductRequest) => {
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

/**
 * Listar un historial de precio específico por ID
 */
export const listarProductService = async (params: ISearchProductRequest) => {
  try {
    const response = await ProductInstance.get(BasicRequestProduct.Listar, { 
      params // Axios convierte este objeto a query string automáticamente
    });
    return response.data;
  } catch (error) {
    console.error("Error en listarProductService:", error);
    throw error;
  }
};