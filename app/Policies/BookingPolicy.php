<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;
use App\Models\Trainer;

class BookingPolicy
{
    /**
     * Determine if the user can view any bookings.
     */
    public function viewAny(User $user): bool
    {
        return true; // All authenticated users can view their own bookings
    }

    /**
     * Determine if the user can view the booking.
     */
    public function view(User $user, Booking $booking): bool
    {
        // User is the customer
        if ($booking->user_id === $user->id) {
            return true;
        }

        // User is the trainer
        $trainer = Trainer::where('created_by', $user->id)->first();
        if ($trainer && $trainer->id === $booking->trainer_id) {
            return true;
        }

        // User is admin
        return $user->hasRole('admin');
    }

    /**
     * Determine if the user can create bookings.
     */
    public function create(User $user): bool
    {
        return true; // All authenticated users can create bookings
    }

    /**
     * Determine if the user can update the booking.
     */
    public function update(User $user, Booking $booking): bool
    {
        // Only admin or trainer can update booking status
        if ($user->hasRole('admin')) {
            return true;
        }

        $trainer = Trainer::where('created_by', $user->id)->first();
        return $trainer && $trainer->id === $booking->trainer_id;
    }

    /**
     * Determine if the user can cancel the booking.
     */
    public function cancel(User $user, Booking $booking): bool
    {
        // Customer can cancel their own booking
        if ($booking->user_id === $user->id) {
            return true;
        }

        // Trainer can cancel
        $trainer = Trainer::where('created_by', $user->id)->first();
        if ($trainer && $trainer->id === $booking->trainer_id) {
            return true;
        }

        // Admin can cancel
        return $user->hasRole('admin');
    }

    /**
     * Determine if the user can reschedule the booking.
     */
    public function reschedule(User $user, Booking $booking): bool
    {
        // Booking must not be cancelled or completed
        if (in_array($booking->booking_status, ['cancelled', 'completed'])) {
            return false;
        }

        // Customer can reschedule their own booking
        if ($booking->user_id === $user->id) {
            return true;
        }

        // Trainer can reschedule
        $trainer = Trainer::where('created_by', $user->id)->first();
        if ($trainer && $trainer->id === $booking->trainer_id) {
            return true;
        }

        // Admin can reschedule
        return $user->hasRole('admin');
    }

    /**
     * Determine if the user can delete the booking.
     */
    public function delete(User $user, Booking $booking): bool
    {
        // Only admin can delete bookings
        return $user->hasRole('admin');
    }
}
