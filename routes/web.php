<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StartGoController;

// use App\Http\Controllers\Page\Home\HomeController;


// Route::get( '/', [ HomeController::class, 'get' ]);

Route::get( '/start-go', [ StartGoController::class, 'get' ]);



// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {

    
    return view('dashboard');


})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
