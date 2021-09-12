<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
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
        $user = Auth::user();
        // dd($user);
        if (Auth::check()) {
            if($user->role == 1){
                // dd('admin');
                return redirect(route('makeSale'));
    
            } else {
                // dd('user');
                return redirect(route('home'));

                // return view('home');
            }
            // return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}
