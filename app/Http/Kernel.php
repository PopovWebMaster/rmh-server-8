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
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        // \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,

        //  \App\Http\Middleware\AddMyHeaders::class,
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
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            // \App\Http\Middleware\AddMyHeaders::class,
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
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,


        'validate.company' => \App\Http\Middleware\ValidateCompany::class,
        'validate.company.get' => \App\Http\Middleware\ValidateCompanyGet::class,
        'validate.access.right' => \App\Http\Middleware\ValidateAccessRight::class,
        'validate.access.only.admin' => \App\Http\Middleware\ValidateAccessRightOnlyAdmin::class,


        // 'access.layout_remove_event' => \App\Http\Middleware\AccessRights\LayoutRemoveEvent::class,
        'access.layout_event_remove' => \App\Http\Middleware\AccessRights\LayoutEventRemove::class,
        'access.layout_event_edit' => \App\Http\Middleware\AccessRights\LayoutEventEdit::class,
        'access.layout_event_add' => \App\Http\Middleware\AccessRights\LayoutEventAdd::class,

        'access.layout_category_add' => \App\Http\Middleware\AccessRights\LayoutCategoryAdd::class,
        'access.layout_category_edit' => \App\Http\Middleware\AccessRights\LayoutCategoryEdit::class,
        'access.layout_category_remove' => \App\Http\Middleware\AccessRights\LayoutCategoryRemove::class,
        'access.layout_grid_edit' => \App\Http\Middleware\AccessRights\LayoutGridEdit::class,


        'access.schedule_create_new' => \App\Http\Middleware\AccessRights\ScheduleCreateNew::class,
        'access.schedule_remove' => \App\Http\Middleware\AccessRights\ScheduleRemove::class,
        'access.schedule_edit' => \App\Http\Middleware\AccessRights\ScheduleEdit::class,



 

    ];
}
