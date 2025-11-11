<?php

namespace Database\Seeders;

use App\Models\AcademicPeriod;
use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        $student = Student::first();
        $classroom = Classroom::first();
        $subject = Subject::first();
        $teacher = Teacher::first();
        $period = AcademicPeriod::first();

        Attendance::firstOrCreate(
            [
                'student_id' => $student->id,
                'classroom_id' => $classroom->id,
                'subject_id' => $subject->id,
                'teacher_id' => $teacher->id,
                'academic_period_id' => $period->id,
                'date' => now()->subDay()->toDateString(),
            ],
            [
                'status' => 'presente',
                'notes' => 'Asistencia puntual',
            ]
        );
    }
}
