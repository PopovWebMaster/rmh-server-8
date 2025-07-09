<?php 

namespace App\Http\Controllers\Page\AirApplications\Traits;


use App\Models\SubApplication;
// use App\Models\SubApplicationFileName;
// use App\Models\SubApplicationDescription;

use App\Models\Company;
use App\Models\Application;
use App\Models\SubApplicationRelease;


use App\Http\Controllers\Page\AirApplications\Traits\GetOneApplicationDataTrait;
use App\Http\Controllers\Traits\GetApplicationListTrait;


use Validator;


trait SaveSubApplicationReleaseTrait{

    use GetOneApplicationDataTrait;
    use GetApplicationListTrait;

    public function SaveSubApplicationRelease( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $companyAlias = $request['data']['companyAlias'];

        $applicationId =    isset( $request['data']['application_id'] )?        $request['data']['application_id']: null;
        $subApplicationId = isset( $request['data']['sub_application_id'] )?    $request['data']['sub_application_id']: null;
        $releaseList =      isset( $request['data']['release_list'] )?          $request['data']['release_list']: null;


        $validate = Validator::make( [ 
            'applicationId' =>      $applicationId,
            'subApplicationId' =>   $subApplicationId,
            'releaseList' =>        $releaseList,
        ], [
            'applicationId' =>                  [ 'required', 'exists:application,id' ],
            'subApplicationId' =>               [ 'required', 'exists:sub_application,id' ],
            'releaseList.*.grid_event_id' =>    [ 'nullable', 'exists:grid_events,id'],
            'releaseList.*.date' =>             [ 'required', 'string' ],
            'releaseList.*.time_sec' =>         [ 'required', 'numeric', 'min:0', 'max:86400' ],
        ]);

        if( $validate->fails() ){
            $result[ 'message' ] = $validate->getMessageBag()->all();
        }else{
            $result[ 'ok' ] = true;

            $company = Company::where( 'alias', '=', $companyAlias )->first();
            $company_id = $company->id;

            $application = Application::where( 'company_id', '=', $company_id )->where( 'id', '=', $applicationId )->first();

            if( $application === null ){
                $result[ 'message' ] = 'У вас прав доступа к заявкам этой компании.';
            }else{
                

                $subApplication = SubApplication::where( 'application_id', '=', $applicationId )->where( 'id', '=', $subApplicationId )->first();

                if( $subApplication === null ){
                    $result[ 'message' ] = 'Подзаявка не имеет отношения к заявке';
                }else{

                    $result[ 'ok' ] = true;
                    $subApplicationReleaseList = SubApplicationRelease::where( 'sub_application_id', '=', $subApplicationId )->get();

                    if( count( $subApplicationReleaseList ) > 0 ){
                        $subApplicationReleaseList->map->delete();
                    };

                    for( $i = 0; $i < count( $releaseList ); $i++ ){

                        $grid_event_id =    $releaseList[ $i ][ 'grid_event_id' ];
                        $date =             $releaseList[ $i ][ 'date' ];
                        $time_sec =         $releaseList[ $i ][ 'time_sec' ];

                        $subApplicationRelease = new SubApplicationRelease;
                        $subApplicationRelease->sub_application_id =    $subApplicationId;
                        $subApplicationRelease->grid_event_id =         $grid_event_id;
                        $subApplicationRelease->date =                  $date;
                        $subApplicationRelease->time_sec =              $time_sec;
                        $subApplicationRelease->save();
                    };


                };

                $result[ 'application' ] = $this->GetOneApplicationData( $applicationId );
                $result[ 'applicationList' ] = $this->GetApplicationList( $companyAlias );

            };



        };


















        // $validateApp = $this->ValidateApplicationData([
        //     'applicationId' =>              $applicationId,
        //     'applicationName' =>            $applicationName,
        //     'applicationCategoryId' =>      $applicationCategoryId,
        //     'applicationNum' =>             $applicationNum,
        //     'applicationManagerNotes' =>    $applicationManagerNotes,
        // ]);

        // if( $validateApp[ 'fails' ] ){
        //     $result[ 'message' ] = $validateApp[ 'message' ];
        // }else{
        //     $company = Company::where( 'alias', '=', $companyAlias )->first();
        //     $company_id = $company->id;

        //     $application = Application::where( 'company_id', '=', $company_id )->where( 'id', '=', $applicationId )->first();

        //     if( $application === null ){
        //         $result[ 'message' ] = 'У вас прав доступа к заявкам этой компании.';
        //     }else{

        //         $result[ 'ok' ] = true;

        //         $application->category_id =     $applicationCategoryId;
        //         $application->name =            $applicationName;
        //         $application->num =             $applicationNum;
        //         $application->manager_notes =   $applicationManagerNotes;
        //         $application->save();

        //         if( $subApplication !== null ){
        //             $validateSubApp = $this->ValidateSubApplicationData( $subApplication );
        //             if( $validateSubApp[ 'fails' ] ){
        //                 $result[ 'ok' ] = false;
        //                 $result[ 'message' ] = $validateSubApp[ 'message' ];
        //             }else{

        //                 $this->SetSubApplicationChanges( $subApplication );

        //             };
        //         };

        //         $result[ 'application' ] = $this->GetOneApplicationData( $applicationId );
        //         $result[ 'applicationList' ] = $this->GetApplicationList( $companyAlias );


        //     };
        // };


        return $result;




    }

}


?>


