import { AxiosResponse } from "axios";
import { IConfigType } from "../../domain/interfaces/i.config.type";
import { SetStateFunction, procesarRespuesta } from "../../infrastructure/configuration/state";
import {
  traerProductService,
  buscarProductService,
  crearProductService,
  modificarProductService,
  eliminarProductService,
  traerTodoProductService,
} from "../services/Product.service";
import { ISetProductDtoInput, ISearchProductDtoInput, ITraerProductDtoInput } from "../../domain/dtos/input/i.product.dto.input";

/**
 * Traer una categoría específica
 */
export const traerProductUseCase = async (
  param: ITraerProductDtoInput,
  setState: SetStateFunction
) => {
  traerProductService(param).then((response: AxiosResponse<IConfigType>) => {
    setState(procesarRespuesta(response));
  });
};


/**
 * Buscar productos según filtros
 */
export const buscarProductUseCase = async (
  param: ISearchProductDtoInput,
  setState: SetStateFunction
) => {
  buscarProductService(param).then((response: AxiosResponse<IConfigType>) => {
    setState(procesarRespuesta(response));
  });
};

/**
 * Crear una nueva categoría
 */
export const crearProductUseCase = async (
  param: ISetProductDtoInput,
  setState: SetStateFunction
) => {
  crearProductService(param).then((response: AxiosResponse<IConfigType>) => {
    setState(procesarRespuesta(response));
  });
};

/**
 * Modificar una categoría existente
 */
export const modificarProductUseCase = async (
  param: ISetProductDtoInput,
  setState: SetStateFunction
) => {
  modificarProductService(param).then((response: AxiosResponse<IConfigType>) => {
    setState(procesarRespuesta(response));
  });
};

/**
 * Eliminar una categoría
 */
export const eliminarProductUseCase = async (
  param: ISearchProductDtoInput,
  setState: SetStateFunction
) => {
  eliminarProductService(param).then((response: AxiosResponse<IConfigType>) => {
    setState(procesarRespuesta(response));
  });
};

/**
 * Traer todas las productos
 */
export const traerTodoProductUseCase = async (
  setState: SetStateFunction
) => {
  traerTodoProductService().then((response: AxiosResponse<IConfigType>) => {
    setState(procesarRespuesta(response));
  });
};

