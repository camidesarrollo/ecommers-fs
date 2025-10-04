import { ref, onMounted, Ref } from "vue";
import { LoginUseCase, RegisterUseCase } from "../use-cases/user.use.case";
import { IUserLoginRequest, IUserStoreRequest } from "../../domain/dtos/input/i.user.dto.input";
import type { IConfigType } from "../../domain/interfaces/i.config.type";
import { IApiRespuesta } from "../../domain/interfaces/i.apiRespuesta";
import { IUserResource } from "../../domain/dtos/output/i.usuario.dto.output";

export function useUser() {
  // Estados reactivos
  let loginResponse = ref<IApiRespuesta | IUserResource[]>([]);
  const registerResponse = ref<IApiRespuesta | IUserResource | null >(null);
  const loading = ref<boolean>(false);
  const error = ref<string | null>(null);
  const success = ref<boolean>(false); // ✅ Nuevo estado para indicar éxito

  // Callback para login
  const callbackLogin = (response: IApiRespuesta) => {
    loginResponse.value = response.data;
  };

  // Callback para registro
  const callbackRegister = (response: IApiRespuesta) => {
      if (response?.data != null) {
          registerResponse.value = response.data;
          success.value = true; // ✅ Marcar como exitoso
      } else {
          registerResponse.value = response;
          success.value = false; // ❌ Marcar como fallo
      }
      console.log('Datos de registro:', registerResponse.value);
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
    success.value = false; // ✅ Resetear el estado de éxito
    try {
      await RegisterUseCase(param, callbackRegister);
      return registerResponse.value; // ✅ Retornar la respuesta
    } catch (err: any) {
      error.value = err.message || "Error en registro";
      throw err; // ✅ Re-lanzar el error para que se capture en el componente
    } finally {
      loading.value = false;
    }
  };

  return {
    loginResponse,
    registerResponse,
    loading,
    error,
    success, // ✅ Exportar el nuevo estado
    login,
    register,
  };
}