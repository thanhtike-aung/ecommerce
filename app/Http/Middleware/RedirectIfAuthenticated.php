<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
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
                // Check if the user is an admin and trying to access admin routes
                if (Auth::user()->isAdmin() && $request->is('admin*')) {
                    return redirect('/admin/dashboard');
                }

                // Check if the user is a customer and trying to access customer routes
                if (Auth::user()->isCustomer() && $request->is('customer*')) {
                    return redirect('/customer/dashboard');
                }

                // Default redirect
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
