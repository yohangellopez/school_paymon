<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Communication extends Model
{
    use HasFactory;
    
    protected $fillable = ['title', 'message', 'send_date', 'course_id'];

    // Si deseas una relación opcional con Course:
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
