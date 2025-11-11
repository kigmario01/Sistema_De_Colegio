<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClassroomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update aulas');
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:120'],
            'grade_level' => ['sometimes', 'string', 'max:20'],
            'section' => ['sometimes', 'string', 'max:10'],
            'capacity' => ['sometimes', 'integer', 'min:1'],
            'academic_period_id' => ['sometimes', 'exists:academic_periods,id'],
            'subjects' => ['nullable', 'array'],
            'subjects.*' => ['integer', 'exists:subjects,id'],
        ];
    }
}
