export interface IUserResource {
  id: number;
  name: string;
  apellido: string | null;
  email: string;
  phone: string | null;
  rut: string | null;
  pasaporte: string | null;
  status: string;
  avatar: string | null;
  roles: string[];
  permissions: string[];
  isAdmin: boolean;
  isVendor: boolean;
  isCustomer: boolean;
  isActive: boolean;
  createdAt: string | null;
  updatedAt: string | null;
}
