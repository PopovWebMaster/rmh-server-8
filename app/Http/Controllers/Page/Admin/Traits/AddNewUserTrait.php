<?php 

namespace App\Http\Controllers\Page\Admin\Traits;

use App\Http\Controllers\Page\Admin\Traits\GetOneCompanyDataTrait;

use App\Models\UserCompany;
use App\Models\User;

trait AddNewUserTrait{

    use GetOneCompanyDataTrait;

    public function AddNewUser( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $userName =     isset( $request[ 'data' ][ 'userName' ] )?      $request[ 'data' ][ 'userName' ]: null;
        $userEmail =    isset( $request[ 'data' ][ 'userEmail' ] )?     $request[ 'data' ][ 'userEmail' ]: null;
        $userPassword = isset( $request[ 'data' ][ 'userPassword' ] )?  $request[ 'data' ][ 'userPassword' ]: null;

        $companyId =    isset( $request[ 'data' ][ 'companyId' ] )? $request[ 'data' ][ 'companyId' ]: null;

        $userChack = User::where( 'email', '=', $userEmail )->first();

        if( $userChack === null ){

            $result[ 'ok' ] = true;

            User::create([
                'name' => $userName,
                'email' => $userEmail,
                'password' => bcrypt( $userPassword ),
            ]);

            $user = User::where( 'email', '=', $userEmail )->first();

            if( $user !== null ){
                $user_id = $user->id;

                $userCompanyChak = UserCompany::where( 'user_id', '=', $user_id )
                                            ->where( 'company_id', '=', $companyId )
                                            ->first();

                if( $userCompanyChak === null ){
                    $userCompany = new UserCompany;
                    $userCompany->user_id = $user_id;
                    $userCompany->company_id = $companyId;
                    $userCompany->save();
                };
            };

            $result[ 'company' ] = $this->GetOneCompanyData( $request, $companyId );
        };

        return $result;
    }

}


?>



