<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HealthCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle($request, $next) {
        $uuid = $request->header('X-Owner');
        if (!$uuid) return response()->json(['error' => 'Header X-Owner missing'], 403);
        return $next($request);
    }
}
