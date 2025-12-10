<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\Trainer;
use App\Models\TrainerBooking;
use App\Models\Availability;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TrainerDashboardController extends Controller
{
    public function index()
    {
        $trainer = Trainer::where('created_by', Auth::id())->firstOrFail();

        // Get statistics
        $stats = [
            'total_bookings' => TrainerBooking::forTrainer($trainer->id)->count(),
            'this_month' => TrainerBooking::forTrainer($trainer->id)
                ->whereMonth('created_at', Carbon::now()->month)
                ->count(),
            'pending' => TrainerBooking::forTrainer($trainer->id)
                ->where('booking_status', 'pending')
                ->count(),
            'total_revenue' => TrainerBooking::forTrainer($trainer->id)
                ->where('payment_status', 'paid')
                ->sum('price'),
        ];

        // Get upcoming bookings (next 7 days)
        $upcomingBookings = TrainerBooking::forTrainer($trainer->id)
            ->upcoming()
            ->whereHas('timeSlot', function ($query) {
                $query->whereBetween('slot_datetime', [
                    Carbon::now(),
                    Carbon::now()->addDays(7)
                ]);
            })
            ->with(['user', 'timeSlot.availability'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Get recent bookings
        $recentBookings = TrainerBooking::forTrainer($trainer->id)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Get availabilities
        $availabilities = Availability::where('trainer_id', $trainer->id)
            ->active()
            ->orderBy('day_of_week')
            ->get();

        return view('trainer.dashboard', compact(
            'trainer',
            'stats',
            'upcomingBookings',
            'recentBookings',
            'availabilities'
        ));
    }
}
