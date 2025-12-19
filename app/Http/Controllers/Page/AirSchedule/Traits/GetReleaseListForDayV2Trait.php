<?php 

namespace App\Http\Controllers\Page\AirSchedule\Traits;



use Validator;

use App\Models\Company;
use App\Models\Application;
use App\Models\SubApplication;

use App\Models\SubApplicationFileName;
use App\Models\SubApplicationRelease;

trait GetReleaseListForDayV2Trait{

    public function GetReleaseListForDayV2( $companyAlias, $YYYY_MM_DD ){

        $company = Company::where( 'alias', '=', $companyAlias )->first();
        $company_id = $company->id;

        $list = [];

        $application = Application::where( 'company_id', '=', $company_id )->get();

        $YYYY_MM_DD_sec = strtotime( $YYYY_MM_DD );

        $valid_sub_application_list = [];

        foreach( $application as $model_application ){
            $application_id = $model_application->id;
            $subApplication = SubApplication::where( 'application_id', '=', $application_id )->get();

            foreach( $subApplication as $model_sub_application ){
                $from_sec = strtotime( $model_sub_application->period_from );
                $to_sec = strtotime( $model_sub_application->period_to );
                if( $from_sec <= $YYYY_MM_DD_sec && $to_sec >= $YYYY_MM_DD_sec ){
                    $sub_application_id = $model_sub_application->id;
                    $valid_sub_application_list[ $sub_application_id ] = [
                        'releases' => [],
                        'file_list' => [],

                        'sub_application_id' => $sub_application_id,
                        'releaseName' =>        $model_sub_application->name,
                        'releaseDuration' =>    $model_sub_application->duration_sec,
                        'air_notes' =>          $model_sub_application->air_notes === null? '': $model_sub_application->air_notes,
                        'application_id' =>     $application_id,
                        'category_id' =>        $model_application->category_id,
                        'manager_id' =>         $model_application->manager_id,
                        'applicationName' =>    $model_application->name,
                        'event_id' =>           $model_application->event_id,
                        'force_event_id' =>     $model_application->force_event_id,
                    ];
                };


            };
        };

        $releases = [];
        $fileNames = [];

        foreach( $valid_sub_application_list as $sub_application_id => $value ){

            $subApplicationRelease = SubApplicationRelease::where( 'sub_application_id', '=', $sub_application_id )
                                                          ->where( 'date', '=', $YYYY_MM_DD )
                                                          ->get();


            foreach( $subApplicationRelease as $release_model ){

                $file_list = [];

                if( isset( $fileNames[ $sub_application_id ] ) ){
                    $file_list = $fileNames[ $sub_application_id ];
                }else{
                    $subApplicationFileName = SubApplicationFileName::where( 'sub_application_id', '=', $sub_application_id )->get();
                    foreach( $subApplicationFileName as $file_model ){
                        array_push( $file_list, $file_model->file_name );
                    };
                    $fileNames[ $sub_application_id ] = $file_list;
                };

                array_push( $releases, [

                    'id' =>                 $release_model->id,
                    'grid_event_id' =>      $release_model->grid_event_id, 
                    'YYYY_MM_DD' =>         $release_model->date, 
                    'startTime' =>          $release_model->time_sec,
                    'file_list' =>          $file_list,

                    'sub_application_id' => $valid_sub_application_list[ $sub_application_id ][ 'sub_application_id' ],
                    'releaseName' =>        $valid_sub_application_list[ $sub_application_id ][ 'releaseName' ],
                    'releaseDuration' =>    $valid_sub_application_list[ $sub_application_id ][ 'releaseDuration' ],
                    'air_notes' =>          $valid_sub_application_list[ $sub_application_id ][ 'air_notes' ],

                    'application_id' =>     $valid_sub_application_list[ $sub_application_id ][ 'application_id' ],
                    'category_id' =>        $valid_sub_application_list[ $sub_application_id ][ 'category_id' ],
                    'manager_id' =>         $valid_sub_application_list[ $sub_application_id ][ 'manager_id' ],
                    'applicationName' =>    $valid_sub_application_list[ $sub_application_id ][ 'applicationName' ],
                    'event_id' =>           $valid_sub_application_list[ $sub_application_id ][ 'event_id' ],
                    'force_event_id' =>     $valid_sub_application_list[ $sub_application_id ][ 'force_event_id' ],

                ] );
            };

        };

        $sort_list = usort($releases, function($a, $b) {
            $a_val = (int) $a['startTime'];
            $b_val = (int) $b['startTime'];

            if($a_val > $b_val) return 1;
            if($a_val < $b_val) return -1;
            return 0;
        });

        return $releases;

        
    }

}


?>

