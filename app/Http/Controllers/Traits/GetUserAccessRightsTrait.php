<?php 

namespace App\Http\Controllers\Traits;


use App\Models\Company;
use App\Models\CompanyProgramSystem;
use App\Models\UserCompany;

use App\Models\User;
use App\Models\UserAccessRight;



trait GetUserAccessRightsTrait{

    public function GetUserAccessRights( $user_id ){

        $result = [];

        if( $user_id !== null ){
            $allList = config( 'access_rights_list' );

            $user = User::find( $user_id );
            if( $user !== null ){
                $user_email = $user->email;
                if( config( 'app.admin_email' ) === $user_email ){
                    $result = $allList;
                }else{
                    for( $i = 0; $i < count( $allList ); $i++ ){
                        $model = UserAccessRight::where( 'user_id', '=', $user_id )->where( 'access', '=', $allList[ $i ] )->first();
                        if( $model !== null ){
                            array_push( $result, $allList[ $i ] );
                        };
                    };
                };
            };

        };

        return $result;
        
    }


        

}


?>



