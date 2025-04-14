<?php

namespace App\Models;

use App\Enum\Course\CourseModalityEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'academy_id', 'name', 'description', 'cost', 'duration_hours', 'modality'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'modality' => CourseModalityEnum::class,
    ];

    // Relación: Un curso pertenece a una academia.
    public function academy()
    {
        return $this->belongsTo(Academy::class);
    }

    // Relación con matriculations (enrollments)
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function communications() {
        return $this->hasMany(Communication::class);
    }
}
