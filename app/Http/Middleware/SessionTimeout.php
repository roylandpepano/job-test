<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SessionTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // Session Management: Set session timeout duration (in seconds)
    protected $timeout = 1800; // 30 minutes

    public function handle(Request $request, Closure $next): Response
    {
        // Security: Invalidate session and force re-login if user is inactive for too long (session timeout)
        if ($request->session()->has('user')) {
            $user      = $request->session()->get('user');
            $last      = $user['last_activity'] ?? time();
            if (time() - $last > $this->timeout) {
                $request->session()->invalidate();
                return redirect()->route('login')->with('error', 'Session expired. Please log in again.');
            }
            // Update last activity timestamp
            $user['last_activity'] = time();
            $request->session()->put('user', $user);
        }

        return $next($request);
    }
}
