<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrainerBooking extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'bookings';

    protected $guarded = [];

    protected $casts = [
        'cancelled_at' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function timeSlot()
    {
        return $this->belongsTo(TimeSlot::class);
    }

    public function reschedules()
    {
        return $this->hasMany(BookingReschedule::class, 'booking_id');
    }

    // Scopes
    public function scopeForTrainer($query, $trainerId)
    {
        return $query->where('trainer_id', $trainerId);
    }

    public function scopeForCustomer($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeUpcoming($query)
    {
        return $query->whereIn('booking_status', ['pending', 'confirmed']);
    }

    public function scopePending($query)
    {
        return $query->where('booking_status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('booking_status', 'confirmed');
    }

    public function scopeCancelled($query)
    {
        return $query->where('booking_status', 'cancelled');
    }

    public function scopeCompleted($query)
    {
        return $query->where('booking_status', 'completed');
    }

    // Helper methods
    public function isCancelled()
    {
        return $this->booking_status === 'cancelled';
    }

    public function isConfirmed()
    {
        return $this->booking_status === 'confirmed';
    }

    public function isPending()
    {
        return $this->booking_status === 'pending';
    }

    public function isCompleted()
    {
        return $this->booking_status === 'completed';
    }
}
