<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        $teacher = Teacher::firstOrCreate(
            ['document_number' => 'DOC-0001'],
            [
                'first_name' => 'Laura',
                'last_name' => 'Gómez',
                'hire_date' => now()->subYears(5),
                'specialty' => 'Matemáticas',
                'phone' => '555-1001',
                'email' => 'laura.gomez@example.com',
            ]
        );

        $user = User::firstOrCreate(
            ['email' => 'laura.gomez@example.com'],
            [
                'name' => 'Laura Gómez',
                'password' => bcrypt('password'),
            ]
        );

        $user->assignRole('docente');
        $teacher->user()->associate($user);
        $teacher->save();

        $teacher->subjects()->syncWithoutDetaching(Subject::all()->pluck('id'));
    }
}
