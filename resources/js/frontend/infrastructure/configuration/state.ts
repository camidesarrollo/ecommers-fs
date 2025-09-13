import { AxiosResponse } from 'axios';
import { IConfigType } from '../../domain/interfaces/i.config.type';
import { IApiRespuesta } from '../../domain/interfaces/i.apiRespuesta';



export type SetStateFunction = (state: IApiRespuesta) => void;

export function procesarRespuesta(respuesta: AxiosResponse<IConfigType>): IApiRespuesta {

  if(respuesta){
    const codigosStatus = {
      200: 'éxito en la solicitud y la respuesta contiene la información solicitada.',
      201: 'éxito en la creación de un nuevo recurso.',
      204: 'éxito en la solicitud, pero la respuesta no contiene contenido.',
      400: 'la solicitud es incorrecta o no se pudo entender por el servidor.',
      401: 'la autenticación es requerida y ha fallado o aún no se ha proporcionado.',
      403: 'la solicitud se entiende, pero se niega la acción porque no se tienen permisos suficientes.',
      404: 'el recurso solicitado no se pudo encontrar en el servidor.',
      500: 'el servidor encontró una condición inesperada que impidió que se pudiera completar la solicitud.',
    }
  
  
    // const mensaje = codigosStatus[respuesta.status] ?? '';
    
    const apiRespuesta: IApiRespuesta = {
      data: respuesta?.data?.message != null  ? [] : respuesta.data,
      code_status: respuesta.status,
      mensaje: respuesta?.data?.message,
      status: respuesta.status === 200 ? "success" : "error",
      mensaje_status: "" 
    };

    return apiRespuesta;
  }

  // retorno por defecto si respuesta es undefined o null
  return {
    data: [],
    code_status: 0,
    mensaje: 'No se recibió respuesta',
    status: 'error',
    mensaje_status: 'No se recibió respuesta del servidor'
  };
}
