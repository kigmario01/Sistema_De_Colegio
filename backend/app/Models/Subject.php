<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'grade_level',
        'credits',
        'pass_score',
    ];

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class, 'classroom_subject_teacher')
            ->withPivot(['teacher_id', 'weekly_hours'])
            ->withTimestamps();
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
