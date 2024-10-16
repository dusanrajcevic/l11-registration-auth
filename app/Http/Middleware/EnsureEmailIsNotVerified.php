<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsNotVerified
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && $request->user()->hasVerifiedEmail()) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
