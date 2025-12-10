<?php

namespace App\Http\Controllers;

use App\Services\StripePaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StripeWebhookController extends Controller
{
    protected $stripeService;

    public function __construct(StripePaymentService $stripeService)
    {
        $this->stripeService = $stripeService;
    }

    /**
     * Handle Stripe webhook events.
     * 
     * POST /stripe/webhook
     */
    public function handle(Request $request)
    {
        $payload = $request->getContent();
        $signature = $request->header('Stripe-Signature');

        try {
            $result = $this->stripeService->handleWebhook($payload, $signature);

            Log::info('Stripe webhook processed successfully', $result);

            return response()->json(['status' => 'success'], 200);
        } catch (\Exception $e) {
            Log::error('Stripe webhook error: ' . $e->getMessage());

            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
