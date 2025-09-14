<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\WorkGroup;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'telefono',
        'email',
        'direccion',
        'rol',
        'licencia_conducir',
        'fecha_contratacion',
        'estado'
    ];

    public function workGroups()
    {
        return $this->belongsToMany(WorkGroup::class, 'work_group_employees');
    }
}
