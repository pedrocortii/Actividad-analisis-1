<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarcaVehiculo extends Model
{
    use HasFactory;
    protected $fillable = ['nombre'];

    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class, 'marca_vehiculo_id');
    }
}
