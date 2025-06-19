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

    function get( Request $request, $company ){

        $this->data['robots'] = 'noindex';
        $this->data['pageTitle'] = 'Эфир. Logs';
        $this->data['companyAlias'] = '';
        $this->data['companyName'] = '';
        $this->data['companyType'] = '';
        $this->data['page'] = 'logs';


        return view( 'air_logs', $this->data );
    }
}
