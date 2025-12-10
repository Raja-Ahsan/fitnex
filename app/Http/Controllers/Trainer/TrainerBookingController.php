<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Trainer;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainerBookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->middleware('auth');
        $this->bookingService = $bookingService;
    }

    /**
     * Display a listing of trainer's bookings.
     */
    public function index(Request $request)
    {
        $trainer = Trainer::where('created_by', Auth::id())->firstOrFail();

        $query = Booking::forTrainer($trainer->id)
            ->with(['user', 'timeSlot'])
            ->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('booking_status', $request->status);
        }

        // Filter by payment status
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereHas('timeSlot', function ($q) use ($request) {
                $q->where('slot_datetime', '>=', $request->date_from);
            });
        }

        if ($request->filled('date_to')) {
            $query->whereHas('timeSlot', function ($q) use ($request) {
                $q->where('slot_datetime', '<=', $request->date_to);
            });
        }

        $bookings = $query->paginate(20);

        $stats = [
            'total' => Booking::forTrainer($trainer->id)->count(),
            'pending' => Booking::forTrainer($trainer->id)->where('booking_status', 'pending')->count(),
            'confirmed' => Booking::forTrainer($trainer->id)->confirmed()->count(),
            'completed' => Booking::forTrainer($trainer->id)->where('booking_status', 'completed')->count(),
        ];

        return view('trainer.bookings.index', compact('bookings', 'stats', 'trainer'));
    }

    /**
     * Display the specified booking.
     */
    public function show(Booking $booking)
    {
        $trainer = Trainer::where('created_by', Auth::id())->firstOrFail();

        if ($booking->trainer_id !== $trainer->id) {
            abort(403, 'Unauthorized access to this booking.');
        }

        $booking->load(['user', 'timeSlot', 'reschedules']);

        return view('trainer.bookings.show', compact('booking'));
    }

    /**
     * Approve/confirm a booking.
     */
    public function approve(Booking $booking)
    {
        $trainer = Trainer::where('created_by', Auth::id())->firstOrFail();

        if ($booking->trainer_id !== $trainer->id) {
            abort(403, 'Unauthorized access to this booking.');
        }

        if ($booking->payment_status !== 'paid') {
            return back()->with('error', 'Cannot approve booking with unpaid status.');
        }

        $booking->update(['booking_status' => 'confirmed']);

        // TODO: Send notification to customer
        // TODO: Create Google Calendar event

        return back()->with('success', 'Booking approved successfully.');
    }

    /**
     * Cancel a booking.
     */
    public function cancel(Request $request, Booking $booking)
    {
        $trainer = Trainer::where('created_by', Auth::id())->firstOrFail();

        if ($booking->trainer_id !== $trainer->id) {
            abort(403, 'Unauthorized access to this booking.');
        }

        $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        $this->bookingService->cancelBooking(
            $booking->id,
            Auth::id(),
            $request->reason
        );

        // TODO: Send notification to customer
        // TODO: Delete Google Calendar event
        // TODO: Process refund if applicable

        return redirect()->route('trainer.bookings.index')
            ->with('success', 'Booking cancelled successfully.');
    }

    /**
     * Mark booking as completed.
     */
    public function complete(Booking $booking)
    {
        $trainer = Trainer::where('created_by', Auth::id())->firstOrFail();

        if ($booking->trainer_id !== $trainer->id) {
            abort(403, 'Unauthorized access to this booking.');
        }

        $this->bookingService->completeBooking($booking->id);

        return back()->with('success', 'Booking marked as completed.');
    }
}
