<?php 

namespace App\Http\Controllers\Traits;


use App\Models\Company;
use App\Models\CompanyProgramSystem;
use App\Models\UserCompany;

use App\Models\User;

use App\Http\Controllers\Traits\GetUserAccessRightsTrait;

trait GetUserDataFromModelTrait{

    use GetUserAccessRightsTrait;

    public function GetUserDataFromModel( $request, $user ){

        $result = [
            'id' =>             '',
            'name' =>           '',
            'email' =>          '',
            'position' =>       '',
            'company' =>        '',
            'accessRights' =>   '',
            'isAuth' =>         false,
        ];

        if( $user !== null ){

            $user_id =          $user->id;
            $user_name =        $user->name;
            $user_email =       $user->email;
            $user_position =    '';

            if( config( 'app.admin_email' ) === $user_email ){
                $user_position = 'admin';
            };

            $companyAliasList = [];
            $companyNamesByAlias = [];


            $userCompany = UserCompany::where( 'user_id', '=', $user_id )->get();

            foreach( $userCompany as $item ){
                $company_id = $item->company_id;
                $company = Company::find( $company_id );
                array_push( $companyAliasList, $company->alias );

                $companyNamesByAlias[ $company->alias ] = $company->name;

                
            };

            $result = [
                'id' =>                     $user_id,
                'name' =>                   $user_name,
                'email' =>                  $user_email,
                'position' =>               $user_position,
                'company' =>                $companyAliasList,
                'companyNamesByAlias' =>    $companyNamesByAlias,
                'accessRights' =>           $this->GetUserAccessRights( $user_id ),


                'isAuth' =>         true,
            ];
        };

        return $result;
        
    }

    // private function GetUserAccessRightsList( $user ){
    //     return [
    //         // config( 'access_rights.logs.see_page.action' ),
    //         // config( 'access_rights.logs.add_files.action' ),
    //         // config( 'access_rights.logs.deleting_files.action' ),
    //         // config( 'access_rights.logs.add_to_report.action' ),

    //     ];

    // }

        

}


?>



