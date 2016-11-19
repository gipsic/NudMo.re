<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIfUserIsDoctorOrNurse
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
        if (Auth::user()->isAdministrator() === false && Auth::user()->isStaff() === false && Auth::user()->isDoctor() === false && Auth::user()->isNurse() === false && Auth::user()->isPharmacist() === false) {
            abort(403);
        }
        return $next($request);
    }
}
