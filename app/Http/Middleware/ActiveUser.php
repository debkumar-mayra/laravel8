<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;

class ActiveUser
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
    
        if (Auth::check() && Auth::user()->notBlock()) {
          return $next($request);
        }else{
            Session::flush();
            Auth::guard("siteUser")->logout();
           return redirect()->route('login')->with('Info-sweet','Your profile has been blocked by admin');
        }

    }
}
