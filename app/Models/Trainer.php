<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trainer extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function hasCreatedBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Get the trainer's weekly availability patterns.
     */
    public function availabilities()
    {
        return $this->hasMany(Availability::class);
    }

    /**
     * Get all time slots for this trainer.
     */
    public function timeSlots()
    {
        return $this->hasMany(TimeSlot::class);
    }

    /**
     * Get all bookings for this trainer.
     */
    public function bookings()
    {
        return $this->hasMany(\App\Models\Booking::class);
    }

    /**
     * Get the trainer's Google Calendar account.
     */
    public function googleAccount()
    {
        return $this->hasOne(TrainerGoogleAccount::class);
    }

    /**
     * Get the trainer's pricing settings.
     */
    public function pricing()
    {
        return $this->hasMany(TrainerPricing::class);
    }

    /**
     * Get blocked time slots for this trainer.
     */
    public function blockedSlots()
    {
        return $this->hasMany(BlockedSlot::class);
    }
}
