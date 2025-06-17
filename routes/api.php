<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiDevelopmentController;
use App\Http\Controllers\PhotoController;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



// Route::resource('/', ApiDevelopmentController::class);
// if( !config( 'app.APP_IS_PRODUCTION' ) ){
//     Route::apiResource('/', ApiDevelopmentController::class);
//     // Route::apiResource('/','ApiDevelopmentController'); 
// };

// Route::group([
//     'middleware' => [ 'api' ],
//     'prefix' => '/',
// ], function ($router) {
    
//     if( !config( 'app.APP_IS_PRODUCTION' ) ){
//         // Route::apiResource('/','Api\ApiGetAnyDevelopmentRequests'); 
//         Route::apiResource('/', ApiDevelopmentController::class);
//     };



//     // Route::apiResource('/download/png/0/d','ApiDpwnloadPdfController'); 



// });

Route::group([
    'middleware' => [ 'api' ],
    'prefix' => '/',
], function ($router) {

    Route::apiResource( '', ApiDevelopmentController::class );
    
//    Route::apiResources([
//     '/' => PhotoController::class,
// ]);

});

// Route::apiResource( '/', ApiDevelopmentController::class )->middleware(['api']);





