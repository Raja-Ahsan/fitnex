<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class NotificationService
{
    /**
     * Send booking confirmation notification.
     * 
     * @param Booking $booking
     * @return void
     */
    public function sendBookingConfirmation(Booking $booking)
    {
        try {
            // Send to customer
            $this->sendEmail(
                $booking->user->email,
                'Booking Confirmed - Training Session',
                'emails.booking.confirmed',
                [
                    'booking' => $booking,
                    'customer' => $booking->user,
                    'trainer' => $booking->trainer,
                ]
            );

            // Send to trainer
            $this->sendEmail(
                $booking->trainer->email,
                'New Booking Received',
                'emails.booking.new-for-trainer',
                [
                    'booking' => $booking,
                    'customer' => $booking->user,
                    'trainer' => $booking->trainer,
                ]
            );

            Log::info("Booking confirmation emails sent for booking #{$booking->id}");
        } catch (\Exception $e) {
            Log::error("Failed to send booking confirmation: " . $e->getMessage());
        }
    }

    /**
     * Send booking cancellation notification.
     * 
     * @param Booking $booking
     * @param string $cancelledBy 'customer' or 'trainer'
     * @return void
     */
    public function sendBookingCancellation(Booking $booking, string $cancelledBy = 'customer')
    {
        try {
            if ($cancelledBy === 'customer') {
                // Notify trainer
                $this->sendEmail(
                    $booking->trainer->email,
                    'Booking Cancelled by Customer',
                    'emails.booking.cancelled-by-customer',
                    [
                        'booking' => $booking,
                        'customer' => $booking->user,
                        'trainer' => $booking->trainer,
                    ]
                );

                // Confirm to customer
                $this->sendEmail(
                    $booking->user->email,
                    'Booking Cancellation Confirmed',
                    'emails.booking.cancellation-confirmed',
                    [
                        'booking' => $booking,
                        'customer' => $booking->user,
                    ]
                );
            } else {
                // Notify customer
                $this->sendEmail(
                    $booking->user->email,
                    'Booking Cancelled by Trainer',
                    'emails.booking.cancelled-by-trainer',
                    [
                        'booking' => $booking,
                        'customer' => $booking->user,
                        'trainer' => $booking->trainer,
                    ]
                );
            }

            Log::info("Booking cancellation emails sent for booking #{$booking->id}");
        } catch (\Exception $e) {
            Log::error("Failed to send cancellation notification: " . $e->getMessage());
        }
    }

    /**
     * Send booking reschedule notification.
     * 
     * @param Booking $booking
     * @param string $rescheduledBy 'customer' or 'trainer'
     * @param string|null $oldDateTime
     * @param string|null $newDateTime
     * @return void
     */
    public function sendBookingReschedule(Booking $booking, string $rescheduledBy, $oldDateTime = null, $newDateTime = null)
    {
        try {
            if ($rescheduledBy === 'customer') {
                // Notify trainer
                $this->sendEmail(
                    $booking->trainer->email,
                    'Booking Rescheduled by Customer',
                    'emails.booking.rescheduled-by-customer',
                    [
                        'booking' => $booking,
                        'customer' => $booking->user,
                        'trainer' => $booking->trainer,
                        'old_datetime' => $oldDateTime,
                        'new_datetime' => $newDateTime,
                    ]
                );

                // Confirm to customer
                $this->sendEmail(
                    $booking->user->email,
                    'Booking Rescheduled Successfully',
                    'emails.booking.reschedule-confirmed',
                    [
                        'booking' => $booking,
                        'customer' => $booking->user,
                        'old_datetime' => $oldDateTime,
                        'new_datetime' => $newDateTime,
                    ]
                );
            } else {
                // Notify customer
                $this->sendEmail(
                    $booking->user->email,
                    'Booking Rescheduled by Trainer',
                    'emails.booking.rescheduled-by-trainer',
                    [
                        'booking' => $booking,
                        'customer' => $booking->user,
                        'trainer' => $booking->trainer,
                        'old_datetime' => $oldDateTime,
                        'new_datetime' => $newDateTime,
                    ]
                );
            }

            Log::info("Booking reschedule emails sent for booking #{$booking->id}");
        } catch (\Exception $e) {
            Log::error("Failed to send reschedule notification: " . $e->getMessage());
        }
    }

    /**
     * Send payment success notification.
     * 
     * @param Booking $booking
     * @return void
     */
    public function sendPaymentSuccess(Booking $booking)
    {
        try {
            $this->sendEmail(
                $booking->user->email,
                'Payment Successful - Training Session Booked',
                'emails.payment.success',
                [
                    'booking' => $booking,
                    'customer' => $booking->user,
                    'trainer' => $booking->trainer,
                ]
            );

            Log::info("Payment success email sent for booking #{$booking->id}");
        } catch (\Exception $e) {
            Log::error("Failed to send payment success notification: " . $e->getMessage());
        }
    }

    /**
     * Send payment failed notification.
     * 
     * @param Booking $booking
     * @return void
     */
    public function sendPaymentFailed(Booking $booking)
    {
        try {
            $this->sendEmail(
                $booking->user->email,
                'Payment Failed - Please Try Again',
                'emails.payment.failed',
                [
                    'booking' => $booking,
                    'customer' => $booking->user,
                ]
            );

            Log::info("Payment failed email sent for booking #{$booking->id}");
        } catch (\Exception $e) {
            Log::error("Failed to send payment failed notification: " . $e->getMessage());
        }
    }

    /**
     * Send booking reminder (24 hours before).
     * 
     * @param Booking $booking
     * @return void
     */
    public function sendBookingReminder(Booking $booking)
    {
        try {
            // Send to customer
            $this->sendEmail(
                $booking->user->email,
                'Reminder: Training Session Tomorrow',
                'emails.booking.reminder',
                [
                    'booking' => $booking,
                    'customer' => $booking->user,
                    'trainer' => $booking->trainer,
                ]
            );

            // Send to trainer
            $this->sendEmail(
                $booking->trainer->email,
                'Reminder: Training Session Tomorrow',
                'emails.booking.reminder-trainer',
                [
                    'booking' => $booking,
                    'customer' => $booking->user,
                    'trainer' => $booking->trainer,
                ]
            );

            Log::info("Booking reminder emails sent for booking #{$booking->id}");
        } catch (\Exception $e) {
            Log::error("Failed to send booking reminder: " . $e->getMessage());
        }
    }

    /**
     * Helper method to send email.
     * 
     * @param string $to
     * @param string $subject
     * @param string $view
     * @param array $data
     * @return void
     */
    protected function sendEmail(string $to, string $subject, string $view, array $data = [])
    {
        Mail::send($view, $data, function ($message) use ($to, $subject) {
            $message->to($to)
                ->subject($subject);
        });
    }

    /**
     * Create database notification.
     * 
     * @param User $user
     * @param string $type
     * @param array $data
     * @return void
     */
    public function createDatabaseNotification(User $user, string $type, array $data)
    {
        try {
            $user->notifications()->create([
                'type' => $type,
                'data' => $data,
                'read_at' => null,
            ]);

            Log::info("Database notification created for user #{$user->id}, type: {$type}");
        } catch (\Exception $e) {
            Log::error("Failed to create database notification: " . $e->getMessage());
        }
    }
}
