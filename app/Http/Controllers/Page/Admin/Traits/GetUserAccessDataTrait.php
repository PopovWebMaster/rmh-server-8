<?php 

namespace App\Http\Controllers\Page\Admin\Traits;

use App\Http\Controllers\Traits\GetUserAccessRightsTrait;

use App\Models\User;
use App\Models\UserCompany;
use App\Models\Company;


trait GetUserAccessDataTrait{

    use GetUserAccessRightsTrait;

    public function GetUserAccessData( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $userId = isset( $request[ 'data' ][ 'userId' ] )? $request[ 'data' ][ 'userId' ]: null;
        if( $userId === null ){
            $result[ 'message' ] = 'Что-то не так с айдишником пользователя';
        }else{
            $searshUser = User::find( $userId );
            if( $searshUser === null ){
                $result[ 'message' ] = 'Айдишник не верный';
            }else{
                $result[ 'ok' ] = true;

                $companyAliasList = [];
                $userCompany = UserCompany::where( 'user_id', '=', $userId )->get();
                foreach( $userCompany as $item ){
                    $company_id = $item->company_id;
                    $company = Company::find( $company_id );
                    array_push( $companyAliasList, $company->alias );
                };

                $result[ 'allAccsessRights' ] = config( 'access_rights_list' );
                $result[ 'userAccsessRights' ] = $this->GetUserAccessRights( $userId );
                $result[ 'companyAliasList' ] = $companyAliasList;


            };
        };
       
        return $result;
        
    }

}


?>

