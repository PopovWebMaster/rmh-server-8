<?php 

namespace App\Http\Controllers\Page\AirLayout\Traits;

use App\Http\Controllers\Traits\Validate\ValidateGridEventIdTrait;
use App\Http\Controllers\Traits\GetGridEventsListTrait;

use App\Models\Company;
use App\Models\GridEvents;


trait RemoveGridEventTrait{

    use GetGridEventsListTrait;
    use ValidateGridEventIdTrait;

    public function RemoveGridEvent( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $companyAlias = $request['data']['companyAlias'];

        $gridEventId = isset( $request['data']['gridEventId'] )? $request['data']['gridEventId']: null;

        $validate = $this->ValidateGridEventId( [ 'gridEventId' => $gridEventId ] );
        
        if( $validate[ 'fails' ] ){
            $result[ 'message' ] = $validate[ 'message' ];
        }else{
            $result[ 'ok' ] = true;

            $company = Company::where( 'alias', '=', $companyAlias )->first();
            $company_id = $company->id;

            $models = GridEvents::where( 'company_id', '=', $company_id )->where( 'first_segment_id', '=', $gridEventId )->get();

            if( count( $models ) > 0 ){
                $models->map->delete();
            };

            $gridEvents = GridEvents::find( $gridEventId );
            if( $gridEvents !== null ){
                $gridEvents->delete();

            };

            // $result[ 'list' ] = $this->GetGridEventsList( $companyAlias );

        };


        return $result;
        
    }

}


?>

