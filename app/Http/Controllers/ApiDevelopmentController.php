<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use App\Http\Controllers\Page\Home\Traits\GetStartingDataHomeTrait;

class ApiDevelopmentController extends Controller
{

    // use GetStartingDataHomeTrait;

    public function store(Request $request)
    {
        $result = [
            100,
            200
        ];

        // $route = $request['data']['route'];
        
        // // $user = User::find( 1 );

        // $result[ 'user' ] = null;

        // switch( $route ){

        //     case 'home/get-starting-data':
        //         $result = $this->GetStartingDataHome( $request, $user );
        //         break;

        // };

        return response()->json( $result, 200, [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
            'Access-Control-Allow-Headers' => 'Accept,Content-Type,Authorization',
            'Content-Type' => 'application/json; charset=UTF-8'
            
            ] );
                // ->header('Access-Control-Allow-Origin', '*')
                // ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                // ->header('Access-Control-Allow-Headers', 'Accept,Content-Type,Authorization');

    //     ->withHeaders([
    //     'Access-Control-Allow-Origin' => '*',
    //     'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
    //     // 'Access-Control-Allow-Headers' => 'Accept,Content-Type,Authorization',


    //     'Access-Control-Allow-Headers', 'Content-Type, X-Auth-Token, Origin'
    // ]);


    // ->header('Access-Control-Allow-Origin', '*')
    //             ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
    //             ->header('Access-Control-Allow-Headers', 'Accept,Content-Type,Authorization');




            // ->header('Access-Control-Allow-Origin', '*')
            // ->header('Access-Control-Allow-Methods', '*')
            // ->header('Access-Control-Allow-Credentials', true)
            // ->header('Access-Control-Allow-Headers', 'X-Requested-With,Content-Type,X-Token-Auth,Authorization')
            // ->header('Accept', 'application/json');
    }

}
