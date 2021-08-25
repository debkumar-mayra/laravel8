<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'siteUser')
    {
        if (!Auth::guard($guard)->check()) {
            if (!session()->has('url.intended')) {
                session(['url.intended' => url()->previous()]);
            }
            return redirect()->route('login');
        }
        return $next($request);
    }
}
