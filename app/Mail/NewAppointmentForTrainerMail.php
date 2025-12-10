<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Appointment;

class NewAppointmentForTrainerMail extends Mailable
{
    use Queueable, SerializesModels;

    public $appointment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Get client name and email (handle guest bookings)
        $clientName = $this->appointment->user ? $this->appointment->user->name : $this->appointment->name;
        $clientEmail = $this->appointment->user ? $this->appointment->user->email : $this->appointment->email;
        
        return $this->subject('New Appointment Booking - ' . $clientName)
                    ->view('emails.new_appointment_for_trainer')
                    ->with([
                        'appointment' => $this->appointment,
                        'user' => $this->appointment->user,
                        'trainer' => $this->appointment->trainer,
                        'clientName' => $clientName,
                        'clientEmail' => $clientEmail,
                    ]);
    }
} 