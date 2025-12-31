<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TimeSlot;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SlotController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    /**
     * Get available time slots for a trainer on a specific date.
     * 
     * GET /api/trainer/{id}/available-slots?date=YYYY-MM-DD
     */
    public function getAvailableSlots(Request $request, int $trainerId)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
        ]);

        $slots = $this->bookingService->getAvailableSlots($trainerId, $request->date);

        return response()->json([
            'success' => true,
            'date' => $request->date,
            'slots' => $slots->map(function ($slot) {
                return [
                    'id' => $slot->id,
                    'time' => $slot->formatted_time,
                    'datetime' => $slot->slot_datetime->toIso8601String(),
                    'available' => !$slot->is_booked,
                ];
            }),
        ]);
    }

    /**
     * Get calendar events for FullCalendar.js
     * 
     * GET /api/trainer/{id}/calendar-events?start=YYYY-MM-DD&end=YYYY-MM-DD
     */
    public function getCalendarEvents(Request $request, int $trainerId)
    {
        $request->validate([
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
        ]);

        $startDate = Carbon::parse($request->start);
        $endDate = Carbon::parse($request->end);

        $slots = TimeSlot::forTrainer($trainerId)
            ->whereBetween('slot_datetime', [$startDate, $endDate])
            ->orderBy('slot_datetime')
            ->get();

        $events = $slots->map(function ($slot) {
            return [
                'id' => $slot->id,
                'title' => $slot->is_booked ? 'Booked' : 'Available',
                'start' => $slot->slot_datetime->toIso8601String(),
                'end' => $slot->slot_datetime->copy()->addMinutes(
                    $slot->availability ? (int) $slot->availability->session_duration : 60
                )->toIso8601String(),
                'backgroundColor' => $slot->is_booked ? '#dc3545' : '#28a745',
                'borderColor' => $slot->is_booked ? '#dc3545' : '#28a745',
                'classNames' => $slot->is_booked ? ['booked-slot'] : ['available-slot'],
                'extendedProps' => [
                    'is_booked' => $slot->is_booked,
                    'slot_id' => $slot->id,
                ],
            ];
        });

        return response()->json($events);
    }

    /**
     * Validate if a slot is available for booking.
     * 
     * POST /api/booking/validate-slot
     */
    public function validateSlot(Request $request)
    {
        $request->validate([
            'slot_id' => 'required|exists:time_slots,id',
        ]);

        $isAvailable = $this->bookingService->validateSlotAvailability($request->slot_id);

        return response()->json([
            'success' => true,
            'available' => $isAvailable,
            'message' => $isAvailable ? 'Slot is available' : 'Slot is not available',
        ]);
    }
}
