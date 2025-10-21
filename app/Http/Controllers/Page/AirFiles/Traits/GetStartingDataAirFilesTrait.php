<?php 

namespace App\Http\Controllers\Page\AirFiles\Traits;

use App\Http\Controllers\Traits\GetStartingDataTrait;

trait GetStartingDataAirFilesTrait{

    use GetStartingDataTrait;

    public function GetStartingDataAirFiles( $request, $user ){

        $what_to_take = [
            'userData',
            'categoryList',
            'eventsList',
            'airFilePrefix',
        ];

        $result = $this->GetStartingData( $what_to_take, $request, $user );

        return $result;
        
    }

}


?>

