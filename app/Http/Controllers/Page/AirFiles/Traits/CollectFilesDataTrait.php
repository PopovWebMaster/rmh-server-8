<?php 

namespace App\Http\Controllers\Page\AirFiles\Traits;

use Validator;

use App\Models\Company;
use App\Models\AirFilePrefix;
use App\Models\AirFileNames;

use App\Models\Events;


use Storage;

use App\Http\Controllers\Traits\Validate\ValidateYYYYMMDDTrait;


trait CollectFilesDataTrait{

    use ValidateYYYYMMDDTrait;

    public function CollectFilesData( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $companyAlias = $request['data']['companyAlias'];

        $periodFrom =   isset( $request['data']['periodFrom'] )?    $request['data']['periodFrom']: null;
        $periodTo =     isset( $request['data']['periodTo'] )?      $request['data']['periodTo']: null;

        $validateFrom = $this->ValidateYYYYMMDD( $periodFrom );
        if( $validateFrom[ 'fails' ] ){
            $result[ 'message' ] = 'не валиден период от';
        }else{
            $validateTo = $this->ValidateYYYYMMDD( $periodTo );
            if( $validateTo[ 'fails' ] ){
                $result[ 'message' ] = 'не валиден период до';
            }else{
                $company = Company::where( 'alias', '=', $companyAlias )->first();
                $company_id = $company->id;

                $jsonFiles = $this->GetArrayOfFiles_( $periodFrom, $periodTo, $companyAlias );
                $airFiles = [];

                for( $i = 0; $i < count( $jsonFiles ); $i++ ){
                    $jsonFile = $jsonFiles[ $i ];
                    if(  Storage::disk('play_report')->exists( $jsonFile ) ){
                        $json = Storage::disk('play_report')->get( $jsonFile );
                        $arr = json_decode( $json );

                        for( $index = 0; $index < count($arr); $index++ ){
                            $type = $arr[$index]->type;
                            if( $type === 'movie' ){
                                $name = $arr[$index]->file->name;

                                $dateMs =       $arr[$index]->date->ms;
                                $startTimeMs =  $arr[$index]->startTime->ms;

                                $premiereSec = ( $dateMs + $startTimeMs )/1000;

                                if( isset( $airFiles[ $name ] ) ){
                                    $airFiles[ $name ][ 'count' ] = $airFiles[ $name ][ 'count' ] + 1;
                                    if( $airFiles[ $name ][ 'premiereSec' ] > $premiereSec ){
                                        $airFiles[ $name ][ 'premiereSec' ] = $premiereSec;
                                    };
                                }else{
                                    $event_id = null;
                                    $premiere_sec = null;

                                    $airFileNames = AirFileNames::where( 'name', '=', $name )->where( 'company_id', '=', $company_id ) ->first();

                                    if( $airFileNames !== null ){
                                        $event_id =     $airFileNames->event_id;
                                        $premiere_sec = $airFileNames->premiere_sec;

                                    };

                                    if( $premiere_sec !== null ){
                                        if( $premiere_sec < $premiereSec ){
                                            $premiereSec = $premiere_sec;
                                        }else if( $premiereSec < $premiere_sec ){
                                            $airFileNames->premiere_sec = $premiereSec;
                                            $airFileNames->save();
                                        };
                                    };

                                    $airFiles[ $name ] = [
                                        'premiereSec' => $premiereSec,
                                        'count' => 1,
                                        'event_id' => $event_id,

                                    ];

                                };


                            };
                        };
                    };
                    

                };

                $result[ 'airFiles' ] = $airFiles;

                $result[ 'ok' ] = true;
            };
        };

        return $result;
        
    }

    
    private function GetArrayOfFiles_( $dataFrom, $dataTo, $companyAlias ){

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

