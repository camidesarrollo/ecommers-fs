<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Domain\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear permisos
        $permisos = [
            'gestionar usuarios',
            'gestionar productos',
            'comprar productos',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso, 'guard_name' => 'web']);
        }

        // Crear roles
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $compradorRole = Role::firstOrCreate(['name' => 'comprador', 'guard_name' => 'web']);

        // Asignar permisos a roles
        $adminRole->givePermissionTo(Permission::all());
        $compradorRole->givePermissionTo(['comprar productos']);

        // Crear usuario Administrador
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrador',
                'apellido' => 'Sistema',
                'rut' => '99999999-9',
                'phone' => '987654321',
                'password' => Hash::make('password123'), // cámbialo luego
            ]
        );
        $admin->assignRole($adminRole);

        // Crear usuario Comprador
        $comprador = User::firstOrCreate(
            ['email' => 'comprador@example.com'],
            [
                'name' => 'Comprador',
                'apellido' => 'Cliente',
                'rut' => '22222222-2',
                'phone' => '912345678',
                'password' => Hash::make('password123'), // cámbialo luego
            ]
        );
        $comprador->assignRole($compradorRole);
    }
}
