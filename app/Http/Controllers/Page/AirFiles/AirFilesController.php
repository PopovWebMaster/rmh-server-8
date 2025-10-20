<?php

namespace App\Http\Controllers\Page\AirFiles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\SiteController;

class AirFilesController extends SiteController
{
    public function __construct(){
        parent::__construct();

    }

    function get( Request $request, $company = null ){

        $this->AddCompanyDataToThisData( $company );

        $this->data['robots'] = 'noindex';
        $this->data['pageTitle'] = 'Эфир. Учёт файлов';
        
        $this->data['page'] = 'air-files';


        return view( 'air_files', $this->data );
    }
}
