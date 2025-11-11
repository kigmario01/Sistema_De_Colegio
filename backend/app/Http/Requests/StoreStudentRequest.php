<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create estudiantes');
    }

    public function rules(): array
    {
        return [
            'user_id' => ['nullable', 'exists:users,id'],
            'first_name' => ['required', 'string', 'max:120'],
            'last_name' => ['required', 'string', 'max:120'],
            'document_type' => ['required', 'string', 'max:10'],
            'document_number' => ['required', 'string', 'max:25', 'unique:students,document_number'],
            'birth_date' => ['required', 'date'],
            'gender' => ['nullable', 'in:masculino,femenino,otro'],
            'address' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:150'],
            'current_grade' => ['required', 'string', 'max:20'],
            'current_section' => ['required', 'string', 'max:10'],
            'school_year' => ['required', 'string', 'max:9'],
            'status' => ['required', 'in:activo,inactivo'],
            'guardian_name' => ['required', 'string', 'max:150'],
            'guardian_phone' => ['nullable', 'string', 'max:30'],
            'guardian_email' => ['nullable', 'email', 'max:150'],
        ];
    }
}
