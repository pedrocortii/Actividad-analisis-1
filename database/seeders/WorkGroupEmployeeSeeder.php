<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WorkGroupEmployee;

class WorkGroupEmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WorkGroupEmployee::create([
            'work_group_id' => 1,
            'employee_id' => 1
        ]);
        WorkGroupEmployee::create([
            'work_group_id' => 1,
            'employee_id' => 2
        ]);
        WorkGroupEmployee::create([
            'work_group_id' => 2,
            'employee_id' => 2
        ]);
    }
}
