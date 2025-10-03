<?php 

namespace App\Http\Controllers\Page\AirLayout\Traits;

use App\Http\Controllers\Traits\Validate\ValidateEventIdTrait;
use App\Http\Controllers\Traits\GetEventsListTrait;
use App\Http\Controllers\Traits\GetGridEventsListTrait;

use App\Models\Company;
use App\Models\Events;
use App\Models\GridEvents;
use App\Models\Application;





trait RemoveEventTrait{

    use ValidateEventIdTrait;
    use GetEventsListTrait;
    use GetGridEventsListTrait;

    public function RemoveEvent( $request, $user ){

        

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $companyAlias = $request['data']['companyAlias'];

        $company = Company::where( 'alias', '=', $companyAlias )->first();
        $company_id = $company->id;

        $eventId = isset( $request['data']['eventId'] )? $request['data']['eventId']: null;
        $removeAnyway = isset( $request['data']['removeAnyway'] )? $request['data']['removeAnyway']: null;
        /*
            removeAnyway на клиенте не передавать, если не нужно жёстское удаление
            Если removeAnyway на клиенте не передавать, то удаление не произойдёт, программа переспросит, 
            а нужно ли удаление если к событию так много всего привязанно
        */

        $validateEventId = $this->ValidateEventId([
            'eventId' =>    $eventId,
            'companyId' =>  $company_id,
        ]);

        if( $validateEventId[ 'fails' ] ){
            $result[ 'message' ] = $validateEventId[ 'message' ];
        }else{

            $result[ 'ok' ] = true;

            if( $removeAnyway === null ){
                $isConditions = false;

                $gridEvents = GridEvents::where( 'event_id', '=', $eventId )->get();
                $applications = Application::where( 'event_id', '=', $eventId )->get();

                if( count( $gridEvents ) > 0 ){
                    $isConditions = true;
                };

                if( count( $applications ) > 0 ){
                    $isConditions = true;
                };

                $result[ 'isCondition' ] = $isConditions;

                if( $isConditions ){
                    $result[ 'gridEventsLength' ] = count( $gridEvents );
                    $result[ 'applicationsLength' ] = count( $applications );
                }else{
                    $event = Events::find( $eventId );
                    $event->delete();

                    $result[ 'eventsList' ] = $this->GetEventsList( $companyAlias );
                    $result[ 'gridEventsList' ] = $this->GetGridEventsList( $companyAlias );
                };
            }else{

                $event = Events::find( $eventId );
                $event->delete();

                $gridEvents = GridEvents::where( 'event_id', '=', $eventId )->get();
                if( count( $gridEvents ) > 0 ){
                    $gridEvents->map->delete();
                };

                $applications = Application::where( 'event_id', '=', $eventId )->get();
                foreach( $applications as $model ){
                    $model->event_id = null;
                    $model->save();
                };

                $applications_force = Application::where( 'force_event_id', '=', $eventId )->get();
                foreach( $applications_force as $model ){
                    $model->force_event_id = null;
                    $model->save();
                };

                $result[ 'eventsList' ] = $this->GetEventsList( $companyAlias );
                $result[ 'gridEventsList' ] = $this->GetGridEventsList( $companyAlias );

            };

            

            /*

            $event = Events::find( $eventId );
            $event->delete();

            $result[ 'eventsList' ] = $this->GetEventsList( $companyAlias );
            $result[ 'gridEventsList' ] = $this->GetGridEventsList( $companyAlias );
*/



        };
 

        return $result;
        
    }

}


?>

