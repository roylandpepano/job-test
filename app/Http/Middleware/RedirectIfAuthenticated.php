<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Security: Redirect authenticated users away from guest-only routes (e.g., login/register) to prevent access when already logged in.
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->has('user')) {
            return redirect()->route('dashboard');
        }
        return $next($request);
    }
}
