<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\Company;
use App\Models\UserCompany;

use Auth;

class ValidateAccessRight
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

        $alias = $request[ 'data' ][ 'companyAlias' ];
        $page = $request[ 'data' ][ 'currentPage' ];

        $result = [
            'ok' => false,
            'message' => 'У вас нет прав доступа к данным этой компании. '.$alias,
        ];

        $uri = $request->getRequestUri();
        $arr = explode('/', $uri);  

        $route = $arr[2];

        $model = Company::where( 'alias', '=', $alias )->first();
        $company_id = $model->id;

        $user_id = null;

        if( Auth::check() ){
            $user = Auth::user();
            $result[ 'user' ] = $user;
            $user_id = $user->id;
        };
        
        $userCompany = UserCompany::where( 'company_id', '=', $company_id )->where( 'user_id', '=', $user_id )->first();

        if( $userCompany === null ){
            return response()->json( $result, 200, ['Content-Type' => 'application/json; charset=UTF-8'] );
        }else{
            return $next($request);
        };

    }
}
