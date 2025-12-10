<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ============================================
// BOOKING MODULE API ROUTES
// ============================================

// Public API routes for slot availability (used by FullCalendar)
Route::prefix('trainer/{id}')->group(function () {
    Route::get('available-slots', [\App\Http\Controllers\Api\SlotController::class, 'getAvailableSlots']);
    Route::get('calendar-events', [\App\Http\Controllers\Api\SlotController::class, 'getCalendarEvents']);
});

// Booking validation
Route::post('booking/validate-slot', [\App\Http\Controllers\Api\SlotController::class, 'validateSlot']);

// Stripe Webhook (exclude CSRF protection)
Route::post('stripe/webhook', [\App\Http\Controllers\StripeWebhookController::class, 'handle'])
    ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
