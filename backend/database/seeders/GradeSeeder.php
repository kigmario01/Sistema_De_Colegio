<?php

namespace Database\Seeders;

use App\Models\AcademicPeriod;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    public function run(): void
    {
        $student = Student::first();
        $subject = Subject::first();
        $teacher = Teacher::first();
        $classroom = Classroom::first();
        $period = AcademicPeriod::first();

        Grade::firstOrCreate(
            [
                'student_id' => $student->id,
                'subject_id' => $subject->id,
                'academic_period_id' => $period->id,
            ],
            [
                'teacher_id' => $teacher->id,
                'classroom_id' => $classroom->id,
                'partial_score' => [18, 19, 17],
                'final_grade' => 18,
                'status' => 'aprobado',
                'observations' => 'Excelente desempeño',
            ]
        );
    }
}
