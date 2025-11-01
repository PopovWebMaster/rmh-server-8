<?php 

namespace App\Http\Controllers\Page\AirPlayReport\Traits;

use Storage;

use App\Models\AirFileNames;
use App\Models\Company;
use App\Models\Events;

trait AddFileDataToPlayReportListTrait{

    public function AddFileDataToPlayReportList( $params ){

        $companyAlias =     $params[ 'companyAlias' ];
        $playReportList =   $params[ 'playReportList' ];

        $result = [];

        $company = Company::where( 'alias', '=', $companyAlias )->first();
        $company_id = $company->id;

        for( $index = 0; $index < count($playReportList); $index++ ){

            $type = $playReportList[$index]->type;
            $premiere_YYYY_MM_DD = null;
            $premiere_sec = null;
            $premiere_startTime = null;

            $file_eventId = null;

            $isPremiere = false;

            if( $type === 'movie' ){
                $fileName = $playReportList[ $index ]->file->name;

                $airFileNames = AirFileNames::where( 'company_id', '=', $company_id )->where( 'name', '=', $fileName )->first();
                if( $airFileNames !== null ){
                    $file_eventId = $airFileNames->event_id;


                    $eventModel = Events::where( 'company_id', '=', $company_id )->where( 'id', '=', $file_eventId )->first();
                    if( $eventModel === null ){
                        $file_eventId = null;
                    };

                    $premiere_sec = $airFileNames->premiere_sec;
                    $premiere_YYYY_MM_DD = date( "Y-m-d",  $premiere_sec );
                    $strT = strtotime( $premiere_YYYY_MM_DD );
                    $premiere_startTime = $premiere_sec - $strT;

                    if( $premiere_YYYY_MM_DD === $playReportList[ $index ]->date->YYYY_MM_DD ){
                        $itemStartTime = $playReportList[ $index ]->startTime->ms / 1000;

                        if( $premiere_startTime === $itemStartTime ){
                            $isPremiere = true;
                        };

                    };




                };

            };

            $playReportList[ $index ]->premiere = [
                'YYYY_MM_DD' => $premiere_YYYY_MM_DD,
                'date_sec' => $premiere_sec,
                'startTime' => $premiere_startTime,
                'isPremiere' => $isPremiere,
            ];
            $playReportList[ $index ]->eventId = $file_eventId;

            array_push( $result, $playReportList[ $index ] );

        };

        return $result;
        
    }

}


?>
