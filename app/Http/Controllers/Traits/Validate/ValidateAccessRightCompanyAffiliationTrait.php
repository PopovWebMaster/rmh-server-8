<?php 

namespace App\Http\Controllers\Traits\Validate;

use App\Models\UserCompany;
use App\Models\Company;

trait ValidateAccessRightCompanyAffiliationTrait{

    public function ValidateAccessRightCompanyAffiliation( $companyAlias, $user ){

        $result = [
            'fails' => true,
            'message' => 'Нет права доступа к данным этой компании - '.$companyAlias,
        ];

        if( $user !== null ){
            $user_id = $user->id;

            $company = Company::where( 'alias', '=', $companyAlias )->first();

            if( $company !== null ){
                $company_id = $company->id;

                $userCompany = UserCompany::where( 'user_id', '=', $user_id )
                                          ->where( 'company_id', '=', $company_id )
                                          ->first();
                                          
                if( $userCompany !== null ){
                    $result[ 'fails' ] = false;
                    $result[ 'message' ] = '';

                };
            };
        };

        return $result;
        
    }

}


?>