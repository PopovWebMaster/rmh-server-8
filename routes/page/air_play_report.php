<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Page\AirPlayReport\AirPlayReportController;
use App\Http\Controllers\Page\AirPlayReport\Post\GetStartingDataAirPlayReportController;;
use App\Http\Controllers\Page\AirPlayReport\Post\GetOneDayPlayReportListController;
use App\Http\Controllers\Page\AirPlayReport\Post\GetEntierListForSearchValueController;


Route::get('/company/{company?}/air-play-report', [ AirPlayReportController::class, 'get' ])->middleware( [ 'auth', 'validate.company.get' ] );

Route::prefix('/air-play-report')->middleware( [ 'auth', 'validate.company', 'validate.access.right' ] )->group(function ($router) {

    Route::post('/get-starting-data', [ GetStartingDataAirPlayReportController::class, 'post' ]);

    Route::post('/get-entier-list-for-search-value', [ GetEntierListForSearchValueController::class, 'post' ]);
    Route::post('/get-one-day-entire-list', [ GetOneDayPlayReportListController::class, 'post' ]);


});





?>