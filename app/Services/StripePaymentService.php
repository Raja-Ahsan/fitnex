<?php

namespace App\Services;

use App\Models\Booking;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;
use Illuminate\Support\Facades\Log;
use Exception;

class StripePaymentService
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Create a Stripe Checkout session for a booking.
     * 
     * @param Booking $booking
     * @return StripeSession
     * @throws Exception
     */
    public function createCheckoutSession(Booking $booking): StripeSession
    {
        try {
            $session = StripeSession::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => strtolower($booking->currency),
                            'product_data' => [
                                'name' => 'Training Session with ' . $booking->trainer->name,
                                'description' => 'Session on ' . $booking->timeSlot->formatted_date . ' at ' . $booking->timeSlot->formatted_time,
                            ],
                            'unit_amount' => (int) ($booking->price * 100), // Convert to cents
                        ],
                        'quantity' => 1,
                    ]
                ],
                'mode' => 'payment',
                'success_url' => route('payment.success', ['booking_id' => $booking->id]) . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('payment.cancel', ['booking_id' => $booking->id]),
                'client_reference_id' => (string) $booking->id,
                'metadata' => [
                    'booking_id' => $booking->id,
                    'trainer_id' => $booking->trainer_id,
                    'user_id' => $booking->user_id,
                    'time_slot_id' => $booking->time_slot_id,
                ],
            ]);

            // Save session ID to booking
            $booking->update([
                'stripe_session_id' => $session->id,
            ]);

            Log::info("Stripe checkout session created for booking {$booking->id}: {$session->id}");

            return $session;
        } catch (Exception $e) {
            Log::error("Error creating Stripe checkout session: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Handle Stripe webhook events.
     * 
     * @param string $payload
     * @param string $signature
     * @return array
     * @throws Exception
     */
    public function handleWebhook(string $payload, string $signature): array
    {
        $webhookSecret = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent(
                $payload,
                $signature,
                $webhookSecret
            );
        } catch (SignatureVerificationException $e) {
            Log::error('Stripe webhook signature verification failed: ' . $e->getMessage());
            throw new Exception('Invalid signature');
        }

        Log::info('Stripe webhook received: ' . $event->type);

        switch ($event->type) {
            case 'checkout.session.completed':
                return $this->handleCheckoutSessionCompleted($event->data->object);

            case 'payment_intent.succeeded':
                return $this->handlePaymentIntentSucceeded($event->data->object);

            case 'payment_intent.payment_failed':
                return $this->handlePaymentIntentFailed($event->data->object);

            default:
                Log::info('Unhandled webhook event type: ' . $event->type);
                return ['status' => 'ignored'];
        }
    }

    /**
     * Handle checkout.session.completed event.
     * 
     * @param object $session
     * @return array
     */
    protected function handleCheckoutSessionCompleted($session): array
    {
        $bookingId = $session->metadata->booking_id ?? $session->client_reference_id;

        if (!$bookingId) {
            Log::error('No booking ID found in Stripe session metadata');
            return ['status' => 'error', 'message' => 'No booking ID'];
        }

        try {
            $booking = Booking::findOrFail($bookingId);

            // Update booking status
            $booking->update([
                'payment_status' => 'paid',
                'booking_status' => 'confirmed',
                'stripe_payment_intent' => $session->payment_intent,
                'stripe_session_id' => $session->id,
            ]);

            Log::info("Booking {$bookingId} marked as paid via Stripe webhook");

            return ['status' => 'success', 'booking_id' => $bookingId];
        } catch (Exception $e) {
            Log::error("Error processing checkout.session.completed: " . $e->getMessage());
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    /**
     * Handle payment_intent.succeeded event.
     * 
     * @param object $paymentIntent
     * @return array
     */
    protected function handlePaymentIntentSucceeded($paymentIntent): array
    {
        Log::info("Payment intent succeeded: {$paymentIntent->id}");

        // Additional processing if needed
        return ['status' => 'success'];
    }

    /**
     * Handle payment_intent.payment_failed event.
     * 
     * @param object $paymentIntent
     * @return array
     */
    protected function handlePaymentIntentFailed($paymentIntent): array
    {
        Log::warning("Payment intent failed: {$paymentIntent->id}");

        // Find booking by payment intent and mark as failed
        $booking = Booking::where('stripe_payment_intent', $paymentIntent->id)->first();

        if ($booking) {
            $booking->update([
                'payment_status' => 'failed',
            ]);

            Log::info("Booking {$booking->id} marked as payment failed");
        }

        return ['status' => 'success'];
    }

    /**
     * Create a refund for a cancelled booking.
     * 
     * @param string $paymentIntentId
     * @param float|null $amount
     * @return \Stripe\Refund
     * @throws Exception
     */
    public function createRefund(string $paymentIntentId, float $amount = null)
    {
        try {
            $refundData = ['payment_intent' => $paymentIntentId];

            if ($amount) {
                $refundData['amount'] = (int) ($amount * 100); // Convert to cents
            }

            $refund = \Stripe\Refund::create($refundData);

            Log::info("Refund created for payment intent {$paymentIntentId}: {$refund->id}");

            return $refund;
        } catch (Exception $e) {
            Log::error("Error creating refund: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Retrieve a checkout session by ID.
     * 
     * @param string $sessionId
     * @return StripeSession
     */
    public function retrieveSession(string $sessionId): StripeSession
    {
        return StripeSession::retrieve($sessionId);
    }
}
