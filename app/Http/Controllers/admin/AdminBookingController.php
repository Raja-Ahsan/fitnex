<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Appointment;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    /**
     * Display a listing of all bookings.
     */
    public function index()
    {
        $page_title = 'All Bookings';
        
        // Get all bookings with relationships
        $bookings = Booking::with(['trainer', 'user', 'timeSlot.availability'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        // Get all appointments with relationships
        $appointments = Appointment::with(['trainer', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        // Get statistics
        $stats = [
            'total_bookings' => Booking::count(),
            'total_appointments' => Appointment::count(),
            'pending_bookings' => Booking::where('booking_status', 'pending')->count(),
            'confirmed_bookings' => Booking::where('booking_status', 'confirmed')->count(),
            'cancelled_bookings' => Booking::where('booking_status', 'cancelled')->count(),
            'completed_bookings' => Booking::where('booking_status', 'completed')->count(),
            'pending_appointments' => Appointment::where('status', 'pending')->count(),
            'confirmed_appointments' => Appointment::where('status', 'confirmed')->count(),
            'total_revenue' => Booking::where('payment_status', 'paid')->sum('price') + 
                             Appointment::where('payment_status', 'paid')->sum('price'),
        ];
        
        return view('admin.bookings.index', compact('bookings', 'appointments', 'stats', 'page_title'));
    }

    /**
     * Display the specified booking.
     */
    public function show($id)
    {
        $booking = Booking::with(['trainer', 'user', 'timeSlot.availability', 'reschedules'])->findOrFail($id);
        $page_title = 'Booking Details';
        
        return view('admin.bookings.show', compact('booking', 'page_title'));
    }

    /**
     * Display the specified appointment.
     */
    public function showAppointment($id)
    {
        $appointment = Appointment::with(['trainer', 'user'])->findOrFail($id);
        $page_title = 'Appointment Details';
        
        return view('admin.appointments.show', compact('appointment', 'page_title'));
    }
}

