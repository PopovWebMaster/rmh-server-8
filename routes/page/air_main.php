<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Page\AirMain\AirMainController;
use App\Http\Controllers\Page\AirMain\Post\GetStartingDataAirMainController;



Route::get('/company/air-main/{company?}', [ AirMainController::class, 'get' ])->middleware( [ 'auth' ] );

Route::prefix('/air-main')->middleware( [ 'auth', 'chackCompany' ] )->group(function ($router) {

    Route::post('/get-starting-data/{company?}', [ GetStartingDataAirMainController::class, 'post' ]);

});



?>