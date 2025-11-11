<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'full_name' => $this->first_name . ' ' . $this->last_name,
            'document_number' => $this->document_number,
            'birth_date' => optional($this->birth_date)->toDateString(),
            'contact' => [
                'address' => $this->address,
                'phone' => $this->phone,
                'email' => $this->email,
            ],
            'academic' => [
                'grade' => $this->current_grade,
                'section' => $this->current_section,
                'school_year' => $this->school_year,
                'status' => $this->status,
            ],
            'guardian' => [
                'name' => $this->guardian_name,
                'phone' => $this->guardian_phone,
                'email' => $this->guardian_email,
            ],
            'enrollments' => EnrollmentResource::collection($this->whenLoaded('enrollments')),
            'grades' => GradeResource::collection($this->whenLoaded('grades')),
            'attendances' => AttendanceResource::collection($this->whenLoaded('attendances')),
        ];
    }
}
