<?php 

namespace App\Http\Controllers\Traits;

use App\Http\Controllers\Traits\GetUserDataFromModelTrait;
use App\Http\Controllers\Traits\GetCompanyListTrait;

use App\Models\Company;
use App\Models\CompanyProgramSystem;

use Storage;

trait GetStartingDataTrait{

    use GetUserDataFromModelTrait;
    use GetCompanyListTrait;

    public function GetStartingData( $what_to_take, $request, $user ){

        /*
            НЕ УДАЛЯТЬ! 
            Это список того, что можно брать!!!!!!!!!!

            $what_to_take = [
                'companyList',
                'userData',
                'programSystem',
                'playReportFiles'

            ];

        */

        $result = [
            'ok' => true,
            'message' => '',
        ];

        if( in_array( 'userData', $what_to_take ) ){
            $result[ 'userData' ] = $this->GetUserDataFromModel( $request, $user );
        };

        if( in_array( 'companyList', $what_to_take ) ){
            $result[ 'companyList' ] = $this->GetCompanyList();
        };

        if( in_array( 'programSystem', $what_to_take ) ){
            $result[ 'programSystem' ] = null;
            if( $user !== null ){
                $companyAlias = $request['data']['companyAlias'];
                $company = Company::where( 'alias', '=',  $companyAlias )->first();
                $company_id = $company->id;
                $companyProgramSystem = CompanyProgramSystem::where( 'company_id', '=',  $company_id )->first();
                if( $companyProgramSystem !== null ){
                    $result[ 'programSystem' ] = $companyProgramSystem->name;
                };
            };
        };

        if( in_array( 'playReportFiles', $what_to_take ) ){
            $companyAlias = $request['data']['companyAlias'];
            $result[ 'playReportFiles' ] = Storage::disk('play_report')->files( $companyAlias );
        };

        

        

        return $result;
    }

        

}


?>






