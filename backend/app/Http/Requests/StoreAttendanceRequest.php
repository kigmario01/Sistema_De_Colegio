<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttendanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create asistencias');
    }

    public function rules(): array
    {
        return [
            'student_id' => ['required', 'exists:students,id'],
            'classroom_id' => ['required', 'exists:classrooms,id'],
            'subject_id' => ['required', 'exists:subjects,id'],
            'teacher_id' => ['required', 'exists:teachers,id'],
            'academic_period_id' => ['required', 'exists:academic_periods,id'],
            'date' => ['required', 'date'],
            'status' => ['required', 'in:presente,ausente,retardo,justificado'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
