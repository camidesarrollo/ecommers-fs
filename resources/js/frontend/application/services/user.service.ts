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

    // Primero obtener el token CSRF (si es necesario)
    // await axios.get(`${urlBase}/sanctum/csrf-cookie`, { withCredentials: true });

    const response = await UserRequestInstance.post(
      UserRequest.Registro,
      params
    );

    return { success: true, data: response.data };
  } catch (error: any) {
    console.error("Error en Register:", error);

    if (error.response) {
      return {
        success: false,
        status: error.response.status,
        data: error.response.data,
      };
    } else {
      return {
        success: false,
        status: 500,
        data: { message: error.message },
      };
    }
  }
};