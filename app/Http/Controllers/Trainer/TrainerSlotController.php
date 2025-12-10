<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\Trainer;
use App\Models\TimeSlot;
use App\Models\BlockedSlot;
use App\Http\Requests\BlockSlotRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TrainerSlotController extends Controller
{
    /**
     * Display all slots for the trainer.
     */
    public function index(Request $request)
    {
        $trainer = Trainer::where('created_by', Auth::id())->firstOrFail();

        $query = TimeSlot::forTrainer($trainer->id)
            ->with('availability', 'booking.user');

        // Filter by date range
        if ($request->filled('start_date')) {
            $query->where('slot_datetime', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->where('slot_datetime', '<=', $request->end_date);
        }

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'available') {
                $query->available();
            } elseif ($request->status === 'booked') {
                $query->booked();
            }
        }

        $slots = $query->orderBy('slot_datetime')
            ->paginate(50);

        return view('trainer.slots.index', compact('trainer', 'slots'));
    }

    /**
     * Show form to block slots.
     */
    public function blockForm()
    {
        $trainer = Trainer::where('created_by', Auth::id())->firstOrFail();
        return view('trainer.slots.block', compact('trainer'));
    }

    /**
     * Block specific time slots.
     */
    public function block(BlockSlotRequest $request)
    {
        $trainer = Trainer::where('created_by', Auth::id())->firstOrFail();

        $startDateTime = Carbon::parse($request->start_datetime);
        $endDateTime = Carbon::parse($request->end_datetime);

        // Create blocked slot record
        BlockedSlot::create([
            'trainer_id' => $trainer->id,
            'start_datetime' => $startDateTime,
            'end_datetime' => $endDateTime,
            'reason' => $request->reason,
        ]);

        // Mark existing slots in this range as unavailable
        TimeSlot::forTrainer($trainer->id)
            ->whereBetween('slot_datetime', [$startDateTime, $endDateTime])
            ->available()
            ->update(['is_available' => false]);

        return redirect()->route('trainer.slots.index')
            ->with('success', 'Time slots blocked successfully.');
    }

    /**
     * Unblock a blocked slot.
     */
    public function unblock($id)
    {
        $trainer = Trainer::where('created_by', Auth::id())->firstOrFail();

        $blockedSlot = BlockedSlot::where('trainer_id', $trainer->id)
            ->findOrFail($id);

        // Re-enable slots in this range
        TimeSlot::forTrainer($trainer->id)
            ->whereBetween('slot_datetime', [
                $blockedSlot->start_datetime,
                $blockedSlot->end_datetime
            ])
            ->update(['is_available' => true]);

        $blockedSlot->delete();

        return redirect()->route('trainer.slots.index')
            ->with('success', 'Time slots unblocked successfully.');
    }

    /**
     * View blocked slots.
     */
    public function blocked()
    {
        $trainer = Trainer::where('created_by', Auth::id())->firstOrFail();

        $blockedSlots = BlockedSlot::where('trainer_id', $trainer->id)
            ->orderBy('start_datetime', 'desc')
            ->paginate(20);

        return view('trainer.slots.blocked', compact('trainer', 'blockedSlots'));
    }
}
