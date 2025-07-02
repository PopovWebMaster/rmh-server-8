<?php 

namespace App\Http\Controllers\Page\AirLayout\Traits;

use App\Http\Controllers\Traits\GetEventsListTrait;
use App\Http\Controllers\Traits\Validate\ValidateOneEventTrait;

use App\Models\Company;
use App\Models\Events;
use App\Models\GridEvents;

trait SaveOneEventDataTrait{

    use ValidateOneEventTrait;
    use GetEventsListTrait;

    public function SaveOneEventData( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $companyAlias = $request['data']['companyAlias'] ;

        $eventId =              isset( $request[ 'data'][ 'eventId' ] )?            $request[ 'data'][ 'eventId' ] :            null;
        $categoryId =           isset( $request[ 'data'][ 'categoryId' ] )?         $request[ 'data'][ 'categoryId' ] :         null;
        $eventName =            isset( $request[ 'data'][ 'eventName' ] )?          $request[ 'data'][ 'eventName' ] :          null;
        $eventNotes =           isset( $request[ 'data'][ 'eventNotes' ] )?         $request[ 'data'][ 'eventNotes' ] :         null;
        $eventType =            isset( $request[ 'data'][ 'eventType' ] )?          $request[ 'data'][ 'eventType' ] :          null;
        $eventDurationTime =    isset( $request[ 'data'][ 'eventDurationTime' ] )?  $request[ 'data'][ 'eventDurationTime' ] :  null;

        $durationSec =          isset( $request[ 'data'][ 'durationSec' ] )?        $request[ 'data'][ 'durationSec' ] :        null;

        /*
            $durationSec добавляется только когда меняется время в событии
            он нужен только для того чтоб в событиях сетки время перебить;

            ПО СУТИ ЭТО КОСТЫЛЬ? потому чт я тупанул и сделал разный формат для времени duration в событиях и событиях сетки

        */


        $validate = $this->ValidateOneEvent([
            'eventName' =>          $eventName,
            'eventNotes' =>         $eventNotes,
            'eventType' =>          $eventType,
            'categoryId' =>         $categoryId,
            'eventDurationTime' =>  $eventDurationTime,

        ]);

        if( $validate[ 'fails' ] ){
            array_push( $result[ 'message' ], $validate[ 'message' ]);
        }else{

            $result[ 'ok' ] = true;

            $company = Company::where( 'alias', '=', $companyAlias )->first();
            $company_id = $company->id;

            $events = Events::where( 'id', '=', $eventId )
                            ->where( 'company_id', '=', $company_id )
                            ->first();

            if( $events !== null ){

                $events->category_id = $categoryId;
                $events->notes = $eventNotes;
                $events->name = $eventName;
                $events->durationTime = $eventDurationTime;
                $events->save();

                $gridEvents = GridEvents::where( 'company_id', '=', $company_id )->where( 'event_id', '=', $eventId )->get();

                foreach( $gridEvents as $model ){
                    $model->notes = $eventNotes;
                    
                    if( $durationSec !== null ){
                        $model->duration_time = $durationSec;
                    };

                    $model->save();
                };

                
            };

            $result[ 'list' ] = $this->GetEventsList( $companyAlias );

        };
        return $result;


    }

}


?>

