<?php 

namespace App\Http\Controllers\Page\Admin\Traits;

use App\Models\Company;
use App\Models\CompanyProgramSystem;
use App\Models\CompanyLegalName;
use App\Models\CompanyCity;

use App\Models\UserCompany;
use App\Models\User;

use App\Http\Controllers\Traits\GetUserDataFromModelTrait;


trait GetOneCompanyDataTrait{

    use GetUserDataFromModelTrait;

    public function GetOneCompanyData( $request, $company_id ){

        $result = [
            'company_id' =>             '',
            'company_name' =>           '',
            'company_alias' =>          '',
            'company_type' =>           '',
            'company_program_system' => '',
            'company_legal_name' =>     '',
            'company_city' =>           '',
            'company_personal' =>       [],
        ];

        $company = Company::find( $company_id );

        if( $company !== null ){

            $company_id =       $company->id;
            $company_name =     $company->name;
            $company_alias =    $company->alias;
            $company_type =     $company->type;

            $company_program_system = '';
            $companyProgramSystem =     CompanyProgramSystem::where( 'company_id', '=', $company_id )->first();
            if( $companyProgramSystem !== null ){
                $company_program_system =   $companyProgramSystem->name;
            };
            
            $company_legal_name = '';
            $companyLegalName = CompanyLegalName::where( 'company_id', '=', $company_id )->first();
            if( $companyLegalName !== null ){
                $company_legal_name = $companyLegalName->name;
            };

            $company_city = '';
            $companyCity = CompanyCity::where( 'company_id', '=', $company_id )->first();
            if( $companyCity !== null ){
                $company_city = $companyCity->name;
            };

            $personal = [];
            $userCompany = UserCompany::where( 'company_id', '=', $company_id )->get();
            foreach( $userCompany as $item ){
                $user_id = $item->user_id;
                $user = User::find( $user_id );
                if( $user !== null ){
                    if( $user->email !== config( 'app.admin_email' ) ){
                        $user_data = $this->GetUserDataFromModel( $request, $user );
                        array_push( $personal, $user_data );
                    };
                };
            };

            $result[ 'company_id' ] = $company_id;
            $result[ 'company_name' ] = $company_name;
            $result[ 'company_alias' ] = $company_alias;
            $result[ 'company_type' ] = $company_type;
            $result[ 'company_program_system' ] = $company_program_system;
            $result[ 'company_legal_name' ] = $company_legal_name;
            $result[ 'company_city' ] = $company_city;
            $result[ 'company_personal' ] = $personal;
        };


        return $result;
        
    }

}


?>
