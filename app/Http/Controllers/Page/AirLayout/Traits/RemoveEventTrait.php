<?php 

namespace App\Http\Controllers\Page\AirLayout\Traits;

use App\Http\Controllers\Traits\Validate\ValidateEventIdTrait;
use App\Http\Controllers\Traits\GetEventsListTrait;
use App\Http\Controllers\Traits\GetGridEventsListTrait;

use App\Models\Company;
use App\Models\Events;

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

        $validateEventId = $this->ValidateEventId([
            'eventId' =>    $eventId,
            'companyId' =>  $company_id,
        ]);

        if( $validateEventId[ 'fails' ] ){
            $result[ 'message' ] = $validateEventId[ 'message' ];
        }else{
            $result[ 'ok' ] = true;

            $event = Events::find( $eventId );
            $event->delete();

            $result[ 'eventsList' ] = $this->GetEventsList( $companyAlias );
            $result[ 'gridEventsList' ] = $this->GetGridEventsList( $companyAlias );


        };
 

        return $result;
        
    }

}


?>

