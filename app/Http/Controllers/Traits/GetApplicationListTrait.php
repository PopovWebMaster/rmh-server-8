<?php 

namespace App\Http\Controllers\Traits;

use App\Models\Application;
use App\Models\Company;
use App\Models\Category;
use App\Models\SubApplication;

use App\Http\Controllers\Traits\SetSubApplicationChangesTrait;

trait GetApplicationListTrait{

    use SetSubApplicationChangesTrait;

    public function GetApplicationList( $companyAlias ){

        $company = Company::where( 'alias', '=', $companyAlias )->first();
        $company_id = $company->id;

        $applications = Application::where( 'company_id', '=', $company_id )
                                   ->orderBy( 'updated_at', 'desc' )
                                   ->get();

        $list = [];
        foreach( $applications as $model ){

            $application_id = $model->id;

            $category_id = $model->category_id;
            if( $category_id !== null ){
                $category = Category::find( $category_id );
                if( $category === null ){
                    $category_id = null;
                    $model->category_id = null;
                    $model->save();
                };
            };

            array_push( $list, [
                'id' =>                     $application_id,
                'name' =>                   $model->name,
                'num' =>                    $model->num === null? '': $model->num,
                'manager_notes' =>          $model->manager_notes === null? '': $model->manager_notes,
                'category_id' =>            $category_id,
                'sub_application_list' =>   $this->GetSubApplicationList( $application_id ),
            ] );

        };

        return $list;
        
    }

}


?>
