<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

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
        $list = $request->route()->parameters();
        $request['company'] = $list[ 'company' ];


        return $next($request);
    }
}
