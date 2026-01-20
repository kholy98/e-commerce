<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OptionalSanctumAuth
{
    /**
     * Handle an incoming request.
     *
     * Attempts Sanctum authentication but allows the request to continue
     * even if authentication fails (for guest users).
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Try to authenticate with Sanctum, but don't fail if it doesn't work
        try {
            // This will attempt to authenticate via Bearer token or session
            Auth::guard('sanctum')->user();
        } catch (\Exception $e) {
            // Authentication failed, but continue with the request
            // The request will proceed as an unauthenticated/guest request
        }

        return $next($request);
    }
}
