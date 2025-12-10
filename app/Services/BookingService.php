<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\TimeSlot;
use App\Models\Trainer;
use App\Models\User;
use App\Models\TrainerPricing;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\NotificationService;
use App\Services\GoogleCalendarService;
use Exception;

class BookingService
{
    protected $notificationService;
    protected $calendarService;

    public function __construct(
        NotificationService $notificationService,
        GoogleCalendarService $calendarService
    ) {
        $this->notificationService = $notificationService;
        $this->calendarService = $calendarService;
    }
    /**
     * Create a new booking.
     * 
     * @param array $data
     * @return Booking
     * @throws Exception
     */
    public function createBooking(array $data): Booking
    {
        DB::beginTransaction();
        try {
            // Validate slot availability
            $timeSlot = TimeSlot::findOrFail($data['time_slot_id']);

            if (!$this->validateSlotAvailability($timeSlot->id)) {
                throw new Exception('This time slot is no longer available.');
            }

            // Get pricing
            $trainer = Trainer::findOrFail($data['trainer_id']);
            $availability = $timeSlot->availability;
            $sessionDuration = $availability ? $availability->session_duration : 60;

            $price = $this->getTrainerPrice($trainer->id, $sessionDuration);

            // Create booking
            $booking = Booking::create([
                'user_id' => $data['user_id'],
                'trainer_id' => $data['trainer_id'],
                'time_slot_id' => $timeSlot->id,
                'price' => $price,
                'currency' => 'USD',
                'payment_status' => 'pending',
                'booking_status' => 'pending',
                'notes' => $data['notes'] ?? null,
            ]);

            // Mark slot as booked
            $timeSlot->update([
                'is_booked' => true,
                'booking_id' => $booking->id,
            ]);

            DB::commit();
            Log::info("Booking created: {$booking->id} for user {$data['user_id']}");

            return $booking;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Error creating booking: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Validate if a time slot is available for booking.
     * 
     * @param int $slotId
     * @return bool
     */
    public function validateSlotAvailability(int $slotId): bool
    {
        $slot = TimeSlot::find($slotId);

        if (!$slot) {
            return false;
        }

        // Check if already booked
        if ($slot->is_booked) {
            return false;
        }

        // Check if slot is in the future
        if ($slot->slot_datetime->isPast()) {
            return false;
        }

        return true;
    }

    /**
     * Get trainer price for a specific session duration.
     * 
     * @param int $trainerId
     * @param int $duration
     * @return float
     */
    public function getTrainerPrice(int $trainerId, int $duration): float
    {
        $pricing = TrainerPricing::forTrainer($trainerId)
            ->forDuration($duration)
            ->active()
            ->first();

        if ($pricing) {
            return (float) $pricing->price;
        }

        // Fallback to trainer's default price
        $trainer = Trainer::find($trainerId);
        return $trainer && $trainer->price ? (float) $trainer->price : 50.00;
    }

    /**
     * Confirm a booking after successful payment.
     * 
     * @param int $bookingId
     * @param string $stripePaymentIntent
     * @return Booking
     */
    public function confirmBooking(int $bookingId, string $stripePaymentIntent = null): Booking
    {
        $booking = Booking::findOrFail($bookingId);

        $booking->update([
            'payment_status' => 'paid',
            'booking_status' => 'confirmed',
            'stripe_payment_intent' => $stripePaymentIntent,
        ]);

        $booking = $booking->fresh();

        // Send confirmation notifications
        try {
            $this->notificationService->sendBookingConfirmation($booking);
            $this->notificationService->sendPaymentSuccess($booking);
        } catch (Exception $e) {
            Log::error("Failed to send booking confirmation notifications: " . $e->getMessage());
        }

        // Create Google Calendar event
        try {
            $this->createGoogleCalendarEvent($booking);
        } catch (Exception $e) {
            Log::error("Failed to create Google Calendar event: " . $e->getMessage());
        }

        Log::info("Booking confirmed: {$bookingId}");
        return $booking;
    }

    /**
     * Cancel a booking.
     * 
     * @param int $bookingId
     * @param int $cancelledBy User ID who cancelled
     * @param string|null $reason
     * @return Booking
     */
    public function cancelBooking(int $bookingId, int $cancelledBy, string $reason = null): Booking
    {
        DB::beginTransaction();
        try {
            $booking = Booking::findOrFail($bookingId);

            // Release the time slot
            if ($booking->timeSlot) {
                $booking->timeSlot->update([
                    'is_booked' => false,
                    'booking_id' => null,
                ]);
            }

            // Update booking
            $booking->update([
                'booking_status' => 'cancelled',
                'cancelled_at' => now(),
                'cancelled_by' => $cancelledBy,
                'cancellation_reason' => $reason,
            ]);

            DB::commit();

            $booking = $booking->fresh();

            // Send cancellation notifications
            try {
                $cancelledByUser = User::find($cancelledBy);
                $isCustomer = $booking->user_id === $cancelledBy;
                $cancelledBy = $isCustomer ? 'customer' : 'trainer';
                $this->notificationService->sendBookingCancellation($booking, $cancelledBy);
            } catch (Exception $e) {
                Log::error("Failed to send cancellation notifications: " . $e->getMessage());
            }

            // Delete Google Calendar event
            try {
                $this->deleteGoogleCalendarEvent($booking);
            } catch (Exception $e) {
                Log::error("Failed to delete Google Calendar event: " . $e->getMessage());
            }

            Log::info("Booking cancelled: {$bookingId} by user {$cancelledBy}");

            return $booking;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Error cancelling booking: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Complete a booking (mark as completed).
     * 
     * @param int $bookingId
     * @return Booking
     */
    public function completeBooking(int $bookingId): Booking
    {
        $booking = Booking::findOrFail($bookingId);

        $booking->update([
            'booking_status' => 'completed',
        ]);

        Log::info("Booking completed: {$bookingId}");
        return $booking->fresh();
    }

    /**
     * Get available slots for a trainer on a specific date.
     * 
     * @param int $trainerId
     * @param string $date
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAvailableSlots(int $trainerId, string $date)
    {
        return TimeSlot::forTrainer($trainerId)
            ->forDate($date)
            ->available()
            ->orderBy('slot_datetime')
            ->get();
    }

    /**
     * Check if user can book with this trainer.
     * 
     * @param int $userId
     * @param int $trainerId
     * @return bool
     */
    public function canUserBook(int $userId, int $trainerId): bool
    {
        // Check if user has any pending unpaid bookings with this trainer
        $pendingBookings = Booking::forCustomer($userId)
            ->forTrainer($trainerId)
            ->where('payment_status', 'pending')
            ->where('booking_status', '!=', 'cancelled')
            ->count();

        return $pendingBookings === 0;
    }

    /**
     * Create Google Calendar event for booking.
     * 
     * @param Booking $booking
     * @return void
     */
    protected function createGoogleCalendarEvent(Booking $booking): void
    {
        $trainer = $booking->trainer;
        $googleAccount = $trainer->googleAccount;

        if (!$googleAccount || !$googleAccount->is_connected) {
            Log::info("Trainer {$trainer->id} does not have Google Calendar connected");
            return;
        }

        $timeSlot = $booking->timeSlot;
        $startDateTime = $timeSlot->slot_datetime;
        $duration = $timeSlot->availability->session_duration ?? 60;
        $endDateTime = $startDateTime->copy()->addMinutes($duration);

        $title = "Training Session with {$booking->user->name}";
        $description = "Booking ID: #{$booking->id}\n";
        $description .= "Customer: {$booking->user->name}\n";
        $description .= "Email: {$booking->user->email}\n";
        if ($booking->notes) {
            $description .= "Notes: {$booking->notes}";
        }

        $attendees = [
            $booking->user->email,
            $trainer->email,
        ];

        $event = $this->calendarService->createEvent(
            $googleAccount->calendar_id,
            $title,
            $startDateTime,
            $endDateTime,
            $description,
            $attendees
        );

        if ($event) {
            // Extract event ID from the event object
            $eventId = null;
            if (property_exists($event, 'googleEvent') && $event->googleEvent && isset($event->googleEvent->id)) {
                $eventId = $event->googleEvent->id;
            } elseif (isset($event->id)) {
                $eventId = $event->id;
            }

            if ($eventId) {
                $booking->update(['google_event_id' => $eventId]);
                Log::info("Google Calendar event created for booking {$booking->id}: {$eventId}");
            }
        }
    }

    /**
     * Delete Google Calendar event for booking.
     * 
     * @param Booking $booking
     * @return void
     */
    protected function deleteGoogleCalendarEvent(Booking $booking): void
    {
        if (!$booking->google_event_id) {
            return;
        }

        $trainer = $booking->trainer;
        $googleAccount = $trainer->googleAccount;

        if (!$googleAccount || !$googleAccount->is_connected) {
            return;
        }

        $deleted = $this->calendarService->deleteEvent(
            $booking->google_event_id,
            $googleAccount->calendar_id
        );

        if ($deleted) {
            $booking->update(['google_event_id' => null]);
            Log::info("Google Calendar event deleted for booking {$booking->id}");
        }
    }
}
