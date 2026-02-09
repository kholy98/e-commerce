<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class SessionTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Workaround for Safari ITP blocking third-party cookies.
     * Reads session ID from X-Session-Token header and restores session.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check for X-Session-Token header (Safari workaround)
        if ($request->hasHeader('X-Session-Token')) {
            $sessionId = $request->header('X-Session-Token');

            // Validate session ID format (Laravel uses 40-char alphanumeric)
            if (preg_match('/^[a-zA-Z0-9]{40}$/', $sessionId)) {
                session()->setId($sessionId);
                session()->start();
            }
        }
        $response = $next($request);
        // Always return current session ID in response header
        $response->headers->set('X-Session-Token', session()->getId());
        return $response;
    }
}
