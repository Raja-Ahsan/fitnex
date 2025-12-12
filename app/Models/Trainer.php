<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trainer extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['user'];

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

    /**
     * Accessor methods to get user data through relationship
     * These replace the removed duplicate columns
     */
    public function getNameAttribute()
    {
        return $this->user ? ($this->user->name . ' ' . ($this->user->last_name ?? '')) : null;
    }

    public function getEmailAttribute()
    {
        return $this->user ? $this->user->email : null;
    }

    public function getPhoneAttribute()
    {
        return $this->user ? $this->user->phone : null;
    }

    public function getImageAttribute()
    {
        return $this->user ? $this->user->image : null;
    }

    public function getDesignationAttribute()
    {
        return $this->user ? $this->user->designation : null;
    }

    public function getFacebookAttribute()
    {
        return $this->user ? $this->user->facebook : null;
    }

    public function getTwitterAttribute()
    {
        return $this->user ? $this->user->twitter : null;
    }

    public function getInstagramAttribute()
    {
        return $this->user ? $this->user->instagram : null;
    }

    public function getLinkedinAttribute()
    {
        return $this->user ? $this->user->linkedin : null;
    }

    public function getYoutubeAttribute()
    {
        return $this->user ? $this->user->youtube : null;
    }
}
