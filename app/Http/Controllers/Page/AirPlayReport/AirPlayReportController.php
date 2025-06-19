<?php

namespace App\Http\Controllers\Page\AirPlayReport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\SiteController;

class AirPlayReportController extends SiteController
{
    public function __construct(){
        parent::__construct();

    }

    function get( Request $request, $company ){

        $this->data['robots'] = 'noindex';
        $this->data['pageTitle'] = 'Эфир. Эфирный отчёт';
        $this->data['companyAlias'] = '';
        $this->data['companyName'] = '';
        $this->data['companyType'] = '';
        $this->data['page'] = 'air-play-report';


        return view( 'air_play_report', $this->data );
    }
}
