<?php 

namespace App\Http\Controllers\Page\AirLayout\Traits;

trait GetOneGridEventItemFromModelTrait{

    protected function GetOneGridEventItemFromModel( $model ){

        $result = [
            'id' =>             $model->id,
            'dayNum' =>         $model->day_num,
            'firstSegmentId' => $model->first_segment_id,
            'startTime' =>      $model->start_time,
            'durationTime' =>   $model->duration_time,
            'notes' =>          $model->notes === null? '': $model->notes,
            'eventId' =>        $model->event_id,
            'pushIt' =>         $model->push_it,
            'cutPart' =>        $model->cut_part,
            'is_premiere' =>    ( bool ) $model->is_premiere,
            'isKeyPoint' =>     ( bool ) $model->is_a_key_point,
        ];

        return $result;


        
    }

}


?>

