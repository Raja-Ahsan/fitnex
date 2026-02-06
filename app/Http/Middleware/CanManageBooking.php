<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Booking;

class CanManageBooking
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $bookingId = $request->route('booking');

        if (!$bookingId) {
            return $next($request);
        }

        $booking = Booking::find($bookingId);

        if (!$booking) {
            abort(404, 'Booking not found.');
        }

        $user = auth()->user();

        // Check if user can manage this booking
        // User is the customer
        if ($booking->user_id === $user->id) {
            return $next($request);
        }

        // User is the trainer
        $trainer = $user->trainer;
        if ($trainer && $trainer->id === $booking->trainer_id) {
            return $next($request);
        }

        // User is admin
        if ($user->hasRole('admin')) {
            return $next($request);
        }

        abort(403, 'Unauthorized to manage this booking.');
    }
}
