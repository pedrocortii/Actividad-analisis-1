<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\WorkGroup;

class Vehiculo extends Model
{
    use HasFactory;
    protected $fillable = [
        'patente',
        'marca_vehiculo_id',
        'modelo',
        'año',
        'foto',
        'vtv',
        'estado',
        'mobile_id'
    ];

    public function workGroup()
    {
        return $this->hasOne(WorkGroup::class);
    }

    public function marca()
    {
        return $this->belongsTo(MarcaVehiculo::class, 'marca_vehiculo_id');
    }

    public function setPatenteAttribute($value)
    {
        $this->attributes['patente'] = strtoupper(str_replace(' ', '', $value));
    }
}
