<?php 

namespace App\Http\Middleware\AccessRights\Traits;

use App\Models\UserAccessRight;
use Auth;


trait ChackAccessTrait{

    protected function ChackAccess( $accessRightName ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $user = null;
        $user_id = null;

        if( Auth::check() ){
            $user = Auth::user();
            $user_id = $user->id;
        };

        if( $user_id === null ){
            $result[ 'message' ] = 'нет прав';
        }else{
            if( $user->email === config( 'app.admin_email' ) ){
                $result[ 'ok' ] = true;
            }else{
                $model = UserAccessRight::where( 'user_id', '=', $user_id )
                                        ->where( 'access', '=', $accessRightName )
                                        ->first();
                if( $model === null ){
                    $result[ 'message' ] = 'нет прав';
                }else{
                    $result[ 'ok' ] = true;
                };
            };  
        };

        return $result;
 
    }

}


?>
