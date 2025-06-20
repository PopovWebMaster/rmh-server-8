<?php 

namespace App\Http\Controllers\Page\AirLogs\Traits;

use App\Http\Controllers\Traits\GetStartingDataTrait;

trait GetStartingDataAirLogsTrait{

    use GetStartingDataTrait;

    public function GetStartingDataAirLogs( $request, $user ){

        $what_to_take = [
            'userData',
            'programSystem'
        ];

        $result = $this->GetStartingData( $what_to_take, $request, $user );

        return $result;
        
    }

}


?>

