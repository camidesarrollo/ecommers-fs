import axios, {
  AxiosError,
  AxiosInstance,
  AxiosResponse,
  InternalAxiosRequestConfig,
  AxiosRequestHeaders,
} from "axios";
import { IBasicRequestEndpoints } from "../../domain/interfaces/i.basic-request.interface";

const urlBase: string = (window as any).ECOMMERCE_API_BASE || "http://127.0.0.1:8000";
const apiVersion: string = (window as any).ECOMMERCE_API_VERSION || "v1";

export const BasicRequestCategory: IBasicRequestEndpoints = {
  Buscar: "Search",
  Traer: "Get",
  Crear: "Create",
  Modificar: "Update",
  Eliminar: "Delete",
  TraerTodo: "/",
  Activas: "active", // endpoint extra específico de categorías
};

export const BasicRequestProduct: IBasicRequestEndpoints = {
  Buscar: "Search",
  Traer: "Get",
  Crear: "Create",
  Modificar: "Update",
  Eliminar: "Delete",
  TraerTodo: "/",
};

export const BasicRequestProductVariantPriceHistory: IBasicRequestEndpoints = {
  Buscar: "Search",
  Traer: "Get",
  Crear: "Create",
  Modificar: "Update",
  Eliminar: "Delete",
  TraerTodo: "/",
};

export const UserRequest: IBasicRequestEndpoints = {
  Buscar: "Search",
  Traer: "Get",
  Crear: "Create",
  Modificar: "Update",
  Eliminar: "Delete",
  TraerTodo: "/",
  Registro: "register",
  Login: "login"
}

// Configuración de Axios para categorías
const config = (modulo: string): InternalAxiosRequestConfig => {
  return {
    baseURL: `${urlBase}/api/${apiVersion}/${modulo}/`,
    xsrfCookieName: "XSRF-TOKEN",
    xsrfHeaderName: "X-XSRF-TOKEN",
    headers: {
      "Content-Type": "application/json",
      Authorization: `Bearer ${sessionStorage.getItem("token") || ""}`,
    } as AxiosRequestHeaders,
  };
};

// Interceptores genéricos
const onRequest = (config: InternalAxiosRequestConfig): InternalAxiosRequestConfig => {
  // Puedes agregar token, logs, etc.
  return config;
};

const onRequestError = (error: AxiosError): Promise<AxiosError> => {
  return Promise.reject(error);
};

const onResponse = (response: AxiosResponse): AxiosResponse => response;

const onResponseError = (error: AxiosError): Promise<AxiosError> => {
  return Promise.reject(error);
};

// Función para agregar interceptores
export function setupInterceptorsTo(axiosInstance: AxiosInstance): AxiosInstance {
  axiosInstance.interceptors.request.use(onRequest, onRequestError);
  axiosInstance.interceptors.response.use(onResponse, onResponseError);
  return axiosInstance;
}

// Instancia de Axios para categorías
export const CategoryInstance = setupInterceptorsTo(
  axios.create(config("categories"))
);

export const ProductInstance = setupInterceptorsTo(
  axios.create(config("products"))
);


export const ProductVariantPriceHistoryInstance = setupInterceptorsTo(
  axios.create(config("price-history"))
);

export const UserRequestInstance = setupInterceptorsTo(
  axios.create(config("user"))
);
