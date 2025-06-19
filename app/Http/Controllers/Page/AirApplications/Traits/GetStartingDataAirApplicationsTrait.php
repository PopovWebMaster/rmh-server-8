<?php 

namespace App\Http\Controllers\Page\AirApplications\Traits;

use App\Http\Controllers\Traits\GetStartingDataTrait;

trait GetStartingDataAirApplicationsTrait{

    use GetStartingDataTrait;

    public function GetStartingDataAirApplications( $request, $user ){

        $what_to_take = [
            'userData',
        ];

        $result = $this->GetStartingData( $what_to_take, $request, $user );

        return $result;
        
    }

}


?>

