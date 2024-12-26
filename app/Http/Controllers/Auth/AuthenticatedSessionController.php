<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        // dd('from create function');
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // dd('from store function');
        $request->authenticate();

        $request->session()->regenerate();

        // default dashboard
        // return redirect()->intended( route('dashboard', absolute: false ));

        if($request->user()->role == 'admin'){
            return to_route('adminDashboard');
        }

        if($request->user()->role == 'user'){
            return to_route('customerDashboard');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // dd('Redirecting to / ');
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // dd('Redirecting to / ');
        return redirect('/');
    }
}
