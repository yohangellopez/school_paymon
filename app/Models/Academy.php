<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academy extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'description'];

    // Relación: Una academy tiene muchos cursos.
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
