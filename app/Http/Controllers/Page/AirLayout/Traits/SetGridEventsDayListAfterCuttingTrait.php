<?php 

namespace App\Http\Controllers\Page\AirLayout\Traits;

use App\Http\Controllers\Traits\Validate\ValidateDayNumTrait;
use App\Http\Controllers\Traits\Validate\ValidateGridEventsDayListTrait;
use App\Http\Controllers\Traits\GetGridEventsListTrait;

use App\Models\Company;
use App\Models\GridEvents;

trait SetGridEventsDayListAfterCuttingTrait{

    use ValidateDayNumTrait;
    use ValidateGridEventsDayListTrait;
    use GetGridEventsListTrait;

    public function SetGridEventsDayListAfterCutting( $request, $user ){

        $result = [
            'ok' => false,
            'message' => '',
        ];

        $companyAlias = $request['data']['companyAlias'];;

        $dayNum_ =   isset( $request['data']['dayNum'] )?    $request['data']['dayNum']: null;
        $dayList =   isset( $request['data']['dayList'] )?   $request['data']['dayList']: null;

        $validateDayNum = $this->ValidateDayNum([ 'dayNum' => $dayNum_ ]);
        if( $validateDayNum[ 'fails' ] ){
            $result[ 'message' ] = $validateDayNum[ 'message' ];
        }else{

            $validateList = $this->ValidateGridEventsDayList([
                'dayList' => $dayList,
                'withNewCut' => true,
            ]);

            if( $validateList[ 'fails' ] ){
                $result[ 'message' ] = $validateList[ 'message' ];
            }else{

                $company = Company::where( 'alias', '=', $companyAlias )->first();
                $company_id = $company->id;

                $result[ 'ok' ] = true;

                $id_participants = [];
                
                for( $i = 0; $i < count( $dayList ); $i++ ){

                    $id =               $dayList[ $i ][ 'id' ];
                    $cutPart =          $dayList[ $i ][ 'cutPart' ];
                    $dayNum =           $dayList[ $i ][ 'dayNum' ];
                    $durationTime =     $dayList[ $i ][ 'durationTime' ];
                    $eventId =          $dayList[ $i ][ 'eventId' ];
                    $firstSegmentId =   $dayList[ $i ][ 'firstSegmentId' ];
                    $isKeyPoint =       $dayList[ $i ][ 'isKeyPoint' ];
                    $notes =            $dayList[ $i ][ 'notes' ];
                    $pushIt =           $dayList[ $i ][ 'pushIt' ];
                    $startTime =        $dayList[ $i ][ 'startTime' ];
                    $is_premiere =      $dayList[ $i ][ 'is_premiere' ];

                    if( $id === null ){

                        $model = new GridEvents;
                        $model->is_a_key_point = $isKeyPoint;
                        $model->day_num = $dayNum;
                        $model->company_id = $company_id;
                        $model->start_time = $startTime;
                        $model->duration_time = $durationTime;
                        $model->event_id = $eventId;
                        $model->first_segment_id = $firstSegmentId;
                        $model->notes = $notes;
                        $model->cut_part = $cutPart;
                        $model->push_it = $pushIt;
                        $model->is_premiere = $is_premiere;


                        $model->save();
                        $newId = $model->id;
                        array_push( $id_participants, $newId );

                    }else{
                        $gridEvents = GridEvents::where( 'company_id', '=', $company_id )->where( 'day_num', '=', $dayNum )->where( 'id', '=', $id )->first();
                        if( $gridEvents !== null ){

                            $gridEvents->is_a_key_point = $isKeyPoint;
                            $gridEvents->start_time = $startTime;
                            $gridEvents->duration_time = $durationTime;
                            $gridEvents->event_id = $eventId;
                            $gridEvents->first_segment_id = $firstSegmentId;
                            $gridEvents->notes = $notes;
                            $gridEvents->cut_part = $cutPart;
                            $gridEvents->push_it = $pushIt;
                            $gridEvents->save();
                            array_push( $id_participants, $id );
                        };
                    };

                };

                $id_for_delete = [];
                $models = GridEvents::where( 'company_id', '=', $company_id )->where( 'day_num', '=', $dayNum_ )->get();
                foreach( $models as $item ){
                    if( in_array( $item->id, $id_participants )){

                    }else{
                        array_push( $id_for_delete, $item->id );
                    };

                };

                for( $i = 0; $i < count( $id_for_delete ); $i++ ){
                    $modelDel = GridEvents::find($id_for_delete[ $i ]);
                    $modelDel->delete();
                };

                $result[ 'list' ] = $this->GetGridEventsList( $companyAlias );


            };
        };


        return $result;
        
    }

}


?>

