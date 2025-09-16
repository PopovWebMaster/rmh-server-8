<?php 

namespace App\Http\Controllers\Traits\Validate;

use Validator;
use Illuminate\Validation\Rule;

trait ValidateYYYYMMDDTrait{

    public function ValidateYYYYMMDD( $YYYY_MM_DD ){

        $result = [
            'fails' => true,
            'message' => '',
        ];

      


        $validate = Validator::make( [ 
            // 'applicationId' =>  $applicationId,
            // 'serialNumFrom' =>  $serialNumFrom,
            // 'serialNumTo' =>    $serialNumTo,
            // 'periodFrom' =>     $periodFrom,
            // 'periodTo' =>       $periodTo,
            // 'durationSec' =>    $durationSec,
            'YYYY_MM_DD' =>       $YYYY_MM_DD,

        ], [
            // 'applicationId' =>  [ 'required', 'exists:application,id' ],
            // 'serialNumFrom' =>  [ 'required', 'numeric', 'min:1', 'max:1000000' ],
            // 'serialNumTo' =>    [ 'required', 'numeric', 'min:1', 'max:1000000' ],
            // 'periodFrom' =>     [ 'required', 'string' ],
            // 'periodTo' =>       [ 'required', 'string' ],
            // 'durationSec' =>    [ 'required', 'numeric', 'min:0', 'max:86400' ],
            // 'airNotes' =>       [ 'nullable', 'string' ],
            // 'airNotes' =>       'required|regex:/^\d{3}-\d{3}-\d{4}$/',
            'YYYY_MM_DD' =>         [ 'required', 'regex:/^\d{4}-\d{2}-\d{2}$/' ],

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
