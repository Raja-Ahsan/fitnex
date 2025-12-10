<?php

namespace App\Services;

use App\Models\Trainer;
use App\Models\Availability;
use App\Models\TimeSlot;
use App\Models\BlockedSlot;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SlotGenerationService
{
    /**
     * Generate time slots for a trainer based on their availability.
     * 
     * @param int $trainerId
     * @param int $days Number of days to generate slots for (default: 60)
     * @return int Number of slots generated
     */
    public function generateSlotsForTrainer(int $trainerId, int $days = 60): int
    {
        $trainer = Trainer::findOrFail($trainerId);
        $availabilities = $trainer->availabilities()->active()->get();

        if ($availabilities->isEmpty()) {
            Log::info("No active availabilities found for trainer {$trainerId}");
            return 0;
        }

        $slotsGenerated = 0;
        $startDate = Carbon::today();
        $endDate = Carbon::today()->addDays($days);

        DB::beginTransaction();
        try {
            // Loop through each day in the range
            for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
                $dayOfWeek = $date->dayOfWeek; // 0=Sunday, 6=Saturday

                // Get availabilities for this day of week
                $dayAvailabilities = $availabilities->where('day_of_week', $dayOfWeek);

                foreach ($dayAvailabilities as $availability) {
                    $slotsGenerated += $this->generateSlotsForDay(
                        $trainer,
                        $availability,
                        $date
                    );
                }
            }

            DB::commit();
            Log::info("Generated {$slotsGenerated} slots for trainer {$trainerId}");
            return $slotsGenerated;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error generating slots for trainer {$trainerId}: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Generate slots for a specific day based on availability.
     * 
     * @param Trainer $trainer
     * @param Availability $availability
     * @param Carbon $date
     * @return int Number of slots generated
     */
    protected function generateSlotsForDay(Trainer $trainer, Availability $availability, Carbon $date): int
    {
        $slotsGenerated = 0;
        $sessionDuration = (int) $availability->session_duration;

        $startStr = Carbon::parse($availability->start_time)->format('H:i:s');
        $endStr = Carbon::parse($availability->end_time)->format('H:i:s');

        $startTime = Carbon::parse($date->format('Y-m-d') . ' ' . $startStr);
        $endTime = Carbon::parse($date->format('Y-m-d') . ' ' . $endStr);

        // Skip if the entire time block is in the past
        if ($endTime->isPast()) {
            return 0;
        }

        // Adjust start time if it's in the past
        if ($startTime->isPast()) {
            $startTime = Carbon::now()->addMinutes(15)->startOfMinute();
        }

        $currentSlot = $startTime->copy();

        while ($currentSlot->copy()->addMinutes($sessionDuration)->lte($endTime)) {
            // Check if slot already exists (prevent duplicates)
            if ($this->slotExists($trainer->id, $currentSlot)) {
                $currentSlot->addMinutes($sessionDuration);
                continue;
            }

            // Check if slot is blocked
            if ($this->isSlotBlocked($trainer->id, $currentSlot, $sessionDuration)) {
                $currentSlot->addMinutes($sessionDuration);
                continue;
            }

            // Create the slot
            TimeSlot::create([
                'trainer_id' => $trainer->id,
                'availability_id' => $availability->id,
                'slot_datetime' => $currentSlot->copy(),
                'is_booked' => false,
            ]);

            $slotsGenerated++;
            $currentSlot->addMinutes($sessionDuration);
        }

        return $slotsGenerated;
    }

    /**
     * Check if a slot already exists.
     * 
     * @param int $trainerId
     * @param Carbon $slotDatetime
     * @return bool
     */
    protected function slotExists(int $trainerId, Carbon $slotDatetime): bool
    {
        return TimeSlot::where('trainer_id', $trainerId)
            ->where('slot_datetime', $slotDatetime)
            ->exists();
    }

    /**
     * Check if a slot is blocked by trainer.
     * 
     * @param int $trainerId
     * @param Carbon $slotDatetime
     * @param int $duration
     * @return bool
     */
    protected function isSlotBlocked(int $trainerId, Carbon $slotDatetime, int $duration): bool
    {
        $blockedSlots = BlockedSlot::forTrainer($trainerId)
            ->forDate($slotDatetime->format('Y-m-d'))
            ->get();

        foreach ($blockedSlots as $blocked) {
            if ($blocked->coversTime($slotDatetime->format('H:i:s'))) {
                return true;
            }
        }

        return false;
    }

    /**
     * Regenerate all slots for a trainer (delete old, create new).
     * 
     * @param int $trainerId
     * @param int $days
     * @return int
     */
    public function regenerateSlots(int $trainerId, int $days = 60): int
    {
        // Delete future unbooked slots
        TimeSlot::where('trainer_id', $trainerId)
            ->where('is_booked', false)
            ->where('slot_datetime', '>', now())
            ->delete();

        // Generate new slots
        return $this->generateSlotsForTrainer($trainerId, $days);
    }

    /**
     * Delete expired slots (past dates, not booked).
     * 
     * @return int Number of slots deleted
     */
    public function deleteExpiredSlots(): int
    {
        $deleted = TimeSlot::where('is_booked', false)
            ->where('slot_datetime', '<', now())
            ->delete();

        Log::info("Deleted {$deleted} expired slots");
        return $deleted;
    }

    /**
     * Generate slots for all active trainers.
     * 
     * @param int $days
     * @return array
     */
    public function generateSlotsForAllTrainers(int $days = 60): array
    {
        $trainers = Trainer::where('status', 1)->get();
        $results = [];

        foreach ($trainers as $trainer) {
            try {
                $count = $this->generateSlotsForTrainer($trainer->id, $days);
                $results[$trainer->id] = [
                    'success' => true,
                    'slots_generated' => $count,
                ];
            } catch (\Exception $e) {
                $results[$trainer->id] = [
                    'success' => false,
                    'error' => $e->getMessage(),
                ];
            }
        }

        return $results;
    }
}
