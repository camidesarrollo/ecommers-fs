export interface IApiRespuesta {
  data: any;
  code_status: number;
  mensaje_status: string;
  mensaje: string;
  status: 'success' | 'error';
}
