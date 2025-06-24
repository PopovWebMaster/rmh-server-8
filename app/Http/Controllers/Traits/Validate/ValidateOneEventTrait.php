<?php 

namespace App\Http\Controllers\Traits\Validate;


use Validator;
// use Illuminate\Validation\Rule;

use App\Models\Events;

trait ValidateOneEventTrait{

    public function ValidateOneEvent( $params ){

        $result = [
            'fails' => true,
            'message' => '',
        ];

        $eventName =            $params[ 'eventName' ];
        $eventNotes =           $params[ 'eventNotes' ];
        $eventType =            $params[ 'eventType' ];
        $categoryId =           $params[ 'categoryId' ];
        $eventDurationTime =    $params[ 'eventDurationTime' ];

        $validate = Validator::make( [ 
            'eventName' =>              $eventName,
            'eventNotes' =>             $eventNotes,
            'eventType' =>              $eventType,
            'categoryId' =>             $categoryId,
            'eventDurationTime' =>      $eventDurationTime,
        ], [
            'eventName' =>          Events::RULE[ 'name' ],
            'eventNotes' =>         Events::RULE[ 'notes' ],
            'eventType' =>          Events::RULE[ 'type' ],
            'categoryId' =>         Events::RULE[ 'category_id' ],
            'eventDurationTime' =>  Events::RULE[ 'durationTime' ],
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
