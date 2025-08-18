<?php 

namespace App\Http\Controllers\Page\Admin\Traits;

use App\Http\Controllers\Page\Admin\Traits\GetOneCompanyDataTrait;

use App\Models\User;
use App\Models\UserCompany;

trait RemoveUserTrait{

    use GetOneCompanyDataTrait;

    public function RemoveUser( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $userId =       isset( $request[ 'data' ][ 'userId' ] )?    $request[ 'data' ][ 'userId' ]: null;
        $companyId =    isset( $request[ 'data' ][ 'companyId' ] )? $request[ 'data' ][ 'companyId' ]: null;

        if( $companyId === null ){
            $result[ 'message' ] = 'чего-то не так с companyId'.$companyId;
        }else{
            
            $user = User::find( $userId );

            if( $user !== null ){
                $result[ 'ok' ] = true;
                $user->delete();

                $userCompany = UserCompany::where( 'user_id', '=', $userId )
                                          ->where( 'company_id', '=', $companyId )
                                          ->first();
                if( $userCompany !== null ){
                    $userCompany->delete();
                };


            }else{
                $result[ 'message' ] = 'пользователь не найден userId - '.$userId;
            };

            $result[ 'company' ] = $this->GetOneCompanyData( $request, $companyId );

        };

        return $result;
        
    }

}


?>

