<?php 

namespace App\Http\Controllers\Traits;

use App\Http\Controllers\Traits\GetUserDataFromModelTrait;
use App\Http\Controllers\Traits\GetCompanyListTrait;
use App\Http\Controllers\Traits\GetKeyPointListTrait;
use App\Http\Controllers\Traits\GetCategoryListTrait;
use App\Http\Controllers\Traits\GetEventsListTrait;
use App\Http\Controllers\Traits\GetGridEventsListTrait;
use App\Http\Controllers\Traits\GetApplicationListTrait;
use App\Http\Controllers\Page\AirApplications\Traits\GetApplicationListByParamsTrait;

use App\Http\Controllers\Page\Admin\Traits\GetOneCompanyDataTrait;
use App\Http\Controllers\Page\AirSchedule\Traits\GetSchaduleResultListTrait;
use App\Http\Controllers\Page\AirSchedule\Traits\GetAllScheduleFileNamesTrait;
use App\Http\Controllers\Page\AirFiles\Traits\GetAirFilePrefixListTrait;

use App\Http\Controllers\Traits\GetManagerListTrait;
use App\Http\Controllers\Page\AirSchedule\Traits\GetFreeReleasesListTrait;


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
    use GetApplicationListByParamsTrait;
    use GetOneCompanyDataTrait;
    use GetSchaduleResultListTrait;
    use GetManagerListTrait;
    use GetAllScheduleFileNamesTrait;
    use GetAirFilePrefixListTrait;
    use GetFreeReleasesListTrait;


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
                'companyLegalName,
                'currentDaySchaduleList'

                'managerList'
                'allScheduleFileNames'
                'airFilePrefix',

                'freeReleaseList'


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

            // $result[ 'applicationList' ] = $this->GetApplicationList( $companyAlias );
            $result[ 'applicationList' ] = $this->GetApplicationListByParams([
                'companyAlias' =>       $companyAlias,
                'period' =>         'all',
                'applicationId' =>  'all',
                'eventId' =>        'all',

            ]);

        };

        if( in_array( 'companyLegalName', $what_to_take ) ){
            $company = Company::where( 'alias', '=',  $companyAlias )->first();
            $legalName = '';
            if( $company !== null ){
                $company_id = $company->id;

                $companyData = $this->GetOneCompanyData( $request, $company_id );
                $legalName = $companyData[ 'company_legal_name' ];
            };
            $result[ 'companyLegalName' ] = $legalName;
        };

        if( in_array( 'currentDaySchaduleList', $what_to_take ) ){
            $YYYY_MM_DD = date("Y-m-d");
            $result[ 'currentDaySchaduleList' ] = $this->GetSchaduleResultList( $companyAlias, $YYYY_MM_DD );
        };

        if( in_array( 'managerList', $what_to_take ) ){
            $result[ 'managerList' ] = $this->GetManagerList( $request, $user );
        };

        if( in_array( 'allScheduleFileNames', $what_to_take ) ){
            $result[ 'allScheduleFileNames' ] = $this->GetAllScheduleFileNames( $request, $user );
        };

        if( in_array( 'airFilePrefix', $what_to_take ) ){
            $result[ 'airFilePrefix' ] = $this->GetAirFilePrefixList( $companyAlias );
        };

        if( in_array( 'freeReleaseList', $what_to_take ) ){
            $result[ 'freeReleaseList' ] = $this->GetFreeReleasesList( $companyAlias );
        };




        // currentDaySchaduleList


        // $result[ 'YYYY_MM_DD' ] = date(DATE_ATOM, mktime(0, 0, 0, 7, 1, 2000));
        // $result[ 'YYYY_MM_DD' ] = date(DATE_ATOM, mktime());
        // $result[ 'YYYY_MM_DD' ] = date("Y-m-d H:i:s");
        // $result[ 'YYYY_MM_DD' ] = date("Y-m-d");


        // date("Y-m-d H:i:s")


        

        

        return $result;
    }

        

}


?>






