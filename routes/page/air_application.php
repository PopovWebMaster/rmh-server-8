<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Page\AirApplications\AirApplicationsController;
use App\Http\Controllers\Page\AirApplications\Post\GetStartingDataAirApplicationsController;



Route::get('/company/{company?}/air-application', [ AirApplicationsController::class, 'get' ])->middleware( [ 'auth', 'validate.company.get' ] );

Route::prefix('/air-application')->middleware( [ 'auth', 'validate.company', 'validate.access.right' ] )->group(function ($router) {

    Route::post('/get-starting-data', [ GetStartingDataAirApplicationsController::class, 'post' ]);

});




?>