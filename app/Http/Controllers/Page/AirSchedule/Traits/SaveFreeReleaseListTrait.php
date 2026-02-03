<?php 

namespace App\Http\Controllers\Page\AirSchedule\Traits;

// use App\Http\Controllers\Traits\Validate\ValidateYYYYMMDDTrait;
// use App\Http\Controllers\Traits\Validate\ValidateScheduleListTrait;

use App\Models\Company;
use App\Models\FreeRelease;



use Storage;
use Validator;

trait SaveFreeReleaseListTrait{

    // use ValidateYYYYMMDDTrait;
    // use ValidateScheduleListTrait;

    public function SaveFreeReleaseList( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $companyAlias =     isset( $request['data']['companyAlias'] )?      $request['data']['companyAlias']:       null;
        $freeReleasesList = isset( $request['data']['freeReleasesList'] )?  $request['data']['freeReleasesList']:   null;

        $min = config( 'app.MIN_EVENT_DURATION_SEC' );

        $validate = Validator::make( [ 
            'freeReleasesList' => $freeReleasesList,
        ], [
            'freeReleasesList' =>           [ 'required', 'array' ],
            'freeReleasesList.*.fileName' => [ 'required', 'string', 'min:5', 'max:255' ],
            'freeReleasesList.*.duration' => [ 'required', 'numeric', 'min:'.$min, 'max:80000' ],
            'freeReleasesList.*.eventId' =>  [ 'required', 'exists:events,id' ],
        ]);

        if( $validate->fails() ){
            $result[ 'message' ] = $validate->getMessageBag()->all();
        }else{

            $company = Company::where( 'alias', '=', $companyAlias )->first();
            $company_id = $company->id;

            $oldFreeRelease = FreeRelease::where( 'company_id', '=', $company_id )->get();
            if( count( $oldFreeRelease ) > 0 ){
                $oldFreeRelease->map->delete();
            };

            for( $i = 0; $i < count( $freeReleasesList ); $i++ ){

                $event_id =     $freeReleasesList[ $i ][ 'eventId' ];
                $file_name =    $freeReleasesList[ $i ][ 'fileName' ];
                $duration =     $freeReleasesList[ $i ][ 'duration' ];

                $freeRelease = new FreeRelease;
                $freeRelease->company_id =  $company_id;
                $freeRelease->event_id =    $event_id;
                $freeRelease->file_name =   $file_name;
                $freeRelease->duration =    $duration;
                $freeRelease->save();

            };

            $result[ 'ok' ] = true;

        };

        return $result;
        
    }

}


?>

