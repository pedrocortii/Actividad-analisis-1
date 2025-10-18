<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\TareaSeeder;
use Database\Seeders\VehiculoSeeder;
use Database\Seeders\EmployeeSeeder;
use Database\Seeders\WorkGroupSeeder;
use Database\Seeders\WorkGroupEmployeeSeeder;
use Database\Seeders\MarcaVehiculoSeeder;
use Database\Seeders\SkillSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\WorkOrderSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TareaSeeder::class);
        $this->call(MarcaVehiculoSeeder::class);
        $this->call(VehiculoSeeder::class);
        $this->call(SkillSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(WorkGroupSeeder::class);
        $this->call(WorkGroupEmployeeSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(WorkOrderSeeder::class);
    }
}
