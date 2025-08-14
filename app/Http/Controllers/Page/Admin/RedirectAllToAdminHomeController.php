<?php

namespace App\Http\Controllers\Page\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RedirectAllToAdminHomeController extends Controller
{
    function get( Request $request ){
        return redirect()->route( 'admin_home' );
    }
}
