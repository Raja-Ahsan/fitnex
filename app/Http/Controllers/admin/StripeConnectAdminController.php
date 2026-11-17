<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Trainer;
use App\Services\StripeConnectService;
use App\Services\StripeConnectSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class StripeConnectAdminController extends Controller
{
    public function __construct(protected StripeConnectService $stripeConnect)
    {
    }

    public function index(Request $request)
    {
        $settings = StripeConnectSettings::stored();
        $filter = $request->get('filter', 'all');

        $trainers = Trainer::with('user')
            ->where('status', 1)
            ->orderBy('id')
            ->get();

        if ($filter === 'connected') {
            $trainers = $trainers->where('stripe_connect_status', 'connected')->values();
        } elseif ($filter === 'not_connected') {
            $trainers = $trainers->where('stripe_connect_status', '!=', 'connected')->values();
        }

        $payouts = Appointment::with(['trainer.user'])
            ->whereIn('payout_status', ['held', 'manual_pending', 'transferred', 'manual_paid', 'failed'])
            ->orderByDesc('id')
            ->limit(50)
            ->get();

        $stats = [
            'connected' => Trainer::where('stripe_connect_status', 'connected')->count(),
            'pending' => Trainer::whereIn('stripe_connect_status', ['pending', 'restricted'])->count(),
            'not_connected' => Trainer::where(function ($q) {
                $q->whereNull('stripe_connect_status')
                    ->orWhere('stripe_connect_status', 'not_connected');
            })->count(),
            'manual_pending' => Appointment::where('payout_status', 'manual_pending')->count(),
            'held' => Appointment::where('payout_status', 'held')->count(),
        ];

        return view('admin.stripe_connect.index', compact('settings', 'trainers', 'payouts', 'stats', 'filter'));
    }

    public function updateSettings(Request $request)
    {
        $data = $request->validate([
            'commission_percent' => 'required|numeric|min:0|max:100',
            'fee_bearer' => 'required|in:trainer,platform',
            'payout_trigger' => 'required|in:session_complete,booking',
        ]);

        StripeConnectSettings::save($data);

        return back()->with('message', 'Stripe Connect settings saved.');
    }

    public function refreshTrainer(Trainer $trainer)
    {
        if (!$trainer->stripe_account_id) {
            return back()->with('warning', 'This trainer has not started Stripe Connect yet.');
        }

        try {
            $this->stripeConnect->refreshAccountStatus($trainer);
            return back()->with('message', 'Stripe status refreshed for '.$trainer->name.'.');
        } catch (Throwable $e) {
            return back()->with('error', 'Could not refresh Stripe status: '.$e->getMessage());
        }
    }

    public function releasePayout(Appointment $appointment)
    {
        try {
            $appointment = $this->stripeConnect->releasePayout($appointment);

            return back()->with(
                $appointment->payout_status === 'transferred' ? 'message' : 'warning',
                match ($appointment->payout_status) {
                    'transferred' => 'Payout transferred to trainer.',
                    'manual_pending' => 'Could not auto-transfer. Marked for manual payout.'.($appointment->payout_error ? ' '.$appointment->payout_error : ''),
                    default => 'Payout status: '.$appointment->payout_status,
                }
            );
        } catch (Throwable $e) {
            Log::error('Admin payout release failed: '.$e->getMessage());
            return back()->with('error', 'Payout release failed: '.$e->getMessage());
        }
    }

    public function markManualPaid(Appointment $appointment)
    {
        $this->stripeConnect->markManualPaid($appointment);

        return back()->with('message', 'Marked as manually paid.');
    }
}
