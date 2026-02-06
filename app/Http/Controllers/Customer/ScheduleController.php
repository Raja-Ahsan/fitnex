<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Trainer;
use App\Models\TimeSlot;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Show trainer's schedule with FullCalendar.
     */
    public function show(Trainer $trainer)
    {
        $trainer->load(['pricing']);

        return view('customer.schedule.calendar', compact('trainer'));
    }

    /**
     * Get available slots for a specific date (AJAX).
     */
    public function getAvailableSlots(Request $request, Trainer $trainer)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
        ]);

        $slots = TimeSlot::forTrainer($trainer->id)
            ->forDate($request->date)
            ->available()
            ->orderBy('slot_datetime')
            ->get();

        return response()->json([
            'success' => true,
            'slots' => $slots->map(function ($slot) {
                return [
                    'id' => $slot->id,
                    'time' => $slot->formatted_time,
                    'datetime' => $slot->slot_datetime->format('Y-m-d H:i:s'),
                ];
            }),
        ]);
    }
}
