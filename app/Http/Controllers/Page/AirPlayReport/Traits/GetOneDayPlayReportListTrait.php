<?php 

namespace App\Http\Controllers\Page\AirPlayReport\Traits;

use Storage;

trait GetOneDayPlayReportListTrait{

    public function GetOneDayPlayReportList( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];
/*
        $result[ 'ok' ] = true;
        $companyAlias = $request['data']['companyAlias'];
        $date_string = $request[ 'data' ][ 'date_string' ];
        $result[ 'list' ] = [];
        $file = $companyAlias.'/'.$date_string.'.json';

        if( Storage::disk('play_report')->exists( $file ) ){
            $json = Storage::disk('play_report')->get( $file );
            $result[ 'list' ] = json_decode( $json );
        };
*/


        $date_string = $request[ 'data' ][ 'date_string' ];
        $companyAlias = $request['data']['companyAlias'];

        $carrent_sec = strtotime( $date_string );
        $preview_sec = $carrent_sec - 86400;
        $next_sec = $carrent_sec + 86400;

        $current_YYYY_MM_DD =   date('Y-m-d', $carrent_sec );
        $preview_YYYY_MM_DD =   date('Y-m-d', $preview_sec );
        $next_YYYY_MM_DD =      date('Y-m-d', $next_sec );

        $list = [];

        if( Storage::disk('play_report')->exists( $companyAlias.'/'.$preview_YYYY_MM_DD.'.json' ) ){
            $json = Storage::disk('play_report')->get( $companyAlias.'/'.$preview_YYYY_MM_DD.'.json' );
            $arr = json_decode( $json );

            for( $index = 0; $index < count($arr); $index++ ){
                $YYYY_MM_DD = $arr[$index]->date->YYYY_MM_DD;
                if( $YYYY_MM_DD === $current_YYYY_MM_DD ){
                    array_push( $list, $arr[$index] );
                };
            };

        };

        if( Storage::disk('play_report')->exists( $companyAlias.'/'.$current_YYYY_MM_DD.'.json' ) ){
            $json = Storage::disk('play_report')->get( $companyAlias.'/'.$current_YYYY_MM_DD.'.json' );
            $arr = json_decode( $json );
            for( $index = 0; $index < count($arr); $index++ ){
                $YYYY_MM_DD = $arr[$index]->date->YYYY_MM_DD;
                if( $YYYY_MM_DD === $current_YYYY_MM_DD ){
                    array_push( $list, $arr[$index] );
                };
            };
        };

        if( Storage::disk('play_report')->exists( $companyAlias.'/'.$next_YYYY_MM_DD.'.json' ) ){
            $json = Storage::disk('play_report')->get( $companyAlias.'/'.$next_YYYY_MM_DD.'.json' );
            $arr = json_decode( $json );
            for( $index = 0; $index < count($arr); $index++ ){
                $YYYY_MM_DD = $arr[$index]->date->YYYY_MM_DD;
                if( $YYYY_MM_DD === $current_YYYY_MM_DD ){
                    array_push( $list, $arr[$index] );
                };
            };
        };

        if( count( $list ) > 0 ){
            $len = count( $list );
            if( isset( $list[ $len - 2 ] ) ){
                $type = $list[ $len - 2 ]->type;
                if( $type === 'empty' ){
                    $timePoint_0 = $list[ $len - 2 ]->timePoint;
                    $timePoint_1 = $list[ $len - 1 ]->timePoint;
                    if( $timePoint_0 === $timePoint_1 ){
                        array_splice( $list, $len - 2, 1 );
                    };
                };
            };
        };


        $result[ 'list' ] = $list;
        $result[ 'ok' ] = true;

        return $result;
        
    }

}


?>
