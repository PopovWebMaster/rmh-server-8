<?php 

namespace App\Http\Controllers\Page\Home\Traits;

// use App\Http\Controllers\Traits\GetUserDataFromModelTrait;
// use App\Http\Controllers\Traits\GetCompanyListTrait;
use App\Http\Controllers\Traits\GetStartingDataTrait;

trait GetStartingDataHomeTrait{

    use GetStartingDataTrait;
    // use GetCompanyListTrait;

    public function GetStartingDataHome( $request, $user ){


        $what_to_take = [
            'companyList',
            'userData',
        ];

        $result = $this->GetStartingData( $what_to_take, $request, $user );

        // $result = [
        //     'ok' => true,
        //     'message' => '',
        // ];

        // $result[ 'companyList' ] =  $this->GetCompanyList();
        // $result[ 'userData' ] =     $this->GetUserDataFromModel( $request, $user );

        return $result;
        
    }

}


?>

