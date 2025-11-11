<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassroomResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'grade_level' => $this->grade_level,
            'section' => $this->section,
            'capacity' => $this->capacity,
            'academic_period' => new AcademicPeriodResource($this->whenLoaded('academicPeriod')),
            'subjects' => SubjectResource::collection($this->whenLoaded('subjects')),
            'students' => StudentResource::collection($this->whenLoaded('students')),
        ];
    }
}
