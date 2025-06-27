<?php 

namespace App\Http\Controllers\Page\AirApplications\Traits;

use App\Models\SubApplication;
use App\Models\SubApplicationDescription;
use App\Models\SubApplicationFileName;
use App\Models\SubApplicationRelease;

trait RemoveSubApplicationWithAllDataTrait{

    public function RemoveSubApplicationWithAllData( $subApplicationId ){

        $subApplication = SubApplication::find( $subApplicationId );

        if( $subApplication !== null ){

            $description = SubApplicationDescription::where( 'sub_application_id', '=', $subApplicationId )->first();
            if( $description !== null ){
                $description->delete();
            };
            $fileNames = SubApplicationFileName::where( 'sub_application_id', '=', $subApplicationId )->get();
            if( count( $fileNames ) > 0 ){
                $fileNames->map->delete();
            };

            $releases = SubApplicationRelease::where( 'sub_application_id', '=', $subApplicationId )->get();
            if( count( $releases ) > 0 ){
                $releases->map->delete();
            };

            $subApplication->delete();

        };
    }

}


?>



