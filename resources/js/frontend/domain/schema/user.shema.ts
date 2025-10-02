// resources/js/frontend/domain/schema/user.schema.ts

import * as yup from 'yup';

/**
 * Schema para el registro de usuario
 */
export const registerUserSchema = yup.object({
  name: yup
    .string()
    .required('El nombre es obligatorio')
    .min(2, 'El nombre debe tener al menos 2 caracteres')
    .max(50, 'El nombre no puede exceder 50 caracteres'),
  apellido: yup
    .string()
    .optional()
    .max(50, 'El apellido no puede exceder 50 caracteres'),
  email: yup
    .string()
    .required('El correo electrónico es obligatorio')
    .email('Debe ser un correo electrónico válido'),
  password: yup
    .string()
    .required('La contraseña es obligatoria')
    .min(6, 'La contraseña debe tener al menos 6 caracteres'),
  phone: yup
    .string()
    .optional()
    .matches(/^[0-9]+$/, 'El teléfono solo puede contener números')
    .min(6, 'El teléfono debe tener al menos 6 dígitos')
    .max(15, 'El teléfono no puede exceder 15 dígitos'),
  rut: yup.string().optional(),
  pasaporte: yup.string().optional(),
  roles: yup.array().of(yup.string()).optional(),
  permissions: yup.array().of(yup.string()).optional(),
});

/**
 * Schema para el login de usuario
 */
export const loginUserSchema = yup.object({
  email: yup
    .string()
    .required('El correo electrónico es obligatorio')
    .email('Debe ser un correo electrónico válido'),
  password: yup
    .string()
    .required('La contraseña es obligatoria')
});
