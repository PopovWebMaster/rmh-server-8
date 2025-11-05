<?php 

namespace App\Http\Controllers\Page\AirFiles\Traits;

use Validator;

use App\Models\Company;
use App\Models\AirFilePrefix;
use App\Models\AirFileNames;

use Storage;

trait SeveChangesOfFilesTraits{

    public function SeveChangesOfFiles( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $companyAlias = $request['data']['companyAlias'];

        $filesData =   isset( $request['data']['filesData'] )?    $request['data']['filesData']: null;

        $validate = Validator::make( [ 
            'filesData' => $filesData,

        ], [
            'filesData' => [ 'required', 'array' ],
            'filesData.*.name' =>           [ 'required', 'string' ],
            'filesData.*.premiereSec' =>    [ 'required', 'numeric' ],
            // 'filesData.*.event_id' =>       [ 'nullable', 'exists:events,id' ],
        ]);

        if( $validate->fails() ){
            $result[ 'message' ] = $validate->getMessageBag()->all();
        }else{
            
            $company = Company::where( 'alias', '=', $companyAlias )->first();
            $company_id = $company->id;

            for( $i = 0; $i < count( $filesData ); $i++ ){
                $name =         $filesData[ $i ][ 'name' ];
                $premiereSec =  $filesData[ $i ][ 'premiereSec' ];
                $event_id =     $filesData[ $i ][ 'event_id' ];

                $airFileNames = AirFileNames::where( 'name', '=', $name )->where( 'company_id', '=', $company_id )->first();
                if( $airFileNames === null ){
                    if( $event_id === null ){

                    }else{
                        $model = new AirFileNames;
                        $model->name =          $name;
                        $model->event_id =      $event_id;
                        $model->premiere_sec =  $premiereSec;
                        $model->company_id =    $company_id;

                        $model->save();
                    };
                }else{
                    if( $event_id === null ){
                        $airFileNames->delete();
                    }else{
                        $airFileNames->name =           $name;
                        $airFileNames->event_id =       $event_id;
                        if( $premiereSec < $airFileNames->premiere_sec ){
                            $airFileNames->premiere_sec =   $premiereSec;
                        };
                        $airFileNames->save();
                    };
                };
            };

            $result[ 'ok' ] = true;

        };

        return $result;
        
    }

    


}


?>

