<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsTrainer
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

        // Check if user has trainer role
        if (!auth()->user()->hasRole('trainer') && !auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized. Trainer access required.');
        }

        return $next($request);
    }
}
