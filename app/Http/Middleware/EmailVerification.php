<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;

class EmailVerification
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
    // dd(Auth::user()->emailVerification());
    if (Auth::check() && Auth::user()->emailVerification()) {
      // echo 'string'; exit;
      return $next($request);
    } else {
      Session::flush();
      Auth::guard("siteUser")->logout();
      return redirect()->route('login')->with('Warning-sweet', 'Your email not verified');
    }
  }
}
