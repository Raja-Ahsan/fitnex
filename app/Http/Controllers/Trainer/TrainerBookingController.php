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

        $query = \App\Models\Appointment::where('trainer_id', $trainer->id)
            ->with(['user'])
            ->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by payment status
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('appointment_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('appointment_date', '<=', $request->date_to);
        }

        $bookings = $query->paginate(20);

        $stats = [
            'total' => \App\Models\Appointment::where('trainer_id', $trainer->id)->count(),
            'pending' => \App\Models\Appointment::where('trainer_id', $trainer->id)->where('status', 'pending')->count(),
            'confirmed' => \App\Models\Appointment::where('trainer_id', $trainer->id)->where('status', 'confirmed')->count(),
            'completed' => \App\Models\Appointment::where('trainer_id', $trainer->id)->where('status', 'completed')->count(),
        ];

        return view('trainer.bookings.index', compact('bookings', 'stats', 'trainer'));
    }

    /**
     * Display the specified booking.
     */
    public function show($id)
    {
        $trainer = Trainer::where('created_by', Auth::id())->firstOrFail();
        $booking = \App\Models\Appointment::with(['user'])->findOrFail($id);

        if ($booking->trainer_id !== $trainer->id) {
            abort(403, 'Unauthorized access to this booking.');
        }

        return view('trainer.bookings.show', compact('booking'));
    }

    /**
     * Approve/confirm a booking.
     */
    public function approve($id)
    {
        $trainer = Trainer::where('created_by', Auth::id())->firstOrFail();
        $booking = \App\Models\Appointment::findOrFail($id);

        if ($booking->trainer_id !== $trainer->id) {
            abort(403, 'Unauthorized access to this booking.');
        }

        if ($booking->payment_status !== 'paid' && $booking->payment_status !== 'completed' && $booking->price > 0) {
            return back()->with('error', 'Cannot approve booking with unpaid status.');
        }

        $booking->update(['status' => 'confirmed']);

        // TODO: Send notification to customer
        // TODO: Create Google Calendar event

        return back()->with('success', 'Booking approved successfully.');
    }

    /**
     * Cancel a booking.
     */
    public function cancel(Request $request, $id)
    {
        $trainer = Trainer::where('created_by', Auth::id())->firstOrFail();
        $booking = \App\Models\Appointment::findOrFail($id);

        if ($booking->trainer_id !== $trainer->id) {
            abort(403, 'Unauthorized access to this booking.');
        }

        $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        $booking->update([
            'status' => 'cancelled',
            // 'cancellation_reason' => $request->reason // If column exists
        ]);

        return redirect()->route('trainer.bookings.index')
            ->with('success', 'Booking cancelled successfully.');
    }

    /**
     * Mark booking as completed.
     */
    public function complete($id)
    {
        $trainer = Trainer::where('created_by', Auth::id())->firstOrFail();
        $booking = \App\Models\Appointment::findOrFail($id);

        if ($booking->trainer_id !== $trainer->id) {
            abort(403, 'Unauthorized access to this booking.');
        }

        $booking->update(['status' => 'completed']);

        return back()->with('success', 'Booking marked as completed.');
    }
}
