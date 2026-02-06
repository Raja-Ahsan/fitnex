<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\Availability;
use App\Models\Trainer;
use App\Http\Requests\StoreAvailabilityRequest;
use App\Services\SlotGenerationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainerAvailabilityController extends Controller
{
    protected $slotService;

    public function __construct(SlotGenerationService $slotService)
    {
        $this->middleware('auth');
        $this->slotService = $slotService;
    }

    /**
     * Display a listing of the trainer's availability.
     */
    public function index()
    {
        $trainer = Trainer::where('created_by', Auth::id())->firstOrFail();
        $availabilities = $trainer->availabilities()->orderBy('day_of_week')->orderBy('start_time')->get();

        return view('trainer.availability.index', compact('availabilities', 'trainer'));
    }

    /**
     * Show the form for creating new availability.
     */
    public function create()
    {
        $days = [
            0 => 'Sunday',
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
        ];

        return view('trainer.availability.create', compact('days'));
    }

    /**
     * Store a newly created availability.
     */
    public function store(StoreAvailabilityRequest $request)
    {
        $trainer = Trainer::where('created_by', Auth::id())->firstOrFail();

        $availability = $trainer->availabilities()->create($request->validated());

        // Auto-generate slots if enabled
        if (config('booking.auto_generate_slots')) {
            $this->slotService->generateSlotsForTrainer($trainer->id);
        }

        return redirect()->route('trainer.availability.index')
            ->with('success', 'Availability added successfully. Slots have been generated.');
    }

    /**
     * Show the form for editing availability.
     */
    public function edit(Availability $availability)
    {
        $this->authorize('update', $availability);

        $days = [
            0 => 'Sunday',
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
        ];

        return view('trainer.availability.edit', compact('availability', 'days'));
    }

    /**
     * Update the specified availability.
     */
    public function update(StoreAvailabilityRequest $request, Availability $availability)
    {
        $this->authorize('update', $availability);

        $availability->update($request->validated());

        // Regenerate slots
        if (config('booking.auto_generate_slots')) {
            $this->slotService->regenerateSlots($availability->trainer_id);
        }

        return redirect()->route('trainer.availability.index')
            ->with('success', 'Availability updated successfully. Slots have been regenerated.');
    }

    /**
     * Remove the specified availability.
     */
    public function destroy(Availability $availability)
    {
        $this->authorize('delete', $availability);

        $trainerId = $availability->trainer_id;
        $availability->delete();

        // Regenerate slots
        if (config('booking.auto_generate_slots')) {
            $this->slotService->regenerateSlots($trainerId);
        }

        return redirect()->route('trainer.availability.index')
            ->with('success', 'Availability deleted successfully.');
    }
}
