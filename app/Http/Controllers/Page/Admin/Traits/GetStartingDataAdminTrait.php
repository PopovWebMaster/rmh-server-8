<?php 

namespace App\Http\Controllers\Page\Admin\Traits;

use App\Http\Controllers\Page\Admin\Traits\GetAllCompanysDataTrait;
use App\Http\Controllers\Traits\GetStartingDataTrait;


trait GetStartingDataAdminTrait{

    use GetAllCompanysDataTrait;
    use GetStartingDataTrait;

    public function GetStartingDataAdmin( $request, $user ){

        $what_to_take = [
            'userData',
        ];

        $result = $this->GetStartingData( $what_to_take, $request, $user );

        $companies = $this->GetAllCompanysData( $request, $user );

        $result[ 'companies' ] = $companies;
        $result[ 'default_program_system' ] =   config( 'app.company_program_system_forward' );
        $result[ 'default_company_type' ] =     config( 'app.company_type_tv' );



        return $result;
        
    }

}


?>

