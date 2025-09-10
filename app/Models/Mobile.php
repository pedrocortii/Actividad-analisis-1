<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobile extends Model
{
    use HasFactory;
    protected $fillable = ['nombre'];

    public function vehiculos() 
    {
        return $this->hasMany(Vehiculo::class);
    }
}

