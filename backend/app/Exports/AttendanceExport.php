<?php

namespace App\Exports;

use App\Models\Attendance;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AttendanceExport implements FromView
{
    public function __construct(private readonly int $classroomId, private readonly ?\DateTimeInterface $from = null, private readonly ?\DateTimeInterface $to = null)
    {
    }

    public function view(): View
    {
        $query = Attendance::query()->with(['student', 'subject'])
            ->where('classroom_id', $this->classroomId);

        if ($this->from) {
            $query->whereDate('date', '>=', $this->from);
        }
        if ($this->to) {
            $query->whereDate('date', '<=', $this->to);
        }

        return view('exports.attendance', [
            'records' => $query->get(),
        ]);
    }
}
