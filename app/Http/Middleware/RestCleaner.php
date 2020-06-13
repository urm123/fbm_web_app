<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RestCleaner
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
            return response(json_encode(['error' => 'Unauthorised']), 402)
                ->header('Content-Type', 'text/json');
        }

        if (!(Auth::user()->role === 'CLEANER' || Auth::user()->role === 'SUBCONTRACTOR')) {
            return response(json_encode(['error' => 'Unauthorised']), 400)
                ->header('Content-Type', 'text/json');
        }

        return $next($request);
    }
}
