<?php

namespace App\Http\Controllers\Page\AirSchedule\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\Page\AirSchedule\Traits\GetScheduleFreeReleaseListTrait;
use Auth;

class GetScheduleFreeReleaseListController extends Controller
{
    use GetScheduleFreeReleaseListTrait;

    public function post( Request $request ){

        $user = null;

        if( Auth::check() ){
            $user = Auth::user();
        };

        $result = $this->GetScheduleFreeReleaseList( $request, $user );

        return response()->json( $result, 200, ['Content-Type' => 'application/json; charset=UTF-8'] );

    }
}
