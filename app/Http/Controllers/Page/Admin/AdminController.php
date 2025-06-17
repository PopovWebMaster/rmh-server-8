<?php

namespace App\Http\Controllers\Page\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\SiteController;

use App\Http\Controllers\Page\Admin\Traits\AddNewUserTrait;

class AdminController extends SiteController
{

    use AddNewUserTrait;

    public function __construct(){
        parent::__construct();

    }

    function get( Request $request ){

        $this->data['robots'] = 'noindex';
        $this->data['pageTitle'] = 'Главная Admin';
        $this->data['companyAlias'] = '';
        $this->data['companyName'] = '';
        $this->data['companyType'] = '';
        $this->data['page'] = 'admin';


        // $this->AddNewUser([
        //     'name' => 'Aleksandr',
        //     'email' => 'aaa@mail.ru',
        //     'password' => '111222333',
        //     // 'companyAlias' => null,
        // ]);






        return view( 'admin', $this->data );
    }
}
