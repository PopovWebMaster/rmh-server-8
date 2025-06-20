<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Company;

class ValidateCompany
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

        $companyAlias = $request[ 'data' ][ 'companyAlias' ];

        $model = Company::where( 'alias', '=', $companyAlias )->first();
        if( $model === null ){
            $result = [
                'ok' => false,
                'message' => 'Что-то вы химичите, батенька... Компания ваша - липа. Нет такой у нас. "'.$companyAlias.'"',
            ];
            return response()->json( $result, 200, ['Content-Type' => 'application/json; charset=UTF-8'] );
        }else{
            return $next($request);
        };

    }
}
