/**
 * @description Interface que implementa campos de control auditables extendida
 * @export
 * @category domain
 * @interface IAuditableExtended
 */
export interface IAuditableExtended {
  /** Estado del registro (V: vigente, I: inactivo, E: eliminado) */
  estadoReg: string;

  /** Fecha en que se asignó el estado actual */
  fecEstadoReg: Date;

  /** Fecha de ingreso del registro al sistema */
  fecIngReg: Date;

  /** Usuario que ingresó el registro */
  idUsuarioIngReg: string;

  /** Última fecha en que se modificó el registro */
  fecUltModifReg: Date;

  /** Último usuario que modificó el registro */
  idUsuarioUltModifReg: string;

  /** Última funcionalidad que modificó el registro */
  idFuncionUltModifReg: string;

  /** IP del usuario que realizó la última modificación */
  ipUltModifReg?: string;

  /** Host o máquina desde donde se realizó la última modificación */
  hostUltModifReg?: string;

  /** Indica si el registro fue eliminado lógicamente */
  eliminadoLogico?: boolean;

  /** Fecha de eliminación lógica, si aplica */
  fecEliminacion?: Date;

  /** Usuario que realizó la eliminación lógica */
  idUsuarioElimReg?: string;

  /** Comentarios o notas de auditoría */
  observaciones?: string;

  /** Historial de cambios resumido */
  historialCambios?: Array<{
    fecha: Date;
    usuario: string;
    accion: string;
    detalle?: string;
  }>;
}

/**
 * @description Función para crear un objeto IAuditableExtended con valores por defecto
 * @param usu Usuario que crea el registro
 * @param fun Funcionalidad que crea el registro
 * @param ip (Opcional) IP del usuario
 * @param host (Opcional) host del usuario
 */
export const defaultAuditExtended = (
  usu: string,
  fun: string,
  ip?: string,
  host?: string
): IAuditableExtended => ({
  estadoReg: 'V',
  fecEstadoReg: new Date(),
  fecIngReg: new Date(),
  idUsuarioIngReg: usu,
  fecUltModifReg: new Date(),
  idUsuarioUltModifReg: usu,
  idFuncionUltModifReg: fun,
  ipUltModifReg: ip,
  hostUltModifReg: host,
  eliminadoLogico: false,
  historialCambios: [],
  observaciones: '',
});
