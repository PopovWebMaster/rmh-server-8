<?php

namespace App\Http\Controllers\Page\Admin\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use App\Http\Controllers\Page\Admin\Traits\GetCompanyDataTrait;

class GetCompanyDataController extends Controller
{
    use GetCompanyDataTrait;

    public function post( Request $request ){

        $user = null;

        if( Auth::check() ){
            $user = Auth::user();
        };

        $result = $this->GetCompanyData( $request, $user );

        return response()->json( $result, 200, ['Content-Type' => 'application/json; charset=UTF-8'] );

    }
}
