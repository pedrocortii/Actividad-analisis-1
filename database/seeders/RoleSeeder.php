<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Crear permisos
        //Permisos tareas  
        Permission::create(['name' => 'ver tareas']);
        Permission::create(['name' => 'crear tareas']);
        Permission::create(['name' => 'editar tareas']);
        Permission::create(['name' => 'borrar tareas']);
        //permisos usuarios
        Permission::create(['name' => 'ver usuarios']);
        Permission::create(['name' => 'crear usuarios']);
        Permission::create(['name' => 'editar usuarios']);
        Permission::create(['name' => 'eliminar usuarios']);
        //Permisos vehiculos
        Permission::create(['name' => 'ver vehiculos']);
        Permission::create(['name' => 'crear vehiculos']);
        Permission::create(['name' => 'editar vehiculos']);
        Permission::create(['name' => 'eliminar vehiculos']);
        //Permisos Employees
        Permission::create(['name' => 'ver employees']);
        Permission::create(['name' => 'crear employees']);
        Permission::create(['name' => 'editar employees']);
        Permission::create(['name' => 'eliminar employees']);
        //Permisos Work Groups
        Permission::create(['name' => 'ver work groups']);
        Permission::create(['name' => 'crear work groups']);
        Permission::create(['name' => 'editar work groups']);
        Permission::create(['name' => 'eliminar work groups']);
        //Permisos Work Groups Employees
        Permission::create(['name' => 'ver work group employees']);
        Permission::create(['name' => 'crear work group employees']);
        Permission::create(['name' => 'editar work group employees']);
        Permission::create(['name' => 'eliminar work group employees']);
        //Permisos Marca Vehiculos
        Permission::create(['name' => 'ver marca vehiculos']);
        Permission::create(['name' => 'crear marca vehiculos']);
        Permission::create(['name' => 'editar marca vehiculos']);
        Permission::create(['name' => 'eliminar marca vehiculos']);
        //Permisos Skills
        Permission::create(['name' => 'ver skills']);
        Permission::create(['name' => 'crear skills']);
        Permission::create(['name' => 'editar skills']);
        Permission::create(['name' => 'eliminar skills']);
        //permisos work orders
        Permission::create(['name' => 'ver work orders']);
        Permission::create(['name' => 'editar work orders']);
        Permission::create(['name' => 'crear work orders']);
        //Crear roles 
        $admin = Role::create(['name' => 'admin']);
        $empleado = Role::create(['name' => 'empleado']);
        $cliente = Role::create(['name' => 'cliente']);
        $jefe = Role::create(['name' => 'jefe']);
        //Asignar permisos
        $admin->givePermissionTo(Permission::all());
        $empleado->givePermissionTo(['ver tareas','ver vehiculos','ver employees','ver work groups','ver work group employees','ver marca vehiculos','ver skills', 'ver work orders','editar work orders','ver usuarios']);
        $cliente->givePermissionTo(['ver tareas','ver vehiculos']);
        $jefe->givePermissionTo(['ver tareas','crear tareas','editar tareas','borrar tareas','ver vehiculos','crear vehiculos','editar vehiculos','eliminar vehiculos','ver employees','crear employees','editar employees','eliminar employees','ver work groups','crear work groups','editar work groups','eliminar work groups','ver work group employees','crear work group employees','editar work group employees','eliminar work group employees','ver marca vehiculos','crear marca vehiculos','editar marca vehiculos','eliminar marca vehiculos','ver skills','crear skills','editar skills','eliminar skills','ver work orders','editar work orders','crear work orders','ver usuarios','crear usuarios']);
    }
}
