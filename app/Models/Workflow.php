<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workflow extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    // Relación con las transiciones de este flujo de trabajo
    public function transitions()
    {
        return $this->hasMany(WorkflowTransition::class);
    }
}