<?php 

namespace App\Http\Controllers\Page\Admin\Traits;


use App\Models\Company;
use App\Models\CompanyProgramSystem;
use App\Models\UserCompany;

use App\Models\User;


trait AddNewCompanyTvTrait{

    public function AddNewCompanyTv( $params ){

        $result = [];

        $companyFullName =      $params[ 'companyFullName' ];
        $companyAlias =         $params[ 'companyAlias' ];
        
        $companyType =          config( 'app.company_type_tv' );
        $companyProgramSystem = isset( $params[ 'companyProgramSystem' ] )? $params[ 'companyProgramSystem' ]: config( 'app.company_program_system_forward' );

        $company = new Company;
        $company->name = $companyFullName;
        $company->alias = $companyAlias;
        $company->type = $companyType;
        $company->save();

        $company_id = $company->id;

        $companyProgramSystem_model = new CompanyProgramSystem;
        $companyProgramSystem_model->company_id = $company_id;
        $companyProgramSystem_model->name = 'Forward-TA';
        $companyProgramSystem_model->save();

        $alminModel = User::where( 'email', '=', config( 'app.admin_email' ) )->first();

        if( $alminModel !== null ){
            $admin_id = $alminModel->id;
            $userCompany = new UserCompany;
            $userCompany->user_id = $admin_id;
            $userCompany->company_id = $company_id;
            $userCompany->save();
        };
        


        dump( 'Новая компания добавлена' );
        dump( $companyFullName );
        dump( $companyAlias );
        dump( $companyType );
        dd( $companyProgramSystem );


        return $result;
    }

}


?>



