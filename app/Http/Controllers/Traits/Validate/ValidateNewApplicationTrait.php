<?php 

namespace App\Http\Controllers\Traits\Validate;

use Validator;
use Illuminate\Validation\Rule;

trait ValidateNewApplicationTrait{

    public function ValidateNewApplication( $params ){

        $result = [
            'fails' => true,
            'message' => '',
        ];

        $applicationName =          $params[ 'applicationName' ];
        $applicationNum =           $params[ 'applicationNum' ];
        $applicationCategoryId =    $params[ 'applicationCategoryId' ];
        $applicationManagerNotes =  $params[ 'applicationManagerNotes' ];
        $applicationEventId =  $params[ 'applicationEventId' ];


        

        $validate = Validator::make( [ 
            'applicationName' =>            $applicationName,
            'applicationNum' =>             $applicationNum,
            'applicationCategoryId' =>      $applicationCategoryId,
            'applicationManagerNotes' =>    $applicationManagerNotes,
            'applicationEventId' =>    $applicationEventId,


        ], [
            'applicationName' =>            [ 'required', 'string', 'min:1', 'max:255' ],
            'applicationNum' =>             [ 'nullable', 'numeric', 'min:0', 'max:1000000' ],
            'applicationCategoryId' =>      [ 'nullable', 'exists:category,id' ],
            'applicationManagerNotes' =>    [ 'nullable', 'string', ],
            'applicationEventId' =>         [ 'nullable', 'exists:events,id' ],

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
