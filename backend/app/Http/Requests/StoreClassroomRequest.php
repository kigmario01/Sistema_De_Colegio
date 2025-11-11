<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassroomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create aulas');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'grade_level' => ['required', 'string', 'max:20'],
            'section' => ['required', 'string', 'max:10'],
            'capacity' => ['required', 'integer', 'min:1'],
            'academic_period_id' => ['required', 'exists:academic_periods,id'],
            'subjects' => ['nullable', 'array'],
            'subjects.*' => ['integer', 'exists:subjects,id'],
        ];
    }
}
