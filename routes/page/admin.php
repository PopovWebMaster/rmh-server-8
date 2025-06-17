<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Page\Admin\AdminController;
use App\Http\Controllers\Page\Admin\Post\GetStartingDataAdminController;


Route::get( '/admin', [ AdminController::class, 'get' ])->name('admin');
Route::post( '/admin/get-starting-data', [ GetStartingDataAdminController::class, 'post' ]);
// Route::resource( '/home/get-starting-data', ApiDevelopmentController::class);


// Route::prefix('/home')->middleware( [ 'web' ] )->group(function ($router) {

//     Route::post('/get-starting-data',    [ 'uses' => 'Post\GetStartingData\GetStartingDataHomeController@post' ]);

// });

// Route::get('/home', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');



?>