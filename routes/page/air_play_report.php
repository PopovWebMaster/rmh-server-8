<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Page\AirPlayReport\AirPlayReportController;
use App\Http\Controllers\Page\AirPlayReport\Post\GetStartingDataAirPlayReportController;


Route::get('/company/air-play-report/{company?}', [ AirPlayReportController::class, 'get' ])->middleware( [ 'auth' ] );

Route::prefix('/air-play-report')->middleware( [ 'auth' ] )->group(function ($router) {

    Route::post('/get-starting-data/{company?}', [ GetStartingDataAirPlayReportController::class, 'post' ]);

});





?>