<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(Auth::guard($guard)->check()){
            if ($guard == "admin"){
                return redirect(route('admin_dashboard.show'));
            }
            if ($guard == "health_institution"){
                return redirect(route('institution_dashboard.show'));
            }
        }

        return $next($request);
    }
}
