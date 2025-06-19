<?php 

namespace App\Http\Controllers\Traits;


use App\Models\Company;
use App\Models\UserCompany;

use App\Models\User;
use Auth;

trait GetUserCompanyDataTrait{

    public function GetUserCompanyData( $user ){

        $result = [
            'name' => '',
            'alias' => '',
            'type' => '',
        ];

        if( $user !== null ){

            $user_id = $user->id;

            $list = [];

            $userCompany = UserCompany::where( 'user_id', '=', $user_id )->get();
            foreach( $userCompany as $model ){
                $company_id = $model->company_id;
                $company = Company::find( $company_id );
                if( $company !== null ){
                    array_push( $list, [
                        'name' => $company->name,
                        'alias' => $company->alias,
                        'type' => $company->type,
                    ] );
                };
            };

            if( isset( $list[ 0 ] ) ){
                $result = $list[ 0 ];
            };
            
        };

        return $result;
        
    }


        

}


?>



