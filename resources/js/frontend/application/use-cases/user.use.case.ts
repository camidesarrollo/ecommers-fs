import { AxiosResponse } from "axios";
import { IConfigType } from "../../domain/interfaces/i.config.type";
import { SetStateFunction, procesarRespuesta } from "../../infrastructure/configuration/state";
import {
  LoginService, 
  RegisterService
} from "../services/user.service";
import {IUserLoginRequest, IUserStoreRequest} from "../../domain/dtos/input/i.user.dto.input";

export const LoginUseCase = async (
  param: IUserLoginRequest,
  setState: SetStateFunction
) => {
  LoginService(param).then((response: AxiosResponse<IConfigType>) => {
    setState(procesarRespuesta(response));
  });
};

export const RegisterUseCase = async (
  param: IUserStoreRequest,
  setState: SetStateFunction
) => {
  const result = await RegisterService(param);

  if (result.success) {
    setState(procesarRespuesta(result.data));
  } else {
    
    setState({
      ...result.data,
      isError: true,
    });
  }
};
