<?php 

namespace App\Http\Controllers\Traits;

use App\Models\Events;
use App\Models\Company;
use App\Models\Category;


trait GetEventsListTrait{

    public function GetEventsList( $companyAlias ){

        $company = Company::where( 'alias', '=', $companyAlias )->first();
        $company_id = $company->id;

        $events = Events::where( 'company_id', '=', $company_id )->get();

        $list = [];
        foreach( $events as $model ){

            $category_id = null;

            $category = Category::find( $model->category_id );

            if( $category === null ){
                $model->category_id = null;
                $model->save();
            }else{
                $category_id = $model->category_id;
            };

            array_push( $list, [
                'id' =>             $model->id,
                'name' =>           $model->name,
                'category_id' =>    $category_id,
                'notes' =>          $model->notes === null? '': $model->notes,
                'type' =>           $model->type,
                'durationTime' =>   $model->durationTime,

            ] );
        };

        return $list;
        
    }

}


?>

