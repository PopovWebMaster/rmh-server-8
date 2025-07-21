<?php 

namespace App\Http\Controllers\Page\AirSchedule\Traits;

use App\Http\Controllers\Traits\GetStartingDataTrait;

trait GetStartingDataAirScheduleTrait{

    use GetStartingDataTrait;

    public function GetStartingDataAirSchedule( $request, $user ){

        $what_to_take = [
            'userData',
            'categoryList',
            'eventsList',
            'gridEventsList',
        ];

        $result = $this->GetStartingData( $what_to_take, $request, $user );

        return $result;
        
    }

}


?>

