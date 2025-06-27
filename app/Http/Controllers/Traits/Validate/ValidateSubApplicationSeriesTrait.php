<?php 

namespace App\Http\Controllers\Traits\Validate;

use Validator;
use Illuminate\Validation\Rule;

trait ValidateSubApplicationSeriesTrait{

    public function ValidateSubApplicationSeries( $params ){

        $result = [
            'fails' => true,
            'message' => '',
        ];

        $applicationId =    $params[ 'applicationId' ];
        $serialNumFrom =    $params[ 'serialNumFrom' ];
        $serialNumTo =      $params[ 'serialNumTo' ];
        $periodFrom =       $params[ 'periodFrom' ];
        $periodTo =         $params[ 'periodTo' ];
        $durationSec =      $params[ 'durationSec' ];
        $airNotes =         $params[ 'airNotes' ];


        $validate = Validator::make( [ 
            'applicationId' =>  $applicationId,
            'serialNumFrom' =>  $serialNumFrom,
            'serialNumTo' =>    $serialNumTo,
            'periodFrom' =>     $periodFrom,
            'periodTo' =>       $periodTo,
            'durationSec' =>    $durationSec,
            'airNotes' =>       $airNotes,

        ], [
            'applicationId' =>  [ 'required', 'exists:application,id' ],
            'serialNumFrom' =>  [ 'required', 'numeric', 'min:1', 'max:1000000' ],
            'serialNumTo' =>    [ 'required', 'numeric', 'min:1', 'max:1000000' ],
            'periodFrom' =>     [ 'required', 'string' ],
            'periodTo' =>       [ 'required', 'string' ],
            'durationSec' =>    [ 'required', 'numeric', 'min:0', 'max:86400' ],
            'airNotes' =>       [ 'nullable', 'string' ],
        ]);

        if( $validate->fails() ){
            $result[ 'message' ] = $validate->getMessageBag()->all();
        }else{
            $result[ 'fails' ] = false;
        };

        return $result;
        
    }

}


?>
