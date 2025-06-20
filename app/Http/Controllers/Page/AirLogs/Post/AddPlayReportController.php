<?php

namespace App\Http\Controllers\Page\AirLogs\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\Page\AirLogs\Traits\AddPlayReportTrait;
use Auth;

class AddPlayReportController extends Controller
{
    use AddPlayReportTrait;

    public function post( Request $request ){

        $user = null;

        if( Auth::check() ){
            $user = Auth::user();
        };

        $result = $this->AddPlayReport( $request, $user );

        return response()->json( $result, 200, ['Content-Type' => 'application/json; charset=UTF-8'] );

    }
}
