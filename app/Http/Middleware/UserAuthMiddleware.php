<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('users')->check()) {
            return $next($request);
        }

        if ($request->expectsJson()) {
            return response([
                'status' => 'error',
                'url' => '/car-admin/auth'
            ], 401);
        }

        return redirect()->route('admin-login');
    }
}
