<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'day_of_week' => $this->day_of_week,
            'starts_at' => optional($this->starts_at)->format('H:i'),
            'ends_at' => optional($this->ends_at)->format('H:i'),
            'room' => $this->room,
            'subject' => new SubjectResource($this->whenLoaded('subject')),
            'classroom' => new ClassroomResource($this->whenLoaded('classroom')),
        ];
    }
}
