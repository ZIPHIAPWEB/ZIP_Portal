<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class IsSuperadminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $userRole = Auth::user()->getUserRole();

        if ($userRole && $userRole->name !== 'superadmin') {

            return response()->json([
                'message' => 'Unable to proceed!',
                'status' => Response::HTTP_FORBIDDEN
            ], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
