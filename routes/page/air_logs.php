<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Page\AirLogs\AirLogsController;
use App\Http\Controllers\Page\AirLogs\Post\GetStartingDataAirLogsController;
use App\Http\Controllers\Page\AirLogs\Post\AddPlayReportController;


Route::get('/company/{company?}/air-logs', [ AirLogsController::class, 'get' ])->middleware( [ 'auth', 'validate.company.get' ] );

Route::prefix('/air-logs')->middleware( [ 'auth', 'validate.company', 'validate.access.right' ] )->group(function ($router) {

    Route::post('/get-starting-data', [ GetStartingDataAirLogsController::class, 'post' ]);
    Route::post('/add-play-report', [ AddPlayReportController::class, 'post' ]);


});




?>