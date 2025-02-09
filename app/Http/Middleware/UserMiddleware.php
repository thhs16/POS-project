<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // when accessing user routes
        // dd('from userR');
        // if(!empty( Auth::user() )){

            if(Auth::user()->role == 'user'){
                // if($request->route()->getName() == 'userRegister' || $request->route()->getName() =='userLogin'){
                //     abort(404);
                // };

                return $next($request);
            }
        // }

        // dd('from userM');
        return back();

    }
}
