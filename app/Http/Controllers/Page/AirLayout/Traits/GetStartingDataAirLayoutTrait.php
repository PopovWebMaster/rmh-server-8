<?php 

namespace App\Http\Controllers\Page\AirLayout\Traits;

use App\Http\Controllers\Traits\GetStartingDataTrait;

trait GetStartingDataAirLayoutTrait{

    use GetStartingDataTrait;

    public function GetStartingDataAirLayout( $request, $user ){

        $what_to_take = [
            'userData',
            'keyPountList',
            'categoryList',
            'eventsList',
        ];

        $result = $this->GetStartingData( $what_to_take, $request, $user );

        return $result;
        
    }

}


?>

