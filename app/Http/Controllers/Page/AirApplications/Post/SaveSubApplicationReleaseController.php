<?php

namespace App\Http\Controllers\Page\AirApplications\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\Page\AirApplications\Traits\SaveSubApplicationReleaseTrait;
use Auth;

class SaveSubApplicationReleaseController extends Controller
{
    use SaveSubApplicationReleaseTrait;

    public function post( Request $request ){

        $user = null;

        if( Auth::check() ){
            $user = Auth::user();
        };

        $result = $this->SaveSubApplicationRelease( $request, $user );

        return response()->json( $result, 200, ['Content-Type' => 'application/json; charset=UTF-8'] );

    }
}
