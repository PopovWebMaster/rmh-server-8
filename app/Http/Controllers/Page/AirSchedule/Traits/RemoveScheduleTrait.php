<?php 

namespace App\Http\Controllers\Page\AirSchedule\Traits;

use App\Http\Controllers\Traits\Validate\ValidateYYYYMMDDTrait;
use App\Http\Controllers\Page\AirSchedule\Traits\GetAllScheduleFileNamesTrait;

use App\Models\Company;

use Storage;


trait RemoveScheduleTrait{

    use ValidateYYYYMMDDTrait;
    use GetAllScheduleFileNamesTrait;

    public function RemoveSchedule( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $companyAlias = isset( $request['data']['companyAlias'] )?  $request['data']['companyAlias']:   null;
        $YYYY_MM_DD =   isset( $request['data']['YYYY_MM_DD'] )?    $request['data']['YYYY_MM_DD']:     null;

        $validateYYYY_MM_DD = $this->ValidateYYYYMMDD( $YYYY_MM_DD );
        if( $validateYYYY_MM_DD[ 'fails' ] ){
            $result[ 'message' ] = $validateYYYY_MM_DD[ 'message' ];
        }else{

            $puth = $companyAlias.'/'.$YYYY_MM_DD.'.json';
            if( Storage::disk('schedule_result')->exists( $puth ) ){
                Storage::disk('schedule_result')->delete( $puth );
            };
            $result[ 'ok' ] = true;
            $result[ 'allScheduleFileNames' ] = $this->GetAllScheduleFileNames( $request, $user );


        };

        return $result;
        
    }

}


?>

