<?php

namespace App\Mail;

use App\Models\ContactUs;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FreeTrialSignupMail extends Mailable
{
    use Queueable, SerializesModels;

    public ContactUs $signup;

    public ?string $serviceLabel;

    public function __construct(ContactUs $signup, ?string $serviceLabel = null)
    {
        $this->signup = $signup;
        $this->serviceLabel = $serviceLabel;
    }

    public function build()
    {
        return $this->subject('New Free Trial Signup - FITNEX')
            ->view('emails.free_trial_signup');
    }
}
