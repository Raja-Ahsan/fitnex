<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingReschedule extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'price_difference' => 'decimal:2',
    ];

    /**
     * Get the booking this reschedule belongs to.
     */
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Get the old time slot.
     */
    public function oldSlot(): BelongsTo
    {
        return $this->belongsTo(TimeSlot::class, 'old_slot_id');
    }

    /**
     * Get the new time slot.
     */
    public function newSlot(): BelongsTo
    {
        return $this->belongsTo(TimeSlot::class, 'new_slot_id');
    }

    /**
     * Get the user who initiated the reschedule.
     */
    public function rescheduledByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'rescheduled_by');
    }
}
