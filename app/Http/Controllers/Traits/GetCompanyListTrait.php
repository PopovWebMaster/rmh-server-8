<?php 

namespace App\Http\Controllers\Traits;


use App\Models\Company;
// use App\Models\CompanyProgramSystem;
// use App\Models\UserCompany;

// use App\Models\User;

trait GetCompanyListTrait{

    public function GetCompanyList(){

        return Company::all();


    }

        

}


?>






