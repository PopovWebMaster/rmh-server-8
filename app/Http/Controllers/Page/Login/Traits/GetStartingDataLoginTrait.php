<?php 

namespace App\Http\Controllers\Page\Login\Traits;

use App\Http\Controllers\Traits\GetStartingDataTrait;

trait GetStartingDataLoginTrait{

    use GetStartingDataTrait;

    public function GetStartingDataLogin( $request, $user ){


        $what_to_take = [
            'userData',
        ];

        $result = $this->GetStartingData( $what_to_take, $request, $user );


        return $result;
        
    }

}


?>

