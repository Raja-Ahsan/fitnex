<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'is_paid' => 'boolean',
    ];

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function timeSlot()
    {
        return $this->belongsTo(TimeSlot::class);
    }

    public function reschedules()
    {
        return $this->hasMany(BookingReschedule::class);
    }

    public function scopeForTrainer($query, $trainerId)
    {
        return $query->where('trainer_id', $trainerId);
    }

    public function scopeConfirmed($query)
    {
        return $query->where('booking_status', 'confirmed');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('booking_status', '!=', 'cancelled')
            ->where('booking_status', '!=', 'completed')
            ->whereHas('timeSlot', function ($q) {
                $q->where('slot_datetime', '>', now());
            });
    }

    public function hasProduct()
    {
        return $this->hasOne(Product::class, 'slug', 'product_slug');
    }
    public function hasCustomer()
    {
        return $this->hasOne(User::class, 'id', 'customer_id');
    }
    public function hasPayment()
    {
        return $this->hasOne(Payment::class, 'order_number', 'booking_number');
    }
    public function hasLocation()
    {
        return $this->hasOne(PickDropLocation::class, 'booking_id', 'id');
    }

    public function hasPickTime()
    {
        return $this->hasOne(City::class, 'id', 'pick_time_zone');
    }
    public function hasDropTime()
    {
        return $this->hasOne(City::class, 'id', 'drop_time_zone');
    }
}
