<?php

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'classroom_id',
        'subject_id',
        'teacher_id',
        'day_of_week',
        'starts_at',
        'ends_at',
        'room',
    ];

    protected $casts = [
        'starts_at' => 'datetime:H:i',
        'ends_at' => 'datetime:H:i',
    ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function overlaps(self $other): bool
    {
        if ($this->day_of_week !== $other->day_of_week || $this->classroom_id !== $other->classroom_id) {
            return false;
        }

        /** @var CarbonInterface $start */
        $start = $this->starts_at;
        /** @var CarbonInterface $end */
        $end = $this->ends_at;
        return $start->lessThan($other->ends_at) && $end->greaterThan($other->starts_at);
    }
}
