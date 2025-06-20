<?php

namespace App\Http\Controllers\Page\AirLogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\SiteController;

class AirLogsController extends SiteController
{
    public function __construct(){
        parent::__construct();

    }

    function get( Request $request, $company = null ){

        $this->AddCompanyDataToThisData( $company );

        $this->data['robots'] = 'noindex';
        $this->data['pageTitle'] = 'Эфир. Logs';
        $this->data['page'] = 'air-logs';


        return view( 'air_logs', $this->data );
    }
}
