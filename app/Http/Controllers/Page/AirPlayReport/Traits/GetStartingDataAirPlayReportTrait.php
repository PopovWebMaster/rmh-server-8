<?php 

namespace App\Http\Controllers\Page\AirPlayReport\Traits;

use App\Http\Controllers\Traits\GetStartingDataTrait;

trait GetStartingDataAirPlayReportTrait{

    use GetStartingDataTrait;

    public function GetStartingDataAirPlayReport( $request, $user ){

        $what_to_take = [
            'userData',
            'playReportFiles',
            'categoryList',
            'eventsList',
        ];

        $result = $this->GetStartingData( $what_to_take, $request, $user );

        return $result;
        
    }

}


?>

