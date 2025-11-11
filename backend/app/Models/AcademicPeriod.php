<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicPeriod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'is_active',
        'grading_scale',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
        'grading_scale' => 'array',
    ];

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
