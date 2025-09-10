<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movil extends Model
{
    use HasFactory;
    protected $fillable = [
        'Nombre',
        'Codigo',
        'Zona_asignada',
        'Estado',
    ];

    public function vehiculos() 
    {
        return $this->hasMany(Vehiculo::class);
    } 
}
