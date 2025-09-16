<?php 

namespace App\Http\Controllers\Page\AirSchedule\Traits;

use App\Models\Company;

use Storage;


trait GetSchaduleResultListTrait{

    public function GetSchaduleResultList( $companyAlias, $YYYY_MM_DD ){

        $result = [];

        $puth = $companyAlias.'/'.$YYYY_MM_DD.'.json';

        $arr = [];

        if( Storage::disk('schedule_result')->exists( $puth ) ){
            $json = Storage::disk('schedule_result')->get( $puth );
            $result = json_decode( $json );
        };

        for( $i = 0; $i < count( $result ); $i++ ){
            $result[ $i ]->notes = $result[ $i ]->notes === null? '': $result[ $i ]->notes;
            $result[ $i ]->finalNotes = $result[ $i ]->finalNotes === null? '': $result[ $i ]->finalNotes;

        };

        return $result;
        
    }

}


?>

