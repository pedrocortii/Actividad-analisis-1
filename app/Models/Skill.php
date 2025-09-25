<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class Skill extends Model
{
    use HasFactory;
    protected $fillable = ['nombre'];

    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }
}
