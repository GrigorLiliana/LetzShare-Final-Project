<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //https://hackernoon.com/laravel-multiple-authentication-80daa855322b

        // if registered AND admin
        if(Auth::check() && auth()->user()->isAdmin === 1)
            return $next($request);
            
        else
            //... ->with('ERROR','You have not admin access'); returns ==> {{ session('ERROR') }}
            return redirect()->route('home')->with('error', 'Restricted area. You have not admin access');
        
    }
}
