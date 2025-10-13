<?php 

namespace App\Http\Controllers\Page\AirApplications\Traits;

use App\Http\Controllers\Traits\Validate\ValidateApplicationDataTrait;
use App\Http\Controllers\Traits\Validate\ValidateSubApplicationDataTrait;
use App\Http\Controllers\Page\AirApplications\Traits\SetSubApplicationChangesTrait;
use App\Http\Controllers\Page\AirApplications\Traits\GetOneApplicationDataTrait;
use App\Http\Controllers\Traits\GetApplicationListTrait;


use App\Models\Company;
use App\Models\Application;
use App\Models\SubApplication;


trait SaveApplicationChangesTrait{

    use ValidateApplicationDataTrait;
    use ValidateSubApplicationDataTrait;
    use SetSubApplicationChangesTrait;
    use GetOneApplicationDataTrait;
    use GetApplicationListTrait;

    public function SaveApplicationChanges( $request, $user ){
        $result = [
            'ok' => false,
            'message' => '',
        ];

        $companyAlias = $request['data']['companyAlias'];

        $applicationId =            isset( $request['data']['applicationId'] )?             $request['data']['applicationId']: null;
        $applicationName =          isset( $request['data']['applicationName'] )?           $request['data']['applicationName']: null;
        $applicationCategoryId =    isset( $request['data']['applicationCategoryId'] )?     $request['data']['applicationCategoryId']: null;
        $applicationNum =           isset( $request['data']['applicationNum'] )?            $request['data']['applicationNum']: null;
        $applicationManagerNotes =  isset( $request['data']['applicationManagerNotes'] )?   $request['data']['applicationManagerNotes']: null;
        $applicationManagerId =     isset( $request['data']['applicationManagerId'] )?   $request['data']['applicationManagerId']: null;


        
        /*
            Внимание! subApplication можно не передавать, в таком случае будет сохранены изменения только в основной заявке
        */
        $subApplication =           isset( $request['data']['subApplication'] )?            $request['data']['subApplication']: null;

        $validateApp = $this->ValidateApplicationData([
            'applicationId' =>              $applicationId,
            'applicationName' =>            $applicationName,
            'applicationCategoryId' =>      $applicationCategoryId,
            'applicationNum' =>             $applicationNum,
            'applicationManagerNotes' =>    $applicationManagerNotes,
            'applicationManagerId' =>       $applicationManagerId,

        ]);

        if( $validateApp[ 'fails' ] ){
            $result[ 'message' ] = $validateApp[ 'message' ];
        }else{
            $company = Company::where( 'alias', '=', $companyAlias )->first();
            $company_id = $company->id;

            $application = Application::where( 'company_id', '=', $company_id )->where( 'id', '=', $applicationId )->first();

            if( $application === null ){
                $result[ 'message' ] = 'У вас прав доступа к заявкам этой компании.';
            }else{

                $result[ 'ok' ] = true;

                $application->category_id =     $applicationCategoryId;
                $application->name =            $applicationName;
                $application->num =             $applicationNum;
                $application->manager_notes =   $applicationManagerNotes;
                // $application->save();
                if( $user->email === config( 'app.admin_email' ) ){
                    if( $applicationManagerId !== null ){
                        $application->manager_id = $applicationManagerId;
                    };
                };

                $application->save();

                if( $subApplication !== null ){
                    $validateSubApp = $this->ValidateSubApplicationData( $subApplication );
                    if( $validateSubApp[ 'fails' ] ){
                        $result[ 'ok' ] = false;
                        $result[ 'message' ] = $validateSubApp[ 'message' ];
                    }else{

                        $this->SetSubApplicationChanges( $subApplication );

                        

                    };
                };



                

                $result[ 'application' ] = $this->GetOneApplicationData( $applicationId );
                $result[ 'applicationList' ] = $this->GetApplicationList( $companyAlias );


            };
        };


        return $result;
    }

}


?>


