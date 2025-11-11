<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update estudiantes');
    }

    public function rules(): array
    {
        return [
            'first_name' => ['sometimes', 'string', 'max:120'],
            'last_name' => ['sometimes', 'string', 'max:120'],
            'document_type' => ['sometimes', 'string', 'max:10'],
            'document_number' => ['sometimes', 'string', 'max:25', 'unique:students,document_number,' . $this->route('student')->id],
            'birth_date' => ['sometimes', 'date'],
            'gender' => ['nullable', 'in:masculino,femenino,otro'],
            'address' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:150'],
            'current_grade' => ['sometimes', 'string', 'max:20'],
            'current_section' => ['sometimes', 'string', 'max:10'],
            'school_year' => ['sometimes', 'string', 'max:9'],
            'status' => ['sometimes', 'in:activo,inactivo'],
            'guardian_name' => ['sometimes', 'string', 'max:150'],
            'guardian_phone' => ['nullable', 'string', 'max:30'],
            'guardian_email' => ['nullable', 'email', 'max:150'],
        ];
    }
}
