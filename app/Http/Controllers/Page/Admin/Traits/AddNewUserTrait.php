<?php 

namespace App\Http\Controllers\Page\Admin\Traits;


use App\Models\Company;
use App\Models\CompanyProgramSystem;
use App\Models\UserCompany;

use App\Models\User;

trait AddNewUserTrait{

    public function AddNewUser( $params ){

        $result = [];

        $userName =         $params[ 'name' ];
        $userEmail =        $params[ 'email' ];
        $userPassword =     $params[ 'password' ];
        $companyAlias =     isset( $params[ 'companyAlias' ] )? $params[ 'companyAlias' ]: null;

        $userChack = User::where( 'email', '=', $userEmail )->first();

        if( $userChack === null ){

            User::create([
                'name' => $userName,
                'email' => $userEmail,
                'password' => bcrypt( $userPassword ),
            ]);

            $user = User::where( 'email', '=', $userEmail )->first();

            if( $user !== null ){
                $user_id = $user->id;

                $company = Company::where( 'alias', '=', $companyAlias )->first();
                if( $company !== null ){
                    $company_id = $company->id;

                    $userCompanyChak = UserCompany::where( 'user_id', '=', $user_id )
                                                ->where( 'company_id', '=', $company_id )
                                                ->first();

                    if( $userCompanyChak === null ){
                        $userCompany = new UserCompany;
                        $userCompany->user_id = $user_id;
                        $userCompany->company_id = $company_id;
                        $userCompany->save();
                    };
                };
            };
        };

        return $result;
    }

}


?>



