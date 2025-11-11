<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAttendanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update asistencias');
    }

    public function rules(): array
    {
        return [
            'status' => ['sometimes', 'in:presente,ausente,retardo,justificado'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
