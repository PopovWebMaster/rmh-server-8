<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Page\Company\Post\GetStartingDataCompanyController;
use App\Http\Controllers\Page\Company\CompanyController;



Route::get('/company', [ CompanyController::class, 'get' ])->middleware( [ 'auth' ] );
Route::post('/company/get-starting-data', [ GetStartingDataCompanyController::class, 'post' ])->middleware( [ 'auth' ] );




?>