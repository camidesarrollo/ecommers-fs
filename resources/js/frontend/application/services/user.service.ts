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
    const response = await UserRequestInstance.post(UserRequest.Registro, {
      params
    });
    return response;
  } catch (error) {
    console.error("Error en Register:", error);
    throw error;
  }
};