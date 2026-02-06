<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Availability;
use App\Models\Trainer;
use Illuminate\Http\Request;

class AdminAvailabilityController extends Controller
{
    /**
     * Display a listing of all trainer availability.
     */
    public function index(Request $request)
    {
        $page_title = 'All Trainer Availability';
        
        $query = Availability::with(['trainer']);
        
        // Filter by trainer if provided
        if ($request->has('trainer_id') && $request->trainer_id) {
            $query->where('trainer_id', $request->trainer_id);
        }
        
        // Filter by day of week if provided
        if ($request->has('day_of_week') && $request->day_of_week !== null) {
            $query->where('day_of_week', $request->day_of_week);
        }
        
        $availabilities = $query->orderBy('trainer_id')->orderBy('day_of_week')->orderBy('start_time')->paginate(50);
        
        // Get all trainers for filter dropdown
        $trainers = Trainer::where('status', 1)->orderBy('name')->get();
        
        // Days of week
        $days = [
            0 => 'Sunday',
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
        ];
        
        // Get statistics
        $stats = [
            'total_availabilities' => Availability::count(),
            'active_availabilities' => Availability::where('is_active', true)->count(),
            'inactive_availabilities' => Availability::where('is_active', false)->count(),
            'trainers_with_availability' => Availability::distinct('trainer_id')->count('trainer_id'),
        ];
        
        return view('admin.availability.index', compact('availabilities', 'trainers', 'days', 'stats', 'page_title'));
    }

    /**
     * Display availability for a specific trainer.
     */
    public function show($trainerId)
    {
        $trainer = Trainer::findOrFail($trainerId);
        $page_title = 'Availability for ' . $trainer->name;
        
        $availabilities = Availability::where('trainer_id', $trainerId)
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();
        
        $days = [
            0 => 'Sunday',
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
        ];
        
        return view('admin.availability.show', compact('trainer', 'availabilities', 'days', 'page_title'));
    }
}

