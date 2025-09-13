<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkGroupEmployee extends Model
{
    use HasFactory;
    protected $fillable = [
        'work_group_id',
        'employee_id',
    ];
}
