<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\WorkGroup;
use App\Models\Employee;

class WorkGroupEmployee extends Model
{
    use HasFactory;
    protected $fillable = [
        'work_group_id',
        'employee_id',
    ];

    public function workGroup()
    {
        return $this->belongsTo(WorkGroup::class);
    }

    // Relación con Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
