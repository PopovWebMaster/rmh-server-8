<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Page\AirFiles\AirFilesController;
use App\Http\Controllers\Page\AirFiles\Post\GetStartingDataAirFilesController;
use App\Http\Controllers\Page\AirFiles\Post\CreateNewFilePrefixController;




Route::get('/company/{company?}/air-files', [ AirFilesController::class, 'get' ])->middleware( [ 'auth', 'validate.company.get' ] );

Route::prefix('/air-files')->middleware( [ 'auth', 'validate.company', 'validate.access.right' ] )->group(function ($router) {

    Route::post('/get-starting-data', [ GetStartingDataAirFilesController::class, 'post' ]);
    Route::post('/create-new-file-prefix', [ CreateNewFilePrefixController::class, 'post' ]);




});



?>