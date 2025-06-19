<?php

namespace App\Http\Controllers\Page\AirMain\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\Page\AirMain\Traits\GetStartingDataAirMainTrait;
use Auth;

class GetStartingDataAirMainController extends Controller
{
    use GetStartingDataAirMainTrait;

    public function post( Request $request ){

        $user = null;

        if( Auth::check() ){
            $user = Auth::user();
        };

        $result = $this->GetStartingDataAirMain( $request, $user );
        $result[ 'request_all' ] = $request->all();

        return response()->json( $result, 200, ['Content-Type' => 'application/json; charset=UTF-8'] );

    }
}
