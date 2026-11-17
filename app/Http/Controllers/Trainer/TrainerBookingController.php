<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Trainer;
use App\Services\BookingService;
use App\Services\StripeConnectService;
use App\Services\StripeConnectSettings;
use App\Services\TrainerGoogleCalendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Throwable;

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
    public function approve($id, TrainerGoogleCalendar $calendar)
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
        $calendar->syncAppointment($booking, 'Confirmed');

        // TODO: Send notification to customer

        return back()->with('success', 'Booking approved successfully.');
    }

    /**
     * Cancel a booking.
     */
    public function cancel(Request $request, $id, TrainerGoogleCalendar $calendar)
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
        $calendar->removeAppointment($booking);

        if (in_array($booking->payout_status, ['held', 'manual_pending', 'failed'], true)) {
            try {
                app(StripeConnectService::class)->markRefunded($booking);
            } catch (Throwable $e) {
                Log::warning('Could not update payout status after cancel: '.$e->getMessage());
            }
        }

        return redirect()->route('trainer.bookings.index')
            ->with('success', 'Booking cancelled successfully. If payment was taken, process the refund from Stripe/admin.');
    }

    /**
     * Mark booking as completed and release Stripe Connect payout when configured.
     */
    public function complete($id, StripeConnectService $stripeConnect)
    {
        $trainer = Trainer::where('created_by', Auth::id())->firstOrFail();
        $booking = \App\Models\Appointment::findOrFail($id);

        if ($booking->trainer_id !== $trainer->id) {
            abort(403, 'Unauthorized access to this booking.');
        }

        if ($booking->status === 'cancelled') {
            return back()->with('error', 'Cancelled bookings cannot be marked as completed.');
        }

        $booking->update(['status' => 'completed']);

        $message = 'Booking marked as completed.';

        if (StripeConnectSettings::payoutOnSessionComplete() && in_array($booking->payment_status, ['completed', 'paid'], true) && (float) $booking->price > 0) {
            try {
                $booking = $stripeConnect->releasePayout($booking->fresh());
                $message .= match ($booking->payout_status) {
                    'transferred' => ' Trainer payout was sent via Stripe.',
                    'manual_pending' => ' Payout needs a manual transfer (trainer may not be connected to Stripe yet).',
                    'failed' => ' Payout could not be released automatically.',
                    default => '',
                };
            } catch (Throwable $e) {
                Log::error('Payout release after complete failed: '.$e->getMessage());
                $message .= ' Payout release failed — admin can retry from Stripe Connect.';
            }
        }

        return back()->with('success', $message);
    }
}
