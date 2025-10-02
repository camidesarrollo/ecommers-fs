// src/application/callbacks/product.cb.ts
import { ref, Ref } from "vue";
import { traerTodoProductUseCase, buscarProductUseCase, listarProductUseCase } from "../use-cases/product.use.case";
import type { ITraerProductDtoOutput, IListaProductosDTOOutput } from "../../domain/dtos/output/i.product.dto.output";
import type { ISearchProductRequest } from "../../domain/dtos/input/i.product.dto.input";
import { IApiRespuesta } from "../../domain/interfaces/i.apiRespuesta";

export function useProduct(): { productos: Ref<ITraerProductDtoOutput[]>, traerProduct: () => void } {
    const productos = ref<ITraerProductDtoOutput[]>([]);

    const CallBackFunctionObtenerproductos = (response: IApiRespuesta) => {
        productos.value = response.data ?? [];
    };

    const traerProduct = () => {
        traerTodoProductUseCase(CallBackFunctionObtenerproductos);
    };

    return { productos, traerProduct };
}

export function useProductSearch() {
  const productos = ref<ITraerProductDtoOutput[]>([]);

  const buscarProduct = (filtros: ISearchProductRequest) => {
    return new Promise<ITraerProductDtoOutput[]>((resolve, reject) => {
      // Llamamos al use case y le pasamos el callback
      buscarProductUseCase(filtros, (response: any) => {
        try {
          productos.value = response?.data ?? [];
          resolve(productos.value); // resuelve la promesa cuando llega la respuesta
        } catch (error) {
          reject(error);
        }
      });
    });
  };

  return { productos, buscarProduct };
}

/**
 * Nuevo: listar productos con filtros
 */
export function useProductList(): {
  productos: Ref<IListaProductosDTOOutput[]>,
  listarProductos: () => void,
  loading: Ref<boolean>,
  error: Ref<string | null>
} {
  const productos = ref<IListaProductosDTOOutput[]>([]);
  const loading = ref<boolean>(false);
  const error = ref<string | null>(null);

  const CallBackFunctionObtenerProductos = (apiResponse: IApiRespuesta) => {
    loading.value = false;
    
    console.log(`[${new Date().toLocaleTimeString()} API Response completa:`, apiResponse);
    
    // Verificar que la respuesta sea exitosa
    if (apiResponse.status === 'success') {
      // Verificar que data existe y es un array
      if (apiResponse.data && Array.isArray(apiResponse.data)) {
        productos.value = apiResponse.data;
        error.value = null;
        console.log(`[${new Date().toLocaleTimeString()}] Productos cargados exitosamente:`, apiResponse.data.length, 'productos');
      } else {
        // Si data no es un array, intentar manejarlo
        console.warn('Los datos recibidos no son un array:', apiResponse.data);
        productos.value = [];
        error.value = 'Formato de datos incorrecto';
      }
    } else {
      // Manejar errores de la API
      productos.value = [];
      error.value = apiResponse.mensaje || 'Error al obtener productos';
      console.error('Error en la respuesta de la API:', {
        status: apiResponse.status,
        mensaje: apiResponse.mensaje,
        code_status: apiResponse.code_status
      });
    }
  };

  const listarProductos = () => {
    loading.value = true;
    error.value = null;
    
    console.log('Iniciando carga de productos...');
    
    try {
      listarProductUseCase({}, CallBackFunctionObtenerProductos);
    } catch (err) {
      loading.value = false;
      error.value = 'Error al realizar la petición';
      console.error('Error en listarProductUseCase:', err);
    }
  };

  return { 
    productos, 
    listarProductos,
    loading,
    error
  };
}

// Versión alternativa más simple si solo necesitas los productos básicos
export function useProductListSimple(): {
  productos: Ref<IListaProductosDTOOutput[]>,
  listarProductos: () => void
} {
  const productos = ref<IListaProductosDTOOutput[]>([]);

  const CallBackFunctionObtenerProductos = (apiResponse: IApiRespuesta) => {
    console.log('API Response:', apiResponse);
    
    if (apiResponse.status === 'success' && Array.isArray(apiResponse.data)) {
      productos.value = apiResponse.data;
    } else {
      productos.value = [];
      console.error('Error fetching products:', apiResponse.mensaje);
    }
  };

  const listarProductos = () => {
    listarProductUseCase({}, CallBackFunctionObtenerProductos);
  };

  return { productos, listarProductos };
}