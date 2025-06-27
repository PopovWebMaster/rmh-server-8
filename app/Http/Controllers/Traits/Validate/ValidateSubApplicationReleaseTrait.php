<?php 

namespace App\Http\Controllers\Traits\Validate;

use Validator;
use Illuminate\Validation\Rule;

trait ValidateSubApplicationReleaseTrait{

    public function ValidateSubApplicationRelease( $params ){

        $result = [
            'fails' => true,
            'message' => '',
        ];

        $applicationId =    $params[ 'applicationId' ];
        $name =             $params[ 'name' ];
        $periodFrom =       $params[ 'periodFrom' ];
        $periodTo =         $params[ 'periodTo' ];
        $durationSec =      $params[ 'durationSec' ];
        $airNotes =         $params[ 'airNotes' ];

        $validate = Validator::make( [ 
            'applicationId' =>  $applicationId,
            'name' =>           $name,
            'periodFrom' =>     $periodFrom,
            'periodTo' =>       $periodTo,
            'durationSec' =>    $durationSec,
            'airNotes' =>       $airNotes,
        ], [
            'applicationId' =>  [ 'required', 'exists:application,id' ],
            'name' =>           [ 'required', 'string', 'max:255' ],
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
