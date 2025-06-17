<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\SiteController;

use Auth;
use Artisan;

class StartGoController extends SiteController
{
     public function __construct(){
        parent::__construct();
        // $this->middleware('auth');
        
    }

    function get( Request $request ){

        // Artisan::call('cache:clear');
        // Artisan::call('config:cache');
        // Artisan::call('view:clear');
        // Artisan::call('route:clear');
        
        // Artisan::call('storage:link');
        // Artisan::call('migrate');
        // Artisan::call('db:seed');

        dd( config( 'app' ) );


        dd( 'start-go' );

    }
}
