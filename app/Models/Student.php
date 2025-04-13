<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['first_name', 'last_name', 'date_of_birth','representative_id'];

    // Relación: Un estudiante pertenece a un padre (o representante).
    public function representative()
    {
        return $this->belongsTo(Representative::class);
    }

    // Relación: Un estudiante se inscribe en un curso mediante una matriculation.
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
