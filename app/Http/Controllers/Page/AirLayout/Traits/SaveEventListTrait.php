<?php 

namespace App\Http\Controllers\Page\AirLayout\Traits;

use App\Http\Controllers\Traits\GetEventsListTrait;
use App\Http\Controllers\Traits\Validate\ValidateOneEventTrait;

use App\Models\Company;
use App\Models\Events;

trait SaveEventListTrait{

    use ValidateOneEventTrait;
    use GetEventsListTrait;

    public function SaveEventList( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $companyAlias = $request['data']['companyAlias'] ;

        $result[ 'ok' ] = true;

        $list =  $request['data']['list'];

        $company = Company::where( 'alias', '=', $companyAlias )->first();
        $company_id = $company->id;

        $result[ 'message' ] = [];

        for( $i = 0; $i < count( $list ); $i++ ){

            $eventId =              isset( $list[ $i ][ 'id' ] )?           $list[ $i ][ 'id' ]:            null;
            $categoryId =           isset( $list[ $i ][ 'category_id' ] )?  $list[ $i ][ 'category_id' ]:   null;
            $eventName =            isset( $list[ $i ][ 'name' ] )?         $list[ $i ][ 'name' ]:          null;
            $eventNotes =           isset( $list[ $i ][ 'notes' ] )?        $list[ $i ][ 'notes' ]:         null;
            $eventType =            isset( $list[ $i ][ 'type' ] )?         $list[ $i ][ 'type' ]:          null;
            $eventDurationTime =    isset( $list[ $i ][ 'durationTime' ] )? $list[ $i ][ 'durationTime' ]:  null;

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

                $events = Events::where( 'id', '=', $eventId )
                                ->where( 'company_id', '=', $company_id )
                                ->first();

                if( $events !== null ){
                    $events->category_id = $categoryId;
                    $events->notes = $eventNotes;
                    $events->name = $eventName;
                    $events->durationTime = $eventDurationTime;
                    $events->save();
                };

            };

        };

        $result[ 'list' ] = $this->GetEventsList( $companyAlias );


        return $result;
        
    }

}


?>

