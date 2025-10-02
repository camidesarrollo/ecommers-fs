import axios from "axios";
import { CategoryInstance, BasicRequestCategory } from "../../infrastructure/configuration/service.config";
import { ISetCategoryRequest, ISearchCategoryRequest, ITraerCategoryRequest } from "../../domain/dtos/input/i.category.dto.input.ts";

/**
 * Traer una categoría específica
 */
export const traerCategoryService = async (params: ITraerCategoryRequest) => {
  try {
    const uri = `${CategoryInstance}${BasicRequestCategory.Traer}?id=${params.id}`;
    const response = await axios.post(uri, params);
    return response.data;
  } catch (error) {
    return error;
  }
};

/**
 * Buscar categorías según filtros
 */
export const buscarCategoryService = async (params: ISearchCategoryRequest) => {
  try {
    const uri = `${CategoryInstance}${BasicRequestCategory.Buscar}`;
    const response = await axios.post(uri, params);
    return response.data;
  } catch (error) {
    return error;
  }
};

/**
 * Crear una nueva categoría
 */
export const crearCategoryService = async (params: ISetCategoryRequest) => {
  try {
    const uri = `${CategoryInstance}${BasicRequestCategory.Crear}`;
    const response = await axios.post(uri, params);
    return response.data;
  } catch (error) {
    return error;
  }
};

/**
 * Modificar una categoría existente
 */
export const modificarCategoryService = async (params: ISetCategoryRequest) => {
  try {
    const uri = `${CategoryInstance}${BasicRequestCategory.Modificar}`;
    const response = await axios.post(uri, params);
    return response.data;
  } catch (error) {
    return error;
  }
};

/**
 * Eliminar una categoría
 */
export const eliminarCategoryService = async (params: ISearchCategoryRequest) => {
  try {
    const uri = `${CategoryInstance}${BasicRequestCategory.Eliminar}`;
    const response = await axios.post(uri, params);
    return response.data;
  } catch (error) {
    return error;
  }
};

/**
 * Traer todas las categorías
 */
export const traerTodoCategoryService = async () => {
  try {
    const response = await CategoryInstance.get(BasicRequestCategory.TraerTodo);
    return response.data;
  } catch (error) {
    console.error(error);
    throw error;
  }
};

export const allActiveService = async () => {
  try {
    const response = await CategoryInstance.get(BasicRequestCategory.Activas);
    return response.data;
  } catch (error) {
    console.error(error);
    throw error;
  }
};