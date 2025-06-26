<?php 

namespace App\Http\Controllers\Traits;

use App\Http\Controllers\Traits\GetUserDataFromModelTrait;
use App\Http\Controllers\Traits\GetCompanyListTrait;
use App\Http\Controllers\Traits\GetKeyPointListTrait;
use App\Http\Controllers\Traits\GetCategoryListTrait;
use App\Http\Controllers\Traits\GetEventsListTrait;
use App\Http\Controllers\Traits\GetGridEventsListTrait;
use App\Http\Controllers\Traits\GetApplicationListTrait;

use App\Models\Company;
use App\Models\CompanyProgramSystem;

use Storage;

trait GetStartingDataTrait{

    use GetUserDataFromModelTrait;
    use GetCompanyListTrait;
    use GetKeyPointListTrait;
    use GetCategoryListTrait;
    use GetEventsListTrait;
    use GetGridEventsListTrait;
    use GetApplicationListTrait;

    public function GetStartingData( $what_to_take, $request, $user ){

        /*

            $what_to_take = [
                'companyList',
                'userData',
                'programSystem',
                'playReportFiles'
                'keyPountList'
                'categoryList'
                'eventsList'
                'gridEventsList'

                'applicationList'

            ];

        */

        $result = [
            'ok' => true,
            'message' => '',
        ];

        $companyAlias = $request['data']['companyAlias'];

        if( in_array( 'userData', $what_to_take ) ){
            $result[ 'userData' ] = $this->GetUserDataFromModel( $request, $user );
        };

        if( in_array( 'companyList', $what_to_take ) ){
            $result[ 'companyList' ] = $this->GetCompanyList();
        };

        if( in_array( 'programSystem', $what_to_take ) ){
            $result[ 'programSystem' ] = null;
            if( $user !== null ){
                // $companyAlias = $request['data']['companyAlias'];
                $company = Company::where( 'alias', '=',  $companyAlias )->first();
                $company_id = $company->id;
                $companyProgramSystem = CompanyProgramSystem::where( 'company_id', '=',  $company_id )->first();
                if( $companyProgramSystem !== null ){
                    $result[ 'programSystem' ] = $companyProgramSystem->name;
                };
            };
        };

        if( in_array( 'playReportFiles', $what_to_take ) ){
            $result[ 'playReportFiles' ] = Storage::disk('play_report')->files( $companyAlias );
        };

        if( in_array( 'keyPountList', $what_to_take ) ){
            $result[ 'keyPountList' ] = $this->GetKeyPointList( $companyAlias );
        };

        if( in_array( 'categoryList', $what_to_take ) ){
            $result[ 'categoryList' ] = $this->GetCategoryList( $companyAlias );
        };

        if( in_array( 'eventsList', $what_to_take ) ){
            $result[ 'eventsList' ] = $this->GetEventsList( $companyAlias );
        };

        if( in_array( 'gridEventsList', $what_to_take ) ){
            $result[ 'gridEventsList' ] = $this->GetGridEventsList( $companyAlias );
        };

        if( in_array( 'applicationList', $what_to_take ) ){
            $result[ 'applicationList' ] = $this->GetApplicationList( $companyAlias );
        };

        

        

        return $result;
    }

        

}


?>






