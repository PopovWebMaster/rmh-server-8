<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Storage;

use App\Http\Controllers\Traits\GetUserCompanyDataTrait;
use Auth;

class SiteController extends Controller
{

    use GetUserCompanyDataTrait;

    protected $data;

    protected function __construct(){

        $this->data = [];

        $this->add_js_css_files_to_the_data([
            'vendors',
            'main',
            'admin',
            'home',
            'company',
            'login',

            'air_main',
            'air_schedule',
            'air_application',
            'air_layout',
            'air_play_report',
            'air_logs',





            // 'logs',
            // 'applications',
            
            // 'mainPage',
            // 'schedule',
            // 'playReport',
            // 'accessIsClosed',
            // 'pageNotFound',
            // 'layout',





        ]);

    } 

    private function add_js_css_files_to_the_data( $list_of_pages ){

        $css =  Storage::disk('assets_css')->allFiles();
        $listNames_css = [];
        for( $i = 0; $i < count( $css ); $i++ ){
            $arr = explode('.', $css[ $i ] );  
            $listNames_css[ $arr[ 0 ] ] = $css[ $i ];
        };

        $js =   Storage::disk('assets_js')->allFiles();
        $listNames_js = [];
        for( $i = 0; $i < count( $js ); $i++ ){
            $arr = explode('.', $js[ $i ] );  
            $listNames_js[ $arr[ 0 ] ] = $js[ $i ];
        };

        $url = url('/');

        for( $i = 0; $i < count( $list_of_pages ); $i++ ){

            $name_of_page = $list_of_pages[ $i ];

            if( isset( $listNames_css[ $name_of_page ] ) ){
                $name = 'css_'.$name_of_page;
                $this->data[ $name ] = $url.'/public/assets/css/'.$listNames_css[ $name_of_page ];
            };

            if( isset( $listNames_js[ $name_of_page ] ) ){
                $name = 'js_'.$name_of_page;
                $this->data[ $name ] = $url.'/public/assets/js/'.$listNames_js[ $name_of_page ];
            };

        };


    }

    public function AddCompanyDataToThisData( $company = null ){
        
        $userCompany = $this->GetUserCompanyData( Auth::user(), $company );

        $this->data['companyAlias'] = $userCompany[ 'alias' ];
        $this->data['companyName'] = $userCompany[ 'name' ];
        $this->data['companyType'] = $userCompany[ 'type' ];

    }

    
}
