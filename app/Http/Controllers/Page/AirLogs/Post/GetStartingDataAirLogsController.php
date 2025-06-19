<?php

namespace App\Http\Controllers\Page\AirLogs\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\Page\AirLogs\Traits\GetStartingDataAirLogsTrait;
use Auth;

class GetStartingDataAirLogsController extends Controller
{
    use GetStartingDataAirLogsTrait;

    public function post( Request $request ){

        $user = null;

        if( Auth::check() ){
            $user = Auth::user();
        };

        $result = $this->GetStartingDataAirLogs( $request, $user );

        return response()->json( $result, 200, ['Content-Type' => 'application/json; charset=UTF-8'] );

    }
}
