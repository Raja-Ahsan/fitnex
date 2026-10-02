<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TrainerGoogleCalendarReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $connectUrl;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->connectUrl = rtrim(config('app.url'), '/') . '/trainer/google';
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Connect your Google Calendar to FITNEX',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.trainer_google_calendar_reminder',
        );
    }
}
