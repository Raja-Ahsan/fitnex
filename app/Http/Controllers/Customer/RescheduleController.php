<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Http\Requests\RescheduleBookingRequest;
use App\Services\RescheduleService;
use Illuminate\Support\Facades\Auth;

class RescheduleController extends Controller
{
    protected $rescheduleService;

    public function __construct(RescheduleService $rescheduleService)
    {
        $this->middleware('auth');
        $this->rescheduleService = $rescheduleService;
    }

    /**
     * Show reschedule form.
     */
    public function show(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this booking.');
        }

        // Check if user can reschedule
        $canReschedule = $this->rescheduleService->canReschedule($booking->id, Auth::id());

        if (!$canReschedule['can_reschedule']) {
            return redirect()->route('customer.bookings.show', $booking->id)
                ->with('error', $canReschedule['reason']);
        }

        // Get available slots
        $availableSlots = $this->rescheduleService->getAvailableSlotsForReschedule($booking->id);

        return view('customer.reschedule.form', compact('booking', 'availableSlots'));
    }

    /**
     * Process reschedule request.
     */
    public function store(RescheduleBookingRequest $request)
    {
        $booking = Booking::findOrFail($request->booking_id);

        if ($booking->user_id !== Auth::id()) {
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
            // TODO: Send notification to trainer

            return redirect()->route('customer.bookings.show', $booking->id)
                ->with('success', 'Booking rescheduled successfully.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
