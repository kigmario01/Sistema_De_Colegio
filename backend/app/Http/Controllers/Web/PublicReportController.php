<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\View\View;

class PublicReportController extends Controller
{
    public function subjects(): View
    {
        return view('public.subjects', [
            'subjects' => Subject::query()->orderBy('grade_level')->get(),
        ]);
    }

    public function teachers(): View
    {
        return view('public.teachers', [
            'teachers' => Teacher::with('subjects')->get(),
        ]);
    }

    public function schedules(): View
    {
        return view('public.schedules', [
            'classrooms' => Classroom::with(['schedules.subject', 'schedules.teacher'])->get(),
        ]);
    }
}
