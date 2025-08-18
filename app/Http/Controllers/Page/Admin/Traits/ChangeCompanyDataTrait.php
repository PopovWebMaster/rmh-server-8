<?php 

namespace App\Http\Controllers\Page\Admin\Traits;

use App\Http\Controllers\Page\Admin\Traits\GetOneCompanyDataTrait;

use App\Models\Company;
use App\Models\CompanyCity;
use App\Models\CompanyLegalName;
use App\Models\CompanyProgramSystem;





trait ChangeCompanyDataTrait{

    use GetOneCompanyDataTrait;

    public function ChangeCompanyData( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $companyId =            isset( $request[ 'data' ][ 'companyId' ] )?             $request[ 'data' ][ 'companyId' ]: null;
        $companyName =          isset( $request[ 'data' ][ 'companyName' ] )?           $request[ 'data' ][ 'companyName' ]: '';
        $companyProgramSystem = isset( $request[ 'data' ][ 'companyProgramSystem' ] )?  $request[ 'data' ][ 'companyProgramSystem' ]: '';
        $companyLegalName =     isset( $request[ 'data' ][ 'companyLegalName' ] )?      $request[ 'data' ][ 'companyLegalName' ]: '';
        $companyCity =          isset( $request[ 'data' ][ 'companyCity' ] )?           $request[ 'data' ][ 'companyCity' ]: '';

        if( $companyId === null ){
            $result[ 'message' ] = 'чего-то не так с companyId'.$companyId;
        }else{
            $result[ 'ok' ] = true;

            $company = Company::find( $companyId );
            if( $company !== null ){
                $company->name = $companyName;
                $company->save();
            };

            $companyCityModel = CompanyCity::where( 'company_id', '=', $companyId )->first();
            if( $companyCityModel !== null ){
                $companyCityModel->name = $companyCity;
                $companyCityModel->save();
            }else{
                $model = new CompanyCity;
                $model->company_id = $companyId;
                $model->name = $companyCity;
                $model->save();
            };

            $companyLegalNameModel = CompanyLegalName::where( 'company_id', '=', $companyId )->first();
            if( $companyLegalNameModel !== null ){
                $companyLegalNameModel->name = $companyLegalName;
                $companyLegalNameModel->save();
            }else{
                $model = new CompanyLegalName;
                $model->company_id = $companyId;
                $model->name = $companyLegalName;
                $model->save();
            };

            $companyProgramSystemModel = CompanyProgramSystem::where( 'company_id', '=', $companyId )->first();
            if( $companyProgramSystemModel !== null ){
                $companyProgramSystemModel->name = $companyProgramSystem;
                $companyProgramSystemModel->save();
            }else{
                $model = new CompanyProgramSystem;
                $model->company_id = $companyId;
                $model->name = $companyProgramSystem;
                $model->save();
            };

            $result[ 'company' ] = $this->GetOneCompanyData( $request, $companyId );

        };

        return $result;
        
    }

}


?>

