<?php 

namespace App\Http\Controllers\Page\AirSchedule\Traits;

use App\Models\Company;
use App\Models\FreeRelease;


trait GetFreeReleasesListTrait{

    public function GetFreeReleasesList( $companyAlias ){

        $result = [];

        $company = Company::where( 'alias', '=', $companyAlias )->first();
        $company_id = $company->id;

        $freeRelease = FreeRelease::where( 'company_id', '=', $company_id )->get();

        foreach( $freeRelease as $model ){
            array_push( $result, [
                'fileName' =>   $model->file_name,
                'duration' =>   $model->duration,
                'eventId' =>    $model->event_id,
                'count' =>      0,
            ] );
        };

        return $result;
        
    }

}


?>

