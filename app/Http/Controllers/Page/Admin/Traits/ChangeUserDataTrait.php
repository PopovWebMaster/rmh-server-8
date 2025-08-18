<?php 

namespace App\Http\Controllers\Page\Admin\Traits;

use App\Http\Controllers\Page\Admin\Traits\GetOneCompanyDataTrait;

use App\Models\User;

trait ChangeUserDataTrait{

    use GetOneCompanyDataTrait;

    public function ChangeUserData( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $userId =       isset( $request[ 'data' ][ 'userId' ] )?    $request[ 'data' ][ 'userId' ]: null;
        $userData =     isset( $request[ 'data' ][ 'userData' ] )?  $request[ 'data' ][ 'userData' ]: null;
        $companyId =    isset( $request[ 'data' ][ 'companyId' ] )? $request[ 'data' ][ 'companyId' ]: null;

        if( $companyId === null ){
            $result[ 'message' ] = 'чего-то не так с companyId'.$companyId;
        }else{
            

            if( $userData !== null ){

                $accessRights =     isset( $userData[ 'accessRights' ] )?  $userData[ 'accessRights' ]: null;
                $company =          isset( $userData[ 'company' ] )?       $userData[ 'company' ]: null;
                $email =            isset( $userData[ 'email' ] )?         $userData[ 'email' ]: null;
                $name =             isset( $userData[ 'name' ] )?          $userData[ 'name' ]: null;
                $position =         isset( $userData[ 'position' ] )?      $userData[ 'position' ]: null;
                $password =         isset( $userData[ 'password' ] )?      $userData[ 'password' ]: null;

                $user = User::find( $userId );

                if( $user !== null ){
                    $result[ 'ok' ] = true;
                    $user->name = $name;
                    $user->email = $email;
                    if( $password !== null ){
                        $user->password = bcrypt( $password );
                    };
                    $user->save();

                }else{
                    $result[ 'message' ] = 'пользователь не найден userId - '.$userId;
                };


            }else{
                $result[ 'message' ] = 'userData отсутствует';
            };

            $result[ 'company' ] = $this->GetOneCompanyData( $request, $companyId );

        };

        return $result;
        
    }

}


?>

