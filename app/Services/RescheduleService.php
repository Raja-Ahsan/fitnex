<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\BookingReschedule;
use App\Models\TimeSlot;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\NotificationService;
use App\Services\GoogleCalendarService;
use Exception;

class RescheduleService
{
    protected $cutoffHours;
    protected $notificationService;
    protected $calendarService;

    public function __construct(
        NotificationService $notificationService,
        GoogleCalendarService $calendarService
    ) {
        $this->cutoffHours = config('booking.reschedule_cutoff_hours', 6);
        $this->notificationService = $notificationService;
        $this->calendarService = $calendarService;
    }

    /**
     * Reschedule a booking to a new time slot.
     * 
     * @param int $bookingId
     * @param int $newSlotId
     * @param int $userId User initiating the reschedule
     * @param string|null $reason
     * @return Booking
     * @throws Exception
     */
    public function rescheduleBooking(int $bookingId, int $newSlotId, int $userId, string $reason = null): Booking
    {
        DB::beginTransaction();
        try {
            $booking = Booking::findOrFail($bookingId);
            $newSlot = TimeSlot::findOrFail($newSlotId);

            // Validate reschedule permission
            $this->validateReschedulePermission($booking, $userId);

            // Validate new slot availability
            if (!$this->validateNewSlot($newSlot, $booking->trainer_id)) {
                throw new Exception('The selected time slot is not available.');
            }

            $oldSlot = $booking->timeSlot;

            // Calculate price difference if applicable
            $priceDifference = $this->calculatePriceDifference($oldSlot, $newSlot, $booking);

            // Release old slot
            $this->releaseOldSlot($oldSlot);

            // Assign new slot
            $this->assignNewSlot($newSlot, $booking->id);

            // Update booking
            $booking->update([
                'time_slot_id' => $newSlot->id,
            ]);

            // Save reschedule record
            BookingReschedule::create([
                'booking_id' => $booking->id,
                'old_slot_id' => $oldSlot->id,
                'new_slot_id' => $newSlot->id,
                'rescheduled_by' => $userId,
                'reason' => $reason,
                'price_difference' => $priceDifference,
            ]);

            DB::commit();

            $booking = $booking->fresh();

            // Send reschedule notifications
            try {
                $user = User::find($userId);
                $isCustomer = $booking->user_id === $userId;
                $rescheduledBy = $isCustomer ? 'customer' : 'trainer';

                $oldDateTime = $oldSlot->slot_datetime->format('M d, Y h:i A');
                $newDateTime = $newSlot->slot_datetime->format('M d, Y h:i A');

                $this->notificationService->sendBookingReschedule(
                    $booking,
                    $rescheduledBy,
                    $oldDateTime,
                    $newDateTime
                );
            } catch (Exception $e) {
                Log::error("Failed to send reschedule notifications: " . $e->getMessage());
            }

            // Update Google Calendar event
            try {
                $this->updateGoogleCalendarEvent($booking, $newSlot);
            } catch (Exception $e) {
                Log::error("Failed to update Google Calendar event: " . $e->getMessage());
            }

            Log::info("Booking {$bookingId} rescheduled by user {$userId}");

            return $booking;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Error rescheduling booking: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Validate if user has permission to reschedule.
     * 
     * @param Booking $booking
     * @param int $userId
     * @throws Exception
     */
    protected function validateReschedulePermission(Booking $booking, int $userId): void
    {
        $user = User::findOrFail($userId);

        // Check if booking is cancelled
        if ($booking->isCancelled()) {
            throw new Exception('Cannot reschedule a cancelled booking.');
        }

        // Check if booking slot is in the past
        if ($booking->timeSlot->slot_datetime->isPast()) {
            throw new Exception('Cannot reschedule a past booking.');
        }

        // Check if user is the customer or trainer
        $isCustomer = $booking->user_id === $userId;
        $isTrainer = $booking->trainer->created_by === $userId || $user->hasRole('trainer');

        if (!$isCustomer && !$isTrainer) {
            throw new Exception('You do not have permission to reschedule this booking.');
        }

        // If customer, check cutoff time
        if ($isCustomer && !$isTrainer) {
            $hoursUntilBooking = now()->diffInHours($booking->timeSlot->slot_datetime, false);

            if ($hoursUntilBooking < $this->cutoffHours) {
                throw new Exception("Customers can only reschedule bookings at least {$this->cutoffHours} hours in advance.");
            }
        }

        // Trainers can reschedule anytime (no cutoff restriction)
    }

    /**
     * Validate that the new slot is available.
     * 
     * @param TimeSlot $newSlot
     * @param int $trainerId
     * @return bool
     */
    protected function validateNewSlot(TimeSlot $newSlot, int $trainerId): bool
    {
        // Check if slot belongs to the same trainer
        if ($newSlot->trainer_id !== $trainerId) {
            return false;
        }

        // Check if slot is already booked
        if ($newSlot->is_booked) {
            return false;
        }

        // Check if slot is in the future
        if ($newSlot->slot_datetime->isPast()) {
            return false;
        }

        return true;
    }

    /**
     * Calculate price difference between old and new slots.
     * 
     * @param TimeSlot $oldSlot
     * @param TimeSlot $newSlot
     * @param Booking $booking
     * @return float|null
     */
    protected function calculatePriceDifference(TimeSlot $oldSlot, TimeSlot $newSlot, Booking $booking): ?float
    {
        // Get session durations
        $oldDuration = $oldSlot->availability ? (int) $oldSlot->availability->session_duration : 60;
        $newDuration = $newSlot->availability ? (int) $newSlot->availability->session_duration : 60;

        // If same duration, no price difference
        if ($oldDuration === $newDuration) {
            return null;
        }

        // Get pricing service to calculate new price
        $pricingService = app(BookingService::class);
        $newPrice = $pricingService->getTrainerPrice($booking->trainer_id, $newDuration);
        $oldPrice = (float) $booking->price;

        $difference = $newPrice - $oldPrice;

        return $difference != 0 ? $difference : null;
    }

    /**
     * Release the old time slot.
     * 
     * @param TimeSlot $slot
     */
    protected function releaseOldSlot(TimeSlot $slot): void
    {
        $slot->update([
            'is_booked' => false,
            'booking_id' => null,
        ]);
    }

    /**
     * Assign the new time slot to the booking.
     * 
     * @param TimeSlot $slot
     * @param int $bookingId
     */
    protected function assignNewSlot(TimeSlot $slot, int $bookingId): void
    {
        $slot->update([
            'is_booked' => true,
            'booking_id' => $bookingId,
        ]);
    }

    /**
     * Check if a booking can be rescheduled by a specific user.
     * 
     * @param int $bookingId
     * @param int $userId
     * @return array ['can_reschedule' => bool, 'reason' => string|null]
     */
    public function canReschedule(int $bookingId, int $userId): array
    {
        try {
            $booking = Booking::findOrFail($bookingId);
            $this->validateReschedulePermission($booking, $userId);

            return [
                'can_reschedule' => true,
                'reason' => null,
            ];
        } catch (Exception $e) {
            return [
                'can_reschedule' => false,
                'reason' => $e->getMessage(),
            ];
        }
    }

    /**
     * Get available slots for rescheduling (same trainer, future dates).
     * 
     * @param int $bookingId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAvailableSlotsForReschedule(int $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        return TimeSlot::forTrainer($booking->trainer_id)
            ->available()
            ->future()
            ->orderBy('slot_datetime')
            ->limit(50)
            ->get();
    }

    /**
     * Update Google Calendar event for rescheduled booking.
     * 
     * @param Booking $booking
     * @param TimeSlot $newSlot
     * @return void
     */
    protected function updateGoogleCalendarEvent(Booking $booking, TimeSlot $newSlot): void
    {
        if (!$booking->google_event_id) {
            Log::info("No Google Calendar event ID for booking {$booking->id}, skipping update");
            return;
        }

        $trainer = $booking->trainer;
        $googleAccount = $trainer->googleAccount;

        if (!$googleAccount || !$googleAccount->is_connected) {
            Log::info("Trainer {$trainer->id} does not have Google Calendar connected");
            return;
        }

        $startDateTime = $newSlot->slot_datetime;
        $duration = $newSlot->availability->session_duration ?? 60;
        $endDateTime = $startDateTime->copy()->addMinutes($duration);

        $updated = $this->calendarService->updateEvent(
            $booking->google_event_id,
            $googleAccount->calendar_id,
            [
                'startDateTime' => $startDateTime,
                'endDateTime' => $endDateTime,
            ]
        );

        if ($updated) {
            Log::info("Google Calendar event updated for booking {$booking->id}");
        }
    }
}
