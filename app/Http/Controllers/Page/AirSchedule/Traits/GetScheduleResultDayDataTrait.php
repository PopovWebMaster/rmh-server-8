<?php 

namespace App\Http\Controllers\Page\AirSchedule\Traits;



use Validator;

use App\Models\Company;
use App\Models\Application;
use App\Models\SubApplication;

use App\Models\SubApplicationFileName;
use App\Models\SubApplicationRelease;




trait GetScheduleResultDayDataTrait{


    public function GetScheduleResultDayData( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $companyAlias = $request['data']['companyAlias'];
        $YYYY_MM_DD =   isset( $request['data']['YYYY_MM_DD'] )? $request['data']['YYYY_MM_DD']: null;

        $validate = Validator::make( [ 
            'YYYY_MM_DD' => $YYYY_MM_DD,
        ], [
            'YYYY_MM_DD' => [ 'required', 'string', 'min:10', 'max:10' ],
        ]);

        if( $validate->fails() ){
            $result[ 'message' ] = $validate->getMessageBag()->all();
        }else{
            $result[ 'ok' ] = true;

            $company = Company::where( 'alias', '=', $companyAlias )->first();
            $company_id = $company->id;

            $list = [];

            $application = Application::where( 'company_id', '=', $company_id )->get();

            foreach( $application as $model_application ){
                $application_id = $model_application->id;

                $subApplication = SubApplication::where( 'application_id', '=', $application_id )->get();

                foreach( $subApplication as $model_sub_application ){

                    $sub_application_id = $model_sub_application->id;

                    $file_list = [];

                    $subApplicationFileName = SubApplicationFileName::where( 'sub_application_id', '=', $sub_application_id )->get();
                    foreach( $subApplicationFileName as $file_model ){
                        array_push( $file_list, $file_model->file_name );
                    };

                    $subApplicationRelease = SubApplicationRelease::where( 'sub_application_id', '=', $sub_application_id )
                                                                  ->where( 'date', '=', $YYYY_MM_DD )
                                                                  ->get();

                    foreach( $subApplicationRelease as $release_model ){
                        array_push( $list, [
                            'grid_event_id' =>      $release_model->grid_event_id, 
                            'YYYY_MM_DD' =>         $release_model->date, 
                            'startTime' =>          $release_model->time_sec,

                            'sub_application_id' => $sub_application_id,
                            'releaseName' =>        $model_sub_application->name,
                            'releaseDuration' =>    $model_sub_application->duration_sec,
                            'air_notes' =>          $model_sub_application->air_notes === null? '': $model_sub_application->air_notes,

                            'file_list' =>          $file_list,

                            'application_id' =>     $application_id,
                            'category_id' =>        $model_application->category_id,
                            'manager_id' =>         $model_application->manager_id,
                            'applicationName' =>    $model_application->name,
                            'event_id' =>           $model_application->event_id,

                        ] );
                    };

                };

            };

            $sort_list = usort($list, function($a, $b) {
                $a_val = (int) $a['startTime'];
                $b_val = (int) $b['startTime'];

                if($a_val > $b_val) return 1;
                if($a_val < $b_val) return -1;
                return 0;
            });

            $result[ 'release_list' ] = $list;

        };

        return $result;
        
    }

}


?>

