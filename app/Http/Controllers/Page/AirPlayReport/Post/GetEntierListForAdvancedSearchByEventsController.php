<?php

namespace App\Http\Controllers\Page\AirPlayReport\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\Page\AirPlayReport\Traits\GetEntierListForAdvancedSearchByEventsTrait;
use Auth;

class GetEntierListForAdvancedSearchByEventsController extends Controller
{
    use GetEntierListForAdvancedSearchByEventsTrait;

    public function post( Request $request ){

        $user = null;

        if( Auth::check() ){
            $user = Auth::user();
        };

        $result = $this->GetEntierListForAdvancedSearchByEvents( $request, $user );

        return response()->json( $result, 200, ['Content-Type' => 'application/json; charset=UTF-8'] );

    }
}
