<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkGroup extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'vehicle_id'
    ];

    public function vehiculo()
    {
    return $this->belongsTo(Vehiculo::class);
    }

    public function employees()
    {
    return $this->belongsToMany(Employee::class, 'work_group_employees');
    }   
}