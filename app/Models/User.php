<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function hasCity()
    {
        return $this->belongsTo(City::class, 'city_id'); // Replace 'city_id' with the actual foreign key in the users table.
    }

    public function hasState()
    {
        return $this->belongsTo(State::class, 'state_id'); // Replace 'state_id' with the actual foreign key in the users table.
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function payment()
    {
        return $this->hasOne(Payment::class, 'customer_id', 'id'); // Assuming customer_id in payments refers to id in users
    }

    // Add the storedProjects relationship
    public function storedProjects()
    {
        return $this->belongsToMany(Project::class, 'stored_projects', 'user_id', 'project_id');
    }

    // Add the categories relationship (for user interests)
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'user_categories', 'user_id', 'category_id');
    }

    /**
     * Get all bookings made by this user (as customer).
     */
    public function bookings()
    {
        return $this->hasMany(\App\Models\Booking::class);
    }

    /**
     * Get bookings rescheduled by this user.
     */
    public function rescheduledBookings()
    {
        return $this->hasMany(BookingReschedule::class, 'rescheduled_by');
    }
}
