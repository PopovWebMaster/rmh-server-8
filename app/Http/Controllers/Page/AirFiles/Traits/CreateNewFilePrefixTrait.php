<?php 

namespace App\Http\Controllers\Page\AirFiles\Traits;

use Validator;

use App\Models\Company;
use App\Models\AirFilePrefix;

use App\Http\Controllers\Page\AirFiles\Traits\GetAirFilePrefixListTrait;


trait CreateNewFilePrefixTrait{

    use GetAirFilePrefixListTrait;

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
            'prefix' =>   AirFilePrefix::RULE[ 'prefix' ], //     [ 'required', 'string', 'max:60' ],
            'eventId' =>  AirFilePrefix::RULE[ 'event_id' ], //  [ 'required', 'exists:events,id' ],
        ]);

        if( $validate->fails() ){
            $result[ 'message' ] = $validate->getMessageBag()->all();
        }else{

            $company = Company::where( 'alias', '=', $companyAlias )->first();
            $company_id = $company->id;

            $airFilePrefix = AirFilePrefix::where( 'company_id', '=', $company_id )->where( 'prefix', '=', $prefix )->first();

            if( $airFilePrefix === null ){

                $model = new AirFilePrefix;
                $model->company_id =    $company_id;
                $model->prefix =        $prefix;
                $model->event_id =      $eventId;
                $model->save();

            }else{
                $airFilePrefix->event_id = $eventId;
                $airFilePrefix->save();
            };

            $result[ 'ok' ] = true;

            $result[ 'airFilePrefix' ] = $this->GetAirFilePrefixList( $companyAlias );


            
        };




        return $result;
        
    }

}


?>

