<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGradeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create calificaciones');
    }

    public function rules(): array
    {
        return [
            'student_id' => ['required', 'exists:students,id'],
            'subject_id' => ['required', 'exists:subjects,id'],
            'teacher_id' => ['required', 'exists:teachers,id'],
            'classroom_id' => ['required', 'exists:classrooms,id'],
            'academic_period_id' => ['required', 'exists:academic_periods,id'],
            'partial_score' => ['required', 'array', 'min:1'],
            'partial_score.*.valor' => ['required', 'numeric', 'between:0,20'],
            'final_grade' => ['nullable', 'numeric', 'between:0,20'],
            'observations' => ['nullable', 'string'],
        ];
    }
}
