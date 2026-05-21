<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Email extends Mailable
{
    use Queueable, SerializesModels;
    public $details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $fromAddress = config('mail.from.address', 'joinfitnex@gmail.com');
        $fromName = config('mail.from.name', 'FITNEX');

        if ($this->details['from'] == 'verify') {
            return $this->from($fromAddress, $fromName)
                ->subject('Verify your FITNEX account')
                ->view('emails.verify-email');
        }

        if ($this->details['from'] == 'password-reset' || $this->details['from'] == 'admin-password-reset') {
            return $this->from($fromAddress, $fromName)
                ->subject('Reset Password Notification')
                ->view('emails.password-reset');
        }

        return $this->from($fromAddress, $fromName)
            ->subject('FITNEX Notification')
            ->view('emails.verify-email');
    }
}
