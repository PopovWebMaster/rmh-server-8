<?php

namespace App\Http\Controllers\Page\AirLayout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\SiteController;

class AirLayoutController extends SiteController
{
    public function __construct(){
        parent::__construct();

    }

    function get( Request $request, $company = null ){

        $this->AddCompanyDataToThisData( $company );

        $this->data['robots'] = 'noindex';
        $this->data['pageTitle'] = 'Эфир. Макет';
        
        $this->data['page'] = 'air-layout';


        return view( 'air_layout', $this->data );
    }
}
