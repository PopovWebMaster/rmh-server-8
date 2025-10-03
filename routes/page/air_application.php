<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Page\AirApplications\AirApplicationsController;
use App\Http\Controllers\Page\AirApplications\Post\GetStartingDataAirApplicationsController;

use App\Http\Controllers\Page\AirApplications\Post\AddNewApplicationController;
use App\Http\Controllers\Page\AirApplications\Post\AddNewSubApplicationReleaseController;
use App\Http\Controllers\Page\AirApplications\Post\AddNewSubApplicationSeriesController;
use App\Http\Controllers\Page\AirApplications\Post\GetApplicationDataController;
use App\Http\Controllers\Page\AirApplications\Post\RemoveApplicationController;
use App\Http\Controllers\Page\AirApplications\Post\RemoveSubApplicationController;
use App\Http\Controllers\Page\AirApplications\Post\SeveApplicationDataController;
use App\Http\Controllers\Page\AirApplications\Post\SaveSubApplicationReleaseController;
use App\Http\Controllers\Page\AirApplications\Post\GetApplicationListForPeriodController;






Route::get('/company/{company?}/air-application', [ AirApplicationsController::class, 'get' ])->middleware( [ 'auth', 'validate.company.get' ] );
Route::get('/company/{company?}/air-application/{applicationId?}', [ AirApplicationsController::class, 'get' ])->middleware( [ 'auth', 'validate.company.get' ] );


Route::prefix('/air-application')->middleware( [ 'auth', 'validate.company', 'validate.access.right' ] )->group(function ($router) {

    Route::post('/get-starting-data', [ GetStartingDataAirApplicationsController::class, 'post' ]);


    Route::post('/add-new-application',             [ AddNewApplicationController::class, 'post' ]);
    Route::post('/get-application-data',            [ GetApplicationDataController::class, 'post' ]);
    Route::post('/seve-application-data',           [ SeveApplicationDataController::class, 'post' ]);
    Route::post('/add-new-subapplication-release',  [ AddNewSubApplicationReleaseController::class, 'post' ]);
    Route::post('/add-new-subapplication-series',   [ AddNewSubApplicationSeriesController::class, 'post' ]);
    Route::post('/remove-sub-application',          [ RemoveSubApplicationController::class, 'post' ]);
    Route::post('/remove-application',              [ RemoveApplicationController::class, 'post' ]);

    Route::post('/save-sub-application-release',    [ SaveSubApplicationReleaseController::class, 'post' ]);
    Route::post('/get_application_list_for_period',    [ GetApplicationListForPeriodController::class, 'post' ]);






});




?>