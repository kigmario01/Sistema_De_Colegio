<?php

namespace App\Observers;

use App\Models\Grade;
use Illuminate\Support\Facades\Notification;
use App\Notifications\GradeStatusChanged;

class GradeObserver
{
    public function updated(Grade $grade): void
    {
        if ($grade->wasChanged('status') && $grade->student?->user) {
            Notification::send($grade->student->user, new GradeStatusChanged($grade));
        }
    }
}
