<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Skill::create(['nombre' => 'Instalacion de routers']);
        Skill::create(['nombre' => 'Mantenimiento de redes']);
        Skill::create(['nombre' => 'Soporte tecnico']);
        Skill::create(['nombre' => 'Configuracion de equipos']);
        Skill::create(['nombre' => 'Atencion al cliente']);
        Skill::create(['nombre' => 'Administracion de sistemas']);
        Skill::create(['nombre' => 'Seguridad informatica']);
        Skill::create(['nombre' => 'Instalacion de cableado estructurado']);
        Skill::create(['nombre' => 'Diagnostico de fallas']);
        Skill::create(['nombre' => 'Actualizacion de software']);
    }
}
