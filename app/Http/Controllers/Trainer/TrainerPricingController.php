<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\Trainer;
use App\Models\TrainerPricing;
use App\Http\Requests\UpdatePricingRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrainerPricingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display trainer's pricing settings.
     */
    public function index()
    {
        $trainer = Trainer::where('created_by', Auth::id())->firstOrFail();
        $pricing = $trainer->pricing()->get()->keyBy('session_duration');

        $durations = config('booking.session_durations', [30, 45, 60]);

        return view('trainer.pricing.index', compact('trainer', 'pricing', 'durations'));
    }

    /**
     * Update trainer's pricing.
     */
    public function update(UpdatePricingRequest $request)
    {
        $trainer = Trainer::where('created_by', Auth::id())->firstOrFail();

        DB::beginTransaction();
        try {
            foreach ($request->pricing as $pricingData) {
                TrainerPricing::updateOrCreate(
                    [
                        'trainer_id' => $trainer->id,
                        'session_duration' => $pricingData['session_duration'],
                    ],
                    [
                        'price' => $pricingData['price'],
                        'currency' => $pricingData['currency'] ?? 'USD',
                        'is_active' => $pricingData['is_active'] ?? true,
                    ]
                );
            }

            DB::commit();

            return redirect()->route('trainer.pricing.index')
                ->with('success', 'Pricing updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to update pricing: ' . $e->getMessage());
        }
    }
}
