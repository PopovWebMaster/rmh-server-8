<?php 

namespace App\Http\Controllers\Traits\Validate;

use App\Http\Controllers\Traits\Validate\ValidateOneGridEventTrait;

use Validator;
use Illuminate\Validation\Rule;

trait ValidateGridEventListTrait{

    use ValidateOneGridEventTrait;

    public function ValidateGridEventList( $params ){

        $result = [
            'fails' => false,
            'message' => [],
        ];

        $list =         $params[ 'list' ];
        $company_id =   $params[ 'company_id' ];

        if( is_array( $list ) ){
            if( count( $list ) === 7 ){

                for( $day_num = 0; $day_num < count( $list ); $day_num++ ){
                    for( $i = 0; $i < count( $list[ $day_num ]); $i++ ){
                        $validate = $this->ValidateOneGridEvent( $list[ $day_num ][ $i ] );
                        if( $validate[ 'fails' ] ){
                            $result[ 'fails' ] = true;
                            for( $error_i = 0; $error_i < count( $validate[ 'message' ] ); $error_i++ ){
                                $str = $validate[ 'message' ][ $error_i ].' DAY - '.$day_num.', INDEX - '.$i;
                                array_push( $result[ 'message' ], $str );
                            };
                        };
                    };
                };

            }else{
                $result[ 'message' ] = 'Список не является валидным массивом';
            };
        }else{
            $result[ 'message' ] = 'Список не является массивом';
        };

        return $result;
        
    }

}


?>
