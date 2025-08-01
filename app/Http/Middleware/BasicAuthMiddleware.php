<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BasicAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if (!str_starts_with($request->path(), 'api/')) {
            return $next($request);
        }

        $username = env('BASIC_AUTH_USERNAME');
        $password = env('BASIC_AUTH_PASSWORD');

        $hasValidAuth = $request->getUser() === $username && $request->getPassword() === $password;
        if (!$hasValidAuth) {
            return response()->json([
                'message' => '401 Unauthorized',
                'statusCode' => 401,
                "status" => false
            ], 401, [
                'WWW-Authenticate' => 'Basic'
            ]);
        }

        return $next($request);


    }
}
