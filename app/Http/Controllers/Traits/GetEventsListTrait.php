<?php 

namespace App\Http\Controllers\Traits;

use App\Models\Events;
use App\Models\Company;
use App\Models\Category;

use App\Models\EventLinkedFile;


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

            $linked_file = null;
            $eventLinkedFile = EventLinkedFile::where( 'company_id', '=', $company_id )->where( 'event_id', '=', $model->id )->get();
            foreach( $eventLinkedFile as $model_linked_file ){
                if( $linked_file === null ){
                    $linked_file = [];
                };
                array_push( $linked_file, [
                    'name' => $model_linked_file->name, 
                    'duration' => $model_linked_file->duration, 
                ] );
            };

            array_push( $list, [
                'id' =>             $model->id,
                'name' =>           $model->name,
                'category_id' =>    $category_id,
                'notes' =>          $model->notes === null? '': $model->notes,
                'type' =>           $model->type,
                'durationTime' =>   $model->durationTime,
                'linked_file' =>    $linked_file, // null or [ 'name' => 'name', 'duration' => 100 ]
                /*
                    'linked_file' => null, [
                        [
                            'name' => 'string', 
                            'duration' => number,
                        ],
                        ...
                    ]
                */

            ] );
        };

        return $list;
        
    }

}


?>

