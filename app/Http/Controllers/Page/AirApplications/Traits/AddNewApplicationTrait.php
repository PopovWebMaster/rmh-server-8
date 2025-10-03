<?php 

namespace App\Http\Controllers\Page\AirApplications\Traits;

use App\Http\Controllers\Traits\Validate\ValidateNewApplicationTrait;

use App\Http\Controllers\Traits\GetApplicationListTrait;

use App\Models\Application;
use App\Models\Company;

trait AddNewApplicationTrait{

    use ValidateNewApplicationTrait;
    use GetApplicationListTrait;

    public function AddNewApplication( $request, $user ){
        $result = [
            'ok' => false,
            'message' => '',
        ];

        $companyAlias = $request['data']['companyAlias'];

        $applicationName =          isset( $request['data']['applicationName'] )?           $request['data']['applicationName']: null;
        $applicationNum =           isset( $request['data']['applicationNum'] )?            $request['data']['applicationNum']: null;
        $applicationCategoryId =    isset( $request['data']['applicationCategoryId'] )?     $request['data']['applicationCategoryId']: null;
        $applicationManagerNotes =  isset( $request['data']['applicationManagerNotes'] )?   $request['data']['applicationManagerNotes']: null;

        $applicationEventId =       isset( $request['data']['applicationEventId'] )?        $request['data']['applicationEventId']: null;
        $applicationForceEventId =  isset( $request['data']['applicationForceEventId'] )?   $request['data']['applicationForceEventId']: null;


        $validate = $this->ValidateNewApplication([
            'applicationName' =>            $applicationName,
            'applicationNum' =>             $applicationNum,
            'applicationCategoryId' =>      $applicationCategoryId,
            'applicationManagerNotes' =>    $applicationManagerNotes,
            'applicationEventId' =>         $applicationEventId,
            'applicationForceEventId' =>    $applicationForceEventId,



        ]);

        if( $validate[ 'fails' ] ){
            $result[ 'message' ] = $validate[ 'message' ];
        }else{

            $result[ 'ok' ] = true;

            $company = Company::where( 'alias', '=', $companyAlias )->first();
            $company_id = $company->id;

            $application = new Application;

            $application->company_id =      $company_id;
            $application->manager_id =      $user->id;
            $application->name =            $applicationName;
            $application->num =             $applicationNum;
            $application->manager_notes =   $applicationManagerNotes;
            $application->category_id =     $applicationCategoryId;
            $application->event_id =        $applicationEventId;
            $application->force_event_id =  $applicationForceEventId;

            $application->save();

            $result[ 'list' ] = $this->GetApplicationList( $companyAlias );
            
        };


        return $result;
    }

}


?>

