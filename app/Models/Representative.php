<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Representative extends Model
{
    protected $fillable = ['name', 'email', 'phone'];

   // Relación: Un padre (o representante) puede tener varios estudiantes.
   public function students()
   {
       return $this->hasMany(Student::class);
   }
}
