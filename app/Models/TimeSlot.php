<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Carbon\Carbon;

class TimeSlot extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'slot_datetime' => 'datetime',
        'is_booked' => 'boolean',
    ];

    /**
     * Get the trainer that owns this time slot.
     */
    public function trainer(): BelongsTo
    {
        return $this->belongsTo(Trainer::class);
    }

    /**
     * Get the availability pattern this slot was generated from.
     */
    public function availability(): BelongsTo
    {
        return $this->belongsTo(Availability::class);
    }

    /**
     * Get the booking associated with this slot.
     */
    public function booking(): HasOne
    {
        return $this->hasOne(Booking::class);
    }

    /**
     * Scope to get only available (not booked) slots.
     */
    public function scopeAvailable($query)
    {
        return $query->where('is_booked', false)
            ->where('slot_datetime', '>', now());
    }

    /**
     * Scope to get slots for a specific date.
     */
    public function scopeForDate($query, $date)
    {
        $startOfDay = Carbon::parse($date)->startOfDay();
        $endOfDay = Carbon::parse($date)->endOfDay();

        return $query->whereBetween('slot_datetime', [$startOfDay, $endOfDay]);
    }

    /**
     * Scope to get slots for a specific trainer.
     */
    public function scopeForTrainer($query, int $trainerId)
    {
        return $query->where('trainer_id', $trainerId);
    }

    /**
     * Scope to get future slots only.
     */
    public function scopeFuture($query)
    {
        return $query->where('slot_datetime', '>', now());
    }

    /**
     * Scope to get past slots.
     */
    public function scopePast($query)
    {
        return $query->where('slot_datetime', '<', now());
    }

    /**
     * Get formatted time for display (time range).
     */
    public function getFormattedTimeAttribute(): string
    {
        $startTime = $this->slot_datetime;
        $sessionDuration = 60; // Default duration
        
        // Get session duration from availability if available
        if ($this->availability) {
            $sessionDuration = (int) ($this->availability->session_duration ?? 60);
        }
        
        $endTime = $startTime->copy()->addMinutes($sessionDuration);
        
        return $startTime->format('g:i A') . ' - ' . $endTime->format('g:i A');
    }

    /**
     * Get formatted date for display.
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->slot_datetime->format('M d, Y');
    }
}
