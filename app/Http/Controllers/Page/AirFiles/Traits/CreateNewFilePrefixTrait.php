<?php 

namespace App\Http\Controllers\Page\AirFiles\Traits;

use Validator;

use App\Models\Company;


trait CreateNewFilePrefixTrait{


    public function CreateNewFilePrefix( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $companyAlias = $request['data']['companyAlias'];

        $prefix =   isset( $request['data']['prefix'] )?    $request['data']['prefix']: null;
        $eventId =  isset( $request['data']['eventId'] )?   $request['data']['eventId']: null;

        $validate = Validator::make( [ 
            'prefix' => $prefix,
            'eventId' => $eventId,

        ], [
            'prefix' =>     [ 'required', 'string', 'max:60' ],
            'eventId' =>    [ 'required', 'exists:events,id' ],
        ]);

        if( $validate->fails() ){
            $result[ 'message' ] = $validate->getMessageBag()->all();
        }else{

            $result[ 'ok' ] = true;

            $company = Company::where( 'alias', '=', $companyAlias )->first();
            $company_id = $company->id;

            $result[ 'company_id' ] = $company_id;
            $result[ 'prefix' ] = $prefix;
            $result[ 'eventId' ] = $eventId;




            
        };




        return $result;
        
    }

}


?>

