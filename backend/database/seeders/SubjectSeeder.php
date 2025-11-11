<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [
            ['name' => 'Matemáticas', 'code' => 'MAT', 'grade_level' => '1', 'credits' => 5, 'pass_score' => 10, 'description' => 'Matemáticas básicas'],
            ['name' => 'Lengua', 'code' => 'LEN', 'grade_level' => '1', 'credits' => 4, 'pass_score' => 10, 'description' => 'Comunicación y lenguaje'],
            ['name' => 'Ciencias', 'code' => 'CIE', 'grade_level' => '1', 'credits' => 4, 'pass_score' => 10, 'description' => 'Ciencias naturales'],
        ];

        foreach ($subjects as $subject) {
            Subject::firstOrCreate(['code' => $subject['code']], $subject);
        }
    }
}
