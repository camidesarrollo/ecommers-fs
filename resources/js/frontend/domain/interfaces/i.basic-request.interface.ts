export interface IBasicRequestEndpoints {
  Buscar: string;
  Traer: string;
  Crear: string;
  Modificar: string;
  Eliminar: string;
  TraerTodo: string;
  // Opcional: si algún módulo tiene endpoints extras
  [key: string]: string;
}