<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usuario administrador
        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'administrador@contratista.com',
            'password' => Hash::make('12345678'),

        ]);
        $admin->assignRole('admin');

        // Usuario empleado
        $empleado = User::create([
            'name' => 'Pepe',
            'email' => 'pepe@contratista.com',
            'password' => Hash::make('12345678'),

        ]);
        $empleado->assignRole('empleado');
    }
}