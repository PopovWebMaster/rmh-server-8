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
use App\Http\Controllers\Page\AirLayout\Post\SaveOneEventDataController;
use App\Http\Controllers\Page\AirLayout\Post\SaveGridEvenListForOneDayController;





Route::get('/company/{company?}/air-layout',                [ AirLayoutController::class, 'get' ])->middleware( [ 'auth', 'validate.company.get' ] );
Route::get('/company/{company?}/air-layout/key-points',     [ AirLayoutController::class, 'get' ])->middleware( [ 'auth', 'validate.company.get' ] );
Route::get('/company/{company?}/air-layout/events',         [ AirLayoutController::class, 'get' ])->middleware( [ 'auth', 'validate.company.get' ] );
Route::get('/company/{company?}/air-layout/categories',     [ AirLayoutController::class, 'get' ])->middleware( [ 'auth', 'validate.company.get' ] );

Route::prefix('/air-layout')->middleware( [ 'auth', 'validate.company', 'validate.access.right' ] )->group(function ($router) {

    Route::post('/get-starting-data',                       [ GetStartingDataAirLayoutController::class, 'post' ]);
    Route::post('/add-new-category',                        [ AddNewCategoryController::class, 'post' ])->middleware( [ 'access.layout_category_add' ] );
    Route::post('/remove-category',                         [ RemoveCategoryController::class, 'post' ])->middleware( [ 'access.layout_category_remove' ] );
    Route::post('/save-category-list',                      [ SaveCategoryListController::class, 'post' ])->middleware( [ 'access.layout_category_edit' ] );
    Route::post('/add-new-event',                           [ AddNewEventController::class, 'post' ])->middleware( [ 'access.layout_event_add' ] );
    Route::post('/save-event-list',                         [ SaveEventListController::class, 'post' ])->middleware( [ 'access.layout_event_edit' ] );
    Route::post('/remove-event',                            [ RemoveEventController::class, 'post' ])->middleware( [ 'access.layout_event_remove' ] );
    Route::post('/save-grid-event-list',                    [ SaveGridEventListController::class, 'post' ]);
    Route::post('/add-new-grid-event',                      [ AddNewGridEventController::class, 'post' ]);
    Route::post('/remove-grid-event',                       [ RemoveGridEventController::class, 'post' ]);
    Route::post('/set-grid-events-day-list-after-cutting',  [ SetGridEventsDayListAfterCuttingController::class, 'post' ]);
    Route::post('/save-one-event-data',                     [ SaveOneEventDataController::class, 'post' ])->middleware( [ 'access.layout_event_edit' ] );
    Route::post('/save-grid-event-list-for-one-day',        [ SaveGridEvenListForOneDayController::class, 'post' ]);


// 'access.layout_event_add'



});



?>