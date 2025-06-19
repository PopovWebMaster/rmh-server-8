<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Page\AirApplications\AirApplicationsController;
use App\Http\Controllers\Page\AirApplications\Post\GetStartingDataAirApplicationsController;



Route::get('/company/air-application/{company?}', [ AirApplicationsController::class, 'get' ])->middleware( [ 'auth' ] );

Route::prefix('/air-application')->middleware( [ 'auth' ] )->group(function ($router) {

    Route::post('/get-starting-data/{company?}', [ GetStartingDataAirApplicationsController::class, 'post' ]);

});




?>