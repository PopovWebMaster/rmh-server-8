<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Page\Admin\AdminController;
use App\Http\Controllers\Page\Admin\Post\GetStartingDataAdminController;
use App\Http\Controllers\Page\Admin\Post\AddNewCompanyController;
use App\Http\Controllers\Page\Admin\Post\GetCompanyDataController;
use App\Http\Controllers\Page\Admin\Post\ChangeUserDataController;
use App\Http\Controllers\Page\Admin\Post\RemoveUserController;
use App\Http\Controllers\Page\Admin\Post\RemoveCompanyController;
use App\Http\Controllers\Page\Admin\Post\ChangeCompanyDataController;
use App\Http\Controllers\Page\Admin\Post\AddNewUserController;
use App\Http\Controllers\Page\Admin\Post\GetUserAccessDataController;
use App\Http\Controllers\Page\Admin\Post\SetUserAccessRightsChangesController;



use App\Http\Controllers\Page\Admin\RedirectAllToAdminHomeController;



Route::prefix('/admin')->middleware( [ 'auth', 'validate.access.only.admin' ] )->group(function ($router) {


    Route::get( '/', [ AdminController::class, 'get' ])->name('admin_home');

    Route::get( '/company', [ RedirectAllToAdminHomeController::class, 'get' ]);
    Route::get( '/company/{company_id}', [ RedirectAllToAdminHomeController::class, 'get' ]);


    Route::post( '/get-starting-data',              [ GetStartingDataAdminController::class, 'post' ]);
    Route::post( '/add-new-company',                [ AddNewCompanyController::class, 'post' ]);
    Route::post( '/get-company-data',               [ GetCompanyDataController::class, 'post' ]);
    Route::post( '/change-user-data',               [ ChangeUserDataController::class, 'post' ]);
    Route::post( '/remove-user',                    [ RemoveUserController::class, 'post' ]);
    Route::post( '/remove-company',                 [ RemoveCompanyController::class, 'post' ]);
    Route::post( '/change-company-data',            [ ChangeCompanyDataController::class, 'post' ]);
    Route::post( '/add-new-user',                   [ AddNewUserController::class, 'post' ]);
    Route::post( '/get-user-access-right',          [ GetUserAccessDataController::class, 'post' ]);
    Route::post( '/set-user-access-rights-changes', [ SetUserAccessRightsChangesController::class, 'post' ]);








});



?>