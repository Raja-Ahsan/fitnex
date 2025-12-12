<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TimeSlot;
use App\Models\Trainer;
use App\Models\BlockedSlot;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminSlotController extends Controller
{
    /**
     * Display a listing of all trainer slots.
     */
    public function index(Request $request)
    {
        $page_title = 'All Trainer Slots';
        
        $query = TimeSlot::with(['trainer', 'availability']);
        
        // Filter by trainer if provided
        if ($request->has('trainer_id') && $request->trainer_id) {
            $query->where('trainer_id', $request->trainer_id);
        }
        
        // Filter by date range if provided
        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('slot_datetime', '>=', $request->date_from);
        }
        
        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('slot_datetime', '<=', $request->date_to);
        }
        
        // Filter by status
        if ($request->has('status') && $request->status) {
            if ($request->status === 'available') {
                $query->where('is_booked', false);
            } elseif ($request->status === 'booked') {
                $query->where('is_booked', true);
            }
            // Note: Blocked slots are handled separately via BlockedSlot model, not in time_slots table
        }
        
        $slots = $query->orderBy('slot_datetime', 'desc')->paginate(50);
        
        // Get all trainers for filter dropdown
        $trainers = Trainer::where('status', 1)->orderBy('name')->get();
        
        // Get statistics
        // Note: Blocked slots are stored in blocked_slots table, not time_slots table
        // Available slots = not booked (blocked slots are handled separately)
        $stats = [
            'total_slots' => TimeSlot::count(),
            'available_slots' => TimeSlot::where('is_booked', false)->count(),
            'booked_slots' => TimeSlot::where('is_booked', true)->count(),
            'blocked_slots' => BlockedSlot::count(),
            'upcoming_slots' => TimeSlot::where('slot_datetime', '>', now())->count(),
        ];
        
        return view('admin.slots.index', compact('slots', 'trainers', 'stats', 'page_title'));
    }

    /**
     * Display blocked slots.
     */
    public function blocked()
    {
        $page_title = 'Blocked Slots';
        
        $blockedSlots = BlockedSlot::with(['trainer'])
            ->orderBy('date', 'desc')
            ->orderBy('start_time', 'desc')
            ->paginate(50);
        
        return view('admin.slots.blocked', compact('blockedSlots', 'page_title'));
    }
}

