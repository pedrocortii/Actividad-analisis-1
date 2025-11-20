<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    // Relación con las transiciones donde este estado es el de origen
    public function fromTransitions()
    {
        return $this->hasMany(WorkflowTransition::class, 'from_status_id');
    }

    // Relación con las transiciones donde este estado es el de destino
    public function toTransitions()
    {
        return $this->hasMany(WorkflowTransition::class, 'to_status_id');
    }
}