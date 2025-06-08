<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tarea;
class TareaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tarea::create(['nombre'=> 'Instalacion']);
        Tarea::create(['nombre'=> 'Service']);
        Tarea::create(['nombre'=> 'Reconexion']);
        Tarea::create(['nombre'=> 'Desconexion']);
    }
}
