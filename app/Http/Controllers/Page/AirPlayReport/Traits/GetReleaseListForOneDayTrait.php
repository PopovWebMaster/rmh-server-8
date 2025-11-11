<?php 

namespace App\Http\Controllers\Page\AirPlayReport\Traits;


use Validator;

use App\Http\Controllers\Page\AirSchedule\Traits\GetReleaseListForDayTrait;

trait GetReleaseListForOneDayTrait{

    use GetReleaseListForDayTrait;

    public function GetReleaseListForOneDay( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $companyAlias = $request['data']['companyAlias'];
        $YYYY_MM_DD =   isset( $request['data']['YYYY_MM_DD'] )? $request['data']['YYYY_MM_DD']: null;

        $validate = Validator::make( [ 
            'YYYY_MM_DD' => $YYYY_MM_DD,
        ], [
            'YYYY_MM_DD' => [ 'required', 'string', 'min:10', 'max:10' ],
        ]);

        if( $validate->fails() ){
            $result[ 'message' ] = $validate->getMessageBag()->all();
        }else{

            $result[ 'release_list' ] = $this->GetReleaseListForDay( $companyAlias, $YYYY_MM_DD );

            $result[ 'ok' ] = true;

        };

        return $result;
        
    }

}


?>
