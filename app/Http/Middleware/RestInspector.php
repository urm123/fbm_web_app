<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RestInspector
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
        if ((Auth::user()->role !== 'INSPECTOR_1' && Auth::user()->role !== 'INSPECTOR_2') || Auth::user()->status != 'ACTIVE') {
            return response(json_encode(['error' => 'Unauthorised']), 402)
                ->header('Content-Type', 'text/json');
        }
        return $next($request);
    }
}
