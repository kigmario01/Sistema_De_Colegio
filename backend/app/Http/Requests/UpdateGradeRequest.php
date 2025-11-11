<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGradeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update calificaciones');
    }

    public function rules(): array
    {
        return [
            'partial_score' => ['sometimes', 'array'],
            'partial_score.*.valor' => ['required_with:partial_score', 'numeric', 'between:0,20'],
            'final_grade' => ['nullable', 'numeric', 'between:0,20'],
            'observations' => ['nullable', 'string'],
        ];
    }
}
