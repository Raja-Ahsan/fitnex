<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Appointment;

class AppointmentConfirmedMail extends Mailable
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
        
        $email = $this->subject('Appointment Confirmed - ' . $this->appointment->trainer->name)
                    ->view('emails.appointment_confirmed')
                    ->with([
                        'appointment' => $this->appointment,
                        'user' => $this->appointment->user,
                        'trainer' => $this->appointment->trainer,
                        'clientName' => $clientName,
                        'clientEmail' => $clientEmail,
                    ]);

        // Generate ICS content
        $icsContent = $this->generateIcsContent();
        
        // Attach ICS file
        $email->attachData($icsContent, 'appointment.ics', [
            'mime' => 'text/calendar',
        ]);
        
        return $email;
    }

    /**
     * Generate ICS content for the appointment
     *
     * @return string
     */
    protected function generateIcsContent()
    {
        $appointment = $this->appointment;
        $trainer = $appointment->trainer;
        
        $startTime = \Carbon\Carbon::parse($appointment->appointment_date . ' ' . $appointment->appointment_time);
        $endTime = $startTime->copy()->addHour(); // Default to 1 hour
        
        $start = $startTime->format('Ymd\THis');
        $end = $endTime->format('Ymd\THis');
        
        $summary = "Training Session with " . $trainer->name;
        $description = "Training session with " . $trainer->name . "\n";
        $description .= "Price: $" . $trainer->price . "\n";
        if ($appointment->description) {
            $description .= "Notes: " . $appointment->description;
        }
        
        // Basic ICS structure
        $ics = "BEGIN:VCALENDAR\r\n";
        $ics .= "VERSION:2.0\r\n";
        $ics .= "PRODID:-//FitNex//Appointment Booking//EN\r\n";
        $ics .= "METHOD:REQUEST\r\n"; // Helps email clients recognize it as a meeting request
        $ics .= "BEGIN:VEVENT\r\n";
        $ics .= "UID:" . $appointment->id . "@fitnex.com\r\n"; // Unique ID
        $ics .= "DTSTAMP:" . gmdate('Ymd\THis\Z') . "\r\n";
        $ics .= "DTSTART:{$start}\r\n";
        $ics .= "DTEND:{$end}\r\n";
        $ics .= "SUMMARY:{$summary}\r\n";
        $ics .= "DESCRIPTION:{$description}\r\n";
        $ics .= "LOCATION:FitNex Training Center\r\n"; // Optional location
        $ics .= "STATUS:CONFIRMED\r\n";
        $ics .= "SEQUENCE:0\r\n";
        $ics .= "END:VEVENT\r\n";
        $ics .= "END:VCALENDAR\r\n";
        
        return $ics;
    }
} 