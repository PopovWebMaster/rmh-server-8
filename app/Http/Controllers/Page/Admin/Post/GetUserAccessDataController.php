<?php

namespace App\Http\Controllers\Page\Admin\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\Page\Admin\Traits\GetUserAccessDataTrait;
use Auth;

class GetUserAccessDataController extends Controller
{
    use GetUserAccessDataTrait;

    public function post( Request $request ){

        $user = null;

        if( Auth::check() ){
            $user = Auth::user();
        };

        $result = [];
        $result = $this->GetUserAccessData( $request, $user );


        return response()->json( $result, 200, ['Content-Type' => 'application/json; charset=UTF-8'] );

    }
}
