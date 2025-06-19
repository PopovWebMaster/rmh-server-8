<?php 

namespace App\Http\Controllers\Page\AirMain\Traits;

use App\Http\Controllers\Traits\GetStartingDataTrait;

trait GetStartingDataAirMainTrait{

    use GetStartingDataTrait;

    public function GetStartingDataAirMain( $request, $user ){

        $what_to_take = [
            'userData',
        ];

        $result = $this->GetStartingData( $what_to_take, $request, $user );

        return $result;
        
    }

}


?>

