export interface IUserLoginRequest {
  email: string;
  password: string;
  deviceName?: string; // Opcional, para tokens
}

export interface IUserStoreRequest {
  name: string;
  apellido?: string;
  email: string;
  password: string;
  password_confirmation?: string;
  phone?: string;
  rut?: string;
  pasaporte?: string;
  roles?: string[];        // Array de roles a asignar
  permissions?: string[];  // Array de permisos directos a asignar
}
