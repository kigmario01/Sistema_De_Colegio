<?php

namespace App\Notifications;

use App\Models\Grade;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GradeStatusChanged extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly Grade $grade)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage())
            ->subject('Actualización de calificación')
            ->line("La calificación de {$this->grade->subject->name} ha sido actualizada.")
            ->line("Nota final: {$this->grade->final_grade}")
            ->line("Estado: {$this->grade->status}")
            ->action('Ver detalles', url('/portal-estudiante/calificaciones'));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'grade_id' => $this->grade->id,
            'status' => $this->grade->status,
            'final_grade' => $this->grade->final_grade,
        ];
    }
}
