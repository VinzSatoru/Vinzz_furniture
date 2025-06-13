<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->role !== 'customer') {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized. Only customers can access this resource.'], 403);
            }
            return redirect()->route('home')->with('error', 'Unauthorized. Only customers can access this resource.');
        }

        return $next($request);
    }
} 