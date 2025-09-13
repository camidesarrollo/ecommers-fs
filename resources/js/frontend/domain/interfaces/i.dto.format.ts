export interface IDtoFormat {
  /** Identificador único de la entidad o registro */
  id: string;

  /** Estado de los mensajes asociados */
  estadoMensajes: number;

  /** Título o asunto del mensaje */
  titulo?: string;

  /** Contenido del mensaje */
  contenido?: string;

  /** Fecha de creación del registro */
  fechaCreacion?: Date;

  /** Fecha de última actualización del registro */
  fechaActualizacion?: Date;

  /** Usuario que creó el registro */
  creadoPor?: string;

  /** Usuario que modificó por última vez el registro */
  modificadoPor?: string;

  /** Flag de estado activo/inactivo */
  activo?: boolean;

  /** Etiquetas o categorías asociadas */
  tags?: string[];

  /** Mensajes de error o validación asociados */
  errores?: string[];

  /** Información adicional o metadatos */
  metadata?: Record<string, any>;
}
