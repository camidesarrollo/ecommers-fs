import { UserRequest, UserRequestInstance } from "../../infrastructure/configuration/service.config";
import {IUserLoginRequest, IUserStoreRequest} from "../../domain/dtos/input/i.user.dto.input";

export const LoginService = async (params: IUserLoginRequest) => {
  try {
    console.log("Parámetros enviados:", params);
    const response = await UserRequestInstance.get(UserRequest.Login, {
      params
    });
    return response;
  } catch (error) {
    console.error("Error en Login:", error);
    throw error;
  }
};
export const RegisterService = async (params: IUserStoreRequest) => {
  try {
    console.log("Parámetros enviados:", params);
    const response = await UserRequestInstance.post(UserRequest.Registro, params);
    return { success: true, data: response.data }; // Devuelve data si todo OK
  } catch (error: any) {
    console.error("Error en Register:", error);

    // Axios error
    if (error.response) {
      // La API respondió con un status 4xx/5xx
      return {
        success: false,
        status: error.response.status,
        data: error.response.data, // Aquí estará el mensaje y los errores
      };
    } else {
      // Error de red o algo inesperado
      return {
        success: false,
        status: 500,
        data: { message: error.message },
      };
    }
  }
};
