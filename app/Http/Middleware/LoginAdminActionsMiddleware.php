<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
class LoginAdminActionsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($request->user() && $request->user()->role === 'admin') {
            Log::info('Admin Action', [
                'user_id' => $request->user()->id,
                'route' => $request->path(),
                'method' => $request->method(),
                'ip' => $request->ip(),
            ]);
        }

        return $response;
    }
}
