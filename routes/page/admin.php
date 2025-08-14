<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Page\Admin\AdminController;
use App\Http\Controllers\Page\Admin\Post\GetStartingDataAdminController;
use App\Http\Controllers\Page\Admin\Post\AddNewCompanyController;


use App\Http\Controllers\Page\Admin\RedirectAllToAdminHomeController;



Route::prefix('/admin')->middleware( [ 'auth', 'validate.access.only.admin' ] )->group(function ($router) {


    Route::get( '/', [ AdminController::class, 'get' ])->name('admin_home');

    Route::get( '/company', [ RedirectAllToAdminHomeController::class, 'get' ]);

    Route::post( '/get-starting-data', [ GetStartingDataAdminController::class, 'post' ]);
    Route::post( '/add-new-company', [ AddNewCompanyController::class, 'post' ]);





});



?>