<?php 

namespace App\Http\Controllers\Traits\Validate;

use Validator;
use Illuminate\Validation\Rule;

trait ValidateOneGridEventTrait{

    public function ValidateOneGridEvent( $oneGridEvent, $id_isRequired = true ){

        $result = [
            'fails' => true,
            'message' => '',
        ];

        $dayNum =           isset( $oneGridEvent[ 'dayNum' ] )?         $oneGridEvent[ 'dayNum' ]: null;
        $cutPart =          isset( $oneGridEvent[ 'cutPart' ] )?        $oneGridEvent[ 'cutPart' ]: null;
        $durationTime =     isset( $oneGridEvent[ 'durationTime' ] )?   $oneGridEvent[ 'durationTime' ]: null;
        $eventId =          isset( $oneGridEvent[ 'eventId' ] )?        $oneGridEvent[ 'eventId' ]: null;
        $firstSegmentId =   isset( $oneGridEvent[ 'firstSegmentId' ] )? $oneGridEvent[ 'firstSegmentId' ]: null;
        $id =               isset( $oneGridEvent[ 'id' ] )?             $oneGridEvent[ 'id' ]: null;
        $isKeyPoint =       isset( $oneGridEvent[ 'isKeyPoint' ] )?     $oneGridEvent[ 'isKeyPoint' ]: null;
        $notes =            isset( $oneGridEvent[ 'notes' ] )?          $oneGridEvent[ 'notes' ]: null;
        $pushIt =           isset( $oneGridEvent[ 'pushIt' ] )?         $oneGridEvent[ 'pushIt' ]: null;
        $startTime =        isset( $oneGridEvent[ 'startTime' ] )?      $oneGridEvent[ 'startTime' ]: null;
        $is_premiere =      isset( $oneGridEvent[ 'is_premiere' ] )?    $oneGridEvent[ 'is_premiere' ]: null;


        $id_rule = [];
        if( $id_isRequired ){
            $id_rule = [ 'required', 'numeric', 'exists:grid_events,id' ];
        }else{
            if( $id === null ){
                $id_rule = [ 'nullable' ];
            }else{
                $id_rule = [ 'required', 'numeric', 'exists:grid_events,id' ];
            };
        };

        $validate = Validator::make( [ 
            'dayNum' =>         $dayNum,
            'cutPart' =>        $cutPart,
            'durationTime' =>   $durationTime,
            'eventId' =>        $eventId,
            'firstSegmentId' => $firstSegmentId,
            'id' =>             $id,
            'isKeyPoint' =>     $isKeyPoint,
            'notes' =>          $notes,
            'pushIt' =>         $pushIt,
            'startTime' =>      $startTime,
            'is_premiere' =>     $is_premiere,

        ], [
            'dayNum' =>         [ 'required', 'numeric', Rule::in([ 0, 1, 2, 3, 4, 5, 6 ]) ],
            'cutPart' =>        [ 'nullable', 'numeric', 'max:500' ],
            'durationTime' =>   [ 'required', 'numeric', 'min:0', 'max:86400' ],
            'eventId' =>        [ 'required', 'exists:events,id' ],
            'firstSegmentId' => [ 'nullable', 'exists:grid_events,id' ],
            'id' =>             $id_rule,
            'isKeyPoint' =>     [ 'required', 'boolean' ],
            'notes' =>          [ 'nullable', 'string', 'max:255' ],
            'pushIt' =>         [ 'nullable', 'string', 'max:10' ],
            'startTime' =>      [ 'required', 'numeric', 'min:0', 'max:86400' ],
            'is_premiere' =>     [ 'required', 'boolean' ],

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
