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
        'marca',
        'modelo',
        'año',
        'foto',
        'vtv',
        'mobile_id'
    ];

    public function workGroup()
    {
        return $this->hasOne(WorkGroup::class);
    }
}
