<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    
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

    
    public function getAgeAttribute()
    {
        return Carbon::parse($this->date_of_birth)->age;
    }
}
