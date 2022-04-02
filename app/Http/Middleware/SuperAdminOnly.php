<?php

namespace App\Http\Middleware;

use Closure;
use Redirect;
use Auth;

class SuperAdminOnly
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
            if (Auth::user()->role=='super_admin') {
                return $next($request);
            } else {
                return response()->json(['status' => 'Fail', 'code' => '400', 'message' => 'You do not have rights to access this location.']);
            }
        }
        return response()->json(['status' => 'Fail', 'code' => '400', 'message' => 'Please login first to access Admin Portal.']);
    }
}
