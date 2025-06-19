<?php

namespace App\Http\Controllers\Page\AirApplications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\SiteController;

class AirApplicationsController extends SiteController
{
    public function __construct(){
        parent::__construct();

    }

    function get( Request $request, $company ){

        $this->data['robots'] = 'noindex';
        $this->data['pageTitle'] = 'Эфир. Заявки';
        $this->data['companyAlias'] = '';
        $this->data['companyName'] = '';
        $this->data['companyType'] = '';
        $this->data['page'] = 'air-application';


        return view( 'air_application', $this->data );
    }
}
