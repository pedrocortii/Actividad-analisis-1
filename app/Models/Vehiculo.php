<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;
    protected $fillable = [
        'patente',
        'marca',
        'modelo',
        'año',
        'foto',
        'vtv',
    ];

    public function movil() 
    {
        return $this->belongsTo(Movil::class);
    }
}
