<?php

namespace App\Http\Controllers\Page\Login\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\Page\Login\Traits\GetStartingDataLoginTrait;
use Auth;

class GetStartingDataLoginController extends Controller
{
    use GetStartingDataLoginTrait;

    public function post( Request $request ){

        $user = null;

        $result = [];

        if( Auth::check() ){
            $user = Auth::user();
            $result['ok'] = false;
            $result['message'] = 'юзерам нельзя сюда';
        }else{
            $result = $this->GetStartingDataLogin( $request, null );
        };

        return response()->json( $result, 200, ['Content-Type' => 'application/json; charset=UTF-8'] );
    }
}
