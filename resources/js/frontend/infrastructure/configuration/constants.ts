// theme constant
export const gridSpacing = 3;
export const drawerWidth = 260;
export const appDrawerWidth = 320;

export enum modo {
    Volver = "volver",
    Guardar = "guardar",
    Nuevo = "nuevo",
    Cancelar = "cancelar",
    Eliminar = "eliminar",
    Seleccionar = "seleccionar",
    Buscar = "buscar",
    Modificar = "modificar",
}
  
export const estado = {
succes: 1,
info: 2,
warning: 3,
error: 4,
};

export enum validaciones {
    Requerido = "Campo obligatorio",
    Minimo = "Largo mínimo insuficiente",
    Maximo = "Largo máximo excedido",
    RegexInvalido = "Formato inválido",
    Url = "Url invalido",
}

export const localizedTextsMap = {
    columnMenuUnsort: "Sin clasificar",
    columnMenuSortAsc: "Ordenar de forma ascendente",
    columnMenuSortDesc: "Ordenar de forma descendente",
    columnMenuFilter: "Filtro",
    columnMenuHideColumn: "Ocultar",
    columnMenuShowColumns: "Mostrar columnas"
};