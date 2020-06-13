<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class WebAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->status != 'ACTIVE') {
            Auth::logout();
            return redirect('/login')->withErrors(['errors' => 'Your account is deactivated. Please contact administrator.']);
        }

        if (Auth::user()->role !== 'ADMIN') {
            Auth::logout();
            return redirect('/login')->withErrors(['errors' => 'Please login as administrator']);
        }
        return $next($request);
    }
}
