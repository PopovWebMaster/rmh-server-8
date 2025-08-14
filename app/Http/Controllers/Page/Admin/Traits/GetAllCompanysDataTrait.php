<?php 

namespace App\Http\Controllers\Page\Admin\Traits;

use App\Models\Company;
use App\Models\CompanyProgramSystem;
use App\Models\CompanyLegalName;
use App\Models\CompanyCity;

use App\Models\UserCompany;
use App\Models\User;

// use App\Http\Controllers\Traits\GetUserDataFromModelTrait;

use App\Http\Controllers\Page\Admin\Traits\GetOneCompanyDataTrait;


trait GetAllCompanysDataTrait{

    use GetOneCompanyDataTrait;

    public function GetAllCompanysData( $request, $user ){

        $result = [];

        $company = Company::all();

        foreach( $company as $model ){
            $company_id =       $model->id;
            $company_data = $this->GetOneCompanyData( $request, $company_id );
            array_push( $result, $company_data );

        };
        
        return $result;
        
    }

}


?>
