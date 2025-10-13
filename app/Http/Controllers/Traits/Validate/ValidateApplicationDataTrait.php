<?php 

namespace App\Http\Controllers\Traits\Validate;

use Validator;
use Illuminate\Validation\Rule;

use App\Models\Application;

trait ValidateApplicationDataTrait{

    public function ValidateApplicationData( $params ){

        $result = [
            'fails' => true,
            'message' => '',
        ];

        $applicationId =           $params['applicationId'];
        $applicationName =         $params['applicationName'];
        $applicationCategoryId =   $params['applicationCategoryId'];
        $applicationNum =          $params['applicationNum'];
        $applicationManagerNotes = $params['applicationManagerNotes'];
        $applicationManagerId =    isset( $params['applicationManagerId'] )? $params['applicationManagerId']: null;


        

        $validate = Validator::make( [ 
            'applicationId' =>              $applicationId,
            'applicationName' =>            $applicationName,
            'applicationCategoryId' =>      $applicationCategoryId,
            'applicationNum' =>             $applicationNum,
            'applicationManagerNotes' =>    $applicationManagerNotes,
            'applicationManagerId' =>       $applicationManagerId,


        ], [
            'applicationId' =>              Application::RULE[ 'id' ],
            'applicationName' =>            Application::RULE[ 'name' ],
            'applicationCategoryId' =>      Application::RULE[ 'category_id' ],
            'applicationNum' =>             Application::RULE[ 'num' ],
            'applicationManagerNotes' =>    Application::RULE[ 'manager_notes' ],
            'applicationManagerId' =>       Application::RULE[ 'manager_id' ],

        ]);

        if( $validate->fails() ){
            $result[ 'message' ] = $validate->getMessageBag()->all();
        }else{
            $result[ 'fails' ] = false;

        };

        return $result;
        
    }

}


?>
