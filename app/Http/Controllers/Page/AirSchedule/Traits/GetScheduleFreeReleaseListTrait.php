<?php 

namespace App\Http\Controllers\Page\AirSchedule\Traits;

// use Validator;

use App\Http\Controllers\Page\AirSchedule\Traits\GetFreeReleasesListTrait;


trait GetScheduleFreeReleaseListTrait{

    use GetFreeReleasesListTrait;

    public function GetScheduleFreeReleaseList( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $companyAlias = $request['data']['companyAlias'];

        $result[ 'ok' ] = true;
        $result[ 'freeReleaseList' ] = $this->GetFreeReleasesList( $companyAlias );

        return $result;
        
    }

}


?>

