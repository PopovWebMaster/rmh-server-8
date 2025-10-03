<?php 

namespace App\Http\Controllers\Page\AirPlayReport\Traits;

use Storage;

trait GetEntierListForSearchValueTrait{

    public function GetEntierListForSearchValue( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];


        $companyAlias = $request['data']['companyAlias'];

        $result[ 'ok' ] = true;
        $searchPeriod = $request[ 'data' ][ 'searchPeriod' ];
        $searchValue = mb_convert_case( $request[ 'data' ][ 'searchValue' ], MB_CASE_UPPER );

        $result[ 'list' ] = [];

        if( $searchPeriod === 'all' ){

            $files = Storage::disk('play_report')->files( $companyAlias );

            for( $i = 0; $i < count( $files ); $i++ ){

                $file = $files[ $i ];
                $json = Storage::disk('play_report')->get( $file );

                $arr = json_decode( $json );

                for( $index = 0; $index < count($arr); $index++ ){
                    $type = $arr[$index]->type;
                    if( $type === 'movie' ){
                        $fileName = mb_convert_case( $type = $arr[$index]->file->name, MB_CASE_UPPER );

                        if( strpos( $fileName, $searchValue ) !== false ){
                            array_push( $result[ 'list' ], $arr[$index] );
                        }else{

                            for( $gi = 0; $gi < count( $arr[$index]->graphics ); $gi++ ){
                                $GfileName = mb_convert_case( $arr[ $index ]->graphics[ $gi ]->file->name, MB_CASE_UPPER );
                                if( strpos( $GfileName, $searchValue ) !== false ){
                                    array_push( $result[ 'list' ], $arr[$index] );
                                    break;
                                };
                            };

                        };
                    };
                };
            };
        }else{
            $files = Storage::disk('play_report')->files( $companyAlias );

            $mouthFiles = [];

            for( $i = 0; $i < count( $files ); $i++ ){
                if( strpos( $files[ $i ], $searchPeriod ) !== false ){
                    array_push( $mouthFiles, $files[ $i ] );
                };
            };

            for( $i = 0; $i < count( $mouthFiles ); $i++ ){
                $file = $mouthFiles[ $i ];
                $json = Storage::disk('play_report')->get( $file );

                $arr = json_decode( $json );

                for( $index = 0; $index < count($arr); $index++ ){
                    $type = $arr[$index]->type;
                    if( $type === 'movie' ){
                        $fileName = mb_convert_case( $arr[$index]->file->name, MB_CASE_UPPER );

                        if( strpos( $fileName, $searchValue ) !== false ){
                            array_push( $result[ 'list' ], $arr[$index] );
                        }else{
                            for( $gi = 0; $gi < count( $arr[$index]->graphics ); $gi++ ){
                                $GfileName = mb_convert_case( $arr[ $index ]->graphics[ $gi ]->file->puth, MB_CASE_UPPER );
                                if( strpos( $GfileName, $searchValue ) !== false ){
                                    array_push( $result[ 'list' ], $arr[$index] );
                                    break;
                                };
                            };
                        };
                    };
                };
            };
        };

        return $result;
        
    }

}


?>
