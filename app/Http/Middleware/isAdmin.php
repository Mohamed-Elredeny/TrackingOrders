<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (Auth::guard('admin')->check()) {
            return $next($request);
        }
        return redirect()->route('auth.login')->withErrors(['msg'=>'Make Sure you have entered your email and password']);
    }
}
