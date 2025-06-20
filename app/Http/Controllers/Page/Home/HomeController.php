<?php

namespace App\Http\Controllers\Page\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\SiteController;

use Auth;

class HomeController extends SiteController
{
    public function __construct(){
        parent::__construct();

    }

    function get( Request $request ){

        $this->AddCompanyDataToThisData();

        $this->data['robots'] = 'noindex';
        $this->data['pageTitle'] = 'Главная Home';
        
        $this->data['page'] = 'home';

        if( Auth::check() ){
            $user = Auth::user();
            if( $user->email === config( 'app.admin_email' ) ){
                return view( 'home', $this->data );
            }else{
                return redirect()->route( 'air_main', [ 'company' => $this->data['companyAlias'] ] );
            };
        }else{
            return view( 'home', $this->data );
        };

        
    }
}
