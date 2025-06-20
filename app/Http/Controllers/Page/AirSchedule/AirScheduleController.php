<?php

namespace App\Http\Controllers\Page\AirSchedule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\SiteController;

class AirScheduleController extends SiteController
{
    public function __construct(){
        parent::__construct();

    }

    function get( Request $request, $company = null ){

        $this->AddCompanyDataToThisData( $company );

        $this->data['robots'] = 'noindex';
        $this->data['pageTitle'] = 'Эфир. Расписание';
        
        $this->data['page'] = 'air-schedule';


        return view( 'air_schedule', $this->data );
    }
}
