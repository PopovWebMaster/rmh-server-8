<?php 

namespace App\Http\Controllers\Page\AirApplications\Traits;

use App\Http\Controllers\Page\AirApplications\Traits\GetSubApplicationListTrait;

use App\Models\Application;
use App\Models\Category;
// use App\Models\SubApplication;

trait GetOneApplicationDataTrait{

    use GetSubApplicationListTrait;

    public function GetOneApplicationData( $application_id ){
        $result = [];

        $application = Application::find( $application_id );

        // $application_id =   $application->id;
        $category_id =      $application->category_id;
        $event_id =         $application->event_id;

        $manager_id =       $application->manager_id;
        $name =             $application->name;
        $num =              $application->num === null? '': $application->num;
        $manager_notes =    $application->manager_notes === null? '': $application->manager_notes;

        $categoryModel = Category::find( $category_id );
        if( $categoryModel === null ){
            $application->category_id = null;
            $application->save();
            $category_id = null;
        };


        // $subApplications = SubApplication::where( 'application_id', '=', $application_id )->get();




        $result[ 'application_id' ] =       $application_id;
        $result[ 'category_id' ] =          $category_id;
        $result[ 'event_id' ] =             $event_id;

        $result[ 'manager_id' ] =           $manager_id;
        $result[ 'name' ] =                 $name;
        $result[ 'num' ] =                  $num;
        $result[ 'manager_notes' ] =        $manager_notes;
        $result[ 'sub_application_list' ] = $this->GetSubApplicationList( $application_id, 'all' );

        return $result;
    }

}


?>


