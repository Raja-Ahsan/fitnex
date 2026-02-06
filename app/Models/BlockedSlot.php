<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class BlockedSlot extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Get the trainer that owns this blocked slot.
     */
    public function trainer(): BelongsTo
    {
        return $this->belongsTo(Trainer::class);
    }

    /**
     * Scope to get blocked slots for a specific date.
     */
    public function scopeForDate($query, $date)
    {
        return $query->where('date', Carbon::parse($date)->format('Y-m-d'));
    }

    /**
     * Scope to get blocked slots for a specific trainer.
     */
    public function scopeForTrainer($query, int $trainerId)
    {
        return $query->where('trainer_id', $trainerId);
    }

    /**
     * Scope to get future blocked slots only.
     */
    public function scopeFuture($query)
    {
        return $query->where('date', '>=', now()->format('Y-m-d'));
    }

    /**
     * Check if a specific time falls within this blocked slot.
     */
    public function coversTime(string $time): bool
    {
        $checkTime = Carbon::parse($time)->format('H:i:s');
        $startTime = Carbon::parse($this->start_time)->format('H:i:s');
        $endTime = Carbon::parse($this->end_time)->format('H:i:s');

        return $checkTime >= $startTime && $checkTime < $endTime;
    }
}
