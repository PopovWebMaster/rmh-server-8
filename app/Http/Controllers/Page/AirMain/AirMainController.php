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

        $user = null;
        if( Auth::check() ){
            $user = Auth::user();
        };

        $userCompany = $this->GetUserCompanyData( $user );

        $this->data['robots'] = 'noindex';
        $this->data['pageTitle'] = 'Эфир. Главная';
        $this->data['companyAlias'] = $userCompany[ 'alias' ];
        $this->data['companyName'] = $userCompany[ 'name' ];
        $this->data['companyType'] = $userCompany[ 'type' ];
        $this->data['page'] = 'air-main';


        return view( 'air_main', $this->data );
    }
}
