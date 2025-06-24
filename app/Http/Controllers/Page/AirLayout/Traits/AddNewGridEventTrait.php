<?php 

namespace App\Http\Controllers\Page\AirLayout\Traits;

use App\Http\Controllers\Traits\GetGridEventsListTrait;

use App\Http\Controllers\Traits\Validate\ValidateNewGridEventTrait;

use App\Models\Company;
use App\Models\GridEvents;

trait AddNewGridEventTrait{

    use ValidateNewGridEventTrait;
    use GetGridEventsListTrait;

    public function AddNewGridEvent( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $companyAlias = $request['data']['companyAlias'];

        $gridEventDayNum =          isset( $request['data']['dayNum'] )?        $request['data']['dayNum']: null;
        $gridEventIsAKeyPoint =     isset( $request['data']['isAKeyPoint'] )?   $request['data']['isAKeyPoint']: null;
        $gridEventStartTime =       isset( $request['data']['startTime'] )?     $request['data']['startTime']: null;
        $eventId =                  isset( $request['data']['eventId'] )?       $request['data']['eventId']: null;
        $gridEventDurationTime =    isset( $request['data']['durationTime'] )?  $request['data']['durationTime']: null;

        $validateNewGridEvent = $this->ValidateNewGridEvent([
            'gridEventDayNum' =>        $gridEventDayNum,
            'gridEventIsAKeyPoint' =>   $gridEventIsAKeyPoint,
            'gridEventStartTime' =>     $gridEventStartTime,
            'eventId' =>                $eventId,
            'gridEventDurationTime' =>  $gridEventDurationTime,
        ]);

        if( $validateNewGridEvent[ 'fails' ] ){
            $result[ 'message' ] = $validateNewGridEvent[ 'message' ];
        }else{
            $result[ 'ok' ] = true;

            $company = Company::where( 'alias', '=', $companyAlias )->first();
            $company_id = $company->id;

            $gridEvents = new GridEvents;
            $gridEvents->company_id =       $company_id;
            $gridEvents->day_num =          $gridEventDayNum;
            $gridEvents->is_a_key_point =   $gridEventIsAKeyPoint;
            $gridEvents->start_time =       $gridEventStartTime;
            $gridEvents->duration_time =    $gridEventDurationTime;
            $gridEvents->event_id =         $eventId;

            $gridEvents->save();

            $result[ 'list' ] = $this->GetGridEventsList( $companyAlias );

        };

                

        return $result;
        
    }

}


?>

