<?php

namespace Database\Seeders;

use App\Models\AcademicPeriod;
use App\Models\Classroom;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    public function run(): void
    {
        $period = AcademicPeriod::first();

        $classroom = Classroom::firstOrCreate(
            ['name' => '1A', 'academic_period_id' => $period->id],
            [
                'grade_level' => '1',
                'section' => 'A',
                'capacity' => 30,
            ]
        );

        $subjects = Subject::all();
        $classroom->subjects()->syncWithoutDetaching($subjects->pluck('id')->mapWithKeys(fn ($id) => [$id => ['teacher_id' => 1, 'weekly_hours' => 5]])->toArray());
    }
}
