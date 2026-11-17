<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Trainer;
use Illuminate\Support\Facades\Log;
use Stripe\Account;
use Stripe\AccountLink;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Stripe\Transfer;
use Throwable;

class StripeConnectService
{
    public function __construct()
    {
        $secret = config('services.stripe.secret');
        if ($secret) {
            Stripe::setApiKey($secret);
        }
    }

    public function isConfigured(): bool
    {
        return !empty(config('services.stripe.secret'));
    }

    /**
     * Countries Fitnex currently expects trainers from.
     */
    public static function supportedCountries(): array
    {
        return [
            'US' => 'United States',
            'GB' => 'United Kingdom',
            'IN' => 'India',
            'PK' => 'Pakistan',
        ];
    }

    public function createExpressAccount(Trainer $trainer, string $country): Account
    {
        $user = $trainer->user;
        $country = strtoupper($country);

        $account = Account::create([
            'type' => 'express',
            'country' => $country,
            'email' => $user?->email,
            'capabilities' => [
                'transfers' => ['requested' => true],
            ],
            'business_type' => 'individual',
            'metadata' => [
                'trainer_id' => (string) $trainer->id,
                'user_id' => (string) ($user?->id ?? ''),
                'platform' => 'fitnex',
            ],
        ]);

        $trainer->update([
            'stripe_account_id' => $account->id,
            'stripe_country' => $country,
            'stripe_connect_status' => 'pending',
            'stripe_charges_enabled' => (bool) ($account->charges_enabled ?? false),
            'stripe_payouts_enabled' => (bool) ($account->payouts_enabled ?? false),
            'stripe_details_submitted' => (bool) ($account->details_submitted ?? false),
        ]);

        return $account;
    }

    public function createOnboardingLink(Trainer $trainer): string
    {
        if (!$trainer->stripe_account_id) {
            throw new \RuntimeException('Trainer does not have a Stripe account yet.');
        }

        $link = AccountLink::create([
            'account' => $trainer->stripe_account_id,
            'refresh_url' => route('trainer.stripe.refresh'),
            'return_url' => route('trainer.stripe.return'),
            'type' => 'account_onboarding',
        ]);

        return $link->url;
    }

    public function createLoginLink(Trainer $trainer): ?string
    {
        if (!$trainer->stripe_account_id) {
            return null;
        }

        try {
            $link = Account::createLoginLink($trainer->stripe_account_id);
            return $link->url;
        } catch (Throwable $e) {
            Log::warning('Stripe login link failed for trainer '.$trainer->id.': '.$e->getMessage());
            return null;
        }
    }

    public function refreshAccountStatus(Trainer $trainer): Trainer
    {
        if (!$trainer->stripe_account_id) {
            $trainer->update(['stripe_connect_status' => 'not_connected']);
            return $trainer->fresh();
        }

        $account = Account::retrieve($trainer->stripe_account_id);
        $connected = (bool) ($account->details_submitted && $account->payouts_enabled);
        $status = $connected
            ? 'connected'
            : ((bool) $account->details_submitted ? 'restricted' : 'pending');

        $trainer->update([
            'stripe_charges_enabled' => (bool) $account->charges_enabled,
            'stripe_payouts_enabled' => (bool) $account->payouts_enabled,
            'stripe_details_submitted' => (bool) $account->details_submitted,
            'stripe_connect_status' => $status,
            'stripe_connected_at' => $connected ? ($trainer->stripe_connected_at ?: now()) : $trainer->stripe_connected_at,
        ]);

        return $trainer->fresh();
    }

    public function trainerCanReceivePayouts(Trainer $trainer): bool
    {
        return $trainer->stripe_connect_status === 'connected'
            && !empty($trainer->stripe_account_id)
            && (bool) $trainer->stripe_payouts_enabled;
    }

    /**
     * Snapshot commission amounts when payment is confirmed (funds held on platform).
     */
    public function markPaymentHeld(Appointment $appointment, ?string $paymentIntentId = null): Appointment
    {
        $percent = StripeConnectSettings::commissionPercent();
        $gross = (float) $appointment->price;
        $commission = round($gross * ($percent / 100), 2);
        $stripeFee = $this->resolveStripeFee($paymentIntentId, $gross);
        $feeBearer = StripeConnectSettings::feeBearer();

        $trainerShare = $feeBearer === 'trainer'
            ? max(0, round($gross - $commission - $stripeFee, 2))
            : max(0, round($gross - $commission, 2));

        $appointment->update([
            'stripe_payment_intent_id' => $paymentIntentId ?: $appointment->stripe_payment_intent_id,
            'platform_commission_percent' => $percent,
            'platform_commission_amount' => $commission,
            'stripe_fee_amount' => $stripeFee,
            'trainer_payout_amount' => $trainerShare,
            'payout_status' => 'held',
            'payout_error' => null,
        ]);

        return $appointment->fresh();
    }

    /**
     * Release trainer payout after session is completed.
     */
    public function releasePayout(Appointment $appointment): Appointment
    {
        $appointment->loadMissing('trainer.user');

        if (in_array($appointment->payout_status, ['transferred', 'manual_paid', 'refunded'], true)) {
            return $appointment;
        }

        if (!in_array($appointment->payment_status, ['completed', 'paid'], true)) {
            $appointment->update([
                'payout_status' => 'failed',
                'payout_error' => 'Payment is not completed, so payout cannot be released.',
            ]);
            return $appointment->fresh();
        }

        if ((float) $appointment->price <= 0) {
            $appointment->update(['payout_status' => 'not_applicable']);
            return $appointment->fresh();
        }

        // Ensure held amounts exist.
        if ($appointment->payout_status === 'not_applicable' || $appointment->trainer_payout_amount === null) {
            $this->markPaymentHeld($appointment, $appointment->stripe_payment_intent_id);
            $appointment->refresh();
        }

        $trainer = $appointment->trainer;
        if (!$trainer || !$this->trainerCanReceivePayouts($trainer)) {
            $appointment->update([
                'payout_status' => 'manual_pending',
                'payout_error' => 'Trainer has not completed Stripe Connect. Pay this trainer manually.',
            ]);
            return $appointment->fresh();
        }

        $amountCents = (int) round(((float) $appointment->trainer_payout_amount) * 100);
        if ($amountCents <= 0) {
            $appointment->update([
                'payout_status' => 'failed',
                'payout_error' => 'Trainer payout amount is zero after commission/fees.',
            ]);
            return $appointment->fresh();
        }

        try {
            $transfer = Transfer::create([
                'amount' => $amountCents,
                'currency' => 'usd',
                'destination' => $trainer->stripe_account_id,
                'transfer_group' => 'appointment_'.$appointment->id,
                'metadata' => [
                    'appointment_id' => (string) $appointment->id,
                    'trainer_id' => (string) $trainer->id,
                    'commission_percent' => (string) $appointment->platform_commission_percent,
                    'commission_amount' => (string) $appointment->platform_commission_amount,
                    'stripe_fee_amount' => (string) $appointment->stripe_fee_amount,
                ],
            ], [
                'idempotency_key' => 'appointment-payout-'.$appointment->id,
            ]);

            $appointment->update([
                'stripe_transfer_id' => $transfer->id,
                'payout_status' => 'transferred',
                'payout_released_at' => now(),
                'payout_error' => null,
            ]);
        } catch (ApiErrorException $e) {
            Log::error('Stripe transfer failed for appointment '.$appointment->id.': '.$e->getMessage());
            $appointment->update([
                'payout_status' => 'manual_pending',
                'payout_error' => $e->getMessage(),
            ]);
        }

        return $appointment->fresh();
    }

    public function markManualPaid(Appointment $appointment): Appointment
    {
        $appointment->update([
            'payout_status' => 'manual_paid',
            'payout_released_at' => now(),
            'payout_error' => null,
        ]);

        return $appointment->fresh();
    }

    public function markRefunded(Appointment $appointment): Appointment
    {
        $appointment->update([
            'payout_status' => 'refunded',
            'payout_error' => null,
        ]);

        return $appointment->fresh();
    }

    protected function resolveStripeFee(?string $paymentIntentId, float $gross): float
    {
        if ($paymentIntentId) {
            try {
                $intent = PaymentIntent::retrieve([
                    'id' => $paymentIntentId,
                    'expand' => ['latest_charge.balance_transaction'],
                ]);

                $bt = $intent->latest_charge->balance_transaction ?? null;
                if (is_object($bt) && isset($bt->fee)) {
                    return round(((int) $bt->fee) / 100, 2);
                }
                if (is_string($bt) && $bt !== '') {
                    $balance = \Stripe\BalanceTransaction::retrieve($bt);
                    return round(((int) $balance->fee) / 100, 2);
                }
            } catch (Throwable $e) {
                Log::warning('Could not read Stripe fee for '.$paymentIntentId.': '.$e->getMessage());
            }
        }

        // Fallback estimate (US card pricing): 2.9% + $0.30
        return round(($gross * 0.029) + 0.30, 2);
    }
}
