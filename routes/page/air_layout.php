<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Page\AirLayout\AirLayoutController;
use App\Http\Controllers\Page\AirLayout\Post\GetStartingDataAirLayoutController;



Route::get('/company/air-layout/{company?}', [ AirLayoutController::class, 'get' ])->middleware( [ 'auth' ] );

Route::prefix('/air-layout')->middleware( [ 'auth' ] )->group(function ($router) {

    Route::post('/get-starting-data/{company?}', [ GetStartingDataAirLayoutController::class, 'post' ]);

});



?>