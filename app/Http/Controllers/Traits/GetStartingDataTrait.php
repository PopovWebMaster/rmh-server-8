<?php 

namespace App\Http\Controllers\Traits;

use App\Http\Controllers\Traits\GetUserDataFromModelTrait;
use App\Http\Controllers\Traits\GetCompanyListTrait;

trait GetStartingDataTrait{

    use GetUserDataFromModelTrait;
    use GetCompanyListTrait;

    public function GetStartingData( $what_to_take, $request, $user ){

        /*
            НЕ УДАЛЯТЬ! 
            Это список того, что можно брать!!!!!!!!!!

            $what_to_take = [
                'companyList',
                'userData',
            ];

        */

        $result = [
            'ok' => true,
            'message' => '',
        ];

        if( in_array( 'userData', $what_to_take ) ){
            $result[ 'userData' ] = $this->GetUserDataFromModel( $request, $user );
        };

        if( in_array( 'companyList', $what_to_take ) ){
            $result[ 'companyList' ] = $this->GetCompanyList();
        };

        

        

        return $result;
    }

        

}


?>






