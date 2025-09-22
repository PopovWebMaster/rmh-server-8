<?php

namespace App\Http\Middleware\AccessRights;

use Closure;
use Illuminate\Http\Request;

use App\Models\UserAccessRight;
use Auth;

class LayoutRemoveEvent
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

        $access_right_name = 'layout_remove_event';

        $user = null;
        $user_id = null;

        if( Auth::check() ){
            $user = Auth::user();
            $user_id = $user->id;
        };

        if( $user_id === null ){
            $result = [
                'ok' => false,
                'message' => 'нет прав',
            ];
            return response()->json( $result, 200, ['Content-Type' => 'application/json; charset=UTF-8'] );
        }else{
            $model = UserAccessRight::where( 'user_id', '=', $user_id )
                                    ->where( 'access', '=', $access_right_name )
                                    ->first();
            if( $model === null ){
                $result = [
                    'ok' => false,
                    'message' => 'нет прав',
                ];
                return response()->json( $result, 200, ['Content-Type' => 'application/json; charset=UTF-8'] );
            }else{
                return $next($request);
            };

        };





        // $companyAlias = $request[ 'data' ][ 'companyAlias' ];

        // $model = Company::where( 'alias', '=', $companyAlias )->first();
        // if( $model === null ){
        //     $result = [
        //         'ok' => false,
        //         'message' => 'Что-то вы химичите, батенька... Компания ваша - липа. Нет такой у нас. "'.$companyAlias.'"',
        //     ];
        //     return response()->json( $result, 200, ['Content-Type' => 'application/json; charset=UTF-8'] );
        // }else{
        //     return $next($request);
        // };
    }
}
