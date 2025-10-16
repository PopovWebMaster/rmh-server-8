<?php 

namespace App\Http\Controllers\Page\AirSchedule\Traits;

use App\Http\Controllers\Traits\Validate\ValidateYYYYMMDDTrait;
use App\Http\Controllers\Traits\Validate\ValidateScheduleListTrait;

use App\Models\Company;

use Storage;


trait SaveScheduleListTrait{

    use ValidateYYYYMMDDTrait;
    use ValidateScheduleListTrait;

    public function SaveScheduleList( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $companyAlias = isset( $request['data']['companyAlias'] )?  $request['data']['companyAlias']:   null;
        $list =         isset( $request['data']['list'] )?          $request['data']['list']:           null;
        $YYYY_MM_DD =   isset( $request['data']['YYYY_MM_DD'] )?    $request['data']['YYYY_MM_DD']:     null;

        $validateYYYY_MM_DD = $this->ValidateYYYYMMDD( $YYYY_MM_DD );
        if( $validateYYYY_MM_DD[ 'fails' ] ){
            $result[ 'message' ] = $validateYYYY_MM_DD[ 'message' ];
        }else{
            // $validateList = $this->ValidateScheduleList( $YYYY_MM_DD );
            // if( $validateList[ 'fails' ] ){
            //     $result[ 'message' ] = $validateList[ 'message' ];
            // }else{
                $result[ 'ok' ] = true;

                $json = json_encode( $list, JSON_UNESCAPED_UNICODE );

                $puth = $companyAlias.'/'.$YYYY_MM_DD.'.json';

                if( Storage::disk('schedule_result')->exists( $puth ) ){
                    Storage::disk('schedule_result')->delete( $puth );
                };

                $disk = Storage::disk('schedule_result')->put( $puth, $json );



            // };

        };
        return $result;
        
    }

}


?>

