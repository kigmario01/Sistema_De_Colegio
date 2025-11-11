<?php

namespace Database\Seeders;

use App\Models\AcademicPeriod;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AcademicPeriodSeeder extends Seeder
{
    public function run(): void
    {
        AcademicPeriod::firstOrCreate(
            ['name' => '2025-2026'],
            [
                'start_date' => Carbon::create(2025, 9, 1),
                'end_date' => Carbon::create(2026, 7, 1),
                'is_active' => true,
                'grading_scale' => [
                    'aprobado' => ['min' => 10, 'max' => 20],
                    'recuperacion' => ['min' => 8, 'max' => 9.99],
                    'reprobado' => ['min' => 0, 'max' => 7.99],
                ],
            ]
        );
    }
}
