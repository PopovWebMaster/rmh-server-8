<?php

namespace App\Http\Middleware\AccessRights;

use Closure;
use Illuminate\Http\Request;


use App\Http\Middleware\AccessRights\Traits\ChackAccessTrait;

class LayoutEventRemove
{
    use ChackAccessTrait;

    public function handle(Request $request, Closure $next)
    {

        $chackResult = $this->ChackAccess( 'layout_event_remove' );

        if( $chackResult[ 'ok' ] ){
            return $next($request);
        }else{
            return response()->json( $chackResult, 200, ['Content-Type' => 'application/json; charset=UTF-8'] );
        };

    }
}
