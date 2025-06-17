<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Storage;

class SiteController extends Controller
{
    protected $data;

    protected function __construct(){

        $this->data = [];

        $this->add_js_css_files_to_the_data([
            'vendors',
            'main',
            // 'admin',
            'home',
            // 'logs',
            // 'applications',
            // 'login',
            // 'mainPage',
            // 'schedule',
            // 'playReport',
            // 'accessIsClosed',
            // 'pageNotFound',
            // 'layout',





        ]);

    } 

    private function add_js_css_files_to_the_data( $list_of_pages ){
        
        for( $i = 0; $i < count( $list_of_pages ); $i++ ){

            $name_of_page = $list_of_pages[ $i ];

            $url = url('/');

            $css =  Storage::disk('assets_css')->allFiles();

            foreach( $css as $item ){

                if( is_numeric( strpos( $item, $name_of_page ) ) ){ 
                    $name = 'css_'.$name_of_page;
                    $this->data[ $name ] = $url.'/public/assets/css/'.$item;
                    break;
                };
            };

            $js =   Storage::disk('assets_js')->allFiles();
            foreach( $js as $item ){
                if( is_numeric( strpos( $item, $name_of_page ) ) ){ // (!== false) не исправлять, так надо
                    $name = 'js_'.$name_of_page;
                    $this->data[ $name ] = $url.'/public/assets/js/'.$item;
                    break;
                };
            };

        };

    }
}
