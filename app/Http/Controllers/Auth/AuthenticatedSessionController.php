<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller; // heare
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\SiteController;

class AuthenticatedSessionController extends SiteController
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */

    public function __construct(){
        parent::__construct();

    }

    public function create()
    {

        $this->data['robots'] = 'noindex';
        $this->data['pageTitle'] = 'Login';
        $this->data['companyAlias'] = '';
        $this->data['companyName'] = '';
        $this->data['companyType'] = '';
        $this->data['page'] = 'login';


        // return view( 'home', $this->data );
        return view('auth.login', $this->data );
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
