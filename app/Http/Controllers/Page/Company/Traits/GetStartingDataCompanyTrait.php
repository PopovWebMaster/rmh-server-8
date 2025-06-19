<?php 

namespace App\Http\Controllers\Page\Company\Traits;

use App\Http\Controllers\Traits\GetStartingDataTrait;

trait GetStartingDataCompanyTrait{

    use GetStartingDataTrait;

    public function GetStartingDataCompany( $request, $user ){

        $what_to_take = [
            'userData',
        ];

        $result = $this->GetStartingData( $what_to_take, $request, $user );

        return $result;
        
    }

}


?>

