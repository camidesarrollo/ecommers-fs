<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Domain\Models\User;
use Illuminate\Support\Facades\Hash;

class ApiRolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // ------------------------------
        // Permisos
        // ------------------------------
        $permissions = [
            'view users', 'create users', 'edit users', 'delete users', 'manage user roles',
            'view products', 'create products', 'edit products', 'delete products', 'manage inventory',
            'view orders', 'create orders', 'edit orders', 'delete orders', 'view own orders', 'manage order status',
            'view categories', 'create categories', 'edit categories', 'delete categories',
            'view sales reports', 'view inventory reports', 'view user reports', 'export reports',
            'manage settings', 'manage site configuration',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // ------------------------------
        // Roles
        // ------------------------------
        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $superAdmin->givePermissionTo(Permission::all());

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo([
            'view users', 'create users', 'edit users', 'delete users', 'manage user roles',
            'view products', 'create products', 'edit products', 'delete products', 'manage inventory',
            'view orders', 'edit orders', 'manage order status',
            'view categories', 'create categories', 'edit categories', 'delete categories',
            'view sales reports', 'view inventory reports', 'view user reports', 'export reports',
        ]);

        $vendor = Role::firstOrCreate(['name' => 'vendor']);
        $vendor->givePermissionTo([
            'view products', 'create products', 'edit products', 'manage inventory',
            'view orders', 'edit orders',
            'view categories',
            'view sales reports', 'view inventory reports',
        ]);

        $customer = Role::firstOrCreate(['name' => 'customer']);
        $customer->givePermissionTo([
            'view products',
            'view categories',
            'create orders',
            'view own orders',
        ]);

        // ------------------------------
        // Crear usuario administrador
        // ------------------------------
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'], // único identificador
            [
                'name' => 'Administrador',
                'password' => Hash::make('password123'), // cambiar a un password seguro
            ]
        );

        // Asignar rol super-admin si no lo tiene
        if (!$adminUser->hasRole('super-admin')) {
            $adminUser->assignRole('super-admin');
        }
    }
}
