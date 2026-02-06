<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Trainer;
use App\Http\Requests\RescheduleBookingRequest;
use App\Services\RescheduleService;
use Illuminate\Support\Facades\Auth;

class TrainerRescheduleController extends Controller
{
    protected $rescheduleService;

    public function __construct(RescheduleService $rescheduleService)
    {
        $this->middleware('auth');
        $this->rescheduleService = $rescheduleService;
    }

    /**
     * Show the reschedule form.
     */
    public function show(Booking $booking)
    {
        $trainer = Trainer::where('created_by', Auth::id())->firstOrFail();

        if ($booking->trainer_id !== $trainer->id) {
            abort(403, 'Unauthorized access to this booking.');
        }

        // Get available slots for rescheduling
        $availableSlots = $this->rescheduleService->getAvailableSlotsForReschedule($booking->id);

        return view('trainer.bookings.reschedule', compact('booking', 'availableSlots'));
    }

    /**
     * Process the reschedule request.
     */
    public function store(RescheduleBookingRequest $request)
    {
        $booking = Booking::findOrFail($request->booking_id);
        $trainer = Trainer::where('created_by', Auth::id())->firstOrFail();

        if ($booking->trainer_id !== $trainer->id) {
            abort(403, 'Unauthorized access to this booking.');
        }

        try {
            $this->rescheduleService->rescheduleBooking(
                $request->booking_id,
                $request->new_slot_id,
                Auth::id(),
                $request->reason
            );

            // TODO: Update Google Calendar event
            // TODO: Send notification to customer

            return redirect()->route('trainer.bookings.show', $booking->id)
                ->with('success', 'Booking rescheduled successfully.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
