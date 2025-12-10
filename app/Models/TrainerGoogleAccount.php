<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class TrainerGoogleAccount extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'token_expiry' => 'datetime',
        'is_connected' => 'boolean',
    ];

    protected $hidden = [
        'access_token',
        'refresh_token',
    ];

    /**
     * Get the trainer that owns this Google account.
     */
    public function trainer(): BelongsTo
    {
        return $this->belongsTo(Trainer::class);
    }

    /**
     * Encrypt access token when setting.
     */
    protected function accessToken(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? decrypt($value) : null,
            set: fn($value) => $value ? encrypt($value) : null,
        );
    }

    /**
     * Encrypt refresh token when setting.
     */
    protected function refreshToken(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? decrypt($value) : null,
            set: fn($value) => $value ? encrypt($value) : null,
        );
    }

    /**
     * Check if token is expired.
     */
    public function isTokenExpired(): bool
    {
        return $this->token_expiry && $this->token_expiry->isPast();
    }

    /**
     * Check if account is connected and token is valid.
     */
    public function isValid(): bool
    {
        return $this->is_connected && !$this->isTokenExpired();
    }
}
