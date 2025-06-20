<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Auth;

use App\Models\Company;
use App\Models\UserCompany;

class ValidateCompanyGet
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

        $list = $request->route()->parameters();

        if( isset( $list[ 'company' ] ) ){
            $companyAlias = $list[ 'company' ];
            $model = Company::where( 'alias', '=', $companyAlias )->first();
            if( $model === null ){
                return redirect()->intended('/');
            }else{
                $company_id = $model->id;

                if( Auth::user() === null ){
                    return redirect()->intended('/');
                }else{
                    $user = Auth::user();
                    $user_id = $user->id;

                    $userCompany = UserCompany::where( 'user_id', '=', $user_id )->where( 'company_id', '=', $company_id )->first();
                    if( $userCompany === null ){
                        return redirect()->intended('/');
                    }else{
                        return $next($request);
                    };
                };
            };


        };


        // dd( $list[ 'company' ] );


        // return $next($request);
    }
}
