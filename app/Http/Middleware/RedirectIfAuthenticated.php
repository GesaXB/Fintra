<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Jika user sudah login, redirect ke dashboard
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Already authenticated',
                        'redirect_url' => url('/dashboard')
                    ], 302);
                }
                
                return redirect('/dashboard');
            }
        }

        return $next($request);
    }
}