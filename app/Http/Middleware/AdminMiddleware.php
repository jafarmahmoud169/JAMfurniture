<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check()) {
            return response()->json('Unauthorized', 401);
        } elseif (auth()->user()->is_admin) {
            return $next($request);
        } else {
            return response()->json('Forbidden: you are not an admin', 403);
        }
    }
}
