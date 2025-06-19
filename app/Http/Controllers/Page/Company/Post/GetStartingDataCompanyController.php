<?php

namespace App\Http\Controllers\Page\Company\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\Page\Company\Traits\GetStartingDataCompanyTrait;
use Auth;

class GetStartingDataCompanyController extends Controller
{
    use GetStartingDataCompanyTrait;

    public function post( Request $request ){

        $user = null;

        if( Auth::check() ){
            $user = Auth::user();
        };

        $result = $this->GetStartingDataCompany( $request, $user );

        return response()->json( $result, 200, ['Content-Type' => 'application/json; charset=UTF-8'] );

    }
}
