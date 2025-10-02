import { AxiosResponse } from "axios";
import { IConfigType } from "../../domain/interfaces/i.config.type";
import { SetStateFunction, procesarRespuesta } from "../../infrastructure/configuration/state";
import {
  traerCategoryService,
  buscarCategoryService,
  crearCategoryService,
  modificarCategoryService,
  eliminarCategoryService,
  traerTodoCategoryService,
  allActiveService
} from "../../application/services/category.service";
import { ISetCategoryRequest, ISearchCategoryRequest, ITraerCategoryRequest } from "../../domain/dtos/input/i.category.dto.input";

/**
 * Traer una categoría específica
 */
export const traerCategoryUseCase = async (
  param: ITraerCategoryRequest,
  setState: SetStateFunction
) => {
  traerCategoryService(param).then((response: AxiosResponse<IConfigType>) => {
    setState(procesarRespuesta(response));
  });
};

/**
 * Traer una categoría específica
 */
export const allActiveCategoryUseCase = async (
  setState: SetStateFunction
) => {
  allActiveService().then((response: AxiosResponse<IConfigType>) => {
    setState(procesarRespuesta(response));
  });
};

/**
 * Buscar categorías según filtros
 */
export const buscarCategoryUseCase = async (
  param: ISearchCategoryRequest,
  setState: SetStateFunction
) => {
  buscarCategoryService(param).then((response: AxiosResponse<IConfigType>) => {
    setState(procesarRespuesta(response));
  });
};

/**
 * Crear una nueva categoría
 */
export const crearCategoryUseCase = async (
  param: ISetCategoryRequest,
  setState: SetStateFunction
) => {
  crearCategoryService(param).then((response: AxiosResponse<IConfigType>) => {
    setState(procesarRespuesta(response));
  });
};

/**
 * Modificar una categoría existente
 */
export const modificarCategoryUseCase = async (
  param: ISetCategoryRequest,
  setState: SetStateFunction
) => {
  modificarCategoryService(param).then((response: AxiosResponse<IConfigType>) => {
    setState(procesarRespuesta(response));
  });
};

/**
 * Eliminar una categoría
 */
export const eliminarCategoryUseCase = async (
  param: ISearchCategoryRequest,
  setState: SetStateFunction
) => {
  eliminarCategoryService(param).then((response: AxiosResponse<IConfigType>) => {
    setState(procesarRespuesta(response));
  });
};

/**
 * Traer todas las categorías
 */
export const traerTodoCategoryUseCase = async (
  setState: SetStateFunction
) => {
  traerTodoCategoryService().then((response: AxiosResponse<IConfigType>) => {
    setState(procesarRespuesta(response));
  });
};

