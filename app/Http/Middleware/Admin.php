<?php

namespace App\Http\Middleware;

use Closure;

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

        if(auth()->user()->isAdmin === 1){
            return $next($request);
        }
        
        return redirect('home')->with('error','You have not admin access');

    }
}
