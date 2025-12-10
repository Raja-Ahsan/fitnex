<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\TimeSlot;
use App\Http\Requests\StoreBookingRequest;
use App\Services\BookingService;
use App\Services\StripePaymentService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    protected $bookingService;
    protected $stripeService;

    public function __construct(BookingService $bookingService, StripePaymentService $stripeService)
    {
        $this->middleware('auth');
        $this->bookingService = $bookingService;
        $this->stripeService = $stripeService;
    }

    /**
     * Display customer's bookings.
     */
    public function index(Request $request)
    {
        $query = Booking::forCustomer(Auth::id())
            ->with(['trainer', 'timeSlot'])
            ->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('booking_status', $request->status);
        }

        $bookings = $query->paginate(15);

        return view('customer.bookings.index', compact('bookings'));
    }

    /**
     * Show booking details.
     */
    public function show(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this booking.');
        }

        $booking->load(['trainer', 'timeSlot', 'reschedules']);

        return view('customer.bookings.show', compact('booking'));
    }

    /**
     * Show booking form.
     */
    public function create(Request $request)
    {
        $slotId = $request->slot_id;
        $slot = TimeSlot::with(['trainer', 'availability'])->findOrFail($slotId);

        if (!$this->bookingService->validateSlotAvailability($slotId)) {
            return redirect()->back()->with('error', 'This time slot is no longer available.');
        }

        return view('customer.booking.form', compact('slot'));
    }

    /**
     * Store a new booking and redirect to payment.
     */
    public function store(StoreBookingRequest $request)
    {
        try {
            // Create booking
            $booking = $this->bookingService->createBooking($request->validated());

            // Create Stripe checkout session
            $session = $this->stripeService->createCheckoutSession($booking);

            // Redirect to Stripe Checkout
            return redirect($session->url);
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to create booking: ' . $e->getMessage());
        }
    }

    /**
     * Handle successful payment.
     */
    public function paymentSuccess(Request $request)
    {
        $sessionId = $request->session_id;

        if (!$sessionId) {
            return redirect()->route('customer.bookings.index')
                ->with('error', 'Invalid payment session.');
        }

        try {
            $session = $this->stripeService->retrieveSession($sessionId);
            $bookingId = $session->metadata->booking_id ?? $session->client_reference_id;

            $booking = Booking::findOrFail($bookingId);

            return view('customer.payment.success', compact('booking'));
        } catch (\Exception $e) {
            return redirect()->route('customer.bookings.index')
                ->with('error', 'Payment verification failed.');
        }
    }

    /**
     * Handle cancelled payment.
     */
    public function paymentCancel(Request $request)
    {
        $bookingId = $request->booking_id;

        if ($bookingId) {
            $booking = Booking::find($bookingId);

            if ($booking && $booking->user_id === Auth::id()) {
                // Optionally cancel the booking or mark as payment failed
                return view('customer.payment.cancel', compact('booking'));
            }
        }

        return redirect()->route('trainers.index')
            ->with('info', 'Payment was cancelled. You can try booking again.');
    }
}
