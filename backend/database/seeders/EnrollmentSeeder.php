<?php

namespace Database\Seeders;

use App\Models\AcademicPeriod;
use App\Models\Classroom;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    public function run(): void
    {
        $student = Student::first();
        $classroom = Classroom::first();
        $period = AcademicPeriod::first();

        Enrollment::firstOrCreate(
            [
                'student_id' => $student->id,
                'classroom_id' => $classroom->id,
                'academic_period_id' => $period->id,
            ],
            [
                'enrolled_at' => now()->subMonths(2),
                'status' => 'regular',
            ]
        );
    }
}
