<?php
/**
 * Created by PhpStorm.
 * User: janaka
 * Date: 5/4/18
 * Time: 10:39 AM
 */

namespace App\Http\Middleware;


use Illuminate\Support\Facades\Log;
use Closure;

class LoggerRequest
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    /**
     * @param $request
     * @param $response
     */
    public function terminate($request, $response)
    {
//        Log::info('app.requests', ['request' => $request->all(), 'url' => $request->url(), 'http' => $request, 'auth' => $request->header('Authorization'), 'response' => $response]);
//        Log::info('app.requests', ['auth' => $request->header('Authorization')]);
//        Log::debug('app.requests', ['request' => $request->all(), 'response' => $response]);
//        Log::notice('app.requests', ['request' => $request->all(), 'response' => $response]);
    }
}