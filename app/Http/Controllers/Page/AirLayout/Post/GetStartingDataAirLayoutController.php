<?php

namespace App\Http\Controllers\Page\AirLayout\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\Page\AirLayout\Traits\GetStartingDataAirLayoutTrait;
use Auth;

class GetStartingDataAirLayoutController extends Controller
{
    use GetStartingDataAirLayoutTrait;

    public function post( Request $request ){

        $user = null;

        if( Auth::check() ){
            $user = Auth::user();
        };

        $result = $this->GetStartingDataAirLayout( $request, $user );

        return response()->json( $result, 200, ['Content-Type' => 'application/json; charset=UTF-8'] );

    }
}
