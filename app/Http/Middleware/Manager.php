<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Manager
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
      if (!Auth::check()) {
        return redirect()->route('auth.login');
      } else {
        $user = Auth::user();
        if ($user->hasRole('manager')) {
          return $next($request);// this next function tells Laravel that request is OK and it can continue its jurney
        } else {
          return redirect()->route('home');
        }
      }

    }
}
