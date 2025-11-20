<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkflowTransition extends Model
{
    use HasFactory;
    protected $fillable = [
        'workflow_id',
        'from_status_id',
        'to_status_id',
    ];

    // Relación con el flujo de trabajo
    public function workflow()
    {
        return $this->belongsTo(Workflow::class);
    }

    // Relación con el estado de origen
    public function fromStatus()
    {
        return $this->belongsTo(Status::class, 'from_status_id');
    }

    // Relación con el estado de destino
    public function toStatus()
    {
        return $this->belongsTo(Status::class, 'to_status_id');
    }
}