<?php 

namespace App\Http\Controllers\Page\AirApplications\Traits;

use App\Http\Controllers\Traits\Validate\ValidateSubApplicationIdTrait;
use App\Http\Controllers\Traits\Validate\ValidateApplicationIdTrait;
use App\Http\Controllers\Page\AirApplications\Traits\GetOneApplicationDataTrait;
use App\Http\Controllers\Traits\GetApplicationListTrait;
use App\Http\Controllers\Page\AirApplications\Traits\RemoveSubApplicationWithAllDataTrait;

use App\Models\Company;
use App\Models\Application;
use App\Models\SubApplication;

use App\Models\SubApplicationDescription;
use App\Models\SubApplicationFileName;
use App\Models\SubApplicationRelease;

trait RemoveSubApplicationTrait{

    use ValidateSubApplicationIdTrait;
    use ValidateApplicationIdTrait;
    use GetOneApplicationDataTrait;
    use GetApplicationListTrait;
    use RemoveSubApplicationWithAllDataTrait;

    public function RemoveSubApplication( $request, $user ){
        $result = [
            'ok' => false,
            'message' => '',
        ];

        $companyAlias = $request['data']['companyAlias'];

        $applicationId =    isset( $request['data']['applicationId'] )?     $request['data']['applicationId']: null;
        $subApplicationId = isset( $request['data']['subApplicationId'] )?  $request['data']['subApplicationId']: null;

        $validateApplicationId = $this->ValidateApplicationId( $applicationId );

        if( $validateApplicationId[ 'fails' ] ){
            $result[ 'message' ] = $validateApplicationId[ 'message' ];
        }else{
            $validateSubApplicationId = $this->ValidateSubApplicationId( $subApplicationId );

            if( $validateSubApplicationId[ 'fails' ] ){
                $result[ 'message' ] = $validateSubApplicationId[ 'message' ];
            }else{

                $company = Company::where( 'alias', '=', $companyAlias )->first();
                $company_id = $company->id;

                $application = Application::where( 'company_id', '=', $company_id )->where( 'id', '=', $applicationId )->first();

                if( $application === null ){
                    $result[ 'message' ] = 'У вас прав доступа к заявкам этой компании.';
                }else{

                    $result[ 'ok' ] = true;

                    $subApplication = SubApplication::where( 'application_id', '=', $applicationId )
                                                    ->where( 'id', '=', $subApplicationId )
                                                    ->first();
                    if( $subApplication !== null ){

                        $this->RemoveSubApplicationWithAllData( $subApplicationId );

                        $result[ 'application' ] = $this->GetOneApplicationData( $applicationId );
                        $result[ 'applicationList' ] = $this->GetApplicationList( $companyAlias );

                    };
                };
            };
        };

        return $result;
    }

}


?>


