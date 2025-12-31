<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrainerPricing extends Model
{
    use HasFactory;

    protected $table = 'trainer_pricing';

    protected $guarded = [];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Get the trainer that owns this pricing.
     */
    public function trainer(): BelongsTo
    {
        return $this->belongsTo(Trainer::class);
    }

    /**
     * Scope to get only active pricing.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get pricing for a specific duration.
     */
    public function scopeForDuration($query, int $duration)
    {
        return $query->where('session_duration', $duration);
    }

    /**
     * Scope to get pricing for a specific trainer.
     */
    public function scopeForTrainer($query, int $trainerId)
    {
        return $query->where('trainer_id', $trainerId);
    }

    /**
     * Get formatted price with currency.
     */
    public function getFormattedPriceAttribute(): string
    {
        return $this->currency . ' ' . number_format((float) $this->price, 2);
    }
}
