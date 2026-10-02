<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

/**
 * The FITNEX owner's Google account. Every appointment is copied to this
 * calendar so the owner can see all bookings in one place.
 */
class CentralGoogleAccount extends Model
{
    protected $guarded = [];

    protected $casts = [
        'token_expiry' => 'datetime',
        'is_connected' => 'boolean',
    ];

    protected $hidden = [
        'access_token',
        'refresh_token',
    ];

    public static function current(): ?self
    {
        return static::query()->latest('id')->first();
    }

    protected function accessToken(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? decrypt($value) : null,
            set: fn ($value) => $value ? encrypt($value) : null,
        );
    }

    protected function refreshToken(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? decrypt($value) : null,
            set: fn ($value) => $value ? encrypt($value) : null,
        );
    }
}
