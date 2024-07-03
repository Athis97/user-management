<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LimitContentLength
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (strlen($request->getContent()) > 1024 * 1024) { // 1 MB limit
            return response()->json(['message' => 'Payload too large'], 413);
        }
        return $next($request);
    }
}
