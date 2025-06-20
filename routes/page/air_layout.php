<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Page\AirLayout\AirLayoutController;
use App\Http\Controllers\Page\AirLayout\Post\GetStartingDataAirLayoutController;



Route::get('/company/{company?}/air-layout', [ AirLayoutController::class, 'get' ])->middleware( [ 'auth', 'validate.company.get' ] );

Route::prefix('/air-layout')->middleware( [ 'auth', 'validate.company', 'validate.access.right' ] )->group(function ($router) {

    Route::post('/get-starting-data', [ GetStartingDataAirLayoutController::class, 'post' ]);

});



?>