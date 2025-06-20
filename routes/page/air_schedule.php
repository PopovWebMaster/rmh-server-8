<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Page\AirSchedule\AirScheduleController;
use App\Http\Controllers\Page\AirSchedule\Post\GetStartingDataAirScheduleController;


Route::get('/company/{company?}/air-schedule', [ AirScheduleController::class, 'get' ])->middleware( [ 'auth', 'validate.company.get' ] );

Route::prefix('/air-schedule')->middleware( [ 'auth', 'validate.company', 'validate.access.right' ] )->group(function ($router) {

    Route::post('/get-starting-data', [ GetStartingDataAirScheduleController::class, 'post' ]);

});



?>