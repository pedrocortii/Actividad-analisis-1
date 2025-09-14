<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WorkGroup;

class WorkGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WorkGroup::create([
            'name' => 'Grupo A',
            'vehiculo_id' => 1 // Asegúrate que el vehículo exista
        ]);
        WorkGroup::create([
            'name' => 'Grupo B',
            'vehiculo_id' => 2
        ]);
    }
}
