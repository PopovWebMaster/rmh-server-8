<?php 

namespace App\Http\Controllers\Page\AirApplications\Traits;

use App\Models\SubApplication;
use App\Models\SubApplicationFileName;
use App\Models\SubApplicationDescription;
use App\Models\SubApplicationRelease;

trait GetSubApplicationListTrait{

    public function GetSubApplicationList( $application_id, $period = null, $onlyReleaseLength = false ){ // $period[ 'from' ] , $period[ 'to' ] || null || \all

        $result = [];

        $subApplications = SubApplication::where( 'application_id', '=', $application_id )->get();

        if( $subApplications !== null ){

            foreach( $subApplications as $model_2 ){

                $sub_application_id = $model_2->id;

                $file_names = [];
                $modelFiles = SubApplicationFileName::where( 'sub_application_id', '=', $sub_application_id )->get();

                foreach( $modelFiles as $model_file ){
                    array_push( $file_names, $model_file->file_name );
                };

                $description = '';
                $modelDescription = SubApplicationDescription::where( 'sub_application_id', '=', $sub_application_id )->first();
                if( $modelDescription !== null ){
                    $description = $modelDescription->description;
                };



                $release_list = [];
                // $modelRelease = SubApplicationRelease::where( 'sub_application_id', '=', $sub_application_id )->get();

                $modelRelease = [];
                $release_list_count = 0;
                if( $period !== null ){
                    // $modelRelease = SubApplicationRelease::where( 'sub_application_id', '=', $sub_application_id )
                    //                                         ->where( 'date', '=', $period[ 'from' ] )
                    //                                         ->where( 'date', '<=', $period[ 'to' ] )
                    //                                         ->get();


                    // $modelRelease = SubApplicationRelease::whereBetween( 'date', [ $period[ 'from' ] , $period[ 'to' ] ])->get();

                    if(  $period === 'all' ){
                        $modelRelease = SubApplicationRelease::where( 'sub_application_id', '=', $sub_application_id )->get();
                    }else{
                        $modelRelease = SubApplicationRelease::where( 'sub_application_id', '=', $sub_application_id )->whereBetween( 'date', [ $period[ 'from' ] , $period[ 'to' ] ])->get();

                    };


                    // $modelRelease = SubApplicationRelease::where( 'sub_application_id', '=', $sub_application_id )->whereBetween( 'date', [ $period[ 'from' ] , $period[ 'to' ] ])->get();


                };

                $release_list_count = count( $modelRelease );

                if( $onlyReleaseLength ){
                    
                }else{
                    foreach( $modelRelease as $model_release ){
                        $file_name = '';
                        if( count( $file_names ) > 0 ){
                            $file_name = $file_names[ count( $file_names ) - 1 ];
                        };
                        array_push( $release_list, [
                            'sub_application_id' => $sub_application_id,
                            'grid_event_id' =>      $model_release->grid_event_id,
                            'date' =>               $model_release->date,
                            'time_sec' =>           $model_release->time_sec,
                            'duration_sec' =>       $model_2->duration_sec,
                            'name' =>               $model_2->name,
                            'file_name' =>          $file_name,
                            'type' =>               $model_2->type,
                        ] );
                    };
                };

                

                array_push( $result, [
                    'id' =>             $sub_application_id,
                    'application_id' => $model_2->application_id,
                    'period_from' =>    $model_2->period_from,
                    'period_to' =>      $model_2->period_to,
                    'duration_sec' =>   $model_2->duration_sec,
                    'name' =>           $model_2->name,
                    'serial_num' =>     $model_2->serial_num,
                    'air_notes' =>      $model_2->air_notes,
                    'type' =>           $model_2->type,

                    'file_names' =>     $file_names,
                    'description' =>    $description,
                    'release_list' =>   $release_list,
                    'release_list_count' => $release_list_count,

                ] );

            };

        };

        return $result;

    }

}


?>

