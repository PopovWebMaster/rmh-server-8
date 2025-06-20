<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Auth;

class CheckCompany
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        // $request['test'] = $request->getRequestUri();
        // $list = $request->route()->parameters();
        $request['companyAlias'] = $request[ 'data' ][ 'companyAlias' ];
        $request['currentPage'] = $request[ 'data' ][ 'currentPage' ];
        $uri = $request->getRequestUri();
        $arr = explode('/', $uri);  
        $request['route'] = $arr[2];

        $user = null;

        if( Auth::check() ){
            $user = Auth::user();
        };

        $request['user'] = $user;



        return $next($request);
    }
}
