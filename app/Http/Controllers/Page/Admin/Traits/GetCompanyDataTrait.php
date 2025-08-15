<?php 

namespace App\Http\Controllers\Page\Admin\Traits;

use App\Http\Controllers\Page\Admin\Traits\GetOneCompanyDataTrait;


trait GetCompanyDataTrait{

    use GetOneCompanyDataTrait;

    public function GetCompanyData( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $company = [];

        $companyId = isset( $request[ 'data' ][ 'companyId' ] )? $request[ 'data' ][ 'companyId' ]: null;
        if( $companyId === null ){
            $result[ 'message' ] = 'чего-то не так с companyId'.$companyId;
        }else{
            $result[ 'ok' ] = true;
            $result[ 'message' ] = '';

            $company = $this->GetOneCompanyData( $request, $companyId );
        };

        $result[ 'company' ] = $company;

        return $result;
        
    }

}


?>

