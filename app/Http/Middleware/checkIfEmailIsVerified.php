<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class checkIfEmailIsVerified
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
        if (Auth::check()) {
            if (Auth::user()->verified == false) {
                if (Auth::user()->hasRole('superadmin')) {
                    return redirect()->route('dash.superadmin');
                }
                if (Auth::user()->hasRole('admin')) {
                    return redirect()->route('dash.admin');
                }
                if (Auth::user()->hasRole('student')) {
                    return redirect()->route('verify');
                }
                if (Auth::user()->hasRole('coordinator')) {
                    return redirect()->route('not.activated');
                }
                if (Auth::user()->hasRole('sponsor')) {
                    return redirect()->route('verify');
                }
            } elseif(Auth::user()->verified == true) {
                if (Auth::user()->hasRole('superadmin')) {
                    return redirect()->route('dash.superadmin');
                }
                if (Auth::user()->hasRole('admin')) {
                    return redirect()->route('dash.admin');
                }
                if (Auth::user()->hasRole('student')) {
                    if (!Auth::user()->isFilled) {
                        return redirect()->route('register.form');
                    } else {
                        return redirect()->route('dash.student');
                    }
                }
                if (Auth::user()->hasRole('coordinator')) {
                    return redirect()->route('dash.coordinator');
                }
                if (Auth::user()->hasRole('sponsor')) {
                    return redirect()->route('dash.sponsor');
                }
            }
        } else {
            return redirect()->route('login')->withErrors('Please Sign-in First!');
        }

        return $next($request);
    }
}
