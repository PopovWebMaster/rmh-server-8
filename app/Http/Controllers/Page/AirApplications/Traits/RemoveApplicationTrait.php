<?php 

namespace App\Http\Controllers\Page\AirApplications\Traits;

use App\Http\Controllers\Traits\Validate\ValidateApplicationIdTrait;
use App\Http\Controllers\Traits\GetApplicationListTrait;

use App\Models\Company;
use App\Models\Application;
use App\Models\SubApplication;

use App\Models\SubApplicationDescription;
use App\Models\SubApplicationFileName;
use App\Models\SubApplicationRelease;

trait RemoveApplicationTrait{

    use ValidateApplicationIdTrait;
    use GetApplicationListTrait;

    public function RemoveApplication( $request, $user ){
        $result = [
            'ok' => false,
            'message' => '',
        ];

        $companyAlias = $request['data']['companyAlias'];

        $applicationId =    isset( $request['data']['applicationId'] )?     $request['data']['applicationId']: null;

        $validateApplicationId = $this->ValidateApplicationId( $applicationId );

        if( $validateApplicationId[ 'fails' ] ){
            $result[ 'message' ] = $validateApplicationId[ 'message' ];
        }else{
            
            $company = Company::where( 'alias', '=', $companyAlias )->first();
            $company_id = $company->id;

            $application = Application::where( 'company_id', '=', $company_id )->where( 'id', '=', $applicationId )->first();

            if( $application === null ){
                $result[ 'message' ] = 'У вас прав доступа к заявкам этой компании.';
            }else{

                $result[ 'ok' ] = true;

                $subAppModels = SubApplication::where( 'application_id', '=', $applicationId )->get();
                foreach( $subAppModels as $model ){
                    $subApplicationId = $model->id;

                    $description = SubApplicationDescription::where( 'sub_application_id', '=', $subApplicationId )->first();
                    if( $description !== null ){
                        $description->delete();
                    };
                    $fileNames = SubApplicationFileName::where( 'sub_application_id', '=', $subApplicationId )->get();
                    if( count( $fileNames ) > 0 ){
                        $fileNames->map->delete();
                    };

                    $releases = SubApplicationRelease::where( 'sub_application_id', '=', $subApplicationId )->get();
                    if( count( $releases ) > 0 ){
                        $releases->map->delete();
                    };
                };

                if( count( $subAppModels ) > 0 ){
                    $subAppModels->map->delete();
                };

                $application->delete();

                $result[ 'applicationList' ] = $this->GetApplicationList( $companyAlias );

            };
        };

        return $result;
    }

}


?>


