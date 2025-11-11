<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'subject_id',
        'teacher_id',
        'classroom_id',
        'academic_period_id',
        'partial_score',
        'final_score',
        'final_grade',
        'status',
        'observations',
    ];

    protected $casts = [
        'partial_score' => 'array',
        'final_score' => 'float',
        'final_grade' => 'float',
    ];

    protected static function booted(): void
    {
        static::saving(function (self $grade): void {
            $scores = collect($grade->partial_score ?? [])->map(fn ($item) => is_array($item) ? ($item['valor'] ?? null) : $item)
                ->filter(static fn ($value) => is_numeric($value));
            if ($scores->isNotEmpty()) {
                $grade->final_score = round($scores->avg(), 2);
            }
            if ($grade->final_grade === null && $grade->final_score !== null) {
                $grade->final_grade = $grade->final_score;
            }
            $subject = $grade->relationLoaded('subject') ? $grade->subject : Subject::find($grade->subject_id);
            $passScore = $subject?->pass_score ?? config('school.passing_score');
            if ($grade->final_grade !== null) {
                $grade->status = $grade->final_grade >= $passScore ? 'aprobado' : 'reprobado';
            }
            $grade->attributes['partial_score'] = json_encode($scores->values());
        });
    }

    public function getPartialScoreAttribute($value): array
    {
        return collect(json_decode($value ?? '[]', true))->map(fn ($item) => (float) $item)->toArray();
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
}
