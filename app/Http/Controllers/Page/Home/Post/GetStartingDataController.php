<?php

namespace App\Http\Controllers\Page\Home\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use App\Http\Controllers\Page\Home\Traits\GetStartingDataHomeTrait;

class GetStartingDataController extends Controller
{
    use GetStartingDataHomeTrait;

    public function post( Request $request ){

        $user = null;

        if( Auth::check() ){
            $user = Auth::user();
        };

        $result = $this->GetStartingDataHome( $request, $user );

        return response()->json( $result, 200, ['Content-Type' => 'application/json; charset=UTF-8'] );

    }
}
