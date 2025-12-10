<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Trainer;
use Illuminate\Http\Request;

class TrainerListController extends Controller
{
    /**
     * Display list of all trainers.
     */
    public function index(Request $request)
    {
        $query = Trainer::where('status', 1)
            ->with(['availabilities', 'pricing']);

        // Search by name or designation
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('designation', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $trainers = $query->paginate(12);

        return view('customer.trainers.index', compact('trainers'));
    }

    /**
     * Display trainer profile.
     */
    public function show($id)
    {
        $trainer = Trainer::where('status', 1)
            ->with(['availabilities', 'pricing', 'googleAccount'])
            ->findOrFail($id);

        // Get upcoming available slots (next 7 days)
        $upcomingSlots = $trainer->timeSlots()
            ->available()
            ->future()
            ->whereBetween('slot_datetime', [
                now(),
                now()->addDays(7)
            ])
            ->orderBy('slot_datetime')
            ->limit(10)
            ->get();

        // Get trainer statistics
        $stats = [
            'total_sessions' => $trainer->bookings()->where('booking_status', 'completed')->count(),
            'active_bookings' => $trainer->bookings()->whereIn('booking_status', ['pending', 'confirmed'])->count(),
        ];

        return view('customer.trainers.show', compact('trainer', 'upcomingSlots', 'stats'));
    }
}
