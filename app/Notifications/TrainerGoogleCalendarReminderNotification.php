<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TrainerGoogleCalendarReminderNotification extends Notification
{
    use Queueable;

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'google_calendar_reminder',
            'title' => 'Connect your Google Calendar',
            'message' => 'The FITNEX team asked you to connect Google Calendar so your bookings sync automatically.',
            'icon' => 'fa-brands fa-google',
            'url' => route('trainer.google.index'),
        ];
    }
}
