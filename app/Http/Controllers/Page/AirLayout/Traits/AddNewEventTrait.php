<?php 

namespace App\Http\Controllers\Page\AirLayout\Traits;

use App\Http\Controllers\Traits\GetEventsListTrait;
use App\Http\Controllers\Traits\Validate\ValidateOneEventTrait;

use App\Models\Company;
use App\Models\Events;

trait AddNewEventTrait{

    use ValidateOneEventTrait;
    use GetEventsListTrait;

    public function AddNewEvent( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $companyAlias = $request['data']['companyAlias'];

        $eventName =            isset( $request['data']['eventName'] )?         $request['data']['eventName']: null;
        $eventNotes =           isset( $request['data']['eventNotes'] )?        $request['data']['eventNotes']: null;
        $eventType =            isset( $request['data']['eventType'] )?         $request['data']['eventType']: null;
        $categoryId =           isset( $request['data']['categoryId'] )?        $request['data']['categoryId']: null;
        $eventDurationTime =    isset( $request['data']['eventDurationTime'] )? $request['data']['eventDurationTime']: null;

        $validateOneEvent = $this->ValidateOneEvent([
            'eventName' =>          $eventName,
            'eventNotes' =>         $eventNotes,
            'eventType' =>          $eventType,
            'categoryId' =>         $categoryId,
            'eventDurationTime' =>  $eventDurationTime,
        ]);

        if( $validateOneEvent[ 'fails' ] ){
            $result[ 'message' ] = $validateOneEvent[ 'message' ];
        }else{
            $result[ 'ok' ] = true;

            $company = Company::where( 'alias', '=', $companyAlias )->first();
            $company_id = $company->id;

            $events = new Events;

            $events->company_id =   $company_id;
            $events->category_id =  $categoryId;
            $events->name =         $eventName;
            $events->notes =        $eventNotes;
            $events->type =         $eventType;
            $events->durationTime = $eventDurationTime;

            $events->save();

            $result[ 'list' ] = $this->GetEventsList( $companyAlias );

        };




        return $result;
        
    }

}


?>

