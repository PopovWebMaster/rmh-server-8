<?php 

namespace App\Http\Controllers\Traits\Validate;

use Validator;
use Illuminate\Validation\Rule;

use App\Models\Events;

trait ValidateDayNumTrait{

    public function ValidateDayNum( $params ){

        $result = [
            'fails' => true,
            'message' => '',
        ];

        $dayNum =   $params[ 'dayNum' ];

        $validate = Validator::make( [ 
            'dayNum' => $dayNum,
        ], [
            'dayNum' => [ 'required', 'numeric', Rule::in([ 0, 1, 2, 3, 4, 5, 6 ]), ],
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
