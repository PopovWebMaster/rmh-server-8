<?php 

namespace App\Http\Controllers\Page\AirApplications\Traits;

use App\Http\Controllers\Traits\GetStartingDataTrait;

trait GetStartingApplicationListTrait{

    use GetStartingDataTrait;

    public function GetStartingApplicationList( $request, $user ){

        $what_to_take = [
            'applicationList',
        ];

        $result = $this->GetStartingData( $what_to_take, $request, $user );


        return $result;
        
    }

}


?>

