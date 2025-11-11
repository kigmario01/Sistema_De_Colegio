<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'document_number' => $this->document_number,
            'hire_date' => optional($this->hire_date)->toDateString(),
            'specialty' => $this->specialty,
            'contact' => [
                'phone' => $this->phone,
                'email' => $this->email,
            ],
            'subjects' => SubjectResource::collection($this->whenLoaded('subjects')),
            'schedules' => ScheduleResource::collection($this->whenLoaded('schedules')),
        ];
    }
}
