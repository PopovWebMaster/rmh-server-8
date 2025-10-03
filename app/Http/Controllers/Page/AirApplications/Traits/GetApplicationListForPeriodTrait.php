<?php 

namespace App\Http\Controllers\Page\AirApplications\Traits;


use App\Models\Company;
use App\Models\Application;

use App\Http\Controllers\Traits\Validate\ValidateYYYYMMDDTrait;

use App\Http\Controllers\Traits\GetApplicationListTrait;

trait GetApplicationListForPeriodTrait{

    use ValidateYYYYMMDDTrait;
    use GetApplicationListTrait;

    public function GetApplicationListForPeriod( $request, $user ){
        $result = [
            'ok' => false,
            'message' => '',
        ];

        $companyAlias = $request['data']['companyAlias'];

        $validate = $this->ValidatePeriod_GALFP( $request );

        if( $validate[ 'ok' ] === false ){
            $result[ 'message' ] = $validate[ 'message' ];
        }else{
            $company = Company::where( 'alias', '=', $companyAlias )->first();
            $company_id = $company->id;

            $result[ 'ok' ] = true;

            $period = [
                'from' =>   $request[ 'data' ][ 'period_from' ],
                'to' =>     $request[ 'data' ][ 'period_to' ],
            ];

            $result[ 'list' ] = $this->GetApplicationList( $companyAlias, $period );


        };

        return $result;
    }

    private function ValidatePeriod_GALFP( $request ){
        $result = [
            'ok' => false,
            'message' => '',
        ];

        $dataFrom =         isset( $request[ 'data' ][ 'period_from' ] )?          $request[ 'data' ][ 'period_from' ]:       null;
        $dataTo =           isset( $request[ 'data' ][ 'period_to' ] )?            $request[ 'data' ][ 'period_to' ]:         null;

        $validateDateFrom = $this->ValidateYYYYMMDD( $dataFrom );

        if( $validateDateFrom[ 'fails' ] ){
            $result[ 'message' ] = 'Валидация запроса не пройдена! dataFrom - '.$dataFrom;
        }else{
            $validateDateTo = $this->ValidateYYYYMMDD( $dataTo );
            if( $validateDateTo[ 'fails' ] ){
                $result[ 'message' ] = 'Валидация запроса не пройдена! dataTo - '.$dataTo;
            }else{
                $result[ 'ok' ] = true;
            };
        };

        return $result;
    }

}


?>


