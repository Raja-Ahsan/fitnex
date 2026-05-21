<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\Trainer;
use App\Models\Category;
use App\Models\Availability;
use App\Services\TrainerProfileSync;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TrainerDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $trainer = TrainerProfileSync::resolveTrainer($user);

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

        $upcomingBookings = \App\Models\Appointment::where('trainer_id', $trainer->id)
            ->where('status', '!=', 'cancelled')
            ->where('status', '!=', 'completed')
            ->whereBetween('appointment_date', [
                Carbon::now()->startOfDay(),
                Carbon::now()->addDays(7)->endOfDay(),
            ])
            ->with(['user'])
            ->orderBy('appointment_date', 'asc')
            ->orderBy('appointment_time', 'asc')
            ->limit(5)
            ->get();

        $recentBookings = \App\Models\Appointment::where('trainer_id', $trainer->id)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $availabilities = Availability::where('trainer_id', $trainer->id)
            ->active()
            ->orderBy('day_of_week')
            ->get();

        $profileIncomplete = !TrainerProfileSync::isProfileComplete($trainer);

        return view('trainer.dashboard', compact(
            'trainer',
            'stats',
            'upcomingBookings',
            'recentBookings',
            'availabilities',
            'profileIncomplete'
        ));
    }

    public function profile()
    {
        $user = Auth::user();
        $trainer = TrainerProfileSync::resolveTrainer($user);
        $categories = Category::orderBy('title')->where('status', 1)->get();

        return view('trainer.profile.edit', compact('user', 'trainer', 'categories'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $trainer = TrainerProfileSync::resolveTrainer($user);

        $requireImage = empty($user->image);

        $request->validate(TrainerProfileSync::validationRules($user, $requireImage));

        if (!TrainerProfileSync::normalizedDeliveryModes($request)) {
            return back()
                ->withErrors(['delivery_modes' => 'Select at least one: online or in-person sessions.'])
                ->withInput();
        }

        TrainerProfileSync::syncFromRequest($request, $user, $trainer);

        $user->refresh();
        Auth::setUser($user);

        return redirect()
            ->route('trainer.profile.edit')
            ->with('success', 'Profile updated successfully.');
    }
}
