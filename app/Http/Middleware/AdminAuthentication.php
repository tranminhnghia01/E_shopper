<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuthentication 
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next)
    {
        if( Auth::check() && Auth::user()->level == 1 ){
            return $next($request);
        }else{
            if (Auth::check() && Auth::user()->level == 0) {
                return redirect()->route('home.home');
            }
            Auth::logout();
            return redirect('/login');
        }
    }
}
