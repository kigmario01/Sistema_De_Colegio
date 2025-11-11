<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $student = Student::firstOrCreate(
            ['document_number' => 'EST-0001'],
            [
                'first_name' => 'Carlos',
                'last_name' => 'Pérez',
                'document_type' => 'DNI',
                'birth_date' => now()->subYears(10),
                'gender' => 'masculino',
                'address' => 'Av. Siempre Viva 123',
                'phone' => '555-2002',
                'email' => 'carlos.perez@example.com',
                'current_grade' => '1',
                'current_section' => 'A',
                'school_year' => '2025-2026',
                'status' => 'activo',
                'guardian_name' => 'Ana Pérez',
                'guardian_phone' => '555-3003',
                'guardian_email' => 'ana.perez@example.com',
            ]
        );

        $user = User::firstOrCreate(
            ['email' => 'carlos.perez@example.com'],
            [
                'name' => 'Carlos Pérez',
                'password' => bcrypt('password'),
            ]
        );

        $user->assignRole('estudiante');
        $student->user()->associate($user);
        $student->save();
    }
}
