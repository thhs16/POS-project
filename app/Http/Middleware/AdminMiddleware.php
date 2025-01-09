<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // when accessing admin routes
        if(Auth::user()->role == 'admin'){
            return $next($request);
        }

        // 404 not found
        // dd('from adminM');
        return back(); //show the current page without going anywhere
        // abort('404');
        // view('404 page');

    }
}
