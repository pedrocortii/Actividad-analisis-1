<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vehiculo;

class VehiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vehiculo::create([
            'patente' => 'ABC123',
            'marca_vehiculo_id' => 1,
            'modelo' => 'Partner',
            'año' => 2020,
            'foto' => NULL,
            'vtv' => '2024-12-31'
        ]);

        Vehiculo::create([
            'patente' => 'XYZ789',
            'marca_vehiculo_id' => 2,
            'modelo' => 'Focus',
            'año' => 2021,
            'foto' => NULL,
            'vtv' => '2024-12-01',
        ]);
    }
}
