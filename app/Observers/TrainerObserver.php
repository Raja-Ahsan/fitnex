<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Trainer;

class TrainerObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        // Check if user has Trainer role (check both role field and assigned roles)
        $hasTrainerRole = false;
        if ($user->role && (strtolower($user->role) === 'trainer')) {
            $hasTrainerRole = true;
        } elseif ($user->hasRole('Trainer') || $user->hasRole('trainer')) {
            $hasTrainerRole = true;
        }

        if ($hasTrainerRole) {
            $this->syncTrainer($user);
        }
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        // Check if user has Trainer role (check both role field and assigned roles)
        $hasTrainerRole = false;
        if ($user->role && (strtolower($user->role) === 'trainer')) {
            $hasTrainerRole = true;
        } elseif ($user->hasRole('Trainer') || $user->hasRole('trainer')) {
            $hasTrainerRole = true;
        }

        if ($hasTrainerRole) {
            $this->syncTrainer($user);
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        // Soft delete trainer if user is deleted
        $trainer = Trainer::where('created_by', $user->id)->first();
        if ($trainer) {
            $trainer->delete();
        }
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        // Restore trainer if user is restored
        if ($user->hasRole('Trainer') || $user->hasRole('trainer')) {
            $trainer = Trainer::withTrashed()->where('created_by', $user->id)->first();
            if ($trainer) {
                $trainer->restore();
            } else {
                $this->syncTrainer($user);
            }
        }
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        // Force delete trainer if user is force deleted
        $trainer = Trainer::withTrashed()->where('created_by', $user->id)->first();
        if ($trainer) {
            $trainer->forceDelete();
        }
    }

    /**
     * Sync user data to trainers table
     * Only stores trainer-specific data, references user for duplicate fields
     */
    protected function syncTrainer(User $user): void
    {
        $trainer = Trainer::where('created_by', $user->id)->first();

        $trainerData = [
            'created_by' => $user->id,
            'status' => $user->status == 1 ? 1 : 0, // Sync status from user
            // Note: We don't store duplicate fields (name, email, phone, image, designation, social media)
            // These are accessed through the user relationship via accessor methods
        ];

        if ($trainer) {
            // Update existing trainer - only update status, keep other trainer-specific fields
            $trainer->update([
                'status' => $user->status == 1 ? 1 : 0,
            ]);
        } else {
            // Create new trainer record with minimal data
            // Trainer-specific fields will be set later through admin panel or trainer profile
            Trainer::create($trainerData);
        }
    }
}
