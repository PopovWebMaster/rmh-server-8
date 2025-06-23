<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Page\AirLayout\AirLayoutController;
use App\Http\Controllers\Page\AirLayout\Post\GetStartingDataAirLayoutController;
use App\Http\Controllers\Page\AirLayout\Post\SaveCategoryListController;
use App\Http\Controllers\Page\AirLayout\Post\RemoveCategoryController;
use App\Http\Controllers\Page\AirLayout\Post\AddNewCategoryController;




Route::get('/company/{company?}/air-layout', [ AirLayoutController::class, 'get' ])->middleware( [ 'auth', 'validate.company.get' ] );

Route::prefix('/air-layout')->middleware( [ 'auth', 'validate.company', 'validate.access.right' ] )->group(function ($router) {

    Route::post('/get-starting-data', [ GetStartingDataAirLayoutController::class, 'post' ]);


    Route::post('/add-new-category', [ AddNewCategoryController::class, 'post' ]);
    Route::post('/remove-category', [ RemoveCategoryController::class, 'post' ]);
    Route::post('/save-category-list', [ SaveCategoryListController::class, 'post' ]);


});



?>