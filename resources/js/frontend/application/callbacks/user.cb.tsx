import { ref, onMounted, Ref } from "vue";
import { LoginUseCase, RegisterUseCase } from "../use-cases/user.use.case";
import { IUserLoginRequest, IUserStoreRequest } from "../../domain/dtos/input/i.user.dto.input";
import type { IConfigType } from "../../domain/interfaces/i.config.type";
import { IApiRespuesta } from "../../domain/interfaces/i.apiRespuesta";
import { IUserResource } from "../../domain/dtos/output/i.usuario.dto.output";

export function useUser() {
  // Estados reactivos
  let loginResponse = ref<IUserResource[]>([]);
  const registerResponse = ref<IUserResource | null>(null);
  const loading = ref<boolean>(false);
  const error = ref<string | null>(null);

  // Callback para login
  const callbackLogin = (response: IApiRespuesta) => {
    loginResponse.value = response.data;
  };

  // Callback para registro
  const callbackRegister = (response: IApiRespuesta) => {
    registerResponse.value = response.data;
  };

  // Función para ejecutar login
  const login = async (param: IUserLoginRequest) => {
    loading.value = true;
    error.value = null;
    try {
      await LoginUseCase(param, callbackLogin);
    } catch (err: any) {
      error.value = err.message || "Error en login";
    } finally {
      loading.value = false;
    }
  };

  // Función para ejecutar registro
  const register = async (param: IUserStoreRequest) => {
    loading.value = true;
    error.value = null;
    try {
      await RegisterUseCase(param, callbackRegister);
    } catch (err: any) {
      error.value = err.message || "Error en registro";
    } finally {
      loading.value = false;
    }
  };

  return {
    loginResponse,
    registerResponse,
    loading,
    error,
    login,
    register,
  };
}
