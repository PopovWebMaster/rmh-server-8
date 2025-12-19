<?php 

namespace App\Http\Controllers\Page\AirSchedule\Traits;

use Validator;

use App\Http\Controllers\Page\AirSchedule\Traits\GetSchaduleResultListTrait;
use App\Http\Controllers\Page\AirSchedule\Traits\GetReleaseListForDayTrait;
use App\Http\Controllers\Page\AirSchedule\Traits\GetReleaseListForDayV2Trait;


use App\Http\Controllers\Traits\GetGridEventsListTrait;


trait GetScheduleResultDayDataTrait{

    use GetSchaduleResultListTrait;
    use GetReleaseListForDayTrait;
    use GetReleaseListForDayV2Trait;
    use GetGridEventsListTrait;

    public function GetScheduleResultDayData( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $companyAlias = $request['data']['companyAlias'];

        $YYYY_MM_DD =   isset( $request['data']['YYYY_MM_DD'] )?    $request['data']['YYYY_MM_DD']: null;
        $dayNum =       isset( $request['data']['dayNum'] )?        $request['data']['dayNum']:     null;

        $validate = Validator::make( [ 
            'YYYY_MM_DD' => $YYYY_MM_DD,
            'dayNum' => $dayNum,

        ], [
            'YYYY_MM_DD' => [ 'required', 'string', 'min:10', 'max:10' ],
            'dayNum' =>     [ 'nullable', 'numeric', 'min:0', 'max:6' ],

        ]);

        if( $validate->fails() ){
            $result[ 'message' ] = $validate->getMessageBag()->all();
        }else{

            // $result[ 'release_list' ] = $this->GetReleaseListForDay( $companyAlias, $YYYY_MM_DD );
            $result[ 'release_list' ] = $this->GetReleaseListForDayV2( $companyAlias, $YYYY_MM_DD );

            $result[ 'scheduleEventsList' ] = $this->GetSchaduleResultList( $companyAlias, $YYYY_MM_DD );
            if( $dayNum !== null ){
                $result[ 'gridEventsList' ] = $this->GetGridEventsList( $companyAlias, $dayNum );
            };

            $result[ 'ok' ] = true;


        };

        return $result;
        
    }

}


?>

