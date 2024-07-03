<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogRequests
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
        // Get request information
        $method = $request->getMethod();
        $url = $request->getUri();
        $ip = $request->getClientIp();
        $requestData = $request->all();

        // Log request data
        Log::info("Request: {$method} {$url}", [
            'ip' => $ip,
            'request_data' => $requestData,
        ]);

        // Handle the request and get the response
        $response = $next($request);

        // Log response status code
        $statusCode = $response->getStatusCode();
        Log::info("Response: {$statusCode} {$method} {$url}", [
            'ip' => $ip,
            'request_data' => $requestData,
        ]);

        return $response;
    }
}
