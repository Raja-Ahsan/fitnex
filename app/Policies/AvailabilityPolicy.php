<?php

namespace App\Policies;

use App\Models\Availability;
use App\Models\User;
use App\Models\Trainer;

class AvailabilityPolicy
{
    /**
     * Determine if the user can view any availabilities.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole(['trainer', 'admin']);
    }

    /**
     * Determine if the user can view the availability.
     */
    public function view(User $user, Availability $availability): bool
    {
        return $user->hasRole('admin') ||
            $this->isTrainerOwner($user, $availability);
    }

    /**
     * Determine if the user can create availabilities.
     */
    public function create(User $user): bool
    {
        return $user->hasRole(['trainer', 'admin']);
    }

    /**
     * Determine if the user can update the availability.
     */
    public function update(User $user, Availability $availability): bool
    {
        return $user->hasRole('admin') ||
            $this->isTrainerOwner($user, $availability);
    }

    /**
     * Determine if the user can delete the availability.
     */
    public function delete(User $user, Availability $availability): bool
    {
        return $user->hasRole('admin') ||
            $this->isTrainerOwner($user, $availability);
    }

    /**
     * Check if user is the trainer who owns this availability.
     */
    protected function isTrainerOwner(User $user, Availability $availability): bool
    {
        $trainer = Trainer::where('created_by', $user->id)->first();
        return $trainer && $trainer->id === $availability->trainer_id;
    }
}
