<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Page\AirMain\AirMainController;
use App\Http\Controllers\Page\AirMain\Post\GetStartingDataAirMainController;



Route::get('/company/{company?}/air-main', [ AirMainController::class, 'get' ])->middleware( [ 'auth', 'validate.company.get' ] )->name( 'air_main' );

Route::prefix('/air-main')->middleware( [ 'auth', 'validate.company', 'validate.access.right' ] )->group(function ($router) {

    Route::post('/get-starting-data', [ GetStartingDataAirMainController::class, 'post' ]);

});



?>