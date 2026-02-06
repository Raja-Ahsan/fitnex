<?php

return [
    /**
     * Reschedule cutoff time in hours.
     * Customers must reschedule at least this many hours before the appointment.
     * Trainers can reschedule anytime.
     */
    'reschedule_cutoff_hours' => env('RESCHEDULE_CUTOFF_HOURS', 6),

    /**
     * Number of days to generate slots in advance.
     */
    'slot_generation_days' => env('SLOT_GENERATION_DAYS', 60),

    /**
     * Available session durations in minutes.
     */
    'session_durations' => [30, 45, 60],

    /**
     * Default session duration in minutes.
     */
    'default_session_duration' => 60,

    /**
     * Default currency for bookings.
     */
    'default_currency' => 'USD',

    /**
     * Enable automatic slot generation after availability update.
     */
    'auto_generate_slots' => env('AUTO_GENERATE_SLOTS', true),

    /**
     * Enable Google Calendar integration.
     */
    'google_calendar_enabled' => env('GOOGLE_CALENDAR_ENABLED', true),

    /**
     * Booking statuses.
     */
    'booking_statuses' => [
        'pending' => 'Pending',
        'confirmed' => 'Confirmed',
        'cancelled' => 'Cancelled',
        'completed' => 'Completed',
    ],

    /**
     * Payment statuses.
     */
    'payment_statuses' => [
        'pending' => 'Pending',
        'paid' => 'Paid',
        'failed' => 'Failed',
        'refunded' => 'Refunded',
    ],
];
