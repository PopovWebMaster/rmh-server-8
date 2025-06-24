<?php 

namespace App\Http\Controllers\Traits\Validate;

use Validator;
use Illuminate\Validation\Rule;

trait ValidateNewGridEventTrait{

    public function ValidateNewGridEvent( $params ){

        $result = [
            'fails' => true,
            'message' => '',
        ];

        $gridEventDayNum =          $params[ 'gridEventDayNum' ];
        $gridEventIsAKeyPoint =     $params[ 'gridEventIsAKeyPoint' ];
        $gridEventStartTime =       $params[ 'gridEventStartTime' ];
        $eventId =                  $params[ 'eventId' ];
        $gridEventDurationTime =    $params[ 'gridEventDurationTime' ];



        $validate = Validator::make( [ 
            'gridEventDayNum' =>        $gridEventDayNum,
            'gridEventIsAKeyPoint' =>   $gridEventIsAKeyPoint,
            'gridEventStartTime' =>     $gridEventStartTime,
            'eventId' =>                $eventId,
            'gridEventDurationTime' =>  $gridEventDurationTime,
        ], [
            'gridEventDayNum' =>        [ 'required', 'numeric', Rule::in([ 0, 1, 2, 3, 4, 5, 6 ]), ],
            'gridEventIsAKeyPoint' =>   [ 'required', 'boolean' ],
            'gridEventStartTime' =>     [ 'required', 'numeric', 'min:0', 'max:86400' ],
            'eventId' =>                [ 'required', 'exists:events,id' ],
            'gridEventDurationTime' =>  [ 'required', 'numeric', 'min:0', 'max:86400' ],
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
