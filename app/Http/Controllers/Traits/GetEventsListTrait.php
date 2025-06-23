<?php 

namespace App\Http\Controllers\Traits;

use App\Models\Events;
use App\Models\Company;

trait GetEventsListTrait{

    public function GetEventsList( $companyAlias ){

        $company = Company::where( 'alias', '=', $companyAlias )->first();
        $company_id = $company->id;

        $events = Events::where( 'company_id', '=', $company_id )->get();

        $list = [];
        foreach( $events as $model ){
            array_push( $list, [
                'id' =>             $model->id,
                'name' =>           $model->name,
                'category_id' =>    $model->category_id,
                'notes' =>          $model->notes === null? '': $model->notes,
                'type' =>           $model->type,
                'durationTime' =>   $model->durationTime,

            ] );
        };

        return $list;
        
    }

}


?>

