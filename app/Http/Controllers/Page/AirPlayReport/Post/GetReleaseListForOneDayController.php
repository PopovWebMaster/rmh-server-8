<?php

namespace App\Http\Controllers\Page\AirPlayReport\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\Page\AirPlayReport\Traits\GetReleaseListForOneDayTrait;
use Auth;

class GetReleaseListForOneDayController extends Controller
{
    use GetReleaseListForOneDayTrait;

    public function post( Request $request ){

        $user = null;

        if( Auth::check() ){
            $user = Auth::user();
        };

        $result = $this->GetReleaseListForOneDay( $request, $user );

        return response()->json( $result, 200, ['Content-Type' => 'application/json; charset=UTF-8'] );

    }
}
