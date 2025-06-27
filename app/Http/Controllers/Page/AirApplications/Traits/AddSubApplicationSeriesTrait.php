<?php 

namespace App\Http\Controllers\Page\AirApplications\Traits;

use App\Http\Controllers\Traits\Validate\ValidateSubApplicationSeriesTrait;
use App\Http\Controllers\Traits\Validate\ValidateApplicationDataTrait;
use App\Http\Controllers\Page\AirApplications\Traits\GetOneApplicationDataTrait;
use App\Http\Controllers\Traits\GetApplicationListTrait;

use App\Models\Application;
use App\Models\Company;
use App\Models\SubApplication;

trait AddSubApplicationSeriesTrait{

    use ValidateSubApplicationSeriesTrait;
    use ValidateApplicationDataTrait;
    use GetOneApplicationDataTrait;
    use GetApplicationListTrait;

    public function AddSubApplicationSeries( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $companyAlias = $request['data']['companyAlias'];

        $applicationId =            isset( $request['data']['applicationId'] )?             $request['data']['applicationId']: null;
        $applicationName =          isset( $request['data']['applicationName'] )?           $request['data']['applicationName']: null;
        $applicationCategoryId =    isset( $request['data']['applicationCategoryId'] )?     $request['data']['applicationCategoryId']: null;
        $applicationNum =           isset( $request['data']['applicationNum'] )?            $request['data']['applicationNum']: null;
        $applicationManagerNotes =  isset( $request['data']['applicationManagerNotes'] )?   $request['data']['applicationManagerNotes']: null;

        $serialNumFrom =            isset( $request['data']['serialNumFrom'] )? $request['data']['serialNumFrom']: null;
        $serialNumTo =              isset( $request['data']['serialNumTo'] )?   $request['data']['serialNumTo']: null;
        $periodFrom =               isset( $request['data']['periodFrom'] )?    $request['data']['periodFrom']: null;
        $periodTo =                 isset( $request['data']['periodTo'] )?      $request['data']['periodTo']: null;
        $durationSec =              isset( $request['data']['durationSec'] )?   $request['data']['durationSec']: null;
        $airNotes =                 isset( $request['data']['airNotes'] )?      $request['data']['airNotes']: null;

        $validate = $this->ValidateSubApplicationSeries([
            'applicationId' =>  $applicationId,
            'serialNumFrom' =>  $serialNumFrom,
            'serialNumTo' =>    $serialNumTo,
            'periodFrom' =>     $periodFrom,
            'periodTo' =>       $periodTo,
            'durationSec' =>    $durationSec,
            'airNotes' =>       $airNotes,
        ]);

        if( $validate[ 'fails' ] ){
            $result[ 'message' ] = $validate[ 'message' ];
        }else{

            $company = Company::where( 'alias', '=', $companyAlias )->first();
            $company_id = $company->id;

            $application = Application::where( 'company_id', '=', $company_id )->where( 'id', '=', $applicationId )->first();

            if( $application === null ){
                $result[ 'message' ] = 'Ох, что-то вы мудрите, батенька. Кончали б вы с этим';
            }else{
                $result[ 'ok' ] = true;

                $validateApp = $this->ValidateApplicationData([
                    'applicationId' =>              $applicationId,
                    'applicationName' =>            $applicationName,
                    'applicationCategoryId' =>      $applicationCategoryId,
                    'applicationNum' =>             $applicationNum,
                    'applicationManagerNotes' =>    $applicationManagerNotes,
                ]);

                if( $validateApp[ 'fails' ] ){

                }else{
                    $application->category_id =     $applicationCategoryId;
                    $application->name =            $applicationName;
                    $application->num =             $applicationNum;
                    $application->manager_notes =   $applicationManagerNotes;
                    $application->save();
                };

                for( $i = $serialNumFrom; $i < $serialNumTo + 1; $i++ ){
                    $subApplication = new SubApplication;

                    $subApplication->application_id =   $applicationId;
                    $subApplication->period_from =      $periodFrom;
                    $subApplication->period_to =        $periodTo;
                    $subApplication->duration_sec =     $durationSec;
                    $subApplication->serial_num =       $i;
                    $subApplication->name =             'Серия - '.$i;
                    $subApplication->air_notes =        $airNotes;
                    $subApplication->type =             'series';

                    $subApplication->save();
                };

                $result[ 'application' ] = $this->GetOneApplicationData( $applicationId );
                $result[ 'applicationList' ] = $this->GetApplicationList( $companyAlias );

            };

        };

        return $result;
    }

}


?>

