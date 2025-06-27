<?php 

namespace App\Http\Controllers\Traits;

use App\Models\SubApplication;
use App\Models\SubApplicationFileName;
use App\Models\SubApplicationDescription;


trait SetSubApplicationChangesTrait{

    public function SetSubApplicationChanges( $subApplication ){

        $id =               $subApplication['id'];
        $application_id =   $subApplication['application_id'];
        $air_notes =        $subApplication['air_notes'];
        $duration_sec =     $subApplication['duration_sec'];
        $name =             $subApplication['name'];
        $period_from =      $subApplication['period_from'];
        $period_to =        $subApplication['period_to'];
        $serial_num =       $subApplication['serial_num'];
        $type =             $subApplication['type'];



        $file_names = isset( $subApplication['file_names'] )? $subApplication['file_names']: null;

        if( $file_names !== null ){
            for( $i = 0; $i < count( $file_names ); $i++ ){
                $model = SubApplicationFileName::where( 'sub_application_id', '=', $id )
                                               ->where( 'file_name', '=', $file_names[ $i ] )
                                               ->first();

                if( $model === null ){
                    $new_model = new SubApplicationFileName;
                    $new_model->sub_application_id = $id;
                    $new_model->file_name = $file_names[ $i ];
                    $new_model->save();
                };

            };
        };

        $description = isset( $subApplication['description'] )? $subApplication['description']: null;

        if( $description !== null ){
            $model = SubApplicationDescription::where( 'sub_application_id', '=', $id )->first();
            if( $model === null ){
                $new_model = new SubApplicationDescription;
                $new_model->sub_application_id = $id;
                $new_model->description = $description;
                $new_model->save();
            }else{
                $model->description = $description;
                $model->save();
            };
        };


        // $type =             $subApplication['type'];
        // $type =             $subApplication['type'];


        $model = SubApplication::find( $id );
        
        $model->period_from =   $period_from;
        $model->period_to =     $period_to;
        $model->duration_sec =  $duration_sec;
        $model->name =          $name;
        $model->serial_num =    $serial_num;
        $model->air_notes =     $air_notes;

        $model->save();


    }

}


?>


