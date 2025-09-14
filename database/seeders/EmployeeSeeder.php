<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::create([
            'nombre' => 'Juan',
            'apellido' => 'Pérez',
            'dni' => '12345678',
            'telefono' => '1122334455',
            'email' => 'juan@example.com',
            'direccion' => 'Calle Falsa 123',
            'rol' => 'Chofer',
            'licencia_conducir' => null,
            'fecha_contratacion' => '2023-01-01',
            'estado' => 'activo'
        ]);
        Employee::create([
            'nombre' => 'Ana',
            'apellido' => 'García',
            'dni' => '87654321',
            'telefono' => '2233445566',
            'email' => 'ana@example.com',
            'direccion' => 'Av. Siempreviva 742',
            'rol' => 'Ayudante',
            'licencia_conducir' => null,
            'fecha_contratacion' => '2024-02-15',
            'estado' => 'activo'
        ]);
    }
}
