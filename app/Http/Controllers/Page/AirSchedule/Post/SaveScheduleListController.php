<?php

namespace App\Http\Controllers\Page\AirSchedule\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\Page\AirSchedule\Traits\SaveScheduleListTrait;
use Auth;

class SaveScheduleListController extends Controller
{
    use SaveScheduleListTrait;

    public function post( Request $request ){

        $user = null;

        if( Auth::check() ){
            $user = Auth::user();
        };

        $result = $this->SaveScheduleList( $request, $user );

        return response()->json( $result, 200, ['Content-Type' => 'application/json; charset=UTF-8'] );

    }
}
