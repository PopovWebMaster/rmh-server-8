<?php 

namespace App\Http\Controllers\Page\AirPlayReport\Traits;

use Storage;

trait GetOneDayPlayReportListTrait{

    public function GetOneDayPlayReportList( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $result[ 'ok' ] = true;
        $companyAlias = $request['data']['companyAlias'];
        $date_string = $request[ 'data' ][ 'date_string' ];
        $result[ 'list' ] = [];
        $file = $companyAlias.'/'.$date_string.'.json';

        if( Storage::disk('play_report')->exists( $file ) ){
            $json = Storage::disk('play_report')->get( $file );
            $result[ 'list' ] = json_decode( $json );
        };

        return $result;
        
    }

}


?>
