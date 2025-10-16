<?php 

namespace App\Http\Controllers\Page\AirSchedule\Traits;

use Validator;

use App\Models\Company;

use Storage;

trait GetAllScheduleFileNamesTrait{

    public function GetAllScheduleFileNames( $request, $user ){

        $result = [];

        $companyAlias = $request['data']['companyAlias'];

        $list = [];

        $files = Storage::disk('schedule_result')->allFiles( $companyAlias );

        for( $i = 0; $i < count( $files ); $i++ ){
            $arr_1 = explode( $companyAlias.'/', $files[ $i ] );
            $str_1 = $arr_1[ 1 ];
            $arr_2 = explode( '.json', $str_1 );
            array_push( $result, $arr_2[ 0 ] );
        };

        return $result;
        
    }

}


?>

