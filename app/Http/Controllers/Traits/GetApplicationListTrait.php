<?php 

namespace App\Http\Controllers\Traits;

use App\Models\Application;
use App\Models\Company;
use App\Models\Category;
use App\Models\Events;

use App\Models\SubApplication;
use App\Models\User;




use App\Http\Controllers\Page\AirApplications\Traits\GetSubApplicationListTrait;


trait GetApplicationListTrait{

    use GetSubApplicationListTrait;

    public function GetApplicationList( $companyAlias ){

        $company = Company::where( 'alias', '=', $companyAlias )->first();
        $company_id = $company->id;

        $applications = Application::where( 'company_id', '=', $company_id )
                                   ->orderBy( 'updated_at', 'desc' )
                                   ->get();

        $list = [];
        foreach( $applications as $model ){

            $application_id = $model->id;
            $manager_id = $model->manager_id;


            $category_id = $model->category_id;
            if( $category_id !== null ){
                $category = Category::find( $category_id );
                if( $category === null ){
                    $category_id = null;
                    $model->category_id = null;
                    $model->save();
                };
            };

            $event_id = $model->event_id;
            if( $event_id !== null ){
                $event = Events::find( $event_id );
                if( $event === null ){
                    $event_id = null;
                    $model->event_id = null;
                    $model->save();
                };
            };

            array_push( $list, [
                'id' =>                     $application_id,
                'name' =>                   $model->name,
                'num' =>                    $model->num === null? '': $model->num,
                'manager_notes' =>          $model->manager_notes === null? '': $model->manager_notes,
                'manager' =>                $this->GetManagerInfo( $manager_id ),
                'category_id' =>            $category_id,
                'event_id' =>               $event_id,
                'sub_application_list' =>   $this->GetSubApplicationList( $application_id ),
            ] );

        };

        return $list;
        
    }
    private function GetManagerInfo( $user_id ){

        $result = [
            'name' => '',
            'id' => null,
        ];

        $user = User::find( $user_id );

        if( $user !== null ){
            $result[ 'name' ] = $user->name;
            $result[ 'id' ] =   $user_id;
        };

        return $result;

    }

}


?>
