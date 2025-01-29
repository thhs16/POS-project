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
    public function create()
    {
        // dd('from create function');
        return to_route('userLogin');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

        // dd($request->user()->role == 'admin' | $request->user()->role == 'superAdmin');
        // dd('hello');
        // dd('from store function');
        // dd($request->all());
        $request->authenticate();
        // dd('after authenticate');
        $request->session()->regenerate();

        // dd('to direct the user proper path');

        // default dashboard
        // return redirect()->intended( route('dashboard', absolute: false ));



        if(   in_array($request->user()->role, ['admin', 'superAdmin'])   ){
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
