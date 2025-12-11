<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Banner;
use App\Mail\AppointmentBookedMail;
use App\Mail\AppointmentConfirmedMail;
use App\Mail\NewAppointmentForTrainerMail;
use App\Notifications\AppointmentBookedNotification;
use App\Notifications\AppointmentConfirmedNotification;
use App\Services\GoogleCalendarService;
use Carbon\Carbon;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;
use UnexpectedValueException;
use Illuminate\Validation\ValidationException;

class AppointmentController extends Controller
{
    protected $googleCalendarService;

    public function __construct(GoogleCalendarService $googleCalendarService)
    {
        /* $this->middleware('auth'); */
        // Use config helper instead of env directly
        $stripeSecret = config('services.stripe.secret');
        if ($stripeSecret) {
            Stripe::setApiKey($stripeSecret);
        }
        $this->googleCalendarService = $googleCalendarService;
    }

    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->hasRole('Admin')) {
                // Admin sees all appointments from all users
                $appointments = Appointment::with(['trainer', 'user'])
                    ->latest()
                    ->paginate(10);
            } else {
                // Members see only their own appointments
                $appointments = Appointment::where('user_id', Auth::id())
                    ->with('trainer')
                    ->latest()
                    ->paginate(10);
            }
        } else {
            // Return empty paginated result for non-authenticated users
            $appointments = Appointment::where('id', 0)->paginate(10);
        }

        return view('website.appointment.index', [
            'models' => $appointments,
            'page_title' => Auth::user()->hasRole('Admin') ? 'All Appointments' : 'My Appointments',
        ]);
    }

    public function create(Request $request)
    {
        $trainer = Trainer::findOrFail($request->trainer_id);
        $banner = Banner::where('slug', request()->route()->getName())->where('status', 1)->first();
        return view('website.appointment.create', [
            'trainer' => $trainer,
            'page_title' => 'Book a Session with ' . $trainer->name,
            'banner' => $banner,
        ]);
    }

    public function store(Request $request)
    {
        $validationRules = [
            'trainer_id' => 'required|exists:trainers,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|date_format:H:i',
            'time_zone' => 'required|string',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ];

        try {
            $request->validate($validationRules);
        } catch (ValidationException $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed. Please check your input.',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        }

        // Additional validation for past time slots on today's date
        if ($request->appointment_date === date('Y-m-d')) {
            $currentTime = date('H:i');
            if ($request->appointment_time <= $currentTime) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Cannot book appointments for past time slots.'
                    ], 400);
                }
                return redirect()->back()
                    ->with('error', 'Cannot book appointments for past time slots.')
                    ->withInput();
            }
        }

        $trainer = Trainer::findOrFail($request->trainer_id);

        // Check for conflicting appointments
        $existingAppointment = Appointment::where('trainer_id', $request->trainer_id)
            ->where('appointment_date', $request->appointment_date)
            ->where('appointment_time', $request->appointment_time)
            ->whereIn('status', ['confirmed', 'pending'])
            ->first();

        if ($existingAppointment) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'This time slot is no longer available. Please choose a different time.'
                ], 400);
            }
            return redirect()->back()->with('error', 'This time slot is no longer available. Please choose a different time.')->withInput();
        }

        $user = Auth::user();

        // Allow guest bookings - no user account required
        // If authenticated, use the logged-in user, otherwise use guest information

        // Always require payment first if trainer has a price
        // Google Calendar is only for viewing available slots, payment must happen first
        if ($trainer->price > 0) {
            $appointment = Appointment::create([
                'user_id' => $user ? $user->id : null,
                'name' => $request->name,
                'email' => $request->email,
                'trainer_id' => $trainer->id,
                'appointment_date' => $request->appointment_date,
                'appointment_time' => $request->appointment_time,
                'time_zone' => $request->time_zone,
                'price' => $trainer->price,
                'status' => 'pending',
                'description' => $request->description,
                'payment_status' => 'pending',
            ]);

            // Create Google Calendar event immediately when booking is created
            try {
                if ($trainer && $trainer->google_calendar_id) {
                    // Prepare event details using appointment name and email
                    $clientName = $appointment->name;
                    $clientEmail = $appointment->email;

                    if (!$clientEmail) {
                        Log::error("Appointment {$appointment->id} has no email address. Cannot create Google Calendar event.");
                    } else {
                        $eventTitle = 'Appointment with ' . $clientName . ' (Pending Payment)';
                        $eventDescription = 'Training session with ' . $trainer->name . "\n\n";
                        $eventDescription .= 'Client: ' . $clientName . "\n";
                        $eventDescription .= 'Email: ' . $clientEmail . "\n";
                        $eventDescription .= 'Status: Pending Payment' . "\n";
                        if ($appointment->description) {
                            $eventDescription .= "\nNotes: " . $appointment->description;
                        }

                        // Combine date and time for start datetime
                        $startDateTime = Carbon::parse($appointment->appointment_date . ' ' . $appointment->appointment_time);
                        // Default to 60 minutes duration
                        $endDateTime = $startDateTime->copy()->addMinutes(60);

                        // Add attendees (client and trainer emails)
                        $attendees = [];
                        if ($clientEmail) {
                            $attendees[] = $clientEmail;
                        }
                        // Get trainer email - try user relationship first, then trainer email field
                        $trainerEmail = null;
                        if ($trainer->user && $trainer->user->email) {
                            $trainerEmail = $trainer->user->email;
                        } elseif ($trainer->email) {
                            $trainerEmail = $trainer->email;
                        }
                        if ($trainerEmail) {
                            $attendees[] = $trainerEmail;
                        }

                        // Check if calendar ID is a URL (e.g. Calendly) - if so, skip Google Calendar creation
                        $isUrl = filter_var($trainer->google_calendar_id, FILTER_VALIDATE_URL);
                        $isGoogleId = strpos($trainer->google_calendar_id, '@') !== false || !$isUrl;

                        if ($isGoogleId) {
                            Log::info("Creating Google Calendar event for new booking (appointment {$appointment->id})", [
                                'calendar_id' => $trainer->google_calendar_id,
                                'title' => $eventTitle,
                                'start' => $startDateTime->toDateTimeString(),
                                'end' => $endDateTime->toDateTimeString(),
                                'attendees' => $attendees
                            ]);

                            // Create the event in Google Calendar
                            $calendarEvent = $this->googleCalendarService->createEvent(
                                $trainer->google_calendar_id,
                                $eventTitle,
                                $startDateTime,
                                $endDateTime,
                                $eventDescription,
                                $attendees
                            );

                            // Extract event ID from the returned event object
                            $eventId = null;
                            if ($calendarEvent) {
                                // Try multiple ways to get the event ID
                                if (isset($calendarEvent->id)) {
                                    $eventId = $calendarEvent->id;
                                } elseif (property_exists($calendarEvent, 'googleEvent') && isset($calendarEvent->googleEvent->id)) {
                                    $eventId = $calendarEvent->googleEvent->id;
                                } elseif (method_exists($calendarEvent, 'getId')) {
                                    $eventId = $calendarEvent->getId();
                                }

                                if ($eventId) {
                                    // Save the Google Calendar event ID to the appointment
                                    $appointment->google_calendar_event_id = $eventId;
                                    $appointment->save();

                                    Log::info("Google Calendar event created successfully for new booking (appointment {$appointment->id}). Event ID: {$eventId}, Calendar ID: {$trainer->google_calendar_id}");
                                } else {
                                    Log::warning("Google Calendar event created but ID could not be extracted for appointment {$appointment->id}");
                                    Log::warning("Event object type: " . get_class($calendarEvent));
                                }
                            } else {
                                Log::warning("Google Calendar event creation returned null for appointment {$appointment->id}. Calendar ID: {$trainer->google_calendar_id}");
                                Log::warning("Appointment details: Date={$appointment->appointment_date}, Time={$appointment->appointment_time}, Trainer={$trainer->name}");
                            }
                        } else {
                            Log::info("Trainer has a URL/External calendar ID, skipping Google Calendar API call", [
                                'id' => $trainer->google_calendar_id
                            ]);
                        }
                    }
                } else {
                    if (!$trainer) {
                        Log::error("Appointment {$appointment->id} has no trainer relationship");
                    } else {
                        Log::warning("Trainer {$trainer->id} ({$trainer->name}) has no Google Calendar ID configured. Skipping calendar event creation.");
                    }
                }
            } catch (\Exception $calendarException) {
                Log::error('Google Calendar event creation failed for new booking (appointment ' . $appointment->id . '): ' . $calendarException->getMessage());
                Log::error('Calendar exception details: ' . $calendarException->getTraceAsString());
                // Don't fail the booking process if Google Calendar update fails
            }

            // Send booking confirmation email to client
            try {
                $clientEmail = $appointment->email;
                if ($clientEmail) {
                    Mail::to($clientEmail)->send(new AppointmentBookedMail($appointment));
                    Log::info('Booking confirmation email sent to client: ' . $clientEmail);
                } else {
                    Log::warning('Appointment ' . $appointment->id . ' has no email address for client');
                }
            } catch (\Exception $emailException) {
                Log::error('Booking email sending failed: ' . $emailException->getMessage());
                Log::error('Email exception details: ' . $emailException->getTraceAsString());
                // Don't fail the booking process if email fails
            }

            // Send notification email to trainer
            try {
                $trainer = $appointment->trainer;
                if ($trainer) {
                    $trainerEmail = null;
                    if ($trainer->user && $trainer->user->email) {
                        $trainerEmail = $trainer->user->email;
                    } elseif ($trainer->email) {
                        $trainerEmail = $trainer->email;
                    }

                    if ($trainerEmail) {
                        Mail::to($trainerEmail)->send(new NewAppointmentForTrainerMail($appointment));
                        Log::info('Trainer notification email sent for new booking: ' . $trainerEmail);
                    } else {
                        Log::warning('Trainer ' . $trainer->id . ' has no email address configured');
                    }
                } else {
                    Log::error('Appointment ' . $appointment->id . ' has no trainer relationship');
                }
            } catch (\Exception $emailException) {
                Log::error('Trainer notification email failed: ' . $emailException->getMessage());
                Log::error('Email exception details: ' . $emailException->getTraceAsString());
                // Don't fail the booking process if email fails
            }

            // Send notification to user (only if authenticated)
            if ($user) {
                try {
                    $user->notify(new AppointmentBookedNotification($appointment));
                    Log::info('Appointment booked notification sent to user: ' . $user->id);
                } catch (\Exception $notificationException) {
                    Log::error('Appointment notification failed: ' . $notificationException->getMessage());
                }
            }

            try {
                // Prepare description for Stripe
                $stripeDescription = 'Training session with ' . $trainer->name;
                $stripeDescription .= ' on ' . date('F j, Y', strtotime($request->appointment_date));
                $stripeDescription .= ' at ' . date('g:i A', strtotime($request->appointment_time));
                if ($request->description) {
                    $stripeDescription .= ' - Notes: ' . $request->description;
                }

                if (!config('services.stripe.secret')) {
                    throw new \Exception('Stripe API key is not configured.');
                }

                $checkout_session = Session::create([
                    'payment_method_types' => ['card'],
                    'line_items' => [
                        [
                            'price_data' => [
                                'currency' => 'usd',
                                'product_data' => [
                                    'name' => 'Session with ' . $trainer->name,
                                    'description' => $stripeDescription,
                                ],
                                'unit_amount' => $trainer->price * 100,
                            ],
                            'quantity' => 1,
                        ]
                    ],
                    'mode' => 'payment',
                    'success_url' => route('payment.success', ['appointment_id' => $appointment->id]) . '?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url' => route('payment.cancel', ['appointment_id' => $appointment->id]),
                    'customer_email' => $request->email,
                    'client_reference_id' => $appointment->id,
                    'payment_intent_data' => [
                        'description' => $stripeDescription,
                    ],
                ]);

                $appointment->stripe_session_id = $checkout_session->id;
                $appointment->save();

                // Notify admins about new paid appointment (pending payment)
                try {
                    User::role('Admin')->get()->each->notify(new AppointmentBookedNotification($appointment));
                    Log::info('Admin notification sent for new paid appointment: ' . $appointment->id);
                } catch (\Exception $notificationException) {
                    Log::error('Admin notification failed: ' . $notificationException->getMessage());
                }

                // Return JSON response for AJAX requests, otherwise redirect
                if ($request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Thank you! Your appointment has been sent successfully. Redirecting to payment...',
                        'redirect_url' => $checkout_session->url,
                        'appointment_id' => $appointment->id
                    ]);
                }

                return redirect($checkout_session->url);
            } catch (\Exception $e) {
                Log::error('Stripe Checkout Error: ' . $e->getMessage());
                $appointment->delete();

                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Could not initiate payment. Please try again.'
                    ], 400);
                }

                return redirect()->back()->with('error', 'Could not initiate payment. Please try again.');
            }
        } else {
            // Trainer has no price set - return error
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'This trainer does not have a price set. Please contact support.'
                ], 400);
            }

            return redirect()->back()->with('error', 'This trainer does not have a price set. Please contact support.')->withInput();
        }
    }

    public function paymentSuccess(Request $request, $appointment_id)
    {
        $sessionId = $request->get('session_id');

        if (!$sessionId) {
            return redirect()->route('appointments.index')->with('error', 'Invalid payment session. Please contact support.');
        }

        // Validate appointment_id
        if (!$appointment_id || !is_numeric($appointment_id)) {
            return redirect()->route('appointments.index')->with('error', 'Invalid appointment ID. Please contact support.');
        }

        try {
            $session = Session::retrieve($sessionId);
            $appointment = Appointment::find($appointment_id);

            if (!$appointment) {
                return redirect()->route('appointments.index')->with('error', 'Appointment not found. Please contact support.');
            }

            // Ensure we are updating the correct appointment
            if ($appointment->stripe_session_id !== $sessionId) {
                Log::warning("Mismatched session ID for appointment {$appointment_id}.");
                return redirect()->route('appointments.index')->with('error', 'Invalid session ID. Payment confirmation failed.');
            }

            if ($session->payment_status == 'paid' && $appointment->status === 'pending') {
                $appointment->payment_status = 'completed';
                $appointment->status = 'confirmed';
                $appointment->save();

                // Reload appointment with relationships to ensure we have all data
                $appointment->refresh();
                $appointment->load(['trainer.user', 'user']);

                // Update Google Calendar event after payment success (if event already exists from booking)
                // If event doesn't exist, create a new one
                try {
                    $trainer = $appointment->trainer;
                    if ($trainer && $trainer->google_calendar_id) {
                        // Prepare event details using appointment name and email
                        $clientName = $appointment->name;
                        $clientEmail = $appointment->email;

                        if (!$clientEmail) {
                            Log::error("Appointment {$appointment->id} has no email address. Cannot update Google Calendar event.");
                        } else {
                            $eventTitle = 'Appointment with ' . $clientName;
                            $eventDescription = 'Training session with ' . $trainer->name . "\n\n";
                            $eventDescription .= 'Client: ' . $clientName . "\n";
                            $eventDescription .= 'Email: ' . $clientEmail . "\n";
                            $eventDescription .= 'Status: Confirmed - Payment Completed' . "\n";
                            if ($appointment->description) {
                                $eventDescription .= "\nNotes: " . $appointment->description;
                            }

                            // Combine date and time for start datetime
                            $startDateTime = Carbon::parse($appointment->appointment_date . ' ' . $appointment->appointment_time);
                            // Default to 60 minutes duration, but you can make this configurable
                            $endDateTime = $startDateTime->copy()->addMinutes(60);

                            // Check if calendar ID is a URL (e.g. Calendly) - if so, skip Google Calendar creation/update
                            $isUrl = filter_var($trainer->google_calendar_id, FILTER_VALIDATE_URL);
                            $isGoogleId = strpos($trainer->google_calendar_id, '@') !== false || !$isUrl;

                            if ($isGoogleId) {
                                // Check if event already exists (created during booking)
                                if ($appointment->google_calendar_event_id) {
                                    // Update existing event
                                    Log::info("Updating existing Google Calendar event for appointment {$appointment->id}", [
                                        'event_id' => $appointment->google_calendar_event_id,
                                        'calendar_id' => $trainer->google_calendar_id,
                                        'title' => $eventTitle
                                    ]);

                                    $updatedEvent = $this->googleCalendarService->updateEvent(
                                        $appointment->google_calendar_event_id,
                                        $trainer->google_calendar_id,
                                        [
                                            'name' => $eventTitle,
                                            'description' => $eventDescription,
                                            'startDateTime' => $startDateTime,
                                            'endDateTime' => $endDateTime
                                        ]
                                    );

                                    if ($updatedEvent) {
                                        Log::info("Google Calendar event updated successfully for appointment {$appointment->id}. Event ID: {$appointment->google_calendar_event_id}");
                                    } else {
                                        Log::warning("Failed to update Google Calendar event for appointment {$appointment->id}. Event ID: {$appointment->google_calendar_event_id}");
                                    }
                                } else {
                                    // Create new event if it doesn't exist
                                    Log::info("Creating new Google Calendar event for appointment {$appointment->id} (no existing event found)", [
                                        'calendar_id' => $trainer->google_calendar_id,
                                        'title' => $eventTitle,
                                        'start' => $startDateTime->toDateTimeString(),
                                        'end' => $endDateTime->toDateTimeString()
                                    ]);

                                    // Add attendees (client and trainer emails)
                                    $attendees = [];
                                    if ($clientEmail) {
                                        $attendees[] = $clientEmail;
                                    }
                                    // Get trainer email - try user relationship first, then trainer email field
                                    $trainerEmail = null;
                                    if ($trainer->user && $trainer->user->email) {
                                        $trainerEmail = $trainer->user->email;
                                    } elseif ($trainer->email) {
                                        $trainerEmail = $trainer->email;
                                    }
                                    if ($trainerEmail) {
                                        $attendees[] = $trainerEmail;
                                    }

                                    // Create the event in Google Calendar
                                    $calendarEvent = $this->googleCalendarService->createEvent(
                                        $trainer->google_calendar_id,
                                        $eventTitle,
                                        $startDateTime,
                                        $endDateTime,
                                        $eventDescription,
                                        $attendees
                                    );

                                    // Extract event ID from the returned event object
                                    $eventId = null;
                                    if ($calendarEvent) {
                                        // Try multiple ways to get the event ID
                                        if (isset($calendarEvent->id)) {
                                            $eventId = $calendarEvent->id;
                                        } elseif (property_exists($calendarEvent, 'googleEvent') && isset($calendarEvent->googleEvent->id)) {
                                            $eventId = $calendarEvent->googleEvent->id;
                                        } elseif (method_exists($calendarEvent, 'getId')) {
                                            $eventId = $calendarEvent->getId();
                                        }

                                        if ($eventId) {
                                            // Save the Google Calendar event ID to the appointment
                                            $appointment->google_calendar_event_id = $eventId;
                                            $appointment->save();

                                            Log::info("Google Calendar event created successfully for appointment {$appointment->id}. Event ID: {$eventId}, Calendar ID: {$trainer->google_calendar_id}");
                                        } else {
                                            Log::warning("Google Calendar event created but ID could not be extracted for appointment {$appointment->id}");
                                            Log::warning("Event object type: " . get_class($calendarEvent));
                                        }
                                    } else {
                                        Log::warning("Google Calendar event creation returned null for appointment {$appointment->id}. Calendar ID: {$trainer->google_calendar_id}");
                                        Log::warning("Appointment details: Date={$appointment->appointment_date}, Time={$appointment->appointment_time}, Trainer={$trainer->name}");
                                    }
                                }
                            } else {
                                Log::info("Trainer has a URL/External calendar ID, skipping Google Calendar API call (Payment Success)", [
                                    'id' => $trainer->google_calendar_id
                                ]);
                            }
                        }
                    } else {
                        if (!$trainer) {
                            Log::error("Appointment {$appointment->id} has no trainer relationship");
                        } else {
                            Log::warning("Trainer {$trainer->id} ({$trainer->name}) has no Google Calendar ID configured. Skipping calendar event update.");
                        }
                    }
                } catch (\Exception $calendarException) {
                    Log::error('Google Calendar event update/creation failed for appointment ' . $appointment->id . ': ' . $calendarException->getMessage());
                    Log::error('Calendar exception details: ' . $calendarException->getTraceAsString());
                    // Don't fail the booking if Google Calendar update fails
                }

                // Send email notifications to client and trainer
                // Send confirmation email to client
                if ($appointment->email) {
                    try {
                        Log::info('=== EMAIL SENDING START ===');
                        Log::info('Attempting to send confirmation email to client: ' . $appointment->email);
                        Log::info('Appointment ID: ' . $appointment->id);
                        Log::info('Appointment Date: ' . $appointment->appointment_date);
                        Log::info('Appointment Time: ' . $appointment->appointment_time);

                        $mailResult = Mail::to($appointment->email)->send(new AppointmentConfirmedMail($appointment));

                        Log::info('Confirmation email sent successfully to client: ' . $appointment->email);
                        Log::info('Mail result: ' . ($mailResult ? 'Success' : 'Failed'));
                        Log::info('=== EMAIL SENDING END ===');
                    } catch (\Exception $emailException) {
                        Log::error('=== EMAIL SENDING FAILED ===');
                        Log::error('Failed to send confirmation email to client: ' . $appointment->email);
                        Log::error('Error message: ' . $emailException->getMessage());
                        Log::error('Error code: ' . $emailException->getCode());
                        Log::error('Email exception details: ' . $emailException->getTraceAsString());
                        Log::error('=== EMAIL SENDING FAILED END ===');
                    }
                } else {
                    Log::warning('Appointment ' . $appointment->id . ' has no email address for client');
                }

                // Send notification email to trainer
                if ($appointment->trainer) {
                    // Try to get trainer email from trainer->user relationship first
                    $trainerEmail = null;
                    if ($appointment->trainer->user && $appointment->trainer->user->email) {
                        $trainerEmail = $appointment->trainer->user->email;
                    } elseif ($appointment->trainer->email) {
                        // Fallback to trainer email if user relationship doesn't exist
                        $trainerEmail = $appointment->trainer->email;
                    }

                    if ($trainerEmail) {
                        try {
                            Log::info('=== TRAINER EMAIL SENDING START ===');
                            Log::info('Attempting to send notification email to trainer: ' . $trainerEmail);
                            Log::info('Trainer ID: ' . $appointment->trainer->id);
                            Log::info('Trainer Name: ' . $appointment->trainer->name);

                            $mailResult = Mail::to($trainerEmail)->send(new NewAppointmentForTrainerMail($appointment));

                            Log::info('Trainer notification email sent successfully to: ' . $trainerEmail);
                            Log::info('Mail result: ' . ($mailResult ? 'Success' : 'Failed'));
                            Log::info('=== TRAINER EMAIL SENDING END ===');
                        } catch (\Exception $emailException) {
                            Log::error('=== TRAINER EMAIL SENDING FAILED ===');
                            Log::error('Failed to send notification email to trainer: ' . $trainerEmail);
                            Log::error('Error message: ' . $emailException->getMessage());
                            Log::error('Error code: ' . $emailException->getCode());
                            Log::error('Email exception details: ' . $emailException->getTraceAsString());
                            Log::error('=== TRAINER EMAIL SENDING FAILED END ===');
                        }
                    } else {
                        Log::warning('Trainer ' . $appointment->trainer->id . ' has no email address configured');
                        Log::warning('Trainer user relationship: ' . ($appointment->trainer->user ? 'Exists' : 'NULL'));
                        Log::warning('Trainer email field: ' . ($appointment->trainer->email ?? 'NULL'));
                    }
                } else {
                    Log::error('Appointment ' . $appointment->id . ' has no trainer relationship');
                }

                // Send notification to user for confirmed appointment (only if authenticated)
                if ($appointment->user) {
                    try {
                        $appointment->user->notify(new AppointmentConfirmedNotification($appointment));
                        Log::info('Appointment confirmed notification sent to user: ' . $appointment->user->id);
                    } catch (\Exception $notificationException) {
                        Log::error('Appointment confirmed notification failed: ' . $notificationException->getMessage());
                    }
                }

                // Redirect to payment success page instead of appointments index
                return view('website.appointment.payment-success', ['appointment' => $appointment]);
            } elseif ($appointment->status === 'confirmed') {
                // Handle cases where the user revisits the success URL
                return view('website.appointment.payment-success', ['appointment' => $appointment]);
            } else {
                // If payment was not successful, redirect to the cancellation page
                return redirect()->route('payment.cancel', ['appointment_id' => $appointment_id])->with('error', 'Payment was not successful. Please try again.');
            }
        } catch (\Exception $e) {
            Log::error('Stripe Success Error: ' . $e->getMessage());
            return redirect()->route('appointments.index')->with('error', 'An error occurred while confirming your payment.');
        }
    }

    public function paymentCancel(Request $request, $appointment_id)
    {
        // Validate appointment_id
        if (!$appointment_id || !is_numeric($appointment_id)) {
            return redirect()->route('appointments.index')->with('error', 'Invalid appointment ID. Please contact support.');
        }

        $appointment = Appointment::find($appointment_id);

        if (!$appointment) {
            return redirect()->route('appointments.index')->with('error', 'Appointment not found. Please contact support.');
        }

        if ($appointment->payment_status === 'pending') {
            $appointment->status = 'cancelled';
            $appointment->save();
        }

        return redirect()->route('appointments.index')->with('error', 'Payment was cancelled. Your booking has not been confirmed.');
    }

    public function getAvailableDates($trainer_id, $monthString)
    {
        try {
            // Need to import these models at the top, but for now using fully qualified names or relying on previous imports
            // Trainer, Appointment are already imported.
            // Need Availability and BlockedSlot

            $trainer = Trainer::findOrFail($trainer_id);

            // Parse month string (YYYY-MM)
            $startOfMonth = Carbon::parse($monthString . '-01')->startOfMonth();
            $endOfMonth = $startOfMonth->copy()->endOfMonth();

            $availableDates = [];

            // Get trainer's weekly availability
            $availabilities = \App\Models\Availability::where('trainer_id', $trainer_id)
                ->where('is_active', true)
                ->get()
                ->keyBy('day_of_week'); // 0=Sunday, 1=Monday, etc. (Check standard Carbon/PHP day mapping)

            // Note: Carbon::dayOfWeek returns 0 (Sunday) to 6 (Saturday)
            // Ensure Availability model uses same mapping. 
            // In many systems Mon=1, Sun=7 or Sun=0. 
            // Let's assume standard PHP/Carbon mapping for now: 0 (Sunday) - 6 (Saturday)

            // Get blocked dates for this month
            // Assuming BlockedSlot has date or start_time
            // If BlockedSlot is 'all day', exclude the date.
            // If BlockedSlot is partial, we might still show the date as available.
            // For simplicity, if there are ANY slots unblocked, it's available.

            // Iterate through every day of the month
            $currentDate = $startOfMonth->copy();

            while ($currentDate <= $endOfMonth) {
                // Skip past dates
                if ($currentDate->lt(Carbon::today())) {
                    $currentDate->addDay();
                    continue;
                }

                $dayOfWeek = $currentDate->dayOfWeek; // 0 (Sunday) to 6 (Saturday)

                // Adjust for custom mapping if needed. 
                // Let's check Availability model usually stores localized day names or integers.
                // If it stores 'Monday', 'Tuesday', convert.
                // Assuming integer 0-6 or 1-7.

                // Check if trainer works on this day of week
                // We need to map Carbon dayOfWeek to whatever is stored in DB.
                // If Availability stores 'Monday', 'Tuesday'...
                $dayName = $currentDate->format('l'); // Monday, Tuesday...

                // Let's check if we have availability for this day name
                $hasAvailability = $availabilities->contains(function ($value, $key) use ($dayName, $dayOfWeek) {
                    // Check if key is integer or string
                    return strcasecmp($value->day_of_week, $dayName) === 0 || $value->day_of_week == $dayOfWeek;
                });

                if ($hasAvailability) {
                    // Check if date is fully blocked
                    // This is "Is there at least one slot available?"
                    // Determining full blockage is complex without checking every slot.
                    // For now, assume available if they work that day.
                    // The 'available-times' endpoint will handle the specific slot filtering.

                    $availableDates[] = $currentDate->format('Y-m-d');
                }

                $currentDate->addDay();
            }

            return response()->json($availableDates);

        } catch (\Exception $e) {
            Log::error("Error fetching available dates: " . $e->getMessage());
            return response()->json(['error' => 'Could not fetch available dates.'], 500);
        }
    }
    public function getAvailableTimes($trainer_id, $date)
    {
        try {
            $trainer = Trainer::findOrFail($trainer_id);

            // Check if the selected date is in the past
            if (strtotime($date) < strtotime('today')) {
                return response()->json([]);
            }

            // Get Google Calendar ID from trainer
            $googleCalendarId = $trainer->google_calendar_id;

            // Get available slots from Google Calendar
            $googleCalendarSlots = [];
            if ($googleCalendarId) {
                try {
                    $googleCalendarSlots = $this->googleCalendarService->getAvailableSlots(
                        $googleCalendarId,
                        $date,
                        '09:00', // Start time
                        '20:00', // End time (8 PM)
                        30 // 30 minutes slot duration
                    );
                } catch (\Exception $e) {
                    Log::error("Google Calendar fetch error: " . $e->getMessage());
                    // Continue with database check as fallback
                }
            }

            // Also get booked times from database
            $bookedTimes = Appointment::where('trainer_id', $trainer_id)
                ->where('appointment_date', $date)
                ->whereIn('status', ['confirmed', 'pending'])
                ->pluck('appointment_time')
                ->map(function ($time) {
                    return date('H:i', strtotime($time)); // Ensure H:i format
                })
                ->toArray();

            // If we have Google Calendar slots, use them and filter out database bookings
            // If we have Google Calendar slots, use them and filter out database bookings
            if (!empty($googleCalendarSlots)) {
                $availableSlots = array_diff($googleCalendarSlots, $bookedTimes);
            } else {
                // Fallback: Generate slots based on Trainer's Availability configuration

                // 1. Get Availability for this day
                $dayOfWeek = date('w', strtotime($date)); // 0 (Sunday) to 6 (Saturday)
                $availability = \App\Models\Availability::where('trainer_id', $trainer_id)
                    ->where('day_of_week', $dayOfWeek)
                    ->where('is_active', true)
                    ->first();

                $sessionDuration = $availability->session_duration ?? 60;

                if (!$availability) {
                    $availableSlots = [];
                } else {
                    $startTime = strtotime($availability->start_time);
                    $endTime = strtotime($availability->end_time);
                    $slotInterval = $sessionDuration * 60;

                    $allSlots = [];
                    // Generate slots from start_time to end_time
                    for ($time = $startTime; $time < $endTime; $time += $slotInterval) {
                        $allSlots[] = date('H:i', $time);
                    }

                    // 2. Filter out past times for today
                    if ($date === date('Y-m-d')) {
                        $currentTime = date('H:i');
                        $allSlots = array_filter($allSlots, function ($slot) use ($currentTime) {
                            return $slot > $currentTime;
                        });
                    }

                    // 3. Filter out Blocked Slots
                    $blockedSlots = \App\Models\BlockedSlot::where('trainer_id', $trainer_id)
                        ->where('date', $date)
                        ->get();

                    if ($blockedSlots->count() > 0) {
                        $allSlots = array_filter($allSlots, function ($slot) use ($blockedSlots) {
                            foreach ($blockedSlots as $block) {
                                if ($block->coversTime($slot)) {
                                    return false;
                                }
                            }
                            return true;
                        });
                    }

                    // 4. Filter out Booked Times
                    $availableSlots = array_diff($allSlots, $bookedTimes);
                }
            }

            // Sort available slots
            sort($availableSlots);

            // Fetch session duration if not already set (e.g. Google Calendar path)
            if (!isset($sessionDuration)) {
                $availability = \App\Models\Availability::where('trainer_id', $trainer_id)->first();
                $sessionDuration = $availability->session_duration ?? 60;
            }

            // Map to objects with display range
            $formattedSlots = array_map(function ($slot) use ($sessionDuration) {
                $startTime = Carbon::createFromFormat('H:i', $slot);
                $endTime = $startTime->copy()->addMinutes((int) $sessionDuration);

                return [
                    'value' => $slot,
                    'display' => $startTime->format('g:i A') . ' - ' . $endTime->format('g:i A')
                ];
            }, array_values($availableSlots));

            return response()->json($formattedSlots);

        } catch (\Exception $e) {
            Log::error("Error fetching available times: " . $e->getMessage());
            return response()->json(['error' => 'Could not fetch available times.'], 500);
        }
    }

    public function show($id)
    {
        $appointment = Appointment::with(['trainer', 'user'])->findOrFail($id);

        // Check if user has permission to view this appointment
        // Allow admins to view all appointments
        // Allow users to view their own appointments
        // For guest bookings (user_id is null), check if authenticated user matches the email
        if (Auth::check()) {
            $canView = false;

            if (Auth::user()->hasRole('Admin')) {
                $canView = true;
            } elseif ($appointment->user_id === Auth::id()) {
                $canView = true;
            } elseif ($appointment->user_id === null && $appointment->email === Auth::user()->email) {
                // Guest booking but email matches authenticated user
                $canView = true;
            }

            if ($canView) {
                return view('website.appointment.show', [
                    'appointment' => $appointment,
                    'page_title' => 'Appointment Details',
                ]);
            }
        }

        return redirect()->route('appointments.index')->with('error', 'You do not have permission to view this appointment.');
    }

    public function confirm($id)
    {
        $appointment = Appointment::findOrFail($id);

        // Check if user has permission to confirm this appointment
        if (!Auth::user()->hasRole('Admin')) {
            return redirect()->route('appointments.index')->with('error', 'You do not have permission to confirm appointments.');
        }

        if ($appointment->status !== 'pending') {
            return redirect()->route('appointments.index')->with('error', 'Only pending appointments can be confirmed.');
        }

        try {
            $appointment->status = 'confirmed';
            $appointment->payment_status = 'completed';
            $appointment->save();

            // Send confirmation email
            try {
                Mail::to($appointment->email)->send(new AppointmentConfirmedMail($appointment));
                Log::info('Appointment confirmation email sent to: ' . $appointment->email);
            } catch (\Exception $emailException) {
                Log::error('Appointment confirmation email failed: ' . $emailException->getMessage());
            }

            // Send notification to user (only if authenticated)
            if ($appointment->user) {
                try {
                    $appointment->user->notify(new AppointmentConfirmedNotification($appointment));
                    Log::info('Appointment confirmed notification sent to user: ' . $appointment->user->id);
                } catch (\Exception $notificationException) {
                    Log::error('Appointment confirmed notification failed: ' . $notificationException->getMessage());
                }
            }

            // Send notification to trainer
            try {
                if ($appointment->trainer && $appointment->trainer->user) {
                    Mail::to($appointment->trainer->user->email)->send(new NewAppointmentForTrainerMail($appointment));
                    Log::info('Trainer notification email sent: ' . $appointment->trainer->user->email);
                }
            } catch (\Exception $emailException) {
                Log::error('Trainer notification email failed: ' . $emailException->getMessage());
            }

            return redirect()->route('appointments.index')->with('success', 'Appointment confirmed successfully!');

        } catch (\Exception $e) {
            Log::error('Error confirming appointment: ' . $e->getMessage());
            return redirect()->route('appointments.index')->with('error', 'Failed to confirm appointment. Please try again.');
        }
    }

    public function complete($id)
    {
        $appointment = Appointment::findOrFail($id);

        // Check if user has permission to complete this appointment
        if (!Auth::user()->hasRole('Admin')) {
            return redirect()->route('appointments.index')->with('error', 'You do not have permission to complete appointments.');
        }

        if ($appointment->status !== 'confirmed') {
            return redirect()->route('appointments.index')->with('error', 'Only confirmed appointments can be marked as completed.');
        }

        try {
            $appointment->status = 'completed';
            $appointment->save();

            return redirect()->route('appointments.index')->with('success', 'Appointment marked as completed successfully!');

        } catch (\Exception $e) {
            Log::error('Error completing appointment: ' . $e->getMessage());
            return redirect()->route('appointments.index')->with('error', 'Failed to complete appointment. Please try again.');
        }
    }

    public function cancel($id)
    {
        $appointment = Appointment::findOrFail($id);

        // Check if user has permission to cancel this appointment
        if (!Auth::user()->hasRole('Admin') && $appointment->user_id !== Auth::id()) {
            return redirect()->route('appointments.index')->with('error', 'You do not have permission to cancel this appointment.');
        }

        if ($appointment->status === 'cancelled') {
            return redirect()->route('appointments.index')->with('error', 'This appointment is already cancelled.');
        }

        try {
            $appointment->status = 'cancelled';
            // Update payment status to cancelled if it was pending or completed
            if ($appointment->payment_status === 'pending' || $appointment->payment_status === 'completed') {
                $appointment->payment_status = 'cancelled';
            }
            $appointment->save();

            return redirect()->route('appointments.index')->with('success', 'Appointment cancelled successfully!');

        } catch (\Exception $e) {
            Log::error('Error cancelling appointment: ' . $e->getMessage());
            return redirect()->route('appointments.index')->with('error', 'Failed to cancel appointment. Please try again.');
        }
    }

    public function googleCalendarCallback(Request $request)
    {
        // This method handles callbacks from Google Calendar
        // Extract booking data from request parameters
        $date = $request->get('date');
        $time = $request->get('time');
        $eventId = $request->get('event_id');
        $trainerId = $request->get('trainer_id');

        if (!$date || !$time || !$trainerId) {
            return redirect()->route('appointments.create', ['trainer_id' => $trainerId ?? ''])
                ->with('error', 'Invalid booking data. Please try again.');
        }

        // Redirect to appointment creation page with booking data
        return redirect()->route('appointments.create', [
            'trainer_id' => $trainerId,
            'gc_date' => $date,
            'gc_time' => $time,
            'gc_event_id' => $eventId
        ]);
    }
}

