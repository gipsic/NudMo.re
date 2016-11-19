<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'patient' => \App\Http\Middleware\CheckIfUserIsPatient::class,
        'doctor' => \App\Http\Middleware\CheckIfUserIsDoctor::class,
        'staff' => \App\Http\Middleware\CheckIfUserIsStaff::class,
        'nurse' => \App\Http\Middleware\CheckIfUserIsNurse::class,
        'pharmacist' => \App\Http\Middleware\CheckIfUserIsPharmacist::class,
        'administrator' => \App\Http\Middleware\CheckIfUserIsAdministrator::class,
        'staffteam' => \App\Http\Middleware\CheckIfUserIsInStaffList::class,
        'staffadmin' => \App\Http\Middleware\CheckIfUserIsStaffOrAdministrator::class,
        'pharmacistadmin' => \App\Http\Middleware\CheckIfUserIsPharmacistOrAdmin::class,
        'pharmacistnursestaff' => \App\Http\Middleware\CheckIfUserIsPharmacistOrNurseOrStaff::class,
        'patientpharmacistnursestaff' => \App\Http\Middleware\CheckIfUserIsPatientOrPharmacistOrNurseOrStaff::class,
        'doctoradministrator' => \App\Http\Middleware\CheckIfUserIsDoctorOrAdministrator::class,
        'doctornurse' => \App\Http\Middleware\CheckIfUserIsDoctorOrNurse::class,
        'activated' => \App\Http\Middleware\CheckIfUserActivated::class,
    ];
}
