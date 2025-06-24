<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Page\Home\Traits\GetStartingDataHomeTrait;
use App\Http\Controllers\Page\Login\Traits\GetStartingDataLoginTrait;
use App\Http\Controllers\Page\Company\Traits\GetStartingDataCompanyTrait;

use App\Http\Controllers\Page\AirApplications\Traits\GetStartingDataAirApplicationsTrait;
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


use App\Http\Controllers\Page\AirLogs\Traits\GetStartingDataAirLogsTrait;
use App\Http\Controllers\Page\AirMain\Traits\GetStartingDataAirMainTrait;
use App\Http\Controllers\Page\AirPlayReport\Traits\GetStartingDataAirPlayReportTrait;
use App\Http\Controllers\Page\AirPlayReport\Traits\GetEntierListForSearchValueTrait;
use App\Http\Controllers\Page\AirPlayReport\Traits\GetOneDayPlayReportListTrait;






use App\Http\Controllers\Page\AirSchedule\Traits\GetStartingDataAirScheduleTrait;

use App\Http\Controllers\Page\AirLogs\Traits\AddPlayReportTrait;


use App\Models\User;


class ApiDevelopmentController extends Controller
{

    use GetStartingDataHomeTrait;
    use GetStartingDataLoginTrait;
    use GetStartingDataCompanyTrait;
    use GetStartingDataAirApplicationsTrait;
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

    use GetStartingDataAirLogsTrait;
    use GetStartingDataAirMainTrait;
    use GetStartingDataAirPlayReportTrait;
    use GetEntierListForSearchValueTrait;
    use GetOneDayPlayReportListTrait;
    use GetStartingDataAirScheduleTrait;
    use AddPlayReportTrait;


    public function store(Request $request)
    {

        $result = [];

        $route = $request['data']['route'];
        $user = User::find( 1 );
        // $user = null;



        switch( $route ){

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

            case 'air-application/get-starting-data':
                $result = $this->GetStartingDataAirApplications( $request, $user );
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

            case 'air-layout/remove-event':
                $result = $this->RemoveEvent( $request, $user );
                break;

            case 'air-layout/save-grid-event-list':
                $result = $this->RemoveEvent( $request, $user );
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
