<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MarcaVehiculo;

class MarcaVehiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MarcaVehiculo::create(['nombre'=> 'Toyota']);
        MarcaVehiculo::create(['nombre'=> 'Ford']);
        MarcaVehiculo::create(['nombre'=> 'Chevrolet']);
        MarcaVehiculo::create(['nombre'=> 'Honda']);
        MarcaVehiculo::create(['nombre'=> 'Peugeot']);
        MarcaVehiculo::create(['nombre'=> 'Volkswagen']);
        MarcaVehiculo::create(['nombre'=> 'Renault']);
        MarcaVehiculo::create(['nombre'=> 'Citroën']);
    }
}
