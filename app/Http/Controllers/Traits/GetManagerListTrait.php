<?php 

namespace App\Http\Controllers\Traits;

use App\Models\UserCompany;
use App\Models\User;
use App\Models\Company;


trait GetManagerListTrait{

    public function GetManagerList( $request, $user ){

    
        $result = [];

        $companyAlias = $request['data']['companyAlias'];
        $company = Company::where( 'alias', '=', $companyAlias )->first();
        $company_id = $company->id;

        $userCompany = UserCompany::where( 'company_id', '=', $company_id )->get();
        foreach( $userCompany as $model ){
            $user_id = $model->user_id;
            $user = User::find( $user_id );
            if( $user !== null ){
                array_push( $result, [
                    'name' =>   $user->name,
                    'id' =>     $user->id,
                ] );
            };
        };

        return $result;
    }

        

}


?>






