<?php 

namespace App\Http\Controllers\Page\AirPlayReport\Traits;

use Storage;

use App\Http\Controllers\Traits\Validate\ValidateYYYYMMDDTrait;
use App\Http\Controllers\Page\AirPlayReport\Traits\AddFileDataToPlayReportListTrait;

use Validator;

trait GetEntierListForAdvancedSearchTrait{

    use ValidateYYYYMMDDTrait;
    use AddFileDataToPlayReportListTrait;

    public function GetEntierListForAdvancedSearch( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $companyAlias = $request['data']['companyAlias'];

        $result[ 'ok' ] = true;

        $dataFrom =         isset( $request[ 'data' ][ 'dataFrom' ] )?          $request[ 'data' ][ 'dataFrom' ]:       null;
        $dataTo =           isset( $request[ 'data' ][ 'dataTo' ] )?            $request[ 'data' ][ 'dataTo' ]:         null;
        $requestList =      isset( $request[ 'data' ][ 'requestList' ] )?       $request[ 'data' ][ 'requestList' ]:    null;
        $isOnlyPremiers =   isset( $request[ 'data' ][ 'isOnlyPremiers' ] )?    $request[ 'data' ][ 'isOnlyPremiers' ]: null;

        $validate = $this->ValidateRequestData_GEL( $request );
        if( $validate[ 'ok' ] === false ){
            $result = $validate;
        }else{

            $files = $this->GetArrayOfFiles( $dataFrom, $dataTo, $companyAlias );

            $result[ 'files' ] = $files;

            usort( $requestList, function( $a, $b ){
                $la = strlen( $a );
                $lb = strlen( $b );
                if( $la == $lb ) {
                    return strcmp( $a, $b );
                };
                return $lb - $la;
            });

            $result[ 'requestList' ] = $requestList;
            // $result[ 'list' ] = [];

            $list = [];

            $premiers = [];

            for( $i = 0; $i < count( $files ); $i++ ){
                if( Storage::disk('play_report')->exists( $files[ $i ] ) ){
                    $json = Storage::disk('play_report')->get( $files[ $i ] );
                    $arr = json_decode( $json );

                    for( $index = 0; $index < count( $arr ); $index++ ){
                        $type = $arr[$index]->type;
                        if( $type === 'movie' ){

                            $fileName = mb_convert_case( $arr[$index]->file->name, MB_CASE_UPPER );

                            $makeSearch = false;

                            if( $isOnlyPremiers ){
                                if( in_array( $fileName, $premiers ) ){
                                    $makeSearch = false;
                                }else{
                                    $makeSearch = true;
                                };
                            }else{
                                $makeSearch = true;
                            };

                            if( $makeSearch ){
                                for( $y = 0; $y < count( $requestList ); $y++ ){
                                    $searchValue = mb_convert_case( $requestList[ $y ], MB_CASE_UPPER );
                                    if( strpos( $fileName, $searchValue ) !== false ){
                                        array_push( $list, $arr[$index] );

                                        if( $isOnlyPremiers ){
                                            array_push( $premiers, $fileName );
                                        };
                                        break;
                                    };
                                };
                            };

                        };
                    };

                };

            };

            // $result[ 'list' ] = [];

            $list_with_file_data = $this->AddFileDataToPlayReportList([
                'companyAlias' => $companyAlias,
                'playReportList' => $list,

            ]);

            $result[ 'list' ] = $list_with_file_data;


        };



        return $result;
        
    }

    private function ValidateRequestData_GEL( $request ){
        $result = [
            'ok' => false,
            'message' => '',
        ];

        $dataFrom =         isset( $request[ 'data' ][ 'dataFrom' ] )?          $request[ 'data' ][ 'dataFrom' ]:       null;
        $dataTo =           isset( $request[ 'data' ][ 'dataTo' ] )?            $request[ 'data' ][ 'dataTo' ]:         null;
        $requestList =      isset( $request[ 'data' ][ 'requestList' ] )?       $request[ 'data' ][ 'requestList' ]:    null;
        $isOnlyPremiers =   isset( $request[ 'data' ][ 'isOnlyPremiers' ] )?    $request[ 'data' ][ 'isOnlyPremiers' ]: null;

        $validateDateFrom = $this->ValidateYYYYMMDD( $dataFrom );

        if( $validateDateFrom[ 'fails' ] ){
            $result[ 'message' ] = 'Валидация запроса не пройдена! dataFrom - '.$dataFrom;
        }else{
            $validateDateTo = $this->ValidateYYYYMMDD( $dataTo );
            if( $validateDateTo[ 'fails' ] ){
                $result[ 'message' ] = 'Валидация запроса не пройдена! dataTo - '.$dataTo;
            }else{

                 $validate = Validator::make( [ 
                    'requestList' => $requestList,
                    'isOnlyPremiers' => $isOnlyPremiers,

                ], [
                    'requestList' =>        [ 'required', 'array' ],
                    'requestList.*' =>      [ 'required', 'string' ],
                    'isOnlyPremiers' =>     [ 'required', 'boolean' ],
                ]);

                if( $validate->fails() ){
                    $result[ 'message' ] = $validate->getMessageBag()->all();
                }else{
                    $result[ 'ok' ] = true;
                };
            };
        };

        return $result;
    }

    private function GetArrayOfFiles( $dataFrom, $dataTo, $companyAlias ){

        $result = [];

        $from_sec = strtotime( $dataFrom );
        $to_sec = strtotime( $dataTo );

        $next_sec = $from_sec;

        do{
            $YYYY_MM_DD = date('Y-m-d', $next_sec );
            $file = $companyAlias.'/'.$YYYY_MM_DD.'.json';
            array_push( $result, $file );
            $next_sec = $next_sec + 86400;
        }while( $next_sec <= $to_sec );

        return $result;
    }

}


?>
