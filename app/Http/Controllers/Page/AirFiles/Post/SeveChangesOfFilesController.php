<?php

namespace App\Http\Controllers\Page\AirFiles\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\Page\AirFiles\Traits\SeveChangesOfFilesTraits;
use Auth;

class SeveChangesOfFilesController extends Controller
{
     use SeveChangesOfFilesTraits;

    public function post( Request $request ){

        $user = null;

        if( Auth::check() ){
            $user = Auth::user();
        };

        $result = $this->SeveChangesOfFiles( $request, $user );

        return response()->json( $result, 200, ['Content-Type' => 'application/json; charset=UTF-8'] );

    }
}
