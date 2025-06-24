<?php 

namespace App\Http\Controllers\Traits\Validate;

use Validator;
use Illuminate\Validation\Rule;

use App\Models\Events;

trait ValidateEventIdTrait{

    public function ValidateEventId( $params ){

        $result = [
            'fails' => true,
            'message' => '',
        ];

        $eventId =      $params[ 'eventId' ];
        $companyId =    $params[ 'companyId' ];

        $validate = Validator::make( [ 
            'eventId' => $eventId,
        ], [
            'eventId' => [ 'required', 'exists:events,id' ],
        ]);

        if( $validate->fails() ){
            $result[ 'message' ] = $validate->getMessageBag()->all();
        }else{
            $event = Events::where( 'company_id', '=', $companyId )
                           ->where( 'id', '=', $eventId )
                           ->first();
            if( $event === null ){
                $result[ 'message' ] = 'Компания и событие не совпадают';
            }else{
                $result[ 'fails' ] = false;
            };
        };

        return $result;
        
    }

}


?>
