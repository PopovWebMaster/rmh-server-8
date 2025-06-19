<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Page\AirSchedule\AirScheduleController;
use App\Http\Controllers\Page\AirSchedule\Post\GetStartingDataAirScheduleController;


Route::get('/company/air-schedule/{company?}', [ AirApplicationsController::class, 'get' ])->middleware( [ 'auth' ] );

Route::prefix('/air-schedule')->middleware( [ 'auth' ] )->group(function ($router) {

    Route::post('/get-starting-data/{company?}', [ GetStartingDataAirApplicationsController::class, 'post' ]);

});



?>