<?php

namespace App\Services;

use App\Exports\GradesExport;
use App\Exports\AttendanceExport;
use App\Models\Attendance;
use App\Models\Classroom;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ReportExportService
{
    public function generateAttendancePdf(int $classroomId, ?\DateTimeInterface $from, ?\DateTimeInterface $to): string
    {
        $classroom = Classroom::with('students', 'academicPeriod')->findOrFail($classroomId);
        $query = Attendance::query()->with(['student', 'subject'])
            ->where('classroom_id', $classroomId);
        if ($from) {
            $query->whereDate('date', '>=', $from);
        }
        if ($to) {
            $query->whereDate('date', '<=', $to);
        }
        $records = $query->get();

        $pdf = Pdf::loadView('reports.attendance', [
            'classroom' => $classroom,
            'records' => $records,
        ]);

        Storage::makeDirectory('reports');
        $fileName = storage_path('app/reports/attendance-' . Str::uuid() . '.pdf');
        $pdf->save($fileName);

        return $fileName;
    }

    public function generateAttendanceExcel(int $classroomId, ?\DateTimeInterface $from = null, ?\DateTimeInterface $to = null): string
    {
        Storage::makeDirectory('reports');
        $fileName = 'reports/attendance-' . Str::uuid() . '.xlsx';
        Excel::store(new AttendanceExport($classroomId, $from, $to), $fileName);

        return storage_path('app/' . $fileName);
    }

    public function generateGradesExcel(int $classroomId, int $subjectId, int $periodId): string
    {
        Storage::makeDirectory('reports');
        $fileName = 'reports/grades-' . Str::uuid() . '.xlsx';
        Excel::store(new GradesExport($classroomId, $subjectId, $periodId), $fileName);

        return storage_path('app/' . $fileName);
    }
}
