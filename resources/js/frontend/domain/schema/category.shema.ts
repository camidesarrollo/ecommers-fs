// src/models/Category.ts
import * as yup from "yup";
import { ICategory } from "../interfaces/i.category"; // <-- aquí

// Validación con Yup
export class Category {
  static schema: yup.ObjectSchema<ICategory> = yup.object({
    name: yup
      .string()
      .required("El nombre de la categoría es requerido")
      .min(2, "Mínimo 2 caracteres")
      .max(50, "Máximo 50 caracteres"),
    slug: yup
      .string()
      .required("El slug es requerido")
      .matches(/^[a-z0-9]+(?:-[a-z0-9]+)*$/, "Slug inválido"),
    description: yup.string().max(255, "Máximo 255 caracteres").optional(),
    image: yup.string().url("Debe ser una URL válida").optional(),
    bg_class: yup.string().max(50, "Máximo 50 caracteres").optional(),
    sort_order: yup.number().min(0, "Debe ser mayor o igual a 0").optional(),
    is_active: yup.boolean().required(),
    parent_id: yup.number().optional().nullable(),
  });

  static async isValid(param: ICategory): Promise<boolean> {
    return await Category.schema.isValid(param);
  }

  static async validate(param: ICategory): Promise<yup.ValidationError | null> {
    try {
      await Category.schema.validate(param, { abortEarly: false });
      return null;
    } catch (err: any) {
      return err;
    }
  }
}