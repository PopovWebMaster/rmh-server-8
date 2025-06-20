<?php

namespace App\Http\Controllers\Page\AirMain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\SiteController;

use App\Http\Controllers\Traits\GetUserCompanyDataTrait;
use Auth;

class AirMainController extends SiteController
{

    use GetUserCompanyDataTrait;

    public function __construct(){
        parent::__construct();

    }

    function get( Request $request, $company = null ){

        $this->AddCompanyDataToThisData( $company );

        $this->data['robots'] = 'noindex';
        $this->data['pageTitle'] = 'Эфир. Главная';
        $this->data['page'] = 'air-main';

        return view( 'air_main', $this->data );
    }
}
