<?php 

namespace App\Http\Controllers\Traits\Validate;

use Validator;
use Illuminate\Validation\Rule;

trait ValidateGridEventIdTrait{

    public function ValidateGridEventId( $params ){

        $result = [
            'fails' => true,
            'message' => '',
        ];

        $gridEventId = $params[ 'gridEventId' ];

        $validate = Validator::make( [ 
            'gridEventId' => $gridEventId,
        ], [
            'gridEventId' => [ 'required', 'exists:grid_events,id' ],
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
