<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vehiculo;
use App\Models\Employee;

class WorkGroup extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'vehiculo_id',
        'status'
    ];

    public function vehiculo()
    {
    return $this->belongsTo(Vehiculo::class);
    }

    public function employees()
    {
    return $this->belongsToMany(Employee::class, 'work_group_employees');
    }
    
    public function activeWorkOrders()
    {
        return $this->hasMany(WorkOrder::class)
            ->whereHas('status', function ($q) {
                $q->whereIn('name', ['Pendiente', 'Asignado', 'Aceptado']);
            });
    }   
}