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
        Permission::create(['name' => 'ver tareas']);
        Permission::create(['name' => 'crear tareas']);
        Permission::create(['name' => 'editar tareas']);
        Permission::create(['name' => 'borrar tareas']);

        //Crear roles 
        $admin = Role::create(['name' => 'admin']);
        $empleado = Role::create(['name' => 'empleado']);

        //Asignar permisos
        $admin->givePermissionTo(Permission::all());
        $empleado->givePermissionTo(['ver tareas']);
    }
}
