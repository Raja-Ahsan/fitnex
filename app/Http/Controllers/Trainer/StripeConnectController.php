<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\Trainer;
use App\Services\StripeConnectService;
use App\Services\StripeConnectSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Throwable;

class StripeConnectController extends Controller
{
    public function __construct(protected StripeConnectService $stripeConnect)
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $trainer = Trainer::where('created_by', Auth::id())->firstOrFail();

        if ($trainer->stripe_account_id && $this->stripeConnect->isConfigured()) {
            try {
                $trainer = $this->stripeConnect->refreshAccountStatus($trainer);
            } catch (Throwable $e) {
                Log::warning('Could not refresh Stripe status: '.$e->getMessage());
            }
        }

        $settings = StripeConnectSettings::stored();
        $countries = StripeConnectService::supportedCountries();
        $loginUrl = $trainer->stripe_connect_status === 'connected'
            ? $this->stripeConnect->createLoginLink($trainer)
            : null;

        return view('trainer.stripe.index', compact('trainer', 'settings', 'countries', 'loginUrl'));
    }

    public function connect(Request $request)
    {
        if (!$this->stripeConnect->isConfigured()) {
            return back()->with('error', 'Stripe is not configured on this site yet. Please contact FITNEX support.');
        }

        $request->validate([
            'country' => 'required|in:'.implode(',', array_keys(StripeConnectService::supportedCountries())),
        ]);

        $trainer = Trainer::where('created_by', Auth::id())->firstOrFail();

        try {
            if (!$trainer->stripe_account_id) {
                $this->stripeConnect->createExpressAccount($trainer, $request->country);
                $trainer->refresh();
            } elseif ($trainer->stripe_country && $trainer->stripe_country !== strtoupper($request->country)) {
                return back()->with('error', 'Your Stripe account is already started for '.$trainer->stripe_country.'. Contact support to change country.');
            }

            $url = $this->stripeConnect->createOnboardingLink($trainer);
            return redirect()->away($url);
        } catch (Throwable $e) {
            Log::error('Stripe Connect onboarding failed: '.$e->getMessage());
            return back()->with('error', 'Could not start Stripe onboarding: '.$e->getMessage());
        }
    }

    public function refresh()
    {
        $trainer = Trainer::where('created_by', Auth::id())->firstOrFail();

        if (!$trainer->stripe_account_id) {
            return redirect()->route('trainer.stripe.index')
                ->with('warning', 'Please start Stripe Connect again.');
        }

        try {
            $url = $this->stripeConnect->createOnboardingLink($trainer);
            return redirect()->away($url);
        } catch (Throwable $e) {
            return redirect()->route('trainer.stripe.index')
                ->with('error', 'Could not resume Stripe onboarding: '.$e->getMessage());
        }
    }

    public function returnFromStripe()
    {
        $trainer = Trainer::where('created_by', Auth::id())->firstOrFail();

        try {
            $trainer = $this->stripeConnect->refreshAccountStatus($trainer);
        } catch (Throwable $e) {
            Log::warning('Stripe return refresh failed: '.$e->getMessage());
        }

        if ($trainer->stripe_connect_status === 'connected') {
            return redirect()->route('trainer.stripe.index')
                ->with('success', 'Stripe connected successfully. After you mark a session complete, your payout will be sent automatically.');
        }

        return redirect()->route('trainer.stripe.index')
            ->with('warning', 'Stripe onboarding is not finished yet. Please continue setup so you can receive payouts.');
    }
}
