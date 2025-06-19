<?php

namespace App\Http\Controllers\Page\AirApplications\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\Page\AirApplications\Traits\GetStartingDataAirApplicationsTrait;
use Auth;

class GetStartingDataAirApplicationsController extends Controller
{
    use GetStartingDataAirApplicationsTrait;

    public function post( Request $request ){

        $user = null;

        if( Auth::check() ){
            $user = Auth::user();
        };

        $result = $this->GetStartingDataCompany( $request, $user );

        return response()->json( $result, 200, ['Content-Type' => 'application/json; charset=UTF-8'] );

    }
}
