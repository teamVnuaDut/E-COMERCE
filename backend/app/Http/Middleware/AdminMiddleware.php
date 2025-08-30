<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //check if admin
        if (!Auth::check()) {
            return redirect()->route('show.login')->with('error', 'You must be logged in to access this page.');
        }

        if (Auth::user()->role !== 'admin') {
            abort(403, 'You do not have permission to access this page.');
        }

        if (Auth::check()) {
            \Log::info('Admin access', [
                'user_id' => Auth::id(),
                'email' => Auth::user()->email,
                'ip' => $request->ip(),
                'url' => $request->fullUrl(),
                'time' => now()->toDateTimeString()
            ]);
        }
        return $next($request);
    }
}
