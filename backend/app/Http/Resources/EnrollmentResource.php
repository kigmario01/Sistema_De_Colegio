<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EnrollmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'enrolled_at' => optional($this->enrolled_at)->toDateString(),
            'classroom' => new ClassroomResource($this->whenLoaded('classroom')),
            'academic_period' => new AcademicPeriodResource($this->whenLoaded('academicPeriod')),
        ];
    }
}
