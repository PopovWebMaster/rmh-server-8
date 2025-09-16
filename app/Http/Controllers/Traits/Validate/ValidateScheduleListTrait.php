<?php 

namespace App\Http\Controllers\Traits\Validate;

use Validator;
use Illuminate\Validation\Rule;

trait ValidateScheduleListTrait{

    public function ValidateScheduleList( $list ){

        $result = [
            'fails' => true,
            'message' => '',
        ];

        $validate = Validator::make( [ 
            'list' => $list,

        ], [
            'list' => [ 'required', 'array' ],
            // 'list.*.cutPart' => [ 'nullable', 'numeric' ],
            // 'list.*.dayNum' => [ 'required', 'numeric' ],
            // 'list.*.durationTime' => [ 'required', 'numeric' ],





            // 'array2' => 'present|array',
            // 'array1.*.key1' => 'required|string',
            // 'array1.*.key2' => 'required|integer',
            // 'array2.*.key3' => 'required|string',
            // 'array2.*.key4' => 'required|integer'

        ]);

        if( $validate->fails() ){
            $result[ 'message' ] = $validate->getMessageBag()->all();
        }else{
            $result[ 'fails' ] = false;
        };

        return $result;
        
    }

}

// cutPart
// : 
// null
// dayNum
// : 
// 1
// durationTime
// : 
// 180
// eventId
// : 
// 3
// finalNotes
// : 
// ""
// firstSegmentId
// : 
// null
// gridEventId
// : 
// 429
// id
// : 
// 429
// isKeyPoint
// : 
// true
// is_premiere
// : 
// false
// notes
// : 
// ""
// pushIt
// : 
// null


?>
