<?php

namespace App\Http\Controllers\Page\Admin\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use  App\Http\Controllers\Page\Admin\Traits\GetStartingDataAdminTrait;

class GetStartingDataAdminController extends Controller
{
    use GetStartingDataAdminTrait;

    public function post( Request $request ){

        $user = null;

        if( Auth::check() ){
            $user = Auth::user();
        };

        $result = $this->GetStartingDataAdmin( $request, $user );

        return response()->json( $result, 200, ['Content-Type' => 'application/json; charset=UTF-8'] );
    //     ->withHeaders([
    //     'Access-Control-Allow-Origin' => '*',
    //     'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
    //     // 'Access-Control-Allow-Headers' => 'Accept,Content-Type,Authorization',


    //     'Access-Control-Allow-Headers', 'Content-Type, X-Auth-Token, Origin'
    // ]);
    }
}
