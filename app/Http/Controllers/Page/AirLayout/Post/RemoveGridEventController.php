<?php

namespace App\Http\Controllers\Page\AirLayout\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\Page\AirLayout\Traits\RemoveGridEventTrait;
use Auth;

class RemoveGridEventController extends Controller
{
    use RemoveGridEventTrait;

    public function post( Request $request ){

        $user = null;

        if( Auth::check() ){
            $user = Auth::user();
        };

        $result = $this->RemoveGridEvent( $request, $user );

        return response()->json( $result, 200, ['Content-Type' => 'application/json; charset=UTF-8'] );

    }
}
