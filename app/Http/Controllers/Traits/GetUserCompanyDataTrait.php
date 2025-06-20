<?php 

namespace App\Http\Controllers\Traits;


use App\Models\Company;
use App\Models\UserCompany;

use App\Models\User;
use Auth;

trait GetUserCompanyDataTrait{

    public function GetUserCompanyData( $user, $companyAlias = null ){

        $result = [
            'name' => '',
            'alias' => '',
            'type' => '',
        ];

        if( $user !== null ){

            $user_id = $user->id;

            if( $companyAlias === null ){
                $list = [];
                $userCompany = UserCompany::where( 'user_id', '=', $user_id )->get();
                foreach( $userCompany as $model ){
                    $company_id = $model->company_id;
                    $companyModel = Company::find( $company_id );
                    if( $companyModel !== null ){
                        array_push( $list, [
                            'name' => $companyModel->name,
                            'alias' => $companyModel->alias,
                            'type' => $companyModel->type,
                        ] );
                    };
                };

                if( isset( $list[ 0 ] ) ){
                    $result = $list[ 0 ];
                };
            }else{
                $companyModel = Company::where( 'alias', '=', $companyAlias )->first();
                
                if( $companyModel !== null ){
                    $company_id = $companyModel->id;
                    $userCompany = UserCompany::where( 'user_id', '=', $user_id )->where( 'company_id', '=', $company_id )->first();

                    if( $userCompany !== null ){
                        $result = [
                            'name' => $companyModel->name,
                            'alias' => $companyModel->alias,
                            'type' => $companyModel->type,
                        ];
                    };
                };
            };

        };

        return $result;
        
    }


        

}


?>



