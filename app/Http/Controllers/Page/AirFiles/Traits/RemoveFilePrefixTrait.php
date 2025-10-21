<?php 

namespace App\Http\Controllers\Page\AirFiles\Traits;

use Validator;

use App\Models\Company;
use App\Models\AirFilePrefix;

use App\Http\Controllers\Page\AirFiles\Traits\GetAirFilePrefixListTrait;


trait RemoveFilePrefixTrait{

    use GetAirFilePrefixListTrait;

    public function RemoveFilePrefix( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $companyAlias = $request['data']['companyAlias'];

        $prefixId =   isset( $request['data']['prefixId'] )?    $request['data']['prefixId']: null;

        $validate = Validator::make( [ 
            'prefixId' => $prefixId,
        ], [
            'prefixId' =>   AirFilePrefix::RULE[ 'id' ],
        ]);

        if( $validate->fails() ){
            $result[ 'message' ] = $validate->getMessageBag()->all();
        }else{

            $company = Company::where( 'alias', '=', $companyAlias )->first();
            $company_id = $company->id;

            $airFilePrefix = AirFilePrefix::find( $prefixId );

            if( $airFilePrefix === null ){

            }else{
                $airFilePrefix->delete();
            };

            $result[ 'ok' ] = true;
            
            $result[ 'airFilePrefix' ] = $this->GetAirFilePrefixList( $companyAlias );


            
        };




        return $result;
        
    }

}


?>

