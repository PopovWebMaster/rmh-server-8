<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Page\Home\Traits\GetStartingDataHomeTrait;
use App\Http\Controllers\Page\Login\Traits\GetStartingDataLoginTrait;
use App\Http\Controllers\Page\Company\Traits\GetStartingDataCompanyTrait;

use App\Http\Controllers\Page\AirApplications\Traits\GetStartingDataAirApplicationsTrait;


use App\Http\Controllers\Page\AirApplications\Traits\AddNewApplicationTrait;
use App\Http\Controllers\Page\AirApplications\Traits\GetApplicationDataTrait;
use App\Http\Controllers\Page\AirApplications\Traits\SaveApplicationChangesTrait;
use App\Http\Controllers\Page\AirApplications\Traits\AddSubApplicationSeriesTrait;
use App\Http\Controllers\Page\AirApplications\Traits\AddSubApplicationReleaseTrait;
use App\Http\Controllers\Page\AirApplications\Traits\RemoveSubApplicationTrait;
use App\Http\Controllers\Page\AirApplications\Traits\RemoveApplicationTrait;
use App\Http\Controllers\Page\AirApplications\Traits\SaveSubApplicationReleaseTrait;
use App\Http\Controllers\Page\AirApplications\Traits\GetApplicationListForPeriodTrait;



use App\Http\Controllers\Page\AirLayout\Traits\GetStartingDataAirLayoutTrait;
use App\Http\Controllers\Page\AirLayout\Traits\AddNewCategoryTrait;
use App\Http\Controllers\Page\AirLayout\Traits\RemoveCategoryTrait;
use App\Http\Controllers\Page\AirLayout\Traits\SaveCategoryListTrait;
use App\Http\Controllers\Page\AirLayout\Traits\AddNewEventTrait;
use App\Http\Controllers\Page\AirLayout\Traits\SaveEventListTrait;
use App\Http\Controllers\Page\AirLayout\Traits\RemoveEventTrait;
use App\Http\Controllers\Page\AirLayout\Traits\SaveGridEventListTrait;
use App\Http\Controllers\Page\AirLayout\Traits\AddNewGridEventTrait;
use App\Http\Controllers\Page\AirLayout\Traits\RemoveGridEventTrait;
use App\Http\Controllers\Page\AirLayout\Traits\SetGridEventsDayListAfterCuttingTrait;
use App\Http\Controllers\Page\AirLayout\Traits\SaveOneEventDataTrait;
use App\Http\Controllers\Page\AirLayout\Traits\SaveGridEvenListForOneDayTrait;

use App\Http\Controllers\Page\AirLogs\Traits\GetStartingDataAirLogsTrait;
use App\Http\Controllers\Page\AirMain\Traits\GetStartingDataAirMainTrait;
use App\Http\Controllers\Page\AirPlayReport\Traits\GetStartingDataAirPlayReportTrait;
use App\Http\Controllers\Page\AirPlayReport\Traits\GetEntierListForSearchValueTrait;
use App\Http\Controllers\Page\AirPlayReport\Traits\GetOneDayPlayReportListTrait;
use App\Http\Controllers\Page\AirPlayReport\Traits\GetEntierListForAdvancedSearchTrait;

use App\Http\Controllers\Page\AirSchedule\Traits\GetStartingDataAirScheduleTrait;
use App\Http\Controllers\Page\AirSchedule\Traits\GetScheduleResultDayDataTrait;
use App\Http\Controllers\Page\AirSchedule\Traits\SaveScheduleListTrait;

use App\Http\Controllers\Page\AirSchedule\Traits\RemoveScheduleTrait;

use App\Http\Controllers\Page\AirLogs\Traits\AddPlayReportTrait;



use App\Http\Controllers\Page\Admin\Traits\GetStartingDataAdminTrait;
use App\Http\Controllers\Page\Admin\Traits\AddNewCompanyTrait;
use App\Http\Controllers\Page\Admin\Traits\GetCompanyDataTrait;
use App\Http\Controllers\Page\Admin\Traits\ChangeUserDataTrait;
use App\Http\Controllers\Page\Admin\Traits\RemoveUserTrait;
use App\Http\Controllers\Page\Admin\Traits\AddNewUserTrait;
use App\Http\Controllers\Page\Admin\Traits\RemoveCompanyTrait;
use App\Http\Controllers\Page\Admin\Traits\ChangeCompanyDataTrait;
use App\Http\Controllers\Page\Admin\Traits\GetUserAccessDataTrait;
use App\Http\Controllers\Page\Admin\Traits\SetUserAccessRightsChangesTrait;





use App\Models\User;


class ApiDevelopmentController extends Controller
{

    use GetStartingDataHomeTrait;
    use GetStartingDataLoginTrait;
    use GetStartingDataCompanyTrait;
    use GetStartingDataAirApplicationsTrait;
    use AddNewApplicationTrait;
    use GetApplicationDataTrait;
    use SaveApplicationChangesTrait;
    use AddSubApplicationSeriesTrait;
    use AddSubApplicationReleaseTrait;
    use RemoveSubApplicationTrait;
    use RemoveApplicationTrait;
    use SaveSubApplicationReleaseTrait;
    use GetApplicationListForPeriodTrait;


    use GetStartingDataAirLayoutTrait;
    use AddNewCategoryTrait;
    use RemoveCategoryTrait;
    use SaveCategoryListTrait;
    use AddNewEventTrait;
    use SaveEventListTrait;
    use RemoveEventTrait;
    use SaveGridEventListTrait;
    use AddNewGridEventTrait;
    use RemoveGridEventTrait;
    use SetGridEventsDayListAfterCuttingTrait;
    use SaveOneEventDataTrait;
    use SaveGridEvenListForOneDayTrait;

    use GetStartingDataAirLogsTrait;
    use GetStartingDataAirMainTrait;
    use GetStartingDataAirPlayReportTrait;
    use GetEntierListForSearchValueTrait;
    use GetOneDayPlayReportListTrait;
    use GetEntierListForAdvancedSearchTrait;


    use GetStartingDataAirScheduleTrait;
    use GetScheduleResultDayDataTrait;
    use SaveScheduleListTrait;
    use RemoveScheduleTrait;

    use AddPlayReportTrait;
    use GetStartingDataAdminTrait;
    use AddNewCompanyTrait;
    use GetCompanyDataTrait;
    use ChangeUserDataTrait;
    use RemoveUserTrait;
    use AddNewUserTrait;
    use RemoveCompanyTrait;
    use ChangeCompanyDataTrait;
    use GetUserAccessDataTrait;
    use SetUserAccessRightsChangesTrait;





    public function store(Request $request)
    {

        $result = [];

        $route = $request['data']['route'];
        $user = User::find( 1 );
        // $user = User::find( 4 );

        // $user = null;



        switch( $route ){


            case 'admin/get-starting-data':
                $result = $this->GetStartingDataAdmin( $request, $user );
                break;

                
            case 'admin/add-new-company':
                $result = $this->AddNewCompany( $request, $user );
                break;

            case 'admin/get-company-data':
                $result = $this->GetCompanyData( $request, $user );
                break;

            case 'admin/change-user-data':
                $result = $this->ChangeUserData( $request, $user );
                break;

            case 'admin/remove-user':
                $result = $this->RemoveUser( $request, $user );
                break;

            case 'admin/add-new-user':
                $result = $this->AddNewUser( $request, $user );
                break;

            
            case 'admin/remove-company':
                $result = $this->RemoveCompany( $request, $user );
                break;

            case 'admin/change-company-data':
                $result = $this->ChangeCompanyData( $request, $user );
                break;

            case 'admin/change-company-data':
                $result = $this->ChangeCompanyData( $request, $user );
                break;

            case 'admin/get-user-access-right':
                $result = $this->GetUserAccessData( $request, $user );
                break;

            case 'admin/set-user-access-rights-changes':
                $result = $this->SetUserAccessRightsChanges( $request, $user );
                break;



                












            case 'home/get-starting-data':
                $result = $this->GetStartingDataHome( $request, $user );
                break;

            case 'login/get-starting-data':
                $result = $this->GetStartingDataLogin( $request, null );
                break;

            case 'company/get-starting-data':
                $result = $this->GetStartingDataCompany( $request, $user );
                break;



            case 'air-main/get-starting-data':
                $result = $this->GetStartingDataAirMain( $request, $user );

                break;

            case 'air-schedule/get-starting-data':
                $result = $this->GetStartingDataAirSchedule( $request, $user );
                break;

            case 'air-schedule/get-schedule-result-day-data':
                $result = $this->GetScheduleResultDayData( $request, $user );
                break;

            case 'air-schedule/save-schedule-list':
                $result = $this->SaveScheduleList( $request, $user );
                break;

            case 'air-schedule/remove-schedule':
                $result = $this->RemoveSchedule( $request, $user );
                break;























            case 'air-application/get-starting-data':
                $result = $this->GetStartingDataAirApplications( $request, $user );
                break;

            case 'air-application/add-new-application':
                $result = $this->AddNewApplication( $request, $user );
                break;

            case 'air-application/get-application-data':
                $result = $this->GetApplicationData( $request, $user );
                break;

            case 'air-application/seve-application-data':
                $result = $this->SaveApplicationChanges( $request, $user );
                break;

            case 'air-application/add-new-subapplication-release':
                $result = $this->AddSubApplicationRelease( $request, $user );
                break;

            case 'air-application/add-new-subapplication-series':
                $result = $this->AddSubApplicationSeries( $request, $user );
                break;

            case 'air-application/remove-sub-application':
                $result = $this->RemoveSubApplication( $request, $user );
                break;

           case 'air-application/remove-application':
                $result = $this->RemoveApplication( $request, $user );
                break;

            case 'air-application/save-sub-application-release':
                $result = $this->SaveSubApplicationRelease( $request, $user );
                break;

            case 'air-application/get_application_list_for_period':
                $result = $this->GetApplicationListForPeriod( $request, $user );
                break;


















            case 'air-layout/get-starting-data':
                $result = $this->GetStartingDataAirLayout( $request, $user );
                break;


            case 'air-layout/add-new-category':
                $result = $this->AddNewCategory( $request, $user );
                break;

            case 'air-layout/remove-category':
                $result = $this->RemoveCategory( $request, $user );
                break;

            case 'air-layout/save-category-list':
                $result = $this->SaveCategoryList( $request, $user );
                break;

            case 'air-layout/add-new-event':
                $result = $this->AddNewEvent( $request, $user );
                break;

            case 'air-layout/save-event-list':
                $result = $this->SaveEventList( $request, $user );
                break;

            case 'air-layout/save-one-event-data':
                $result = $this->SaveOneEventData( $request, $user );
                break;

            case 'air-layout/remove-event':
                $result = $this->RemoveEvent( $request, $user );
                break;

            case 'air-layout/save-grid-event-list':
                $result = $this->SaveGridEventList( $request, $user );
                break;


            case 'air-layout/save-grid-event-list-for-one-day':
                $result = $this->SaveGridEvenListForOneDay( $request, $user );
                break;










            case 'air-layout/add-new-grid-event':
                $result = $this->AddNewGridEvent( $request, $user );
                break;

            case 'air-layout/remove-grid-event':
                $result = $this->RemoveGridEvent( $request, $user );
                break;

            case 'air-layout/set-grid-events-day-list-after-cutting':
                $result = $this->SetGridEventsDayListAfterCutting( $request, $user );
                break;

            case 'air-play-report/get-starting-data':
                $result = $this->GetStartingDataAirPlayReport( $request, $user );
                break;

            case 'air-play-report/get-entier-list-for-search-value':
                $result = $this->GetEntierListForSearchValue( $request, $user );
                break;

            case 'air-play-report/get-one-day-entire-list':
                $result = $this->GetOneDayPlayReportList( $request, $user );
                break;

            case 'air-play-report/get-entier-list-for-advanced-search':
                $result = $this->GetEntierListForAdvancedSearch( $request, $user );
                break;







            case 'air-logs/get-starting-data':
                $result = $this->GetStartingDataAirLogs( $request, $user );
                break;

            case 'air-logs/add-play-report':
                $result = $this->AddPlayReport( $request, $user );
                break;







        };

        return response()->json( $result, 200, [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
            'Access-Control-Allow-Headers' => 'Accept,Content-Type,Authorization',
            'Content-Type' => 'application/json; charset=UTF-8'
        ] );
    }

}
