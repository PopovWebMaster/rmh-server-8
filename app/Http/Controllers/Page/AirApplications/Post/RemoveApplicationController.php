<?php

namespace App\Http\Controllers\Page\AirApplications\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\Page\AirApplications\Traits\RemoveApplicationTrait;
use Auth;

class RemoveApplicationController extends Controller
{
    use RemoveApplicationTrait;

    public function post( Request $request ){

        $user = null;

        if( Auth::check() ){
            $user = Auth::user();
        };

        $result = $this->RemoveApplication( $request, $user );

        return response()->json( $result, 200, ['Content-Type' => 'application/json; charset=UTF-8'] );

    }
}
