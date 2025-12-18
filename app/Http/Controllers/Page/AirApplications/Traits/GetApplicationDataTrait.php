<?php 

namespace App\Http\Controllers\Page\AirApplications\Traits;

use App\Http\Controllers\Traits\Validate\ValidateApplicationIdTrait;
// use App\Http\Controllers\Page\AirApplications\Traits\GetOneApplicationDataTrait;
use App\Http\Controllers\Page\AirApplications\Traits\GetApplicationListByParamsTrait;

use App\Models\Company;
use App\Models\Application;

trait GetApplicationDataTrait{

    use ValidateApplicationIdTrait;
    // use GetOneApplicationDataTrait;
    use GetApplicationListByParamsTrait;

    public function GetApplicationData( $request, $user ){
        $result = [
            'ok' => false,
            'message' => '',
        ];

        $companyAlias = $request['data']['companyAlias'];

        $applicationId =  isset( $request['data']['applicationId'] )? $request['data']['applicationId']: null;

        $validate = $this->ValidateApplicationId( $applicationId );

        if( $validate[ 'fails' ] ){
            $result[ 'message' ] = $validate[ 'message' ];
        }else{
            $company = Company::where( 'alias', '=', $companyAlias )->first();
            $company_id = $company->id;

            $application = Application::where( 'company_id', '=', $company_id )->where( 'id', '=', $applicationId )->first();

            if( $application === null ){
                $result[ 'message' ] = 'Эх, что-то вы мудрите, мой дорогой друг, не надо так. Нет у вас прав доступа к заявкам этой компании.';
            }else{
                
                $result[ 'ok' ] = true;

                $list = $this->GetApplicationListByParams([
                    'companyAlias' =>   $companyAlias,
                    'period' =>         'all',
                    'applicationId' =>  $applicationId,
                    'eventId' =>        'all',
                    'withSubApplication' => true,
                ]);

                // $result[ 'application' ] = $this->GetOneApplicationData( $applicationId );
                $result[ 'application' ] = $list[ 0 ];


            };
        };

        return $result;
    }

}


?>


