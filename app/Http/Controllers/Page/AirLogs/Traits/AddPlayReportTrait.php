<?php 

namespace App\Http\Controllers\Page\AirLogs\Traits;

use Storage;

trait AddPlayReportTrait{

    public function AddPlayReport( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $companyAlias = $request['data']['companyAlias'];

        $json = json_encode( $request[ 'data' ][ 'list' ] , JSON_UNESCAPED_UNICODE );
        $puth = $companyAlias.'/'.$request[ 'data' ][ 'date' ].'.json';

        if( Storage::disk('play_report')->exists( $puth ) ){
            Storage::disk('play_report')->delete( $puth );
        };

        $disk = Storage::disk('play_report')->put( $puth, $json );

        return $result;
        
    }

}


?>
