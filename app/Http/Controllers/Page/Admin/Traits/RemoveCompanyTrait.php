<?php 

namespace App\Http\Controllers\Page\Admin\Traits;

use App\Http\Controllers\Page\Admin\Traits\GetAllCompanysDataTrait;

use App\Models\Company;
use App\Models\Application;
use App\Models\SubApplication;
use App\Models\SubApplicationDescription;
use App\Models\SubApplicationFileName;
use App\Models\SubApplicationRelease;
use App\Models\CompanyCity;
use App\Models\CompanyLegalName;
use App\Models\CompanyProgramSystem;
use App\Models\Events;
use App\Models\GridEvents;
use App\Models\KeyPoints;
use App\Models\UserCompany;
use App\Models\User;



use Storage;











// use App\Models\User;
// use App\Models\UserCompany;

trait RemoveCompanyTrait{

    use GetAllCompanysDataTrait;

    public function RemoveCompany( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $secretCode =   isset( $request[ 'data' ][ 'secretCode' ] )?    $request[ 'data' ][ 'secretCode' ]: null;
        $companyId =    isset( $request[ 'data' ][ 'companyId' ] )? $request[ 'data' ][ 'companyId' ]: null;

        if( $companyId === null ){
            $result[ 'message' ] = 'чего-то не так с companyId'.$companyId;
        }else{

            $result[ 'all' ] = $request->all();

            if( $secretCode === '+100500' ){
                $result[ 'ok' ] = true;


                $company = Company::find( $companyId );
                if( $company !== null ){
                    $companyAlias = $company->alias;

                    $application = Application::where( 'company_id', '=', $companyId )->get();
                    foreach( $application as $model ){
                        $application_id = $model->id;
                        $subApplication = SubApplication::where( 'application_id', '=', $application_id )->get();

                        foreach( $subApplication as $sum_model ){
                            $sub_application_id = $sum_model->id;

                            $subApplicationDescription = SubApplicationDescription::where( 'sub_application_id', '=', $sub_application_id )->get();
                            if( count( $subApplicationDescription ) > 0 ){
                                $subApplicationDescription->map->delete();
                            };

                            $subApplicationFileName = SubApplicationFileName::where( 'sub_application_id', '=', $sub_application_id )->get();
                            if( count( $subApplicationFileName ) > 0 ){
                                $subApplicationFileName->map->delete();
                            };

                            $subApplicationRelease = SubApplicationRelease::where( 'sub_application_id', '=', $sub_application_id )->get();
                            if( count( $subApplicationRelease ) > 0 ){
                                $subApplicationRelease->map->delete();
                            };
                        };

                        if( count( $subApplication ) > 0 ){
                            $subApplication->map->delete();
                        };

                    };

                    $companyCity = CompanyCity::where( 'company_id', '=', $companyId )->first();
                    if( $companyCity !== null ){
                        $companyCity->delete();
                    };

                    $companyLegalName = CompanyLegalName::where( 'company_id', '=', $companyId )->first();
                    if( $companyLegalName !== null ){
                        $companyLegalName->delete();
                    };

                    $companyProgramSystem = CompanyProgramSystem::where( 'company_id', '=', $companyId )->first();
                    if( $companyProgramSystem !== null ){
                        $companyProgramSystem->delete();
                    };

                    $events = Events::where( 'company_id', '=', $companyId )->get();
                    if( count( $events ) > 0 ){
                        $events->map->delete();
                    };

                    $gridEvents = GridEvents::where( 'company_id', '=', $companyId )->get();
                    if( count( $gridEvents ) > 0 ){
                        $gridEvents->map->delete();
                    };

                    $keyPoints = KeyPoints::where( 'company_id', '=', $companyId )->get();
                    if( count( $keyPoints ) > 0 ){
                        $keyPoints->map->delete();
                    };

                    $userCompany = UserCompany::where( 'company_id', '=', $companyId )->get();
                    foreach( $userCompany as $userCompanyModel ){
                        $user_id = $userCompanyModel->user_id;
                        $delUser = User::find( $user_id );
                        if( $delUser !== null ){
                            if( $delUser->email !== config( 'app.admin_email' ) ){
                                $delUser->delete();
                            };
                        };
                    };
                    if( count( $userCompany ) > 0 ){
                        $userCompany->map->delete();
                    };


                    Storage::disk('play_report')->deleteDirectory( $companyAlias );
                    $company->delete();





                };

                $result[ 'companies' ] = $this->GetAllCompanysData( $request, $user );
            }else{

            };
            
            

        };


        return $result;
        
    }

}


?>

