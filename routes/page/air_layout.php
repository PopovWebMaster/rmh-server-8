<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Page\AirLayout\AirLayoutController;
use App\Http\Controllers\Page\AirLayout\Post\GetStartingDataAirLayoutController;
use App\Http\Controllers\Page\AirLayout\Post\SaveCategoryListController;
use App\Http\Controllers\Page\AirLayout\Post\RemoveCategoryController;
use App\Http\Controllers\Page\AirLayout\Post\AddNewCategoryController;
use App\Http\Controllers\Page\AirLayout\Post\AddNewEventController;
use App\Http\Controllers\Page\AirLayout\Post\SaveEventListController;
use App\Http\Controllers\Page\AirLayout\Post\RemoveEventController;
use App\Http\Controllers\Page\AirLayout\Post\SaveGridEventListController;
use App\Http\Controllers\Page\AirLayout\Post\AddNewGridEventController;
use App\Http\Controllers\Page\AirLayout\Post\RemoveGridEventController;
use App\Http\Controllers\Page\AirLayout\Post\SetGridEventsDayListAfterCuttingController;


Route::get('/company/{company?}/air-layout',                [ AirLayoutController::class, 'get' ])->middleware( [ 'auth', 'validate.company.get' ] );
Route::get('/company/{company?}/air-layout/key-points',     [ AirLayoutController::class, 'get' ])->middleware( [ 'auth', 'validate.company.get' ] );
Route::get('/company/{company?}/air-layout/events',         [ AirLayoutController::class, 'get' ])->middleware( [ 'auth', 'validate.company.get' ] );
Route::get('/company/{company?}/air-layout/categories',     [ AirLayoutController::class, 'get' ])->middleware( [ 'auth', 'validate.company.get' ] );

Route::prefix('/air-layout')->middleware( [ 'auth', 'validate.company', 'validate.access.right' ] )->group(function ($router) {

    Route::post('/get-starting-data',                       [ GetStartingDataAirLayoutController::class, 'post' ]);
    Route::post('/add-new-category',                        [ AddNewCategoryController::class, 'post' ]);
    Route::post('/remove-category',                         [ RemoveCategoryController::class, 'post' ]);
    Route::post('/save-category-list',                      [ SaveCategoryListController::class, 'post' ]);
    Route::post('/add-new-event',                           [ AddNewEventController::class, 'post' ]);
    Route::post('/save-event-list',                         [ SaveEventListController::class, 'post' ]);
    Route::post('/remove-event',                            [ RemoveEventController::class, 'post' ]);
    Route::post('/save-grid-event-list',                    [ SaveGridEventListController::class, 'post' ]);
    Route::post('/add-new-grid-event',                      [ AddNewGridEventController::class, 'post' ]);
    Route::post('/remove-grid-event',                       [ RemoveGridEventController::class, 'post' ]);
    Route::post('/set-grid-events-day-list-after-cutting',  [ SetGridEventsDayListAfterCuttingController::class, 'post' ]);








});



?>