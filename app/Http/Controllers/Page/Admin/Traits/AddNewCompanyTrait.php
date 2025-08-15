<?php 

namespace App\Http\Controllers\Page\Admin\Traits;


use App\Models\Company;
use App\Models\CompanyProgramSystem;
use App\Models\UserCompany;
use App\Models\User;
use App\Models\CompanyLegalName;
use App\Models\CompanyCity;

use App\Http\Controllers\Page\Admin\Traits\GetAllCompanysDataTrait;

trait AddNewCompanyTrait{

    use GetAllCompanysDataTrait;

    public function AddNewCompany( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $name =             isset( $request[ 'data' ][ 'name' ] )?          $request[ 'data' ][ 'name' ]:        '';
        $city =             isset( $request[ 'data' ][ 'city' ] )?          $request[ 'data' ][ 'city' ]:        '';
        $alias =            isset( $request[ 'data' ][ 'alias' ] )?         $request[ 'data' ][ 'alias' ]:       '';
        $legalName =        isset( $request[ 'data' ][ 'legalName' ] )?     $request[ 'data' ][ 'legalName' ]:   '';
        $programSystem =    isset( $request[ 'data' ][ 'programSystem' ] )? $request[ 'data' ][ 'programSystem' ]:config( 'app.company_program_system_forward' );
        $type =             isset( $request[ 'data' ][ 'type' ] )?          $request[ 'data' ][ 'type' ]:        config( 'app.company_type_tv' );


        $company = new Company;
        $company->name = $name;
        $company->alias = $alias;
        $company->type = $type;
        $company->save();

        $company_id = $company->id;

        $companyProgramSystem_model = new CompanyProgramSystem;
        $companyProgramSystem_model->company_id = $company_id;
        $companyProgramSystem_model->name = $programSystem;
        $companyProgramSystem_model->save();

        $alminModel = User::where( 'email', '=', config( 'app.admin_email' ) )->first();

        if( $alminModel !== null ){
            $userCompany = new UserCompany;
            $userCompany->user_id = $alminModel->id;
            $userCompany->company_id = $company_id;
            $userCompany->save();
        };

        $companyLegalName = new CompanyLegalName;
        $companyLegalName->company_id = $company_id;
        $companyLegalName->name = $legalName;
        $companyLegalName->save();

        $companyCity = new CompanyCity;
        $companyCity->company_id = $company_id;
        $companyCity->name = $city;
        $companyCity->save();

        $companies = $this->GetAllCompanysData( $request, $user );

        $result[ 'companies' ] = $companies;

        return $result;
        
        
    }

}


?>


