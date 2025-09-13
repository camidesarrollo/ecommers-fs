import { IAuditableExtended, defaultAuditExtended } from './i.auditable';

/**
 * @description Clase base abstracta para entidades del dominio
 * @export
 * @abstract
 * @template T Tipo de propiedades de la entidad (debe ser un objeto)
 */
export abstract class IEntity<T extends object> {
  protected readonly props: T;

  /** Identificador único de la entidad */
  readonly id: string;

  /** Campos de auditoría */
  readonly audit: IAuditableExtended;

  constructor(props: T, id?: string, audit?: Partial<IAuditableExtended>, usuario?: string, funcion?: string) {
    this.id = id ?? this.generateId();
    this.props = { ...props }; // inmutable por defecto
    this.audit = { ...defaultAuditExtended(usuario ?? 'system', funcion ?? 'constructor'), ...audit };
  }

  /** Obtener una copia inmutable de las propiedades */
  public getProps(): T {
    return { ...this.props };
  }

  /** Actualizar propiedades de la entidad (manteniendo inmutabilidad) */
  protected setProps(newProps: Partial<T>): void {
    Object.assign(this.props, newProps);
    this.updateAudit();
  }

  /** Actualizar la auditoría automáticamente */
  protected updateAudit(usuario?: string, funcion?: string) {
    this.audit.fecUltModifReg = new Date();
    if (usuario) this.audit.idUsuarioUltModifReg = usuario;
    if (funcion) this.audit.idFuncionUltModifReg = funcion;
  }

  /** Comparar si dos entidades son iguales según su ID */
  public equals(entity?: IEntity<T>): boolean {
    if (!entity) return false;
    return this.id === entity.id;
  }

  /** Clonar la entidad (copia profunda de props y audit) */
  public clone(): IEntity<T> {
    const copy = Object.create(this.constructor.prototype);
    copy.props = JSON.parse(JSON.stringify(this.props));
    copy.audit = JSON.parse(JSON.stringify(this.audit));
    copy.id = this.id;
    return copy;
  }

  /** Generar un ID único simple (puede reemplazarse por UUID) */
  private generateId(): string {
    return `id_${Math.random().toString(36).substr(2, 9)}`;
  }
}
