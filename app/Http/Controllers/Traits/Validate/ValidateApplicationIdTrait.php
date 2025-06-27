<?php 

namespace App\Http\Controllers\Traits\Validate;

use Validator;
use Illuminate\Validation\Rule;

trait ValidateApplicationIdTrait{

    public function ValidateApplicationId( $applicationId ){

        $result = [
            'fails' => true,
            'message' => '',
        ];

        $validate = Validator::make( [ 
            'applicationId' => $applicationId,
        ], [
            'applicationId' => [ 'required', 'exists:application,id' ],
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
