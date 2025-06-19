<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Page\AirLogs\AirLogsController;
use App\Http\Controllers\Page\AirLogs\Post\GetStartingDataAirLogsController;


Route::get('/company/air-logs/{company?}', [ AirLogsController::class, 'get' ])->middleware( [ 'auth' ] );

Route::prefix('/air-logs')->middleware( [ 'auth' ] )->group(function ($router) {

    Route::post('/get-starting-data/{company?}', [ GetStartingDataAirLogsController::class, 'post' ]);

});




?>