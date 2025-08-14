<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Auth;

class ValidateAccessRightOnlyAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next )
    {

        $result = [
            'ok' => false,
            'message' => 'У вас нет прав доступа к данным.',
        ];

        $user_id = null;
        $user_email = null;

        if( Auth::check() ){
            $user = Auth::user();
            $user_id = $user->id;
            $user_email = $user->email;
        };

        if( $user_email === config( 'app.admin_email' ) ){
            return $next($request);
        }else{
            if( $request->method() === 'GET' ){
                return redirect()->route( 'home' );
            }else{
                return response()->json( $result, 200, ['Content-Type' => 'application/json; charset=UTF-8'] );
            };
        };

        

        // return $next($request);
    }
}
