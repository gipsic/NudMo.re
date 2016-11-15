<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIfUserIsPatientOrPharmacistOrNurseOrStaff
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
        if (Auth::user()->isPatient() === false && Auth::user()->isStaff() === false && Auth::user()->isPharmacist() === false && Auth::user()->isNurse() === false) {
            abort(403);
        }
        return $next($request);
    }
}
