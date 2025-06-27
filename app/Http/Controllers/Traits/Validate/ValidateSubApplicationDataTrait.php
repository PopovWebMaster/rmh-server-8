<?php 

namespace App\Http\Controllers\Traits\Validate;


use Validator;
use Illuminate\Validation\Rule;

use App\Models\SubApplication;
// use App\Models\SubApplicationDescription;
// use App\Models\SubApplicationFileName;
// use App\Models\SubApplicationRelease;


trait ValidateSubApplicationDataTrait{


    public function ValidateSubApplicationData( $subApplication ){

        $result = [
            'fails' => true,
            'message' => '',
        ];

        $id =               $subApplication['id'];
        $application_id =   $subApplication['application_id'];
        $air_notes =        $subApplication['air_notes'];
        $duration_sec =     $subApplication['duration_sec'];
        $name =             $subApplication['name'];
        $period_from =      $subApplication['period_from'];
        $period_to =        $subApplication['period_to'];
        $serial_num =       $subApplication['serial_num'];
        $type =             $subApplication['type'];

        $serial_num_rule = [];
        if( $type === 'series' ){
            $serial_num_rule = SubApplication::RULE[ 'serial_num_for_series' ];
        }else if( $type === 'release' ){
            $serial_num_rule = SubApplication::RULE[ 'serial_num_for_release' ];
        };

        $validate = Validator::make( [ 
            'id' =>             $id,
            'application_id' => $application_id,
            'air_notes' =>      $air_notes,
            'duration_sec' =>   $duration_sec,
            'name' =>           $name,
            'period_from' =>    $period_from,
            'period_to' =>      $period_to,
            'serial_num' =>     $serial_num,
            'type' =>           $type,

        ], [
            'application_id' => SubApplication::RULE[ 'application_id' ],

            'id' =>             SubApplication::RULE[ 'id' ],
            'air_notes' =>      SubApplication::RULE[ 'air_notes' ],
            'duration_sec' =>   SubApplication::RULE[ 'duration_sec' ],
            'name' =>           SubApplication::RULE[ 'name' ],
            'period_from' =>    SubApplication::RULE[ 'period_from' ],
            'period_to' =>      SubApplication::RULE[ 'period_to' ],
            'serial_num' =>     $serial_num_rule,
            'type' =>           SubApplication::RULE[ 'type' ],

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
