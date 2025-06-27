<?php 

namespace App\Http\Controllers\Traits\Validate;

use Validator;
use Illuminate\Validation\Rule;

trait ValidateSubApplicationIdTrait{

    public function ValidateSubApplicationId( $subApplicationId ){

        $result = [
            'fails' => true,
            'message' => '',
        ];

        $validate = Validator::make( [ 
            'subApplicationId' => $subApplicationId,
        ], [
            'subApplicationId' => [ 'required', 'exists:sub_application,id' ],
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
