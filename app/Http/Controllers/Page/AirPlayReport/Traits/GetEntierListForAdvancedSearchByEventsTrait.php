<?php 

namespace App\Http\Controllers\Page\AirPlayReport\Traits;

use Storage;

use App\Http\Controllers\Traits\Validate\ValidateYYYYMMDDTrait;

use Validator;

use App\Models\AirFileNames;
use App\Models\Company;



trait GetEntierListForAdvancedSearchByEventsTrait{

    use ValidateYYYYMMDDTrait;

    public function GetEntierListForAdvancedSearchByEvents( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $companyAlias = $request['data']['companyAlias'];

        $result[ 'ok' ] = true;

        $dataFrom =         isset( $request[ 'data' ][ 'dataFrom' ] )?          $request[ 'data' ][ 'dataFrom' ]:       null;
        $dataTo =           isset( $request[ 'data' ][ 'dataTo' ] )?            $request[ 'data' ][ 'dataTo' ]:         null;
        $eventList =        isset( $request[ 'data' ][ 'eventList' ] )?       $request[ 'data' ][ 'eventList' ]:    null;
        $isOnlyPremiers =   isset( $request[ 'data' ][ 'isOnlyPremiers' ] )?    $request[ 'data' ][ 'isOnlyPremiers' ]: null;

        $validate = $this->ValidateRequestData_GEL_BE( $request );
        if( $validate[ 'ok' ] === false ){
            $result = $validate;
        }else{

            $company = Company::where( 'alias', '=', $companyAlias )->first();
            $company_id = $company->id;

            $fileNames = [];

            for( $i = 0; $i < count( $eventList ); $i++ ){
                $airFileNames = AirFileNames::where( 'company_id', '=', $company_id )->where( 'event_id', '=', $eventList[ $i ] )->get();
                foreach( $airFileNames as $item ){
                    // $fileNames[ $item->name ] = $item->premiere_sec;
                    // $fileNames[ $item->name ] = date( "Y-m-d", time() + $item->premiere_sec );
                    $fileNames[ $item->name ] = date( "Y-m-d",  $item->premiere_sec );



                    // date( "Y-m-d", time() + $var );
                };
            };

            $result[ 'fileNames' ] = $fileNames;

            $files = $this->GetArrayOfFiles_BE( $dataFrom, $dataTo, $companyAlias );

            $premiers = [];

            $result[ 'list' ] = [];


            for( $i = 0; $i < count( $files ); $i++ ){
                if( Storage::disk('play_report')->exists( $files[ $i ] ) ){
                    $json = Storage::disk('play_report')->get( $files[ $i ] );
                    $arr = json_decode( $json );

                    for( $index = 0; $index < count( $arr ); $index++ ){
                        $type = $arr[$index]->type;
                        if( $type === 'movie' ){

                            // $fileName = mb_convert_case( $arr[$index]->file->name, MB_CASE_UPPER );
                            $fileName = $arr[$index]->file->name;

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
                                if( isset( $fileNames[ $fileName ] ) ){
                                    if( $isOnlyPremiers ){
                                        if( $fileNames[ $fileName ] === $arr[$index]->date->YYYY_MM_DD ){
                                            array_push( $result[ 'list' ], $arr[$index] );
                                            array_push( $premiers, $fileName );
                                        };
                                    }else{
                                         array_push( $result[ 'list' ], $arr[$index] );   
                                    };
                                };
                            };

                        };
                    };

                };

            };

            $result[ 'ok' ] = true;


        };



        return $result;
        
    }

    private function ValidateRequestData_GEL_BE( $request ){
        $result = [
            'ok' => false,
            'message' => '',
        ];

        $dataFrom =         isset( $request[ 'data' ][ 'dataFrom' ] )?          $request[ 'data' ][ 'dataFrom' ]:       null;
        $dataTo =           isset( $request[ 'data' ][ 'dataTo' ] )?            $request[ 'data' ][ 'dataTo' ]:         null;
        $eventList =        isset( $request[ 'data' ][ 'eventList' ] )?         $request[ 'data' ][ 'eventList' ]:    null;
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
                    'eventList' => $eventList,
                    'isOnlyPremiers' => $isOnlyPremiers,

                ], [
                    'eventList' =>        [ 'required', 'array' ],
                    'eventList.*' =>      [ 'required', 'exists:events,id' ],
                    'isOnlyPremiers' =>   [ 'required', 'boolean' ],
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

    private function GetArrayOfFiles_BE( $dataFrom, $dataTo, $companyAlias ){

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
