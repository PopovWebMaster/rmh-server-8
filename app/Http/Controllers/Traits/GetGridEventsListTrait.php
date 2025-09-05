<?php 

namespace App\Http\Controllers\Traits;

use App\Models\GridEvents;
use App\Models\Company;
use App\Models\Events;

use App\Http\Controllers\Page\AirLayout\Traits\GetOneGridEventItemFromModelTrait;


trait GetGridEventsListTrait{

    use GetOneGridEventItemFromModelTrait;

    public function GetGridEventsList( $companyAlias ){

        $company = Company::where( 'alias', '=', $companyAlias )->first();
        $company_id = $company->id;

        $gridEvents = GridEvents::where( 'company_id', '=', $company_id )->get();

        $day_0 = [];
        $day_1 = [];
        $day_2 = [];
        $day_3 = [];
        $day_4 = [];
        $day_5 = [];
        $day_6 = [];

        foreach( $gridEvents as $model ){

            $event = Events::find( $model->event_id );
            if( $event === null ){
                $model->delete();
            }else{
                // $item = [
                //     'id' =>             $model->id,
                //     'dayNum' =>         $model->day_num,
                //     'firstSegmentId' => $model->first_segment_id,
                //     'startTime' =>      $model->start_time,
                //     'durationTime' =>   $model->duration_time,
                //     'notes' =>          $model->notes === null? '': $model->notes,
                //     'eventId' =>        $model->event_id,
                //     'pushIt' =>         $model->push_it,
                //     'cutPart' =>        $model->cut_part,
                //     'is_premiere' =>    ( bool ) $model->is_premiere,
                //     'isKeyPoint' =>     ( bool ) $model->is_a_key_point,
                // ];

                $item = $this->GetOneGridEventItemFromModel( $model );

                if( $item[ 'dayNum' ] === 0 ){
                    array_push( $day_0, $item );
                }else if( $item[ 'dayNum' ] === 1 ){
                    array_push( $day_1, $item );
                }else if( $item[ 'dayNum' ] === 2 ){
                    array_push( $day_2, $item );
                }else if( $item[ 'dayNum' ] === 3 ){
                    array_push( $day_3, $item );
                }else if( $item[ 'dayNum' ] === 4 ){
                    array_push( $day_4, $item );
                }else if( $item[ 'dayNum' ] === 5 ){
                    array_push( $day_5, $item );
                }else if( $item[ 'dayNum' ] === 6 ){
                    array_push( $day_6, $item );
                };
            }



            

        };

        usort( $day_0, function( $val1, $val2 ){
            if ( $val1['startTime'] == $val2['startTime'] ){
                return 0;
            }else{
                return ( $val1['startTime'] > $val2['startTime'] ) ? 1 : -1;
            };
        } );
        usort( $day_1, function( $val1, $val2 ){
            if ( $val1['startTime'] == $val2['startTime'] ){
                return 0;
            }else{
                return ( $val1['startTime'] > $val2['startTime'] ) ? 1 : -1;
            };
        } );
        usort( $day_2, function( $val1, $val2 ){
            if ( $val1['startTime'] == $val2['startTime'] ){
                return 0;
            }else{
                return ( $val1['startTime'] > $val2['startTime'] ) ? 1 : -1;
            };
        } );
        usort( $day_3, function( $val1, $val2 ){
            if ( $val1['startTime'] == $val2['startTime'] ){
                return 0;
            }else{
                return ( $val1['startTime'] > $val2['startTime'] ) ? 1 : -1;
            };
        } );
        usort( $day_4, function( $val1, $val2 ){
            if ( $val1['startTime'] == $val2['startTime'] ){
                return 0;
            }else{
                return ( $val1['startTime'] > $val2['startTime'] ) ? 1 : -1;
            };
        } );
        usort( $day_5, function( $val1, $val2 ){
            if ( $val1['startTime'] == $val2['startTime'] ){
                return 0;
            }else{
                return ( $val1['startTime'] > $val2['startTime'] ) ? 1 : -1;
            };
        } );
        usort( $day_6, function( $val1, $val2 ){
            if ( $val1['startTime'] == $val2['startTime'] ){
                return 0;
            }else{
                return ( $val1['startTime'] > $val2['startTime'] ) ? 1 : -1;
            };
        } );
        
        $list = [ $day_0, $day_1, $day_2, $day_3, $day_4, $day_5, $day_6 ];

        return $list;
        
    }

}


?>

