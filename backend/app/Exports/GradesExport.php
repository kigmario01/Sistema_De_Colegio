<?php

namespace App\Exports;

use App\Models\Grade;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class GradesExport implements FromView
{
    public function __construct(private readonly int $classroomId, private readonly int $subjectId, private readonly int $periodId)
    {
    }

    public function view(): View
    {
        $grades = Grade::query()
            ->with(['student', 'subject'])
            ->where('classroom_id', $this->classroomId)
            ->where('subject_id', $this->subjectId)
            ->where('academic_period_id', $this->periodId)
            ->get();

        return view('exports.grades', compact('grades'));
    }
}
