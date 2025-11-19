<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear Permisos para Usuarios
        Permission::create(['name' => 'ver usuarios']);
        Permission::create(['name' => 'crear usuarios']);
        Permission::create(['name' => 'editar usuarios']);
        Permission::create(['name' => 'eliminar usuarios']);
        
        // (Aquí puedes añadir todos los demás permisos de tu aplicación)
        // Ejemplo: Permission::create(['name' => 'ver vehiculos']);

        // Crear Roles
        $roleAdmin = Role::create(['name' => 'Admin']);
        $roleEmpleado = Role::create(['name' => 'Empleado']);
        $roleCliente = Role::create(['name' => 'Cliente']);
        $roleJefe = Role::create(['name' => 'Jefe']);
        // Asignar permisos al rol de Admin
        $roleAdmin->givePermissionTo(Permission::all());

        // Asignar permisos al rol de Empleado (si los tuviera)
        // $roleEmpleado->givePermissionTo(['ver vehiculos']);

        // Asignar permisos al rol de Cliente (si los tuviera)
        // $roleCliente->givePermissionTo(['crear orden de trabajo']);
    }
}
