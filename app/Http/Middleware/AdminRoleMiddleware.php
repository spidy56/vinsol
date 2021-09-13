<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class AdminRoleMiddleware
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
        $user = Auth::user();
        // dd(1);
        if(!Auth::check() || $user->role != 1){
            // return redirect(url('/login'));

            return redirect(route('login'));
        }
        return $next($request);
    }
}
