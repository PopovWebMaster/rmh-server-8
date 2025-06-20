<?php

namespace App\Http\Controllers\Page\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\SiteController;

// use Auth;

class CompanyController extends SiteController
{

    public function __construct(){
        parent::__construct();

    }

    function get( Request $request ){

        $this->AddCompanyDataToThisData();

        $this->data['robots'] = 'noindex';
        $this->data['pageTitle'] = 'Company';
        
        $this->data['page'] = 'company';

        return view( 'company', $this->data );
    }
}
