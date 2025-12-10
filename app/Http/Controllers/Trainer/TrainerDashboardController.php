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
            'total_bookings' => \App\Models\Appointment::where('trainer_id', $trainer->id)->count(),
            'this_month' => \App\Models\Appointment::where('trainer_id', $trainer->id)
                ->whereMonth('created_at', Carbon::now()->month)
                ->count(),
            'pending' => \App\Models\Appointment::where('trainer_id', $trainer->id)
                ->where('status', 'pending')
                ->count(),
            'total_revenue' => \App\Models\Appointment::where('trainer_id', $trainer->id)
                ->where(function ($query) {
                    $query->where('payment_status', 'paid')
                        ->orWhere('payment_status', 'completed');
                })
                ->sum('price'),
        ];

        // Get upcoming bookings (next 7 days)
        $upcomingBookings = \App\Models\Appointment::where('trainer_id', $trainer->id)
            ->where('status', '!=', 'cancelled')
            ->where('status', '!=', 'completed')
            ->whereBetween('appointment_date', [
                Carbon::now()->startOfDay(),
                Carbon::now()->addDays(7)->endOfDay()
            ])
            ->with(['user'])
            ->orderBy('appointment_date', 'asc')
            ->orderBy('appointment_time', 'asc')
            ->limit(5)
            ->get();

        // Get recent bookings
        $recentBookings = \App\Models\Appointment::where('trainer_id', $trainer->id)
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
    public function profile()
    {
        $user = Auth::user();
        return view('trainer.profile.edit', compact('user'));
    }

    public function updateProfile(\Illuminate\Http\Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
        }

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/user'), $imageName);
            $user->image = $imageName;

            // Sync with Trainer table
            $trainer = Trainer::where('created_by', $user->id)->first();
            if ($trainer) {
                $trainer->image = $imageName;
                $trainer->save();
            }
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
