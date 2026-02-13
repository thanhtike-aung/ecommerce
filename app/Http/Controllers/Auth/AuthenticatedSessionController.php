<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(Request $request)
    {
        // Determine if this is an admin or customer login request based on the route
        $routeName = $request->route()->getName();

        if ($routeName === 'admin.login') {
            return view('auth.admin.login');
        }

        // Default to customer login - use existing view
        return view('auth.customer.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        // Get the route name to determine which guard to use
        $routeName = $request->route()->getName();
        $guard = 'web';
        $redirectPath = '/';

        // Set guard and redirect path based on route
        if ($routeName === 'admin.login') {
            $guard = 'admin';
            $redirectPath = '/admin/dashboard';

            // Check if user is an admin
            $credentials = $request->only('email', 'password');
            $credentials['role'] = 'admin';

            if (!Auth::guard($guard)->attempt($credentials)) {
                throw ValidationException::withMessages([
                    'email' => __('auth.failed'),
                ]);
            }
        } else if ($routeName === 'customer.login') {
            $guard = 'customer';
            $redirectPath = '/dashboard';

            // Check if user is a customer
            $credentials = $request->only('email', 'password');
            $credentials['role'] = 'customer';

            if (!Auth::guard($guard)->attempt($credentials)) {
                throw ValidationException::withMessages([
                    'email' => __('auth.failed'),
                ]);
            }
        }

        $request->authenticate();
        $request->session()->regenerate();

        // Check if request expects JSON (AJAX)
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'redirect' => redirect()->intended($redirectPath)->getTargetUrl()
            ]);
        }

        return redirect()->intended($redirectPath);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        // Determine the guard based on the route
        $routeName = $request->route()->getName();
        $guard = 'web';
        $redirectPath = '/';

        if ($routeName === 'admin.logout') {
            $guard = 'admin';
            $redirectPath = '/admin/login';
        } else if ($routeName === 'customer.logout') {
            $guard = 'customer';
            $redirectPath = '/customer/login';
        }

        Auth::guard($guard)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect($redirectPath);
    }
}
